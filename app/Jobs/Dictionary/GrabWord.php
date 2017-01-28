<?php

namespace App\Jobs\Dictionary;

use App\Dictionary\Log;
use App\Libraries\Dictionary;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class GrabWord implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    private $word;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($word)
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

        $log = Log::whereWord($this->word)->first();

        if (empty($log)) {
            $dictionary = new Dictionary($this->word);
            $dictionary->get();

            Log::create([
                'word'       => $this->word,
                'is_success' => !$dictionary->isLimited(),
                'created_at' => \Carbon\Carbon::now(),
            ]);
        }
    }
}
