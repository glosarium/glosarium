<?php
namespace App\Jobs\Glosarium\Categories;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class CreateShortUrl implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Category object.
     *
     * @var Category
     */
    private $category;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(\App\Glosarium\Category $category)
    {
        $this->category = $category;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $client = new \GuzzleHttp\Client([
            'base_uri' => config('services.google_url_shortener.url')
        ]);

        $response = $client->post('v1/url', [
            'headers' => [
                'Content-Type' => 'application/json'
            ],
            'query' => ['key' => config('services.google_url_shortener.key')],
            'json' => [
                'longUrl' => sprintf('https://www.glosarium.web.id/kategori/%s', $this->category->slug)
            ],
        ]);

        if ($response->getStatusCode() === 200) {
            $body = json_decode((string)$response->getBody());

            if (!empty($body->id)) {
                $this->category->short_url = $body->id;
                $this->category->save();

                \Cache::forget($this->category->slug);
            }
        }
    }
}
