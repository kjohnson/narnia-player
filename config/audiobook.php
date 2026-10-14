<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Series Details
    |--------------------------------------------------------------------------
    */

    'series' => 'The Chronicles of Narnia',

    'author' => 'C. S. Lewis',

    'narrator' => 'Dr. Chrissi Hart',

    'source' => 'https://www.ancientfaith.com/podcasts/grapevine',

    /*
    |--------------------------------------------------------------------------
    | Audio Location
    |--------------------------------------------------------------------------
    |
    | Each book has its own folder (named after its key below) on a private
    | disk, holding its ebook and its "audio", "text" and "transcripts"
    | folders. Nothing is served from a public URL. On the local disk audio
    | is streamed through a signed route; on S3-compatible object storage
    | (e.g. a private Laravel Cloud bucket) listeners are redirected to a
    | short-lived pre-signed URL.
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
    | Books
    |--------------------------------------------------------------------------
    |
    | In reading order. The key names the book's folder and appears in its
    | URLs. Chapters were cut from the Readings from Under the Grapevine
    | episodes in the podcast feed at http://feeds.ancientfaith.com/grapevine,
    | without the podcast's intros and sign-offs.
    |
    | Running "php artisan audiobook:sync" matches each chapter's text in the
    | ebook against a WhisperX transcript of its audio (in "transcripts") and
    | writes word timings to the "text" folder, which the player reads.
    | Chapters are found in the ebook by their "Chapter N" title. These
    | ebooks number chapters in Roman numerals, so each chapter points at its
    | file with an "epub" key instead.
    |
    | Durations are in seconds, so the chapter list can show lengths before
    | any audio has been loaded. Get them with:
    | ffprobe -v error -show_entries format=duration -of csv=p=0 file.mp3
    |
    */

    'books' => [
        'the-lion-the-witch-and-the-wardrobe' => [
            'title' => 'The Lion, the Witch and the Wardrobe',
            'cover' => 'images/the-lion-the-witch-and-the-wardrobe.jpg',
            'cover_description' => 'A lamp-post glowing in a snowy wood',
            'ebook' => 'lewis-lion-the-witch-and-the-wardrobe.epub',
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
                ],            ],
        ],
        'prince-caspian' => [
            'title' => 'Prince Caspian',
            'cover' => 'images/prince-caspian.jpg',
            'cover_description' => 'The moonlit ruins of a castle on a wooded island',
            'ebook' => 'lewis-prince-caspian.epub',
            'chapters' => [
                [
                    'title' => 'The Island',
                    'file' => 'chapter-01-the-island.mp3',
                    'epub' => 'ch01.xhtml',
                    'duration' => 999.02,
                ],
                [
                    'title' => 'The Ancient Treasure House',
                    'file' => 'chapter-02-the-ancient-treasure-house.mp3',
                    'epub' => 'ch02.xhtml',
                    'duration' => 1251.67,
                ],
                [
                    'title' => 'The Dwarf',
                    'file' => 'chapter-03-the-dwarf.mp3',
                    'epub' => 'ch03.xhtml',
                    'duration' => 916.87,
                ],
                [
                    'title' => 'The Dwarf Tells of Prince Caspian',
                    'file' => 'chapter-04-the-dwarf-tells-of-prince-caspian.mp3',
                    'epub' => 'ch04.xhtml',
                    'duration' => 1482.89,
                ],
                [
                    'title' => 'Caspian’s Adventure in the Mountains',
                    'file' => 'chapter-05-caspians-adventure-in-the-mountains.mp3',
                    'epub' => 'ch05.xhtml',
                    'duration' => 1592.23,
                ],
                [
                    'title' => 'The People That Lived in Hiding',
                    'file' => 'chapter-06-the-people-that-lived-in-hiding.mp3',
                    'epub' => 'ch06.xhtml',
                    'duration' => 1091.11,
                ],
                [
                    'title' => 'Old Narnia in Danger',
                    'file' => 'chapter-07-old-narnia-in-danger.mp3',
                    'epub' => 'ch07.xhtml',
                    'duration' => 1321.01,
                ],
                [
                    'title' => 'How They Left the Island',
                    'file' => 'chapter-08-how-they-left-the-island.mp3',
                    'epub' => 'ch08.xhtml',
                    'duration' => 1348.92,
                ],
                [
                    'title' => 'What Lucy Saw',
                    'file' => 'chapter-09-what-lucy-saw.mp3',
                    'epub' => 'ch09.xhtml',
                    'duration' => 1422.89,
                ],
                [
                    'title' => 'The Return of the Lion',
                    'file' => 'chapter-10-the-return-of-the-lion.mp3',
                    'epub' => 'ch10.xhtml',
                    'duration' => 1569.77,
                ],
                [
                    'title' => 'The Lion Roars',
                    'file' => 'chapter-11-the-lion-roars.mp3',
                    'epub' => 'ch11.xhtml',
                    'duration' => 1392.50,
                ],
                [
                    'title' => 'Sorcery and Sudden Vengeance',
                    'file' => 'chapter-12-sorcery-and-sudden-vengeance.mp3',
                    'epub' => 'ch12.xhtml',
                    'duration' => 1341.14,
                ],
                [
                    'title' => 'The High King in Command',
                    'file' => 'chapter-13-the-high-king-in-command.mp3',
                    'epub' => 'ch13.xhtml',
                    'duration' => 1128.82,
                ],
                [
                    'title' => 'How All Were Very Busy',
                    'file' => 'chapter-14-how-all-were-very-busy.mp3',
                    'epub' => 'ch14.xhtml',
                    'duration' => 1545.82,
                ],
                [
                    'title' => 'Aslan Makes a Door in the Air',
                    'file' => 'chapter-15-aslan-makes-a-door-in-the-air.mp3',
                    'epub' => 'ch15.xhtml',
                    'duration' => 1840.32,
                ],
            ],
        ],
    ],

];
