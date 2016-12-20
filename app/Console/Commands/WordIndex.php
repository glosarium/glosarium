<?php

namespace App\Console\Commands;

use File;
use App\Glosarium\Word;
use Illuminate\Console\Command;
use TeamTNT\TNTSearch\TNTSearch;

class WordIndex extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'word:index';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Index all word using TNT Search';

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
        $tntSearch = new TNTSearch;

        $tntSearch->loadConfig(config('search'));

        $path = config('search.storage');

        // create directory
        if (! File::isDirectory($path)) {
            $created = File::makeDirectory($path, 0777, true);

            if ($created) {
                $this->info('Berhasil membuat direktori ' . $path);
            }
            else {
                $this->error('Gagal membuat direktori ' . $path);
            }
        }

        $index = $tntSearch->createIndex('word.index');

        $index->query('SELECT `id`, `locale`, `foreign` FROM `words` ORDER BY `locale` ASC');

        $index->run();

        $this->info('Semua kata berhasil diindeks.');
    }
}
