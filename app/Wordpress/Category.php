<?php
namespace App\Wordpress;

use GuzzleHttp\Client;

class Category extends Wordpress
{
    /**
     * Get all categories.
     *
     * @return array|null
     */
    public function all() : ? array
    {
        $response = $this->client->get('wp-json/wp/v2/categories');
        if ($response->getStatusCode() === 200) {
            return json_decode((string)$response->getBody());
        }

        return null;
    }
}