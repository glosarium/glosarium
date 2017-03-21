@extends('layouts.app')

@push('metadata')
    <meta name="author" content="{{ config('app.name') }}">
    <meta name="description" content="{{ config('app.description') }}">

    <meta property="og:title" content="{{ config('app.name') }}">
    <meta property="og:description" content="{{ config('app.description') }}">
    <meta property="og:url" content="{{ route('glosarium.word.index') }}">
    <meta property="og:image" content="{{ $imagePath }}">
@endpush

@section('heading')
    @include('partials.title')
@endsection

@section('content')
<div class="container">
    <div class="row">
      <div class="col-lg-3">
        <!-- nav afix -->
        <div class="nav-left-sh hidden-md hidden-sm hidden-xs">
          <ul class="list-unstyled">
            <li><a href="#intro" class="link-innerpage">Pengenalan</a></li>
            <li><a href="#auth" class="link-innerpage">Autentikasi Aplikasi</a></li>
            <hr>
            <li><a href="#category-index" class="link-innerpage">Indeks Kategori</a></li>
            <li><a href="#category-show" class="link-innerpage">Rincian Kategori</a></li>
            <li><a href="#category-search" class="link-innerpage">Pencarian Kategori</a></li>

            <hr>
            <li><a href="#word-index" class="link-innerpage">Indeks Kata</a></li>
            <li><a href="#word-show" class="link-innerpage">Rincian Kata</a></li>
            <li><a href="#word-search" class="link-innerpage">Pencarian Kata</a></li>
            <li><a href="#word-propose" class="link-innerpage">Proposal Baru untuk Kata</a></li>
          </ul>


        </div><!-- end nav afix -->

      </div>
      <div class="col-lg-9">
        <div class="show-grid">
          <h3 class="no-margin-top">
              Pengenalan
              <small>
                  <a href="#intro" id="intro"><i class="fa fa-link"></i></a>
              </small>
          </h3>
          <p>Glosarium menyediakan Antarmuka Pemrograman Aplikasi (<i>Application Programming Interface</i>/API) untuk memberikan kemudahan bagi pengembang yang ingin membuat perangkat lunak baru di pelantar yang berbeda. Seperti perangkat bergerak misalnya.</p>

          <p>Saat ini fitur yang disediakan pada APA Glosarium hanya sebatas baca data, khususnya bagian kata dan kategori (bidang).</p>
          <p>Untuk dapat mengakses APA Glosarium, pengembang diharuskan mendaftar terlebih dahulu sebagai kontributor di aplikasi web Glosarium. Adapaun halaman registrasi dapat diakses melalui <a href="{{ url('register') }}">tautan ini</a>.</p>

          <div class="alert alert-info">
              Hampir sebagian besar contoh skrip pada dokumentasi ini menggunakan bahasa pemrograman PHP dan librari <a href="https://mdref.m6w6.name/http" class="alert-link">HTTP Client</a> versi 2.
          </div>
      </div>

      <div class="show-grid">
          <h3>
            Autentikasi Aplikasi
            <small>
                <a href="#auth" id="auth"><i class="fa fa-link"></i></a>
            </small>
          </h3>
          <p>Sebelum aplikasi dapat berkomunikasi dengan APA Glosarium, pengembang terlebih dahulu menyiapkan token yang disediakan oleh Glosarium. Ada dua cara untuk mendapatkan token.</p>
          <ul>
              <li>Melalui halaman profil kontributor.</li>
              <li>Mengakses APA Glosarium dengan metode POST.</li>
          </ul>

          <p>Adapun contoh untuk mendapatkan token melalui APA adalah sebagai berikut:</p>

          <pre>
              <code>
$client = new http\Client;
$request = new http\Client\Request;

$email = 'glosarium.id@gmail.com';
$password = 'your-secret-password';

$body = new http\Message\Body;
$body->addForm(array(
  'email' => $email,
  'password' => $password
), NULL);

