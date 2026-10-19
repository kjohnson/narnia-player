<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;

class PlayerController extends Controller
{
    /**
     * Show the audiobook player.
     */
    public function __invoke(): View
    {
        $books = collect(config('audiobook.books'))
            ->map(fn (array $book, string $slug) => [
                'slug' => $slug,
                'title' => $book['title'],
                'cover' => self::versionedAsset($book['cover']),
                'coverDescription' => $book['cover_description'],
                'upcomingChapters' => $book['upcoming_chapters'] ?? [],
                'chapters' => collect($book['chapters'])
                    ->values()
                    ->map(fn (array $chapter, int $index) => [
                        'number' => $index + 1,
                        'title' => $chapter['title'],
                        'duration' => $chapter['duration'],
                        'url' => AudioController::signedUrl($slug, $index + 1),
                        'hasText' => TextController::exists($slug, $index + 1),
                    ]),
            ])
            ->values();

        return view('player', [
            'series' => [
                'title' => config('audiobook.series'),
                'author' => config('audiobook.author'),
                'narrator' => config('audiobook.narrator'),
                'source' => config('audiobook.source'),
            ],
            'books' => $books,
        ]);
    }

    /**
     * The URL of a public file, with a short hash of its contents so a
     * changed file gets a new URL. The service worker keeps images it has
     * already saved, so an unchanged URL would keep showing the old one.
     */
    private static function versionedAsset(string $path): string
    {
        $file = public_path($path);

        return is_file($file) ? asset($path).'?v='.substr(hash_file('xxh3', $file), 0, 8) : asset($path);
    }
}
