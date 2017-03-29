@extends('layouts.app')

@push('metadata')
    <meta name="author" content="{{ config('app.name') }}">
    <meta name="description" content="{{ trans('api.description') }}">

    <meta property="og:title" content="{{ config('app.name') }}">
    <meta property="og:description" content="{{ trans('api.description') }}">
    <meta property="og:url" content="{{ url()->current() }}">
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
          @include('page.api.version')

          <ul class="list-unstyled">
            <li><a href="#intro" class="link-innerpage">Pengenalan</a></li>
            <li><a href="#features" class="link-innerpage">Fitur</a></li>
            <li><a href="#upgrade" class="link-innerpage">Memperbarui API dari Alpha ke Beta</a></li>

            <hr>
            <li><a href="#user-login" class="link-innerpage">Registrasi sebagai Kontributor</a></li>
            <li><a href="#user-register" class="link-innerpage">Masuk sebagai Kontributor</a></li>
            <hr>
            <li><a href="#category-index" class="link-innerpage">Indeks Kategori</a></li>
            <li><a href="#category-show" class="link-innerpage">Rincian Kategori</a></li>
            <li><a href="#category-search" class="link-innerpage">Pencarian Kategori</a></li>
            <li><a href="#category-random" class="link-innerpage">Kategori Acak</a></li>

            <hr>
            <li><a href="#word-index" class="link-innerpage">Indeks Kata</a></li>
            <li><a href="#word-show" class="link-innerpage">Rincian Kata</a></li>
            <li><a href="#word-search" class="link-innerpage">Pencarian Kata</a></li>
            <li><a href="#word-random" class="link-innerpage">Kata Acak</a></li>
          </ul>


        </div><!-- end nav afix -->

      </div>
      <div class="col-lg-9">
        <div class="show-grid">

        @if ($version != $latestApi)
        <div class="alert alert-warning">
          <p>Anda sedang membaca dokumentasi API versi {{ ucfirst($version) }}, yang mana dokumentasi API terbaru adalah versi {{ ucfirst($latestApi) }}.</p>
        </div>
        @endif

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
          Fitur APA
          <small>
            <a href="#features" id="features"><i class="fa fa-link"></i></a>
          </small>
        </h3>

        <p>Terdapat tiga fitur baru dalam APA versi Beta, yaitu:</p>
        <ol>
          <li>Memungkinkan mendaftarkan kontributor baru melalui aplikasi.</li>
          <li>Memungkinkan penggunakaan token berdasarkan kontributor lain yang terdaftar dan masuk melalui aplikasi.</li>
          <li>Pengajuan proposal untuk kata baru melalui APA</li>
        </ol>

        <p>Selain penambahan tiga fitur utama di atas, pada versi Beta juga terdapat perbahan mayor struktur data kembalian dari API. Masing-masing struktur data, dapat dilihat pada bagian respon tiap fitur di bawah.</p>
      </div>

      <div class="show-grid">
        <h3>
          Memperbarui API dari versi Alpha ke versi Beta
          <small>
            <a href="#upgrade" id="upgrade"><i class="fa fa-link"></i></a>
          </small>
        </h3>

        <p>Berikut beberapa langkah memperbarui APA dari versi Alpha ke versi Beta.</p>

        <h4>Mengubah titik akhir (<i>endpoint</i>) pada tautan APA</h4>
        <p>Jika sebelumnya menggunakan titik akhir seperti contoh berikut:</p>
        <pre>
          <code>
/api/glosarium/word
/api/glosarium/category
etc...
          </code>
        </pre>
        <p>Maka titik akhir untuk versi Beta diubah menjadi berikut</p>
        <pre>
          <code>
/api/beta/glosarium/word
/api/beta/glosarium/category
etc...
          </code>
        </pre>

      <h4>Melakukan pengecekan pada kembalian <i>header</i></h4>
      <p>Di versi Alpha, terdapat header khusus yang dikirim oleh server sebagai informasi versi yang digunakan, misal: </p>

      <pre>
        <code>
