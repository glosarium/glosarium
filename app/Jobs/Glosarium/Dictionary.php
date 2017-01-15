<?php

namespace App\Jobs\Glosarium;

use App\Dictionary\Word;
use App\User;
use Sastrawi\Stemmer\StemmerFactory;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class Dictionary implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    protected $lang;

    protected $words;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($words, $lang = 'id')
    {
        $this->words = $words;
        $this->lang = $lang;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $stemFactory = new StemmerFactory();

        $stemmer = $stemFactory->createStemmer();

        $words = [];
        foreach ($this->words as $word) {
            if (! empty($word)) {
                $stem = $stemmer->stem($word);
                $words[] = [
                    'type' => 'basic',
                    'text' => $stem
                ];

                if ($word != $stem) {
                    $words[] = [
                        'type' => 'extended',
                        'text' => $word
                    ];
                }
            }
        }


        // save to database
        $now = \Carbon\Carbon::now();

        $user = User::whereEmail('dedy.yugo.purwanto@gmail.com')->first();

        $dictionary = [];
        foreach ($words as $word) {
            $find = Word::whereWord($word['text'])->first();
            if (empty($find)) {
                $dictionary[] = Word::create([
                    'user_id' => empty($user) ? null : $user->id,
                    'word' => $word['text'],
                    'type' => $word['type'],
                    'lang' => $this->lang,
                    'is_published' => true,
                    'is_standard' => true,
                    'created_at' => $now,
                    'updated_at'=> $now
                ]);
            }
        }
    }
}
