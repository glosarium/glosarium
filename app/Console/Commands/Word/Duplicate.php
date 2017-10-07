<?php

namespace App\Console\Commands\Word;

use App\Glosarium\Word;
use Illuminate\Console\Command;

class Duplicate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'word:duplicate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clone and normalize duplicate words';

    /**
     * Create a new command instance.
     *
     * @return void
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
        $words = Word::where('locale', 'LIKE', '%;%')
            ->orderBy('origin', 'ASC')
            ->get();

        $bar = $this->output->createProgressBar(count($words));

        \DB::transaction(function () use ($words, $bar) {
            foreach ($words as $word) {
                $clones = explode(';', $word->locale);
                foreach ($clones as $index => $clone) {
                    if ($index === 0) {
                        $word->locale = trim($clone);
                        $word->save();
                    } else {
                        if (!empty($clone)) {
                            Word::Create([
                                'user_id' => $word->user_id,
                                'category_id' => $word->category_id,
                                'lang' => $word->lang,
                                'origin' => $word->origin,
                                'locale' => trim($clone),
                                'is_published' => $word->is_published,
                                'is_standard' => $word->is_standard,
                            ]);
                        }
                    }
                }

                $bar->advance();
            }
        });

        $bar->finish();
    }
}
