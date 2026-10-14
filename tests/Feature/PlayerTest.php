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
            ->assertViewHas('books', fn ($books) => $books->pluck('slug')->all() === ['the-lion-the-witch-and-the-wardrobe', 'prince-caspian']);
    }

    public function test_player_links_to_signed_audio_urls_instead_of_files(): void
    {
        $this->get('/')
            ->assertOk()
            ->assertDontSee('.mp3')
            ->assertViewHas('books', function ($books) {
                $url = $books->last()['chapters']->first()['url'];

                return str_starts_with($url, url('/audio/prince-caspian/1?expires='))
                    && str_contains($url, 'signature=');
            });
    }

    public function test_every_configured_chapter_file_exists(): void
    {
        $disk = Storage::disk(config('audiobook.disk'));

        foreach (config('audiobook.books') as $book => $details) {
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
        foreach (config('audiobook.books') as $book => $details) {
            $this->assertFileDoesNotExist(public_path("audio/{$details['chapters'][0]['file']}"));
            $this->assertFileDoesNotExist(public_path("{$book}/audio/{$details['chapters'][0]['file']}"));
        }
    }
}
