<?php

/**
 * Glosarium adalah aplikasi berbasis web yang menyediakan berbagai kata glosarium,
 * kamus nasional dan kamus bahasa daerah.
 *
 * @author Yugo <dedy.yugo.purwanto@gmail.com>
 * @copyright Glosarium - 2017
 * @link https://github.com/glosarium/glosarium
 */

namespace App\Libraries;

use App\Dictionary\Description;
use App\Dictionary\Word;
use App\Jobs\Glosarium\Dictionary as DictionaryQueue;
use App\WordType;
use Goutte\Client;

/**
 * Ambil arti kata dari pusat bahasa
 */
class Dictionary
{
    /**
     * @var string
     */
    private $url = 'http://kbbi.kemdikbud.go.id/entri/';

    /**
     * @var string
     */
    private $vocabulary;

    /**
     * @var object
     */
    private $word;

    /**
     * @var object
     */
    private $response;

    /**
     * @var integer
     */
    private $maxTries = 3;

    public function __construct($word)
    {
        $this->vocabulary = $word;
        $this->word       = Word::whereWord($word)->first();
    }

    /**
     * Return word object contains new data
     *
     * @return App\Dictionary\Word
     */
    public function get()
    {
        if (empty($this->word)) {
            // check from kbbi
            $this->response = $this->getResponse($this->vocabulary);

            if ($this->isExists()) {
                // save to database
                $now = \Carbon\Carbon::now();

                $this->word = Word::create([
                    'user_id'      => 1,
                    'word'         => ucfirst($this->vocabulary),
                    'lang'         => 'id',
                    'is_published' => true,
                    'is_standard'  => true,
                    'created_at'   => $now,
                    'updated_at'   => $now,
                ]);
            } else {
                return null;
            }
        }

        $this->word->spell        = $this->spell();
        $this->word->descriptions = $this->descriptions();

        return $this->word;
    }

    /**
     * Request data to KBBI
     *
     * @param  string $word
     * @param  string $action
     * @return Goutte\Client
     */
    private function getResponse($word, $action = 'initial')
    {
        $client   = new Client;
        $response = $client->request('GET', $url = $this->url . strtolower(urlencode($word)));

        if (!empty($this->word)) {
            $this->word->increment('retry_count', 1);
            $this->word->save();
        }

        if (function_exists('debug')) {
            $action = ucwords($action);
            debug("{$action} request to {$url} ({$this->word->retry_count}).");
        }

        return $response;
    }

    /**
     * Check description is exists
     *
     * @return boolean
     */
    private function isExists()
    {
        $count = $this->response->filter('ol, ul.adjusted-par')->count() >= 1;

        if ($count <= 0 and function_exists('debug')) {
            debug(sprintf('Word %s not found.', $this->vocabulary));
        }

        return $count >= 1;
    }

    /**
     * Get spell word
     *
     * @return string
     */
    private function spell()
    {
        if (!empty($this->word->spell) and $this->word->retry_count) {
            return $this->word->spell;
        }

        if (empty($this->response)) {
            if ($this->word->retry_count >= $this->maxTries) {
                return null;
            }

            $this->response = $this->getResponse($this->word->word, 'spell');
        }

        $element = $this->response->filter('h2 span.syllable');
        if ($element->count() >= 1) {
            $spell = $element->first()->text();

            $this->word->spell = $spell;
            $this->word->save();

            return $spell;
        }

        return null;
    }

    /**
     * Get descriptions
     *
     * @return App\Dictionary\Description
     */
    private function descriptions()
    {
        if (!empty($this->word->descriptions) and $this->word->descriptions->count() >= 1) {
            return $this->word->descriptions;
        }

        if (empty($this->response)) {
            if ($this->word->retry_count >= $this->maxTries) {
                return null;
            }

            $this->response = $this->getResponse($this->word->word, 'description');
        }

        $types = WordType::pluck('id', 'alias')->toArray();

        $element      = $this->response->filter('ol > li, ul.adjusted-par > li');
        $descriptions = $element->each(function ($node, $i) use ($types) {
            $description = trim(preg_replace('/\s+/', ' ', $node->text()));

            list($type, $text) = explode(' ', $description, 2);

            // add new vocabularies
            $words = array_map(function ($word) {
                return trim(strtolower($word));
            }, preg_split("/[\s,\/;\(\)]+/", $text));

            dispatch(new DictionaryQueue($words, 'id'));

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

        dispatch(new InvalidWord);

        return collect($db);
    }
}
