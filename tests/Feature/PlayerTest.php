<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class PlayerTest extends TestCase
{
    public function test_player_lists_every_chapter(): void
    {
        $response = $this->get('/');

        $response->assertOk()
            ->assertSee('The Lion, the Witch and the Wardrobe')
            ->assertSee('Lucy Looks into a Wardrobe')
            ->assertSee('Turkish Delight')
            ->assertSee('A Day with the Beavers')
            ->assertSee('Deeper Magic from Before the Dawn of Time')
            ->assertSee('The Hunting of the White Stag');
    }

    public function test_player_lists_every_book_in_reading_order(): void
    {
        $this->get('/')
            ->assertOk()
            ->assertSeeInOrder(['The Lion, the Witch and the Wardrobe', 'Prince Caspian'])
            ->assertSee('The Island')
            ->assertSee('Aslan Makes a Door in the Air')
            ->assertViewHas('books', fn ($books) => $books->pluck('slug')->all() === array_keys(config('audiobook.books'))
                && $books->pluck('slug')->take(2)->all() === ['the-lion-the-witch-and-the-wardrobe', 'prince-caspian']);
    }

    public function test_books_without_chapters_are_listed_as_coming_soon(): void
    {
        config(['audiobook.books.the-silver-chair' => [
            'title' => 'The Silver Chair',
            'cover' => 'images/the-silver-chair.jpg',
            'cover_description' => 'A silver chair glowing in a dark cavern',
            'ebook' => 'lewis-silver-chair.epub',
            'upcoming_chapters' => ['Behind the Gym', 'Jill Is Given a Task'],
            'chapters' => [],
        ]]);

        $this->get('/')
            ->assertOk()
            ->assertSee('images/the-silver-chair.jpg')
            ->assertSee('The Silver Chair chapters, coming soon')
            ->assertSeeInOrder(['Behind the Gym', 'Jill Is Given a Task'])
            ->assertDontSee('data-book="the-silver-chair"', false);
    }

    public function test_each_chapter_has_an_options_menu_for_its_progress(): void
    {
        config(['audiobook.books.the-silver-chair' => [
            'title' => 'The Silver Chair',
            'cover' => 'images/the-silver-chair.jpg',
            'cover_description' => 'A silver chair glowing in a dark cavern',
            'ebook' => 'lewis-silver-chair.epub',
            'upcoming_chapters' => ['Behind the Gym'],
            'chapters' => [],
        ]]);

        $response = $this->get('/')->assertOk();
        $chapterCount = collect(config('audiobook.books'))->sum(fn (array $book): int => count($book['chapters']));

        $this->assertSame($chapterCount, substr_count($response->getContent(), 'data-chapter-options='));
        $this->assertSame($chapterCount, substr_count($response->getContent(), 'data-action="reset-progress"'));
        $response->assertSeeInOrder(['aria-label="Options for Lucy Looks into a Wardrobe"', 'id="actions-the-lion-the-witch-and-the-wardrobe-0"', 'Reset progress'], false)
            ->assertSee('aria-controls="actions-prince-caspian-0"', false)
            ->assertDontSee('data-options-book="the-silver-chair"', false);
    }

    public function test_player_links_to_signed_audio_urls_instead_of_files(): void
    {
        $this->get('/')
            ->assertOk()
            ->assertDontSee('.mp3')
            ->assertViewHas('books', function ($books) {
                $url = $books->firstWhere('slug', 'prince-caspian')['chapters']->first()['url'];

                return str_starts_with($url, url('/audio/prince-caspian/1?expires='))
                    && str_contains($url, 'signature=');
            });
    }

    public function test_every_configured_chapter_file_exists(): void
    {
        $disk = Storage::disk(config('audiobook.disk'));

        foreach (config('audiobook.books') as $book => $details) {
            if ($details['chapters'] === []) {
                continue;
            }

            if ($disk->files("{$book}/audio") === []) {
                $this->markTestSkipped("The audio is not in the repo; add it to storage/app/private/{$book}/audio to check it.");
            }

            foreach ($details['chapters'] as $chapter) {
                $this->assertTrue($disk->exists("{$book}/audio/{$chapter['file']}"), "Missing {$book}/audio/{$chapter['file']}");
            }
        }
    }

    public function test_audio_files_are_not_publicly_accessible(): void
    {
        foreach (array_filter(config('audiobook.books'), fn (array $details) => $details['chapters'] !== []) as $book => $details) {
            $this->assertFileDoesNotExist(public_path("audio/{$details['chapters'][0]['file']}"));
            $this->assertFileDoesNotExist(public_path("{$book}/audio/{$details['chapters'][0]['file']}"));
        }
    }
}