$request->setRequestUrl('http://glosarium.web.id/api/auth');
$request->setRequestMethod('POST');
$request->setBody($body);

$client->enqueue($request)->send();
$response = $client->getResponse();

$body = json_decode($response->getBody());

echo $body->token;
            </code>
          </pre>

          <p>Responnya akan mengembalikan informasi token sesuai dengan akun dan sandi lewat yang telah dikirim. Pastikan untuk menyimpan token ke dalam media yang aman dan mudah diakses, karena token ini akan selalu disertakan setiap kali melakukan permintaan data ke APA Glosarium.</p>

          <pre>
              <code>
POST /api/auth HTTP/1.1
Host: glosarium.web.id
Content-Type: application/vnd.glosarium.api.v1+json

{
  "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9"
}
              </code>
          </pre>
      </div>

      <div class="show-grid">
          <h3>
              Indeks Kategori
              <small>
                  <a href="#category-index" id="category-index"><i class="fa fa-link"></i></a>
              </small>
          </h3>

          <p>Untuk mendapatkan indeks kategori, dapat mengirimkan beberapa data dengan metode GET.</p>

          <table class="table">
              <thead>
                  <th>Nama</th>
                  <th>Jenis Data</th>
                  <th>Keterangan</th>
              </thead>
              <tbody>
                  <tr>
                      <td>limit</td>
                      <td>integer</td>
                      <td>Jumlah data yang ingin ditampilkan</td>
                  </tr>
                  <tr>
                      <td>page</td>
                      <td>integer</td>
                      <td>Indeks halaman yang dituju</td>
                  </tr>
                  <tr>
                      <td>sort</td>
                      <td>string</td>
                      <td>Pilihan data: asc, desc</td>
                  </tr>
              </tbody>
          </table>

          <p>Hasil respon untuk permintaan indeks kategori adalah sebagai berikut.</p>

          <pre>
              <code>
GET /api/glosarium HTTP/1.1
Host: glosarium.web.id
Content-Type: application/vnd.glosarium.api.v1+json

{
    "total": 54,
    "per_page": 20,
    "current_page": 2,
    "last_page": 3,
    "next_page_url": "http:\/\/glosarium.web.id\/api\/glosarium\/category?page=3",
    "prev_page_url": "http:\/\/glosarium.web.id\/api\/glosarium\/category?page=1",
    "from": 21,
    "to": 40,
    "data": [
        {
            "id": 2,
            "slug": "kimia",
            "name": "Kimia",
            "description": "Kimia adalah cabang dari ilmu ...",
            "metadata": {
                "icon": "fa fa-flask"
            },
            "url": "http:\/\/glosarium.web.id\/category\/kimia",
            "updated_diff": "3 bulan yang lalu"
        },
        {
            "id": 26,
            "slug": "komunikasi-massa",
            "name": "Komunikasi Massa",
            "description": "Komunikasi massa adalah proses di ...",
            "metadata": {
                "icon": "fa fa-comments"
            },
            "url": "http:\/\/glosarium.web.id\/category\/komunikasi-massa",
            "updated_diff": "3 bulan yang lalu"
        }
    ]
}
              </code>
          </pre>

          <p>Contoh skrip untuk mendapatkan indeks kategori pada APA Glosarium.</p>
          <pre>
              <code>
$client = new http\Client;
$request = new http\Client\Request;

$token = 'your-token';

$request->setRequestUrl('http://glosarium.web.id/api/glosarium/category');
$request->setRequestMethod('GET');
$request->setQuery(new http\QueryString(array(
  'token' => $token,
  'page' => 1
)));

$client->enqueue($request)->send();
$response = $client->getResponse();

