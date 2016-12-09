<?php

namespace App\Library;

use App\Glosarium\Word;
use App\Glosarium\WordDescription;

/**
 * Dictionary is a class to get all content from KBBI
 * http://kbbi4.portalbahasa.com/
 *
 * @author Yugo <dedy.yugo.purwanto@gmail.com>
 * @link http://www.github.com/arvernester/glosarium
 * @copyright Glosarium - 2016
 */
class Dictionary
{
    /**
     * Base url for web
     *
     * @var string
     */
    private $url = 'http://kbbi4.portalbahasa.com/entri/';

    /**
     * Response from curl
     *
     * @var object
     */
    private $content;

    /**
     * Word data
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
    }

    /**
     * Set a property value
     *
     * @param $property
     * @return mixed
     */
    public function __get($property)
    {
        if (property_exists($this, $property)) {
            return $this->$property;
        }
    }

    /**
     * Get a property value
     *
     * @param $property
     * @param $value
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
     * Get live information from KBBI
     *
     * @author Yugo <dedy.yugo.purwanto@gmail.com>
     * @return void
     */
    public function getRemoteContent()
    {
        // find description in KBBI
        $client = new \Goutte\Client;

        $entry = !empty($this->word->alias) ? urlencode($this->word->alias) : urlencode(strtolower($this->word->locale));

        $this->content = $client->request(
            'GET',
            $url = $this->url . $entry
        );

        if ($this->content->filter('div.kbbi4 > ol')->count() == 0) {
            \Log::debug('Word not found for: ' . $entry);
        }

        return $this;
    }

    /**
     * Parse DOM to get spell word
     *
     * @author Yugo <dedy.yugo.purwanto@gmail.com>
     * @return object $this
     */
    public function getSpell(): string
    {
        abort_if(empty($this->content), 500, 'Empty response content from dictionary.');

        if (empty($this->word->spell)) {
            $element = 'h2 > span.syllable';

            if ($this->content->filter($element)->count() > 0) {
                $this->word->spell = $this->content->filter($element)->first()->text();
                $this->word->save();
            }
        } else {
            \Log::info('Spell not found for: ' . $this->word->locale);
        }

        if (is_null($this->word->spell)) {
            return '';
        }

        return $this->word->spell;
    }

    /**
     * Parse DOM to get descriptions
     *
     * @author Yugo <dedy.yugo.purwanto@gmail.com>
     * @return object $this
     */
    public function getDescriptions(): array
    {
        abort_if(empty($this->content), 500, 'Empty response content from dictionary.');

        $element = $this->content->filter('ol > li');
        if ($element->count() <= 0) {
            return [];
        }

        $first = $element->first()->text();

        $word = $this->word;

        if ($this->word->descriptions->count() <= 0) {
            if (strpos(trim($first), ' ') !== false) {

                $descriptions = $element->each(function ($li, $i) use ($word) {

                    if (strpos(trim($li->text()), ' ') !== false) {
                        list($type, $description) = explode(' ', $li->text(), 2);
                    } else {
                        $type = null;
                        $description = $li->text();
                    }

                    // static data
                    $classAlias = [
                        null   => 0,
                        'n'    => 2,
                        'v'    => 1,
                        'a'    => 5,
                        'adv'  => 6,
                        'num'  => 4,
                        'p'    => 7,
                        'pron' => 3,
                    ];

                    return [
                        'word_id'     => $this->word->id,
                        'type_id'     => isset($classAlias[$type]) ? $classAlias[$type] : 0,
                        'description' => empty($type) ? $description : sprintf('%s: %s', $type, $description),
                        'created_at'  => \Carbon\Carbon::now(),
                        'updated_at'  => \Carbon\Carbon::now(),
                    ];
                });
            } else {
                $client = new \Goutte\Client;
                $alias = $client->request('GET', $this->url . $first);

                // update word alias
                list($aliasWord, $spell) = explode('/', $alias->filter('h2')->text(), 2);

                $this->word->alias = trim($first);
                $this->word->locale = trim(ucwords($aliasWord));
                $this->word->save();

                $aliasElement = $alias->filter('ol > li');
                $descriptions = $aliasElement->each(function ($li, $i) use ($word) {

                    list($type, $description) = explode(' ', $li->text(), 2);

                    // static data
                    $classAlias = [
                        'n'    => 2,
                        'v'    => 1,
                        'a'    => 5,
                        'adv'  => 6,
                        'num'  => 4,
                        'p'    => 7,
                        'pron' => 3,
                    ];

                    return [
                        'word_id'     => $this->word->id,
                        'type_id'     => isset($classAlias[$type]) ? $classAlias[$type] : 0,
                        'description' => empty($type) ? $description : sprintf('%s: %s', $type, $description),
                        'created_at'  => \Carbon\Carbon::now(),
                        'updated_at'  => \Carbon\Carbon::now(),
                    ];
                });
            }

            WordDescription::insert($descriptions);
        } else {
            \Log::debug('Word descriptions not found for:' . $this->word->locale);
        }

        if (is_null($this->word->descriptions)) {
            return [];
        }

        return $this->word->descriptions->toArray();
    }

    /**
     * Get word instance as "Kata turunan"
     *
     * @author Yugo <dedy.yugo.purwanto@gmail.com>
     * @return string
     */
    public function getWordInstance(): string
    {
        if (!empty($this->content)) {
            $element = $this->content->filter('dl.turunan > dd');
            if ($element->count() >= 0) {
                $instance = $element->first()->each(function ($dd, $i) {
                    return str_replace("\n", null, $dd->text());
                });

                return end($instance);
            }
        }

        return '';
    }

    /**
     * Get word join as "Kata gabungan"
     *
     * @author Yugo <dedy.yugo.purwanto@gmail.com>
     * @return string
     */
    public function getWordJoin(): string
    {
        if (!empty($this->content)) {
            $element = $this->content->filter('dl.turunan > dd');
            if ($element->count() >= 0) {
                $joins = $element->eq(1)->each(function ($dd, $i) {
                    return str_replace("\n", null, $dd->text());
                });

                return end($joins);
            }
        }

        return '';
    }

}
