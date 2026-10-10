# The Lion, the Witch and the Wardrobe — Audiobook Player

A mobile-first Laravel site for listening to *The Lion, the Witch and the Wardrobe* by C. S. Lewis, read by
Dr. Chrissi Hart on [Readings from Under the Grapevine](https://www.ancientfaith.com/podcasts/grapevine)
(Ancient Faith Ministries, who read the Chronicles with permission from C.S. Lewis Pte. Ltd.).

- Chapter list with per-chapter progress
- Resume where you left off (saved in the browser's localStorage)
- Back 15s / forward 30s
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

## Audio

The chapters were cut from the "Narnia - The Lion, the Witch, and the Wardrobe" episodes in the podcast feed
at <http://feeds.ancientfaith.com/grapevine>, with the podcast's intro and sign-off trimmed. They live in
`storage/app/private/audio/`, and each has an entry in `chapters` in `config/audiobook.php` with its title,
file, ebook file (`epub`), and duration in seconds:

```sh
ffprobe -v error -show_entries format=duration -of csv=p=0 storage/app/private/audio/chapter-01-lucy-looks-into-a-wardrobe.mp3
```

## Follow-along text

The ebook is `storage/app/private/lewis-lion-the-witch-and-the-wardrobe.epub`. Put a WhisperX JSON transcript
of each chapter in `storage/app/private/transcripts/`, named after its MP3, and run `php artisan audiobook:sync`:

```sh
cd storage/app/private
whisperx audio/chapter-*.mp3 --model small.en --language en --output_format json --output_dir transcripts
php artisan audiobook:sync
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

   This copies `audio/*.mp3` and `text/*.json` from local storage into the same folders in the bucket,
   skipping files that are already uploaded unchanged. Run it again after re-running `audiobook:sync`.
   The player checks for new text every 5 minutes.

The player only receives signed links (`/audio/{chapter}?expires=…&signature=…`) that expire after
`AUDIOBOOK_URL_LIFETIME` minutes (default 360), are rate limited, and are refused when opened directly in
a browser tab or embedded on another site. On the bucket, those links redirect to short-lived pre-signed
URLs. `AUDIOBOOK_DISK` can name a disk other than the default, but isn't needed on Laravel Cloud.
