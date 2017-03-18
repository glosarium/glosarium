<?php

use App\Glosarium\Word;
use App\Library\Dictionary;

/**
 * @author Yugo <dedy.yugo.purwanto@gmail.com>
 * @link https://www.github.com/arvernester/glosarium
 * @copyright Glosarium - 2016
 */
class DictionaryTest extends TestCase
{

    /**
     * @var mixed
     */
    private $word;

    /**
     * @var mixed
     */
    private $dictionary;

    public function testGetRemoteContent()
    {
        // get random word from database
        $this->word = Word::inRandomOrder()->first();
        print 'Test for word: ' . $this->word->locale;

        // get remote data from KBBI
        $this->dictionary = (new Dictionary($this->word))->getRemoteContent();

        $this->assertTrue(!empty($this->dictionary));
    }

    public function testSpell()
    {
        // get spelled word
        if (!empty($this->dictionary)) {
            $this->assertTrue(is_string($spell = $this->dictionary->getSpell()));
            print $spell;
        }
    }

    public function testDescription()
    {
        if (!empty($this->dictionary)) {
            // get word's descriptions
            $this->assertTrue(is_array($descriptions = $this->dictionary->getDescriptions()));
            print json_encode($descriptions);
        }
    }
}
