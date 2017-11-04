<?php
namespace App\Jobs\Glosarium\Words;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Glosarium\Word as GlosariumWord;
use App\Dictionary\Word as DictionaryWord;
use App\Dictionary\Group;

class ParseWord implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $glosariumWord;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(GlosariumWord $word)
    {
        $this->glosariumWord = $word;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // set default user
        $user = \App\User::whereEmail('glosarium.id@gmail.com')->first();
        $userId = empty($user) ? null : $user->id;

        // stem origin word
        $stemmerFactory = new \Sastrawi\Stemmer\StemmerFactory();
        $stemmer = $stemmerFactory->createStemmer();
        
        // save local words
        $locales = array_filter(explode(' ', $stemmer->stem($this->glosariumWord->locale)));

        // get default class
        $group = Group::firstOrCreate([
            'name' => 'Tidak Terdefinisi'
        ]);

        foreach ($locales as $locale) {
            $count = DictionaryWord::whereWord($locale)->count();
            if ($count <= 0) {

                $word = DictionaryWord::create([
                    'user_id' => $userId,
                    'group_id' => $group->id,
                    'lang' => 'id',
                    'word' => $locale,
                    'pronounciation' => '',
                    'source' => ''
                ]);

                \dispatch(new \App\Jobs\Dictionary\Words\UpdateInfo($word));
                unset($word);
            }
        }

        // save foreign word
        $foreigns = array_filter(explode(' ', $this->glosariumWord->origin));
        foreach ($foreigns as $foreign) {
            $count = DictionaryWord::whereWord($foreign)->count();
            if ($count <= 0) {
                DictionaryWord::create([
                    'user_id' => $userId,
                    'group_id' => $group->id,
                    'lang' => $this->glosariumWord->lang,
                    'word' => $foreign,
                    'pronounciation' => '',
                    'source' => ''
                ]);
            }
        }
    }
}
