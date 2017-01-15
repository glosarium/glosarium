<?php

namespace App\Library;

use App\Glosarium\Word;
use App\Glosarium\WordType;
use App\Glosarium\WordDescription;

/**
 * Dictionary is a class to get all content from KBBI
 * http://kbbi4.portalbahasa.com/.
 *
 * @author Yugo <dedy.yugo.purwanto@gmail.com>
 *
 * @link http://www.github.com/arvernester/glosarium
 *
 * @copyright Glosarium - 2016
 */
class Dictionary
{
    /**
     * Base url for web.
     *
     * @var string
     */
    private $url = 'http://kbbi4.portalbahasa.com/entri/';

    /**
     * Response from curl.
     *
     * @var object
     */
    private $content;

    /**
     * Word data.
     *
     * @var object
     */
    private $word;

    /**
     * @param Word $word
     */
    public function __construct(Word $word)
    {
        $this->word = $word;

        if ($this->word->retry <= config('word.tries')) {
            // get remote content
            $client = new \Goutte\Client();

            $entry = !empty($this->word->alias) ? urlencode($this->word->alias) : urlencode(strtolower($this->word->locale));

            $this->content = $client->request('GET', $this->url.$entry);

            if ($this->content->filter('div.kbbi4 > ol')->count() == 0) {
                \Log::debug('Word not found for: '.$entry);
            }
        }
    }

    /**
     * Set a property value.
     *
     * @param $property
     *
     * @return mixed
     */
    public function __get($property)
    {
        if (property_exists($this, $property)) {
            return $this->$property;
        }
    }

    /**
     * Get a property value.
     *
     * @param $property
     * @param $value
     *
     * @return mixed
     */
    public function __set($property, $value)
    {
        if (property_exists($this, $property)) {
            $this->$property = $value;
        }

        return $this;
    }

    /**
     * Parse DOM to get spell word.
     *
     * @author Yugo <dedy.yugo.purwanto@gmail.com>
     *
     * @return object $this
     */
    public function spell(): string
    {
        // no remote content and get if from database
        if (!empty($this->word->spell) or empty($this->content)) {
            return $this->word->spell;
        }

        $element = $this->content->filter('h2 > span.syllable');

        if ($element->count() > 0) {
            return $element->first()->text();
        }

        return '';
    }

    public function descriptions()
    {
        if (!empty($this->word->descriptions) or empty($this->content)) {
            return $this->word->descriptions;
        }

        $element = $this->content->filter('ol > li');

        $types = WordType::where('alias', '!=', '')->pluck('id', 'alias');

        if ($element->count() >= 1) {
            $descriptions = $element->each(function ($node, $i) use ($types) {
                list($type, $text) = explode(' ', $node->text(), 2);

                return [
                    'id' => array_key_exists($type, $types->toArray()) ? $types->get($type) : 0,
                    'type' => $type,
                    'text' => trim($node->text()),
                ];
            });

            return $descriptions;
        }

        return [];
    }

    public function __destruct()
    {
        if ($this->word->retry <= config('word.tries')) {
            $this->word->spell = $this->spell();
            $this->word->increment('retry', 1);
            $this->word->save();

            if ($this->word->descriptions->count() <= 0) {
                $descriptions = [];
                foreach ($this->descriptions() as $description) {
                    $descriptions[] = [
                        'word_id' => $this->word->id,
                        'type_id' => $description['id'],
                        'description' => $description['text'],
                        'created_at' => \Carbon\Carbon::now(),
                        'updated_at' => \Carbon\Carbon::now(),
                    ];
                }

                WordDescription::insert($descriptions);
            }
        }
    }
}
