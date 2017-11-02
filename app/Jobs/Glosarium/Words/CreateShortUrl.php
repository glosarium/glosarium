<?php
namespace App\Jobs\Glosarium\Words;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Glosarium\Word;
use GuzzleHttp\Client;

class CreateShortUrl implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

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
        $client = new Client([
            'base_uri' => config('services.google_url_shortener.url')
        ]);


        $response = $client->post('v1/url', [
            'headers' => [
                'Content-Type' => 'application/json'
            ],
            'query' => [
                'key' => config('services.google_url_shortener.key')
            ],
            'json' => [
                'longUrl' => sprintf(
                    'https://www.glosarium.web.id/%s/%s',
                    $this->word->category->slug,
                    $this->word->slug
                )
            ]
        ]);

        if ($response->getStatusCode() === 200) {
            $body = json_decode((string)$response->getBody());

            if (!empty($body->id)) {
                $this->word->short_url = $body->id;
                $this->word->save();
            }
        }
    }
}