echo $response->getBody();
              </code>
          </pre>
      </div>

      <div class="show-grid">
          <h3>
              Rincian Kategori
              <small>
                  <a href="#category-show" id="category-show"><i class="fa fa-link"></i></a>
              </small>
          </h3>

          <p>Dari daftar indeks kategori yang didapat, pengembang dapat melakukan permintaan rincian kategori. Parameter yang akan digunakan untuk melakukan permintaan adalah slug.</p>

          <table class="table">
              <thead>
                  <th>Nama</th>
                  <th>Jenis Data</th>
                  <th>Keterangan</th>
              </thead>

              <tbody>
                  <tr>
                      <td>slug</td>
                      <td>string</td>
                      <td></td>
                  </tr>
              </tbody>
          </table>

          <p>Contoh kembalian respon apabila permintaan berhasil diproses.</p>

          <pre>
              <code>
POST /api/glosarium/agama-islam HTTP/1.1
Host: glosarium.web.id
Content-Type: application/vnd.glosarium.api.v1+json

{
    "id": 32,
    "slug": "agama-islam",
    "name": "Agama Islam",
    "description": "Islam (Arab: al-islām, الإسلام: \"berserah diri kepada Tuhan\") ...",
    "metadata": {
        "icon": "fa fa-moon-o"
    },
    "words_count": 3542,
    "url": "http:\/\/glosarium.web.id\/category\/agama-islam",
    "updated_diff": "3 bulan yang lalu"
}
              </code>
          </pre>

          <p>Untuk contoh permintaan dapat dipelajari dari potongan skrip di bawah.</p>

          <pre>
              <code>
$client = new http\Client;
$request = new http\Client\Request;

$token = 'your-token';
$slug = 'agama-islam';

$request->setRequestUrl('http://glosarium.web.id/api/glosarium/category/'. $slug);
$request->setRequestMethod('GET');
$request->setQuery(new http\QueryString(array(
  'token' => $token
)));

$client->enqueue($request)->send();
$response = $client->getResponse();

echo $response->getBody();
              </code>
          </pre>

      </div>

      <div class="show-grid">
          <h3>
              Pencarian Kategori
              <small>
                  <a href="#category-search" id="category-search"><i class="fa fa-link"></i></a>
              </small>
          </h3>

          <p>Pengembang juga dapat melakukan pencarian kategori berdasarkan kata kunci. Permintaanya tidak jauh berbeda dengan indeks kategori, hanya dibutuhkan tambahan query berupa keyword.</p>

          <table class="table">
              <thead>
                  <th>Nama</th>
                  <th>Jenis Data</th>
                  <th>Keterangan</th>
              </thead>

              <tbody>
                  <tr>
                      <td>keyword</td>
                      <td>string</td>
                      <td>Harus diisi saat melakukan permintaan</td>
                  </tr>
                  <tr>
                      <td>limit</td>
                      <td>integer</td>
                      <td>Jumlah data yang ingin ditampilkan</td>
                  </tr>
                  <tr>
                      <td>page</td>
                      <td>integer</td>
                      <td>Indeks halaman yang dituju</td>
                  </tr>
                  <tr>
                      <td>sort</td>
                      <td>string</td>
                      <td>Pilihan data: asc, desc</td>
                  </tr>
              </tbody>
          </table>

          <pre>
              <code>
POST /api/glosarium/search?keyword=tekno HTTP/1.1
Host: glosarium.web.id
Content-Type: application/vnd.glosarium.api.v1+json

{
    "total": 1,
    "per_page": 20,
    "current_page": 1,
    "last_page": 1,
    "next_page_url": null,
    "prev_page_url": null,
    "from": 1,
    "to": 1,
    "data": [
        {
            "id": 1,
            "slug": "teknologi-informasi",
            "name": "Teknologi Informasi",
            "description": "Teknologi Informasi (TI), ...",
            "metadata": {
                "icon": "fa fa-desktop"
            },
            "url": "http:\/\/glosarium.web.id\/category\/teknologi-informasi",
            "updated_diff": "3 bulan yang lalu"
        }
    ]
}
              </code>
          </pre>
      </div>

        <div class="show-grid">
            <h3>
                Indeks Kata
                <small>
                    <a href="#word-index" id="word-index"><i class="fa fa-link"></i></a>
                </small>
            </h3>

            <p>Pengembang dapat menggunakan APA indeks kata untuk menampilkan semua kata yang dipecah ke dalam beberapa halaman.</p>

            <pre>
                <code>
