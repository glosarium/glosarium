<?php
namespace App\Wordpress;

use Cache;
use Carbon\Carbon;

class Blog extends Wordpress
{
    /**
     * Get basic info of blog.
     *
     * @return object|null
     */
    public function info() : ? \stdClass
    {
        $client = $this->client;

        return Cache::remember('blog.info', Carbon::now()->addMonth(), function () use ($client) {
            $response = $client->get('wp-json');
            if ($response->getStatusCode() === 200) {
                return json_decode((string)$response->getBody());
            }
        });
    }
}