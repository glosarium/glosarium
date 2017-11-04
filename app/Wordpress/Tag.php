<?php
namespace App\Wordpress;

class Tag extends Wordpress
{
    public function all()
    {
        $response = $this->client->get('wp-json/wp/v2/tags');
        if ($response->getStatusCode() === 200)
            {
            return json_decode((string)$response->getBody());
        }
    }
}