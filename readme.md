# Glosarium Bahasa Indonesia

Glosarium adalah suatu daftar alfabetis istilah dalam suatu ranah pengetahuan tertentu yang dilengkapi dengan definisi untuk istilah-istilah tersebut. Biasanya glosarium ada di bagian akhir suatu buku dan menyertakan istilah-istilah dalam buku tersebut yang baru diperkenalkan atau paling tidak, tak umum ditemukan.

Lihat aplikasi pada [Glosarium Indonesia](http://glosarium.web.id).

[![Glosarium Indonesia.png](https://s28.postimg.org/ov5mtoe1p/Glosarium_Indonesia.png)](https://postimg.org/image/xdf2y0kk9/)

## Fitur Aplikasi
- Pencarian kata.
- Tambah kata dari kontributor (dengan sistem moderasi).
- Daftar kategori glosari dan pencarian kategori.
- Manajemen kata dari halaman admin.
- Manahemen kategori dari halaman admin.
- Notifikasi pengguna.
- Dan berbagai fitur lainnya yang akan terus ditambahkan.

## Kebutuhan Sistem
- Apahace atau Nginx Web Server.
- PHP 7.0.
- MySQL 5.7.x atau di atasnya.
- Redis Server.
- ElasticSearch (opsi).

## Instalasi
- Klon repositori [glosarium/glosarium](https://github.com/glosarium/glosarium) ke mesin lokal.
- Masuk ke direktori aplikasi dan perbarui librari dan kerangka kerja dengan perintah ```composer install```.
- Salin berkas ```.env.example``` menjadi ```.env```. Ubah beberapa pengaturan di dalam berkas tersebut, termasuk berkas pengaturan pangkalan data.
- Buat kunci enkripsi baru dengan perintah ```php artisan key:generate```.
- Jalankan perintah ```php artisan migrate -m``` untuk membuat tabel baru beserta datanya pada pangkalan data.
- Jalankan built-in web server dengan perintah ```php artisan serve```.

Terakhir, akses aplikasi web melalui peramban dengan tautan ```http://localhost:8000```.

## Pengembang
- Dedy Yugo Purwanto ([@arvernester](https://twitter.com/arvernester)).

## Lisensi
Lisensi dapat dibaca pada [berkas berikut](https://github.com/glosarium/glosarium/blob/master/LICENSE.md).