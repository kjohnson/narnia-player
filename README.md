# The Chronicles of Narnia — Audiobook Player

A mobile-first Laravel site for listening to The Chronicles of Narnia by C. S. Lewis, read by
Dr. Chrissi Hart on [Readings from Under the Grapevine](https://www.ancientfaith.com/podcasts/grapevine)
(Ancient Faith Ministries, who read the Chronicles with permission from C.S. Lewis Pte. Ltd.). So far:

1. *The Lion, the Witch and the Wardrobe*
2. *Prince Caspian*
3. *The Voyage of the Dawn Treader*
4. *The Silver Chair*
5. *The Horse and His Boy*
6. *The Magician’s Nephew*
7. *The Last Battle*

- Books and chapter list with per-chapter progress; finishing a book carries on into the next
- Resume where you left off (saved in the browser's localStorage)
- Back 15s / forward 30s
- Works offline: the chapter that's playing and the next one are saved on the device automatically, and
  "Save all" in the chapters menu saves the whole book (about 120–190 MB). A service worker (`public/sw.js`)
  serves saved chapters, including seeking, and keeps the player itself available without a connection.
- Lock-screen and headphone controls via the Media Session API
- Installable to the home screen (web app manifest)

No database is required.

## Local development

```sh
composer install
npm install
cp .env.example .env && php artisan key:generate
composer run dev
```

> `php artisan serve` doesn't support HTTP range requests, so seeking in Safari/iOS only works against a real web server (Laravel Cloud, Herd, Valet, nginx).

## Adding a book

Each book has an entry in `books` in `config/audiobook.php` (in reading order) and its own folder in
`storage/app/private/`, named after its key:

```
storage/app/private/prince-caspian/
    lewis-prince-caspian.epub
    audio/chapter-01-the-island.mp3, …
    transcripts/chapter-01-the-island.json, …
    text/chapter-01.json, …              (written by audiobook:sync)
```

Its cover goes in `public/images/` (1024×1024 JPEG).

## Audio

The chapters were cut from the Narnia episodes in the podcast feed at <http://feeds.ancientfaith.com/grapevine>,
splitting episodes that read two chapters, and trimming the podcast's intro and sign-off so each chapter runs
from the narrator's "Chapter N" to its last word. Each has an entry in its book's `chapters` with its title,
file, ebook file (`epub`), and duration in seconds:

```sh
ffprobe -v error -show_entries format=duration -of csv=p=0 storage/app/private/prince-caspian/audio/chapter-01-the-island.mp3
```

## Follow-along text

Put a WhisperX JSON transcript of each chapter in the book's `transcripts/` folder, named after its MP3, and run
`php artisan audiobook:sync` (or `php artisan audiobook:sync prince-caspian` for one book):

```sh
cd storage/app/private/prince-caspian
whisperx audio/chapter-*.mp3 --model small.en --language en --output_format json --output_dir transcripts
php artisan audiobook:sync prince-caspian
```

## Deploying to Laravel Cloud

The audio, synced text, ebook, and transcripts are not in the repo (`storage/app/private` is ignored). In
production the audio and synced text are served from a private Laravel Cloud Object Storage bucket.

1. Push this repo to GitHub/GitLab/Bitbucket and create an application in Laravel Cloud.
2. Build command: `composer install --no-dev && npm ci && npm run build && php artisan optimize`
3. Deploy command: leave empty (there are no migrations to run).
4. Environment variables: `SESSION_DRIVER=cookie`, `CACHE_STORE=file` (no database needed).
5. Add a **private** Laravel Object Storage bucket to the environment and mark it as the **default disk**
   (any disk name). Redeploy so the bucket's connection is injected.
6. Upload the files. Copy one of the bucket's access keys (Organization > Resources > Object storage >
   your bucket > Access keys > View credentials) into your local `.env`:

   ```dotenv
   AWS_ACCESS_KEY_ID=…
   AWS_SECRET_ACCESS_KEY=…
   AWS_BUCKET=…
   AWS_ENDPOINT=…
   AWS_DEFAULT_REGION=auto
   ```

   Then run:

   ```sh
   php artisan audiobook:upload s3
   ```

   This copies each book's `audio/*.mp3` and `text/*.json` from local storage into the same folders in the bucket,
   skipping files that are already uploaded unchanged. Run it again after re-running `audiobook:sync`.
   The player checks for new text every 5 minutes.

The player only receives signed links (`/audio/{book}/{chapter}?expires=…&signature=…`) that expire after
`AUDIOBOOK_URL_LIFETIME` minutes (default 360), are rate limited, and are refused when opened directly in
a browser tab or embedded on another site. On the bucket, those links redirect to short-lived pre-signed
URLs. `AUDIOBOOK_DISK` can name a disk other than the default, but isn't needed on Laravel Cloud.
