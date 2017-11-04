<?php
use Illuminate\Database\Seeder;

class DictionaryGroupTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Dictionary\Group::create([
            'name' => 'Tidak Terdefinisi'
        ]);
    }
}
