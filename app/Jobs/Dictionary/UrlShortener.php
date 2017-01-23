<?php

/**
 * Glosarium adalah aplikasi berbasis web yang menyediakan berbagai kata glosarium,
 * kamus nasional dan kamus bahasa daerah.
 *
 * @author Yugo <dedy.yugo.purwanto@gmail.com>
 * @copyright Glosarium - 2017
 * @link https://github.com/glosarium/glosarium
 */

namespace App\Jobs\Dictionary;

use App\Dictionary\Word;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class UrlShortener implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    private $word;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Word $word)
    {
        $this->word = $word;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $client = new \GuzzleHttp\Client([
            'base_uri' => $url = config('services.gsid.url'),
        ]);

        $request = $client->request('POST', $segments = 'api/url/create', [
            'timeout'     => 5,
            'form_params' => [
                'id'       => $this->word->id,
                'long_url' => route('dictionary.national.index', [$this->word->slug]),
            ],
        ]);

        if ($request->getStatusCode() != 200) {
            \Log::error('Failed to fetch url ' . $url . $segments);
            return false;
        }

        $response = json_decode((string) $request->getBody());

        if (!$response->isSuccess) {
            \Log::debug(sprintf('Failed to create short url: "%s".', $response->data->message));
        }

        $this->word->url = $response->data->url;
        $this->word->save();
    }
}
