<?php

namespace App\Libraries;

use App\Dictionary\Description;
use App\Dictionary\Word;
use App\Jobs\Dictionary\InvalidWord;
use App\Jobs\Glosarium\Dictionary as DictionaryQueue;
use App\WordType;
use Goutte\Client;
use Log;

/**
 * Ambil arti kata dari pusat bahasa
 */
class Dictionary
{

    private $url = 'http://kbbi.kemdikbud.go.id/entri/';

    private $word;

    private $response;

    public function __construct(Word $word = null)
    {
        $this->word = $word;

        $client = new Client;

        if (!empty($this->word)) {
            $this->response = $this->getResponse($this->word->word);

            if ($this->response->filter('ol, ul.adjusted-par')->count() <= 0) {
                Log::info(sprintf('Kata %s tidak ditemukan', $this->word->word));
            }

            $this->word->increment('retry_count', 1);
            $this->word->save();
        }
    }

    private function getResponse($word)
    {
        $client   = new Client;
        $response = $client->request('GET', $this->url . strtolower(urlencode($word)));

        return $response;
    }

    public function isExists($word)
    {
        $response = $this->getResponse($word);

        return $response->filter('ol')->count() >= 1;
    }

    public function spell()
    {
        $element = $this->response->filter('h2 span.syllable');
        if ($element->count() >= 1) {
            $spell = $element->first()->text();

            $this->word->spell = $spell;
            $this->word->save();

            return $spell;
        }

        return null;
    }

    public function descriptions()
    {
        $types = WordType::pluck('id', 'alias')->toArray();

        $element      = $this->response->filter('ol > li, ul.adjusted-par > li');
        $descriptions = $element->each(function ($node, $i) use ($types) {
            $description = trim(preg_replace('/\s+/', ' ', $node->text()));

            list($type, $text) = explode(' ', $description, 2);

            // add new vocabularies
            // save to dictionary
            $words = array_map(function ($word) {
                return trim(strtolower($word));
            }, preg_split("/[\s,\/;\(\)]+/", $text));

            dispatch(new DictionaryQueue($words, 'id'));
            dispatch(new InvalidWord);

            return [
                'type' => array_key_exists($type, $types) ? $types[$type] : null,
                'text' => ucfirst($text),
            ];
        });

        $now = \Carbon\Carbon::now();

        $db = [];
        foreach ($descriptions as $description) {
            $db[] = Description::create([
                'word_id'    => $this->word->id,
                'type_id'    => $description['type'],
                'text'       => $description['text'],
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }

        return collect($db);
    }
}
