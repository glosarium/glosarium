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

use App\Wikipedia as Model;
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

    private $content;

    public function __construct()
    {
        $this->url = sprintf($this->url, config('app.locale'));

        $this->client = new Client([
            'base_uri' => $this->url,
        ]);
    }

    /**
     * Make sure we can call Wikipedia API
     */
    public function ping(): bool
    {
        $client = new Client;
        $response = $client->get($this->url);

        return $response->getStatusCode() === 200;
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
            $this->content = json_decode((string) $response->getBody());

            $now = \Carbon\Carbon::now();

            Model::insert([
                'url'        => $this->url(),
                'response'   => json_encode($this->content),
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }

        return $this;
    }

    /**
     * Check if data is exists
     *
     * @return boolean
     */
    public function isEmpty(): bool
    {
        return empty($this->content[1]) and empty($this->content[2]);
    }

    /**
     * Get origin title from wikipedia
     *
     * @return string
     */
    public function title(): string
    {
        if (!empty($this->content) and !empty($this->content[1])) {
            return $this->content[1][0];
        }

        return '';
    }

    /**
     * Get description from page
     *
     * @return string
     */
    public function description(): string
    {
        if (!empty($this->content) and !empty($this->content[2])) {
            return $this->content[2][0];
        }
        return '';
    }

    /**
     * Get page url
     *
     * @return string
     */
    public function url(): string
    {
        if (!empty($this->content) and !empty($this->content[3])) {
            return $this->content[3][0];
        }

        return '';
    }
}
