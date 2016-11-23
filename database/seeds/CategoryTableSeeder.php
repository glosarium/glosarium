<?php

use App\Glosarium\WordCategory;
use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $names = [
            'Kimia',
            'Fisika',
            'Matematika',
            'Bilogi',
            'Pertanian',
            'Keuangan',
            'Linguistik',
            'Teknologi Informasi',
            'Farmasi',
            'Perhutanan',
            'Kedokteran',
            'Kedokteran Hewan',
            'Kedokteran Gigi',
            'Peternakan',
            'Perikanan',
            'Teknik Mesin',
            'Teknik Kapal Terbang',
            'Teknok Otomotif',
            'Teknik Dirgantara',
            'Teknik Listrik',
            'Teknik Pertambangan',
            'Ekonomi',
            'Antropologi',
            'Sosiologi',
            'Politik',
            'Komunikasi Massa',
            'Fotografi & Film',
            'Filsafat',
            'Arkeologi',
            'Pendidikan',
            'Agama Islam',
            'Pariwisata',
            'Keperawatan',
            'Teknik Sipil',
            'Sastra',
            'Lain-lain',
        ];

        foreach ($names as $name) {
            $categories[] = [
                'slug'       => str_slug($name),
                'name'       => $name,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ];
        }

        WordCategory::insert($categories);
    }
}
