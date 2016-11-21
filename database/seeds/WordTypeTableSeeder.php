<?php

use App\Glosarium\WordType;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class WordTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = [
            'Verba'     => 'Kata Kerja',
            'Nomina'    => 'Kata Benda',
            'Pronomina' => 'Kata Ganti',
            'Numeralia' => 'Kata Bilangan',
            'Adjektiva' => 'Kata Sifat',
            'Adverbia'  => 'Kata Keterangan',
            'Artikel'   => 'Kata Sandang',
            'Proposisi' => 'Kata Depan',
            'Konjungsi' => 'Kata Penghubung',
            'Injeksi'   => 'Kata Seru',
        ];

        \DB::transaction(function () use ($types) {
            foreach ($types as $name => $description) {
                WordType::insert([
                    'slug'        => str_slug($name),
                    'name'        => $name,
                    'description' => $description,
                    'created_at'  => Carbon::now(),
                    'updated_at'  => Carbon::now(),
                ]);
            }
        });
    }
}