Content-Type: application/vnd.glosarium.api.v1+json
        </code>
      </pre>

      <p>Di versi Beta, ada sedikit perubahan nilai pada <i>header</i> tersebut. Hal ini untuk memberitahukan pada pengembang bahwa adanya perubahan versi.</p>

      <pre>
        <code>
Content-Type: application/vnd.glosarium.api.v2-beta+json
        </code>
      </pre>

      <h4>Menyesuaikan struktur data</h4>
      <p>Perubahan yang cukup signifikan di versi Beta adalah struktur data yang dikembalikan pada klien. Adapun, contoh struktur data tersebut dapat dilihat pada masing-masing fitur di bawah.</p>

      </div>

      <hr>

      <div class="show-grid">
          <h3>
            Registrasi sebagai Kontributor
            <small>
                <a href="#user-register" id="user-register"><i class="fa fa-link"></i></a>
            </small>
          </h3>

          <div class="alert alert-danger">
            <strong>Peringatan!</strong>
            <p>Glosarium berhak memroses secara hukum apabila terdapat pelanggaran atau penyalahgunaan data kontributor atau calon kontributor yang dilakukan oleh pengembang aplikasi.</p>
          </div>

          <p>Pengembang dapat menyediakan fitur registrasi kontributor pada aplikasinya. Kontributor sendiri nanti dapat berpartisipasi untuk mengajukan proposal kata baru, jajak pendapat, forum, dan lain sebagainya.</p>

          <p>Aplikasi yang dibuat pengembang hanya berperan untuk meneruskan data calon kontibutor ke APA Glosarium.</p>

          <p>Setiap kontributor terdaftar, akan memiliki token sendiri. Token ini nantinya akan dimanfaatkan untuk melakukan permintaan ke APA Glosarium.</p>

          <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#auth-response" aria-controls="home" role="tab" data-toggle="tab">Respon</a></li>
    <li role="presentation"><a href="#auth-data" aria-controls="messages" role="tab" data-toggle="tab">Data</a></li>
    <li role="presentation"><a href="#auth-php" aria-controls="profile" role="tab" data-toggle="tab">PHP</a></li>
  </ul>

  <!-- Tab panes -->
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="auth-response">
      <pre>
        <code>
POST /api/beta/user/register HTTP/1.1
Host: glosarium.web.id
Content-Type: application/vnd.glosarium.api.v2-beta+json

{
  "data": {
    "name": "Indah Kirana",
    "username": "indah-kirana-3",
    "type": "contributor",
    "createdAt": "2017-03-27T15:08:24+07:00",
    "updatedAt": "2017-03-27T15:08:24+07:00"
  }
}
        </code>
      </pre>
    </div>

    <div role="tabpanel" class="tab-pane" id="auth-data">
      <table class="table">
        <thead>
          <tr>
            <th>Data</th>
            <th>Jenis</th>
            <th>Keterangan</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>name</td>
            <td>string</td>
            <td></td>
          </tr>
          <tr>
            <td>username</td>
            <td>string</td>
            <td></td>
          </tr>
          <tr>
            <td>email</td>
            <td>string</td>
            <td></td>
          </tr>
          <tr>
            <td>password</td>
            <td>string</td>
            <td></td>
          </tr>
          <tr>
            <td>confirmPassword</td>
            <td>string</td>
            <td></td>
          </tr>
        </tbody>
      </table>
    </div>
    <div role="tabpanel" class="tab-pane" id="auth-php">
      <pre>
        <code>
$client = new http\Client;
$request = new http\Client\Request;

$token = 'your-token';

$body = new http\Message\Body;
$body->addForm(array(
  'password' => 'your-password',
  'confirmPassword' => 'your-password',
  'name' => 'Indah Kirana',
  'email' => 'indahksss@gmail.com'
), NULL);

$request->setRequestUrl('http://glosarium.dev/api/user/register');
$request->setRequestMethod('POST');
$request->setBody($body);

$request->setQuery(new http\QueryString(array(
  'token' => $token
)));

$client->enqueue($request)->send();
$response = $client->getResponse();

echo $response->getBody();
        </code>
      </pre>
    </div>
  </div>

