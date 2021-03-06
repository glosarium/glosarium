<?php

namespace App\Console\Commands\Glosarium;

// Twitter package doesn't define namespace
// so include it manually to prevent conflict with another class
include_once base_path('vendor/dg/twitter-php/src/Twitter.php');

use Illuminate\Console\Command;
use App\Glosarium\Word;
use Illuminate\Support\Facades\Log;

class TweetCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'glosarium:tweet';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Auto tweet glosarium word';

    /**
     * Create a new command instance.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $twitter = new \Twitter(
            env('TWITTER_ID'),
            env('TWITTER_SECRET'),
            env('TWITTER_TOKEN'),
            env('TWITTER_TOKEN_SECRET')
        );

        if (!$twitter->authenticate()) {
            $this->error('Invalid Twitter configuration.');
            exit;
        }

        $word = Word::inRandomOrder()
            ->where('short_url', '!=', '')
            ->with('category')
            ->first();

        if (!empty($word)) {
            $tweet = sprintf('Dalam bidang %s, padanan untuk kata %s adalah %s. #glosarium %s',
                $word->category->name,
                $word->origin,
                $word->locale,
                $word->short_url
            );
            $twitter->send($tweet);

            Log::info('Kata glosarium telah ditwitkan.', [
                'origin' => $word->origin,
                'local' => $word->local,
                'category' => $word->category->name,
            ]);

            $this->info(sprintf('Kata %s (%s) ditwitkan.', $word->origin, $word->locale));
        } else {
            $this->line('Tidak ada kata yang ditwitkan.');
        }
    }
}
