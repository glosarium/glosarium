<?php

namespace App\Libraries;

use Log;
use Goutte\Client;
use App\WordType;

/**
 * Ambil arti kata dari pusat bahasa
 */
class Dictionary
{

    private $url = 'http://kbbi.kemdikbud.go.id/entri/';

    private $word;

    private $response;

    function __construct($word)
    {
        $this->word = strtolower(urlencode($word));

        $this->url .= $this->word;

        $client = new Client;

        $this->response = $client->request('GET', $this->url);

        if ($this->response->filter('ol')->count() <= 0) {
            Log::info(sprintf('Kata %s tidak ditemukan', $this->word));
        }
    }

    public function spell()
    {
        $element = $this->response->filter('h2 span.syllable');
        if ($element->count() >= 1) {
            return $element->first()->text();
        }

        return null;
    }

    public function descriptions()
    {
        $types = WordType::pluck('id', 'alias')->toArray();

        $element = $this->response->filter('ol > li');
        $descriptions = $element->each(function($node, $i) use($types) {
            $description = trim(preg_replace('/\s+/', ' ', $node->text()));

            list($type, $text) = explode(' ', $description, 2);

            return [
                'type' => array_key_exists($type, $types) ? $types[$type] : null,
                'text' => $text
            ];
        });

        return $descriptions;
    }
}