</div>

          <div>
      </div>

      <div class="show-grid">
          <h3>
              Indeks Kategori
              <small>
                  <a href="#category-index" id="category-index"><i class="fa fa-link"></i></a>
              </small>
          </h3>

          <p>Untuk mendapatkan indeks kategori, dapat mengirimkan beberapa data dengan metode GET. Respon dari indeks kategori menampilkan informasi total kategori, tautan halaman, dan data kategori itu sendiri.</p>

          <div>

  <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#category-index-response" aria-controls="home" role="tab" data-toggle="tab">Respon</a></li>
    <li role="presentation"><a href="#category-index-data" aria-controls="messages" role="tab" data-toggle="tab">Data</a></li>
    <li role="presentation"><a href="#category-index-php" aria-controls="profile" role="tab" data-toggle="tab">PHP</a></li>
  </ul>

  <!-- Tab panes -->
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="category-index-response">
      <pre>
              <code>
GET /api/glosarium/category?token=your-token HTTP/1.1
Host: glosarium.web.id
Content-Type: application/vnd.glosarium.api.v1+json

{
    "total": 54,
    "per_page": 20,
    "current_page": 2,
    "last_page": 3,
    "next_page_url": "http:\/\/glosarium.web.id\/api\/glosarium\/category?&amp;token=your-token&amp;page=3",
    "prev_page_url": "http:\/\/glosarium.web.id\/api\/glosarium\/category?&amp;token=your-token&amp;page=1",
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
    </div>

    <div role="tabpanel" class="tab-pane" id="category-index-data">
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
                      <td>Jumlah data yang akan ditampikan, antara 1 sampai 25 data</td>
                  </tr>
                  <tr>
                      <td>page</td>
                      <td>integer</td>
                      <td>Indeks halaman yang dituju</td>
                  </tr>
                  <tr>
                      <td>sort</td>
                      <td>string</td>
                      <td>Urutkan kata berdasar, asc atau desc</td>
                  </tr>
              </tbody>
          </table>
    </div>
    <div role="tabpanel" class="tab-pane" id="category-index-php">

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
  </div>

</div>

      </div>

      <div class="show-grid">
          <h3>
              Rincian Kategori
              <small>
                  <a href="#category-show" id="category-show"><i class="fa fa-link"></i></a>
              </small>
          </h3>

          <p>Dari daftar indeks kategori yang didapat, pengembang dapat melakukan permintaan rincian kategori. Parameter yang akan digunakan untuk melakukan permintaan adalah slug.</p>

          <div>

  <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#category-show-response" aria-controls="home" role="tab" data-toggle="tab">Respon</a></li>
    <li role="presentation"><a href="#category-show-data" aria-controls="messages" role="tab" data-toggle="tab">Data</a></li>
    <li role="presentation"><a href="#category-show-php" aria-controls="profile" role="tab" data-toggle="tab">PHP</a></li>
  </ul>

  <!-- Tab panes -->
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane" id="category-show-response">
      <pre>
              <code>
POST /api/glosarium/category/agama-islam?token=your-token HTTP/1.1
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
    </div>


    <div role="tabpanel" class="tab-pane" id="category-show-data">
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
    </div>

    <div role="tabpanel" class="tab-pane active" id="category-show-php">
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

  </div>

</div>

      </div>

      <div class="show-grid">
          <h3>
              Pencarian Kategori
              <small>
                  <a href="#category-search" id="category-search"><i class="fa fa-link"></i></a>
              </small>
          </h3>

          <p>Pengembang juga dapat melakukan pencarian kategori berdasarkan kata kunci. Permintaanya tidak jauh berbeda dengan indeks kategori, hanya dibutuhkan tambahan query berupa keyword. Jumlah data pencarian bukan hanya satu, tapi banyak, dan formatnya tidak jauh berbeda dengan indeks kategori.</p>

          <div>

  <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#category-search-respon" aria-controls="home" role="tab" data-toggle="tab">Respon</a></li>
    <li role="presentation"><a href="#category-search-data" aria-controls="messages" role="tab" data-toggle="tab">Data</a></li>
    <li role="presentation"><a href="#category-search-php" aria-controls="profile" role="tab" data-toggle="tab">PHP</a></li>
  </ul>

  <!-- Tab panes -->
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="category-search-respon">
      <pre>
              <code>
POST /api/glosarium/category/search?keyword=tekno&amp;token=your-token HTTP/1.1
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
    <div role="tabpanel" class="tab-pane" id="category-search-data">
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
                      <td>Kata kunci pencarian</td>
                  </tr>
                  <tr>
                      <td>limit</td>
                      <td>integer</td>
                      <td>Jumlah data yang akan ditampikan, antara 1 sampai 25 data</td>
                  </tr>
                  <tr>
                      <td>page</td>
                      <td>integer</td>
                      <td>Indeks halaman yang dituju</td>
                  </tr>
                  <tr>
                      <td>sort</td>
                      <td>string</td>
                      <td>Urutkan kata berdasar, asc atau desc</td>
                  </tr>
              </tbody>
          </table>
    </div>
    <div role="tabpanel" class="tab-pane" id="category-search-php">
      <pre>
        <code>
$client = new http\Client;
$request = new http\Client\Request;

$token = 'your-token';
$keyword = 'tekno';

$request->setRequestUrl('http://glosarium.web.id/api/glosarium/category/search');
$request->setRequestMethod('GET');
$request->setQuery(new http\QueryString(array(
  'token' => $token,
  'keyword' => $keyword
)));

$client->enqueue($request)->send();
$response = $client->getResponse();

echo $response->getBody();
        </code>
      </pre>
    </div>
  </div>

</div>

      </div>

        <div class="show-grid">
          <h3>
            Kategori Acak
            <small>
              <a href="#category-random" id="category-random"><i class="fa fa-link"></i></a>
            </small>
          </h3>

          <p>Pengembang juga bisa mendapatkan kategori secara acak. Respo data yang dikembalikan hanya satu data. Formanya sama dengan rincian kategori.</p>

          <div>

  <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#category-random-response" aria-controls="home" role="tab" data-toggle="tab">Respon</a></li>
    <li role="presentation"><a href="#category-random-data" aria-controls="profile" role="tab" data-toggle="tab">Data</a></li>
    <li role="presentation"><a href="#category-random-php" aria-controls="messages" role="tab" data-toggle="tab">PHP</a></li>
  </ul>

  <!-- Tab panes -->
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="category-random-response">
      <pre>
        <code>
GET /api/glosarium/category/random?token=your-token HTTP/1.1
Host: glosarium.web.id
Content-Type: application/vnd.glosarium.api.v1+json

{
  "id": 21,
  "slug": "antropologi",
  "name": "Antropologi",
  "description": "Antropologi adalah ilmu tentang manusia...",
  "metadata": {
    "icon": "fa fa-bookmark"
  },
  "words_count": 3703,
  "url": "http:\/\/glosarium.web.id\/category\/antropologi",
  "updated_diff": "3 bulan yang lalu"
}
        </code>
      </pre>
    </div>
    <div role="tabpanel" class="tab-pane" id="category-random-data">
      <p>
        <div class="alert alert-info">Tidak ada data yang dikirim pada permintaan ini.</div>
      </p>
    </div>
    <div role="tabpanel" class="tab-pane" id="category-random-php">
    <pre>
      <code>
$client = new http\Client;
$request = new http\Client\Request;

$token = 'your-token';

$request->setRequestUrl('http://glosarium.web.id/api/glosarium/category/random');
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
  </div>

</div>
        </div>

        <div class="show-grid">
            <h3>
                Indeks Kata
                <small>
                    <a href="#word-index" id="word-index"><i class="fa fa-link"></i></a>
                </small>
            </h3>

            <p>Pengembang dapat menggunakan APA indeks kata untuk menampilkan semua kata yang dipecah ke dalam beberapa halaman.</p>

            <div>

  <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#word-index-response" aria-controls="home" role="tab" data-toggle="tab">Respon</a></li>
    <li role="presentation"><a href="#word-index-data" aria-controls="profile" role="tab" data-toggle="tab">Data</a></li>
    <li role="presentation"><a href="#word-index-php" aria-controls="messages" role="tab" data-toggle="tab">PHP</a></li>
  </ul>

  <!-- Tab panes -->
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="word-index-response">
      <pre>
        <code>
GET /api/glosarium/word?page=1&amp;limit=1&amp;token=your-token HTTP/1.1
Host: glosarium.web.id
Content-Type: application/vnd.glosarium.api.v1+json

{
  "total": 209341,
  "per_page": "2",
  "current_page": 1,
  "last_page": 104671,
  "next_page_url": "http:\/\/glosarium.web.id\/api\/glosarium\/word?page=2",
  "prev_page_url": null,
  "from": 1,
  "to": 2,
  "data": [
    {
      "slug": "transmisi-akustik",
      "origin": " Acoustic Transmission",
      "locale": "Transmisi Akustik",
      "lang": "en",
      "spell": null,
      "has_description": false,
      "url": "http:\/\/glosarium.web.id\/fisika\/transmisi-akustik",
      "updated_diff": "19 jam yang lalu",
      "short_url": "http:\/\/glosarium.web.id\/3xpkt",
      "edit_url": "http:\/\/glosarium.web.id\/admin\/glosarium\/word\/216925\/edit",
      "category": {
        "id": 3,
        "slug": "fisika",
        "name": "Fisika",
        "description": "Fisika (bahasa Yunani: φυσικός (fysikós)...",
        "metadata": {
          "icon": "fa fa-bookmark"
        },
        "url": "http:\/\/glosarium.web.id\/category\/fisika",
        "updated_diff": "3 bulan yang lalu"
      },
      "description": null
    },
    {
      "slug": "momentum-pemeliharaan",
      "origin": " Maintaining Momentum",
      "locale": "Momentum Pemeliharaan",
      "lang": "en",
      "spell": "",
      "has_description": false,
      "url": "http:\/\/glosarium.web.id\/pendidikan\/momentum-pemeliharaan",
      "updated_diff": "23 jam yang lalu",
      "short_url": "http:\/\/glosarium.web.id\/2l6ms",
      "edit_url": "http:\/\/glosarium.web.id\/admin\/glosarium\/word\/173904\/edit",
      "category": {
        "id": 31,
        "slug": "pendidikan",
        "name": "Pendidikan",
        "description": "Pendidikan adalah pembelajaran pengetahuan...",
        "metadata": {
          "icon": "fa fa-graduation-cap"
        },
        "url": "http:\/\/glosarium.web.id\/category\/pendidikan",
        "updated_diff": "3 bulan yang lalu"
      },
      "description": null
    }
  ]
}
        </code>
      </pre>
    </div>
    <div role="tabpanel" class="tab-pane" id="word-index-data">
      <table class="table">
        <thead>
          <tr>
            <th>Data</th>
            <th>Jenis</th>
            <th>Keterangan</th>
          </tr>
        </thead>

        <tbody>
          <tr>
            <td>limit</td>
            <td>integer</td>
            <td>Jumlah data yang akan ditampikan, antara 1 sampai 25 data</td>
          </tr>
          <tr>
            <td>sort</td>
            <td>string</td>
            <td>Urutkan kata berdasar, asc atau desc</td>
          </tr>
          <tr>
            <td>page</td>
            <td>integer</td>
            <td>Indeks halaman</td>
          </tr>
        </tbody>
      </table>
    </div>
    <div role="tabpanel" class="tab-pane" id="word-index-php">
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
  </div>

</div>


        </div>

        <div class="show-grid">
            <h3>
                Rincian Kata
                <small>
                    <a href="#word-show" id="word-show"><i class="fa fa-link"></i></a>
                </small>
            </h3>

            <p>Setiap indeks kata, dilengkapi dengan informasi slug. Slug ini dapat digunakan untuk mendapatkan rincian tiap kata. Setiap respon berhasil akan mengembalikan satu data kata. Sedangkan apanila permintaan gagal, APA akan mengembalikan data kosong dengan status 404.</p>

            <div>

  <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#word-show-response" aria-controls="home" role="tab" data-toggle="tab">Respon</a></li>
    <li role="presentation"><a href="#word-show-data" aria-controls="profile" role="tab" data-toggle="tab">Data</a></li>
    <li role="presentation"><a href="#word-show-php" aria-controls="messages" role="tab" data-toggle="tab">PHP</a></li>
  </ul>

  <!-- Tab panes -->
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="word-show-response">
      <pre>
        <code>
GET /api/glosarium/word/data?token=your-token HTTP/1.1
Host: glosarium.web.id
Content-Type: application/vnd.glosarium.api.v1+json

{
  "slug": "data",
  "origin": "Data",
  "locale": "Data",
  "lang": "en",
  "spell": "\/da-ta\/",
  "has_description": true,
  "url": "http:\/\/glosarium.web.id\/teknologi-informasi\/data",
  "updated_diff": "3 bulan yang lalu",
  "short_url": "http:\/\/glosarium.web.id\/2in",
  "edit_url": "http:\/\/glosarium.web.id\/admin\/glosarium\/word\/833\/edit",
  "category": {
    "id": 1,
    "slug": "teknologi-informasi",
    "name": "Teknologi Informasi",
    "description": "Teknologi Informasi (TI), atau...",
    "metadata": {
      "icon": "fa fa-desktop"
    },
    "url": "http:\/\/glosarium.web.id\/category\/teknologi-informasi",
    "updated_diff": "3 bulan yang lalu"
  },
  "description": {
    "id": 10,
    "word_id": 833,
    "title": "Data",
    "description": "Data adalah catatan atas kumpulan fakta...,
    "vote_up": 1,
    "vote_down": 0
  }
}
        </code>
      </pre>
    </div>
    <div role="tabpanel" class="tab-pane" id="word-show-data">
      <p>
        <div class="alert alert-info">Tidak ada data yang dikirim pada permintaan ini.</div>
      </p>
    </div>
    <div role="tabpanel" class="tab-pane" id="word-show-php">
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
  </div>

</div>


        </div>

        <div class="show-grid">
            <h3>
                Pencarian Kata
                <small>
                    <a href="#word-search" id="word-search"><i class="fa fa-link"></i></a>
                </small>
            </h3>

            <p>Sama halnya dengan kategori, kata juga dapat dicari dengan menyertakan kata kunci dalam permintaan.</p>

            <div>

  <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#word-search-response" aria-controls="home" role="tab" data-toggle="tab">Respon</a></li>
    <li role="presentation"><a href="#word-search-data" aria-controls="profile" role="tab" data-toggle="tab">Data</a></li>
    <li role="presentation"><a href="#word-search-php" aria-controls="messages" role="tab" data-toggle="tab">PHP</a></li>
  </ul>

  <!-- Tab panes -->
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="word-search-response">
      <pre>
        <code>
GET /api/glosarium/word/search?keyword=data&amp;token=your-token HTTP/1.1
Host: glosarium.web.id
Content-Type: application/vnd.glosarium.api.v1+json

{
  "total": 785,
  "per_page": "2",
  "current_page": 1,
  "last_page": 393,
  "next_page_url": "http:\/\/glosarium.web.id\/api\/glosarium\/word\/search?keyword=data&amp;limit=2&amp;token=your-token&amp;page=2",
  "prev_page_url": null,
  "from": 1,
  "to": 2,
  "data": [
    {
      "slug": "data-4",
      "origin": "Data",
      "locale": "Data",
      "lang": "en",
      "spell": "\/da-ta\/",
      "has_description": true,
      "url": null,
      "updated_diff": "3 bulan yang lalu",
      "short_url": "http:\/\/glosarium.web.id\/2kts2",
      "edit_url": "http:\/\/glosarium.web.id\/admin\/glosarium\/word\/171776\/edit"
    },
    {
      "slug": "data-6",
      "origin": "Data",
      "locale": "Data",
      "lang": "en",
      "spell": null,
      "has_description": true,
      "url": null,
      "updated_diff": "2 bulan yang lalu",
      "short_url": "http:\/\/glosarium.web.id\/3xb61",
      "edit_url": "http:\/\/glosarium.web.id\/admin\/glosarium\/word\/214289\/edit"
    }
  ]
}


        </code>
      </pre>
    </div>
    <div role="tabpanel" class="tab-pane" id="word-search-data">
      <table class="table">
        <thead>
          <tr>
            <th>Data</th>
            <th>Jenis</th>
            <th>Keterangan</th>
          </tr>
        </thead>

        <tbody>
          <tr>
            <td>keyword</td>
            <td>string</td>
            <td>Kata kunci pencarian</td>
          </tr>

          <tr>
            <td>limit</td>
            <td>integer</td>
            <td>Jumlah data yang akan ditampikan, antara 1 sampai 25 data</td>
          </tr>

          <tr>
            <td>sort</td>
            <td>string</td>
            <td>Urutkan kata berdasar, asc atau desc</td>
          </tr>
        </tbody>
      </table>
    </div>
    <div role="tabpanel" class="tab-pane" id="word-search-php">
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
  </div>

</div>


        </div>

        <div class="show-grid">
          <h3>
            Kata Acak
            <small>
              <a href="#word-random" id="word-random"><i class="fa fa-link"></i></a>
            </small>
          </h3>

          <p>Pengembang juga bisa mendapatkan kategori secara acak. Respo data yang dikembalikan hanya satu data. Formanya sama dengan rincian kategori.</p>

          <div>

  <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#word-random-response" aria-controls="home" role="tab" data-toggle="tab">Respon</a></li>
    <li role="presentation"><a href="#word-random-data" aria-controls="profile" role="tab" data-toggle="tab">Data</a></li>
    <li role="presentation"><a href="#word-random-php" aria-controls="messages" role="tab" data-toggle="tab">PHP</a></li>
  </ul>

  <!-- Tab panes -->
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="word-random-response">
      <pre>
        <code>
GET /api/glosarium/word/random?token=your-token HTTP/1.1
Host: glosarium.web.id
Content-Type: application/vnd.glosarium.api.v1+json

{
  "slug": "asam-lemak-1",
  "origin": "Fatty Acid",
  "locale": "Asam Lemak",
  "lang": "en",
  "spell": "",
  "has_description": true,
  "url": "http:\/\/glosarium.web.id\/biologi\/asam-lemak-1",
  "updated_diff": "3 bulan yang lalu",
  "short_url": "http:\/\/glosarium.web.id\/f3vk",
  "edit_url": "http:\/\/glosarium.web.id\/admin\/glosarium\/word\/48234\/edit",
  "category": {
    "id": 5,
    "slug": "biologi",
    "name": "Biologi",
    "description": "Biologi adalah kajian tentang kehidupan...",
    "metadata": {
      "icon": "fa fa-bug"
    },
    "url": "http:\/\/glosarium.web.id\/category\/biologi",
    "updated_diff": "3 bulan yang lalu"
  },
  "description": null
}
        </code>
      </pre>
    </div>
    <div role="tabpanel" class="tab-pane" id="word-random-data">
      <table class="table">
        <thead>
          <tr>
            <th>Data</th>
            <th>Jenis</th>
            <th>Keterangan</th>
          </tr>
        </thead>

        <tbody>
          <tr>
            <td>category</td>
            <td>string</td>
            <td>Masukkan slug kategori untuk kata acak pada kategori tertentu</td>
          </tr>
        </tbody>
      </table>
    </div>
    <div role="tabpanel" class="tab-pane" id="word-random-php">
      <pre>
        <code>
$client = new http\Client;
$request = new http\Client\Request;

$token = 'your-token';

$request->setRequestUrl('http://glosarium.web.id/api/glosarium/word/random');
$request->setRequestMethod('GET');
$request->setQuery(new http\QueryString(array(
  'token' => $token,
  'category' => 'teknologi-informasi'
)));

$client->enqueue($request)->send();
$response = $client->getResponse();

echo $response->getBody();
        </code>
      </pre>
    </div>
  </div>

</div>
        </div>
  </div>
</div>
@endsection

@push('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/monokai.css') }}">
@endpush

@push('js')
    <script src="{{ asset('js/api.js') }}"></script>
@endpush
