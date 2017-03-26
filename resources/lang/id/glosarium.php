<?php

return [
    'word'     => [
        'glossary'         => 'Glosari',
        'index'            => 'Indeks Kata',
        'create'           => 'Tambah Kata',
        'show'             => 'Arti dari glosari :origin adalah :locale',
        'edit'             => 'Edit Kata :origin',
        'description'      => 'Arti dari glosari :origin adalah :locale.',
        'inWikipedia'      => 'Arti ":title" dalam Wikipedia.org',
        'searchResult'     => 'Hasil pencarian untuk',
        'notFound'         => 'Kata tidak ditemukan dalam pangkalan data.',
        'contribute'       => 'Berkontribusi menambahkan glosari pada aplikasi.',
        'loginFirst'       => 'Anda belum masuk atau terdaftar sebagai kontributor. Untuk menambahkan glosari, silakan <a href=":login" class="alert-link">masuk</a> atau <a href=":register" class="alert-link">registrasi</a> terlebih dahulu.',
        'loginAlert'       => 'Anda harus masuk atau mendaftar terlebih dahulu untuk memberikan pilihan.',
        'descriptionHelp'  => 'Tulis rincian, gagasan, atau referensi kata.',
        'inLocale'         => 'Kata dalam Bahasa Indonesia',
        'noDescription'    => 'Deskripsi tidak ditemukan dalam Wikipedia.org.',
        'forward'          => 'Informasi kata juga dikirim ke :email',
        'shares'           => 'Bagikan',
        'wrongDescription' => 'Sehubungan dengan banyaknya respon negatif, deskripsi di bawah bisa jadi tidak sesuai dengan arti kata ',
        'moderation'       => 'Moderasi Kata',

        'btn'              => [
            'create'  => 'Tambah Kata',
            'propose' => 'Ajukan Proposal',
        ],

        'field'            => [
            'origin'      => 'Kata Asal',
            'locale'      => 'Kata Translasi',
            'category'    => 'Kategori',
            'published'   => 'Dipublikasikan',
            'unpublished' => 'Belum Dipublikasikan',
            'pending'     => 'Menunggu Persetujuan',
            'actions'     => 'Aksi',
            'lang'        => 'Bahasa',
            'description' => 'Deskripsi',
            'created'     => 'Dibuat',
            'updated'     => 'Diperbarui',
            'user'        => 'Kontributor',
        ],

        'msg'              => [
            'created' => 'Kata baru berhasil ditambahkan.',
            'edited'  => 'Kata :origin berhasil diperbarui.',
        ],

        'placeholder'      => [
            'search' => 'Kata asing atau dalam Bahasa Indonesia...',
        ],
    ],

    'category' => [
        'index'        => 'Kategori',
        'category'     => 'Kategori',
        'inCategory'   => 'Dalam Kategori',
        'searchResult' => 'Hasil pencarian untuk',
        'notFound'     => 'Kategori tidak ditemukan dalam pangkalan data.',
        'latestWord'   => 'Kata Terbaru',
        'select'       => 'Select Category',

        'field'        => [
            'name'        => 'Nama',
            'description' => 'Deskripsi',
            'published'   => 'Dipublikasikan',
            'totalWord'   => 'Jumlah Kata',
            'actions'     => 'Aksi',
        ],

        'btn'          => [
            'load' => 'Muat Lebih Banyak',
        ],

        'placeholder'  => [
            'search'   => 'Temukan kategori glosari...',
            'searchIn' => 'Cari kata dalam kategori :name...',
        ],

        'msg'          => [
            'edited' => 'Kategori :name berhasil diperbarui.',
        ],
    ],

    'mail'     => [
        'introProposal' => 'Halo, Anda mendapatkan proposal glosari baru dengan kata asal :origin dan arti kata :origin.',
    ],
];
