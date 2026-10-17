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
    | without the podcast's intros and sign-offs. A book with no chapters yet
    | is shown as coming soon, listing its "upcoming_chapters" titles.
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
                    'duration' => 996.89,
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
        'the-voyage-of-the-dawn-treader' => [
            'title' => 'The Voyage of the Dawn Treader',
            'cover' => 'images/the-voyage-of-the-dawn-treader.jpg',
            'cover_description' => 'A dragon-prowed ship under sail on a moonlit sea',
            'ebook' => 'lewis-voyage-of-the-dawn-treader.epub',
            'chapters' => [
                [
                    'title' => 'The Picture in the Bedroom',
                    'file' => 'chapter-01-the-picture-in-the-bedroom.mp3',
                    'epub' => 'ch01.xhtml',
                    'duration' => 1463.98,
                ],
                [
                    'title' => 'On Board the Dawn Treader',
                    'file' => 'chapter-02-on-board-the-dawn-treader.mp3',
                    'epub' => 'ch02.xhtml',
                    'duration' => 1576.90,
                ],
                [
                    'title' => 'The Lone Islands',
                    'file' => 'chapter-03-the-lone-islands.mp3',
                    'epub' => 'ch03.xhtml',
                    'duration' => 1279.37,
                ],
                [
                    'title' => 'What Caspian Did There',
                    'file' => 'chapter-04-what-caspian-did-there.mp3',
                    'epub' => 'ch04.xhtml',
                    'duration' => 1296.43,
                ],
                [
                    'title' => 'The Storm and What Came of It',
                    'file' => 'chapter-05-the-storm-and-what-came-of-it.mp3',
                    'epub' => 'ch05.xhtml',
                    'duration' => 1506.74,
                ],
                [
                    'title' => 'The Adventures of Eustace',
                    'file' => 'chapter-06-the-adventures-of-eustace.mp3',
                    'epub' => 'ch06.xhtml',
                    'duration' => 1607.86,
                ],
                [
                    'title' => 'How the Adventure Ended',
                    'file' => 'chapter-07-how-the-adventure-ended.mp3',
                    'epub' => 'ch07.xhtml',
                    'duration' => 1403.76,
                ],
                [
                    'title' => 'Two Narrow Escapes',
                    'file' => 'chapter-08-two-narrow-escapes.mp3',
                    'epub' => 'ch08.xhtml',
                    'duration' => 1612.10,
                ],
                [
                    'title' => 'The Island of the Voices',
                    'file' => 'chapter-09-the-island-of-the-voices.mp3',
                    'epub' => 'ch09.xhtml',
                    'duration' => 1412.54,
                ],
                [
                    'title' => 'The Magician’s Book',
                    'file' => 'chapter-10-the-magicians-book.mp3',
                    'epub' => 'ch10.xhtml',
                    'duration' => 1499.57,
                ],
                [
                    'title' => 'The Dufflepuds Made Happy',
                    'file' => 'chapter-11-the-dufflepuds-made-happy.mp3',
                    'epub' => 'ch11.xhtml',
                    'duration' => 1354.90,
                ],
                [
                    'title' => 'The Dark Island',
                    'file' => 'chapter-12-the-dark-island.mp3',
                    'epub' => 'ch12.xhtml',
                    'duration' => 1309.44,
                ],
                [
                    'title' => 'The Three Sleepers',
                    'file' => 'chapter-13-the-three-sleepers.mp3',
                    'epub' => 'ch13.xhtml',
                    'duration' => 1327.25,
                ],
                [
                    'title' => 'The Beginning of the End of the World',
                    'file' => 'chapter-14-the-beginning-of-the-end-of-the-world.mp3',
                    'epub' => 'ch14.xhtml',
                    'duration' => 1252.51,
                ],
                [
                    'title' => 'The Wonders of the Last Sea',
                    'file' => 'chapter-15-the-wonders-of-the-last-sea.mp3',
                    'epub' => 'ch15.xhtml',
                    'duration' => 1372.68,
                ],
                [
                    'title' => 'The Very End of the World',
                    'file' => 'chapter-16-the-very-end-of-the-world.mp3',
                    'epub' => 'ch16.xhtml',
                    'duration' => 1647.38,
                ],
            ],
        ],
        'the-silver-chair' => [
            'title' => 'The Silver Chair',
            'cover' => 'images/the-silver-chair.jpg',
            'cover_description' => 'A silver chair glowing in a dark cavern',
            'ebook' => 'lewis-silver-chair.epub',
            'upcoming_chapters' => [
                'Behind the Gym',
                'Jill Is Given a Task',
                'The Sailing of the King',
                'A Parliament of Owls',
                'Puddleglum',
                'The Wild Waste Lands of the North',
                'The Hill of the Strange Trenches',
                'The House of Harfang',
                'How They Discovered Something Worth Knowing',
                'Travels without the Sun',
                'In the Dark Castle',
                'The Queen of Underland',
                'Underland without the Queen',
                'The Bottom of the World',
                'The Disappearance of Jill',
                'The Healing of Harms',
            ],
            'chapters' => [],
        ],
        'the-horse-and-his-boy' => [
            'title' => 'The Horse and His Boy',
            'cover' => 'images/the-horse-and-his-boy.jpg',
            'cover_description' => 'A horse and rider crossing the desert towards a domed city under a crescent moon',
            'ebook' => 'lewis-horse-and-his-boy.epub',
            'upcoming_chapters' => [
                'How Shasta Set Out on His Travels',
                'A Wayside Adventure',
                'At the Gates of Tashbaan',
                'Shasta Falls In with the Narnians',
                'Prince Corin',
                'Shasta among the Tombs',
                'Aravis in Tashbaan',
                'In the House of the Tisroc',
                'Across the Desert',
                'The Hermit of the Southern March',
                'The Unwelcome Fellow Traveller',
                'Shasta in Narnia',
                'The Fight at Anvard',
                'How Bree Became a Wiser Horse',
                'Rabadash the Ridiculous',
            ],
            'chapters' => [],
        ],
        'the-magicians-nephew' => [
            'title' => 'The Magician’s Nephew',
            'cover' => 'images/the-magicians-nephew.jpg',
            'cover_description' => 'A tree of glowing apples on a hill under the stars',
            'ebook' => 'lewis-magician-s-nephew.epub',
            'upcoming_chapters' => [
                'The Wrong Door',
                'Digory and His Uncle',
                'The Wood between the Worlds',
                'The Bell and the Hammer',
                'The Deplorable Word',
                'The Beginning of Uncle Andrew’s Troubles',
                'What Happened at the Front Door',
                'The Fight at the Lamp-Post',
                'The Founding of Narnia',
                'The First Joke and Other Matters',
                'Digory and His Uncle Are Both in Trouble',
                'Strawberry’s Adventure',
                'An Unexpected Meeting',
                'The Planting of the Tree',
                'The End of This Story and the Beginning of All the Others',
            ],
            'chapters' => [],
        ],
        'the-last-battle' => [
            'title' => 'The Last Battle',
            'cover' => 'images/the-last-battle.jpg',
            'cover_description' => 'A stable on a hill at night, with light pouring through its door',
            'ebook' => 'lewis-last-battle.epub',
            'upcoming_chapters' => [
                'By Caldron Pool',
                'The Rashness of the King',
                'The Ape in Its Glory',
                'What Happened That Night',
                'How Help Came to the King',
                'A Good Night’s Work',
                'Mainly about Dwarfs',
                'What News the Eagle Brought',
                'The Great Meeting on Stable Hill',
                'Who Will Go into the Stable?',
                'The Pace Quickens',
                'Through the Stable Door',
                'How the Dwarfs Refused to Be Taken In',
                'Night Falls on Narnia',
                'Further Up and Further In',
                'Farewell to Shadow-Lands',
            ],
            'chapters' => [],
        ],
    ],

];
