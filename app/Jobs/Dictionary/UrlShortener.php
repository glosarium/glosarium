<?php

namespace App\Jobs\Dictionary;

use App\Dictionary\Word;
use App\Link;
use Hashids;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Log;

class UrlShortener implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    private $word;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Word $word)
    {
        $this->word = $word;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $hash = Hashids::connection('dictionary')->encode($this->word->id);

        Log::info('Hash and ID to ' . $hash);

        $link = Link::whereType('dictionary')->whereHash($hash)->first();

        Log::info('Find exists link on database');

        if (empty($link)) {
            $now = \Carbon\Carbon::now();

            Log::info('Prepare to create new link');

            $link = Link::create([
                'hash'       => $hash,
                'type'       => 'dictionary',
                'url'        => route('dictionary.national.index', [$this->word->slug]),
                'created_at' => $now,
                'updated_at' => $now,
            ]);

            Log::info('Link created');
        }
    }
}
