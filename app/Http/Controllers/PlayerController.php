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
                'cover' => asset($book['cover']),
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
}
