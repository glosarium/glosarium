<?php

/**
 * Glosarium adalah aplikasi berbasis web yang menyediakan berbagai kata glosarium,
 * kamus nasional dan kamus bahasa daerah.
 *
 * @author Yugo <dedy.yugo.purwanto@gmail.com>
 * @copyright Glosarium - 2017 *
 *
 * @link https://github.com/glosarium/glosarium
 */

namespace App\Libraries;

use GuzzleHttp\Client;

class Wikipedia
{
    /**
     * Base api url
     *
     * @var string
     */
    private $url = 'https://%s.wikipedia.org/w/api.php';

    /**
     * Guzzle instance
     *
     * @var object
     */
    private $client;

    /**
     * Limit return
     *
     * @var integer
     */
    private $limit = 1;

    public function __construct()
    {
        $this->url = sprintf($this->url, config('app.locale'));

        $this->client = new Client([
            'base_uri' => $this->url,
        ]);
    }

    public function openSearch($keywords = null)
    {
        if (is_array($keywords)) {
            $keywords = implode('|', $keywords);
        }

        $response = $this->client->request('GET', '', [
            'query' => [
                'format'    => 'json',
                'limit'     => $this->limit,
                'search'    => $keywords,
                'redirects' => 'resolve',
                'action'    => 'opensearch',
            ],
        ]);

        if ($response->getStatusCode() == 200) {
            $contents = json_decode((string) $response->getBody());

            $pages = [];
            foreach ($contents as $index => $content) {
                if (is_array($content)) {
                    foreach ($content as $page) {
                        $pages[$index][] = $page;
                    }
                }
            }

            return $pages;
        }

        return null;
    }
}
