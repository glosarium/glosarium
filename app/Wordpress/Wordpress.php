<?php
namespace App\Wordpress;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;

class Wordpress
{
    /**
     * Guzzle client object.
     *
     * @var object
     */
    protected $client;

    /**
     * Default endpoint.
     *
     * @var string
     */
    protected $host;

    public function __construct()
    {
        $this->host = config('services.blog.url');

        $this->client = new Client([
            'base_uri' => $this->host
        ]);
    }

    /**
     * Parse response object from guzzle to decoded json.
     *
     * @param Response $response
     * @return void
     */
    protected function parse(Response $response)
    {
        if ($response->getReasonPhrase() == 'OK') {
            return json_decode((string)$response->getBody());
        }

        return null;
    }
}