$client = new http\Client;
$request = new http\Client\Request;

$token = 'your-token';

$request->setRequestUrl('http://glosarium.web.id/api/glosarium/word');
$request->setRequestMethod('GET');
$request->setQuery(new http\QueryString(array(
  'token' => $token,
  'page' => '1'
)));

$client->enqueue($request)->send();
$response = $client->getResponse();

echo $response->getBody();
                </code>
            </pre>
        </div>

        <div class="show-grid">
            <h3>
                Rincian Kata
                <small>
                    <a href="#word-show" id="word-show"><i class="fa fa-link"></i></a>
                </small>
            </h3>

            <p>Setiap indeks kata, dilengkapi dengan informasi slug. Slug ini dapat digunakan untuk mendapatkan rincian tiap kata.</p>

            <pre>
                <code>
$client = new http\Client;
$request = new http\Client\Request;

$token = 'your-token';
$slug = 'data';

$request->setRequestUrl('http://glosarium.web.id/api/glosarium/word/'. $slug);
$request->setRequestMethod('GET');
$request->setQuery(new http\QueryString(array(
  'token' => $token
)));

$client->enqueue($request)->send();
$response = $client->getResponse();

echo $response->getBody();
                </code>
            </pre>
        </div>

        <div class="show-grid">
            <h3>
                Pencarain Kata
                <small>
                    <a href="#word-search" id="word-search"><i class="fa fa-link"></i></a>
                </small>
            </h3>

            <p>Sama halnya dengan kategori, kata juga dapat dicari dengan menyertakan kata kunci dalam permintaan.</p>

            <pre>
                <code>
$client = new http\Client;
$request = new http\Client\Request;

$token = 'your-token';

$request->setRequestUrl('http://glosarium.web.id/api/glosarium/word/search');
$request->setRequestMethod('GET');
$request->setQuery(new http\QueryString(array(
  'token' => $token,
  'keyword' => 'data'
)));

$client->enqueue($request)->send();
$response = $client->getResponse();

echo $response->getBody();
                </code>
            </pre>
        </div>

        <div class="show-grid">
            <h3>
                Proposal Baru untuk Kata
                <small>
                    <a href="#word-propose" id="word-propose"><i class="fa fa-link"></i></a>
                </small>
            </h3>

            <p>Layaknya pada fitur aplikasi web, pengembang yang berstatus kontributor dapat mengirimkan proposal kata baru. Kata baru nantinya akan masuk ke dalam moderasi sebelum tayang di aplikasi atau di APA Glosarium.</p>

            <pre>
                <code>
$client = new http\Client;
$request = new http\Client\Request;

$body = new http\Message\Body;
$body->addForm(array(
  'category_id' => '1', // category id
  'lang' => 'en', // word lang: en, es, ar, etc
  'origin' => 'Mouse', // origin word
  'locale' => 'Tetikus' // word in locale
), NULL);

$request->setRequestUrl('http://glosarium.web.id/api/glosarium/word');
$request->setRequestMethod('POST');
$request->setBody($body);

$client->enqueue($request)->send();
$response = $client->getResponse();

echo $response->getBody();
                </code>
            </pre>
        </div>

        <hr>

        <div class="text-center">
            <strong class="text-uppercase">Bantuan</strong>
            <h2>Butuh bantuan seputar penggunaan APA?</h2>
            <div class="white-space-20"></div>
            <a href="{{ route('contact.form') }}" class="btn btn-t-primary  btn-theme">Hubungi Kami</a>
          </div>

    </div>


  </div>
</div>
@endsection

@push('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/monokai.css') }}">
@endpush

@push('js')
    <script>
        $(function(){
            $('#content').addClass('block-section line-bottom');
        });

        hljs.initHighlightingOnLoad();
    </script>
@endpush
