<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Book Details
    |--------------------------------------------------------------------------
    */

    'title' => 'The Lion, the Witch and the Wardrobe',

    'author' => 'C. S. Lewis',

    'narrator' => 'Dr. Chrissi Hart',

    'cover' => 'images/cover.jpg',

    'series' => 'The Chronicles of Narnia',

    'source' => 'https://www.ancientfaith.com/podcasts/grapevine',

    /*
    |--------------------------------------------------------------------------
    | Audio Location
    |--------------------------------------------------------------------------
    |
    | Chapters live in the "audio" folder of a private disk and are never
    | served from a public URL. On the local disk they're streamed through a
    | signed route; on S3-compatible object storage (e.g. a private Laravel
    | Cloud bucket) listeners are redirected to a short-lived pre-signed URL.
    |
    | Leave AUDIOBOOK_DISK unset to use the default disk: "local" here, and
    | the bucket attached as the default disk on Laravel Cloud.
    |
    | Signed player URLs expire after "url_lifetime" minutes. The player
    | fetches a fresh one automatically if a listener comes back later.
    |
    */

    'disk' => env('AUDIOBOOK_DISK'),

    'url_lifetime' => (int) env('AUDIOBOOK_URL_LIFETIME', 360),

    /*
    |--------------------------------------------------------------------------
    | Follow-Along Text
    |--------------------------------------------------------------------------
    |
    | The ebook lives on the same private disk as the audio. Running
    | "php artisan audiobook:sync" matches each chapter's text in the ebook
    | against a WhisperX transcript of its audio (in "transcripts") and
    | writes word timings to the "text" folder, which the player reads.
    |
    | Chapters are found in the ebook by their "Chapter N" title. This ebook
    | numbers chapters in Roman numerals, so each chapter below points at
    | its file with an "epub" key instead.
    |
    */

    'ebook' => env('AUDIOBOOK_EBOOK', 'lewis-lion-the-witch-and-the-wardrobe.epub'),

    /*
    |--------------------------------------------------------------------------
    | Chapters
    |--------------------------------------------------------------------------
    |
    | Cut from the Readings from Under the Grapevine episodes in the podcast
    | feed at http://feeds.ancientfaith.com/grapevine, without the podcast's
    | intros and sign-offs. "epub" is the chapter's file in the ebook.
    |
    | Durations are in seconds, so the chapter list can show lengths before
    | any audio has been loaded. Get them with:
    | ffprobe -v error -show_entries format=duration -of csv=p=0 file.mp3
    |
    */

    'chapters' => [
        [
            'title' => 'Lucy Looks into a Wardrobe',
            'file' => 'chapter-01-lucy-looks-into-a-wardrobe.mp3',
            'epub' => 'ch01.xhtml',
            'duration' => 636.12,
        ],
        [
            'title' => 'What Lucy Found There',
            'file' => 'chapter-02-what-lucy-found-there.mp3',
            'epub' => 'ch02.xhtml',
            'duration' => 890.74,
        ],
        [
            'title' => 'Edmund and the Wardrobe',
            'file' => 'chapter-03-edmund-and-the-wardrobe.mp3',
            'epub' => 'ch03.xhtml',
            'duration' => 751.13,
        ],
        [
            'title' => 'Turkish Delight',
            'file' => 'chapter-04-turkish-delight.mp3',
            'epub' => 'ch04.xhtml',
            'duration' => 889.32,
        ],
        [
            'title' => 'Back on This Side of the Door',
            'file' => 'chapter-05-back-on-this-side-of-the-door.mp3',
            'epub' => 'ch05.xhtml',
            'duration' => 811.51,
        ],
        [
            'title' => 'Into the Forest',
            'file' => 'chapter-06-into-the-forest.mp3',
            'epub' => 'ch06.xhtml',
            'duration' => 724.46,
        ],
        [
            'title' => 'A Day with the Beavers',
            'file' => 'chapter-07-a-day-with-the-beavers.mp3',
            'epub' => 'ch07.xhtml',
            'duration' => 1000.94,
        ],
        [
            'title' => 'What Happened after Dinner',
            'file' => 'chapter-08-what-happened-after-dinner.mp3',
            'epub' => 'ch08.xhtml',
            'duration' => 916.10,
        ],
        [
            'title' => 'In the Witch’s House',
            'file' => 'chapter-09-in-the-witchs-house.mp3',
            'epub' => 'ch09.xhtml',
            'duration' => 1027.51,
        ],
        [
            'title' => 'The Spell Begins to Break',
            'file' => 'chapter-10-the-spell-begins-to-break.mp3',
            'epub' => 'ch10.xhtml',
            'duration' => 973.49,
        ],
        [
            'title' => 'Aslan Is Nearer',
            'file' => 'chapter-11-aslan-is-nearer.mp3',
            'epub' => 'ch11.xhtml',
            'duration' => 1019.45,
        ],
        [
            'title' => 'Peter’s First Battle',
            'file' => 'chapter-12-peters-first-battle.mp3',
            'epub' => 'ch12.xhtml',
            'duration' => 951.22,
        ],
        [
            'title' => 'Deep Magic from the Dawn of Time',
            'file' => 'chapter-13-deep-magic-from-the-dawn-of-time.mp3',
            'epub' => 'ch13.xhtml',
            'duration' => 951.67,
        ],
        [
            'title' => 'The Triumph of the Witch',
            'file' => 'chapter-14-the-triumph-of-the-witch.mp3',
            'epub' => 'ch14.xhtml',
            'duration' => 1009.75,
        ],
        [
            'title' => 'Deeper Magic from Before the Dawn of Time',
            'file' => 'chapter-15-deeper-magic-from-before-the-dawn-of-time.mp3',
            'epub' => 'ch15.xhtml',
            'duration' => 1098.12,
        ],
        [
            'title' => 'What Happened about the Statues',
            'file' => 'chapter-16-what-happened-about-the-statues.mp3',
            'epub' => 'ch16.xhtml',
            'duration' => 1034.98,
        ],
        [
            'title' => 'The Hunting of the White Stag',
            'file' => 'chapter-17-the-hunting-of-the-white-stag.mp3',
            'epub' => 'ch17.xhtml',
            'duration' => 1071.91,
        ],
    ],

];
