<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {!! SEO::generate() !!}

    <!-- Styles -->
    <link href="{{ asset('css/app.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">

    <!-- Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Oswald:100,300,400,500,600,800%7COpen+Sans:300,400,500,600,700,800%7CMontserrat:400,700' rel='stylesheet' type='text/css'>

    <!-- Favicons -->
    <link rel="icon" href="{{ asset('img/favicon.ico') }}">
  </head>

  <body class="nav-on-header smart-nav">

    <!-- Main container -->
    <main>

      <section class="no-padding-top">
        <div class="container">
          <div class="row logo">
            <div class="row text-center">
              <a href="{{ route('home') }}" title="Kembali ke Beranda">
                <img src="{{ asset('img/logo.png') }}" alt="{{ config('app.name') }}">
              </a>
            </div>
          </div>

          <div class="row">
            <div class="col-xs-12">
              <form class="header-job-search" method="get" action="{{ url()->current() }}">

                <div class="input-keyword">
                  <input type="search" name="word" class="form-control" placeholder="Kata dalam bahasa asing maupun bahasa lokal" value="{{ request('word') }}">
                </div>

                <div class="btn-search">
                  <button class="btn btn-primary" type="submit">Cari Kata</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </section>

      <!-- Recent words -->
      @if (! empty($words))
      <section class="no-padding-top bg-alt">
        <div class="container">


        <header class="section-header latest-words">
          <span>Pencarian</span>
          @if ($words->total() >= 1)
              <h2>Hasil Pencarian untuk Kata "{{ request('word') }}"</h2>
          @endif
        </header>

          @if ($words->total() <= 0)
            <p>Pencarian kamu - <strong>{{ request('word') }}</strong> - tidak cocok dengan kata apapun.</p>

            <p>Saran:</p>

            <ul>
              <li>Pastikan semua kata dieja dengan benar.</li>
              <li>Coba kata kunci yang lain.</li>
              <li>Coba kata kunci yang lebih umum.</li>
              <li>Coba kurangi kata kunci.</li>
            </ul>
          @endif

          <div class="row item-blocks-condensed">

            <!-- Job item -->
            @foreach ($words as $word)
            <div class="col-xs-12">
              <a class="item-block" href="{{ route('glosarium.word.show', [
                $word->category->slug,
                $word->slug,
                'word' => request('word'),
                'page' => request('page')
              ]) }}" title="Lihat rincian untuk {{ $word->origin }} - {{ $word->locale }}">
                <header>
                  <div class="hgroup">
                    <h4>{{ strtolower($word->origin) }} <span class="label label-success">{{ $word->lang }}</span></h4>
                    <h5>{{ strtolower($word->locale) }}</h5>
                  </div>
                  <time datetime="2016-03-10 20:00">{{ $word->created_diff }}</time>
                </header>

                @if (! empty($word->description))
                <div class="item-body">
                  <p>{{ $word->description['description'] }}</p>
                </div>
                @endif

                <footer>
                  <ul class="details cols-3">
                    <li>
                      <i class="{{ $word->category->metadata['icon'] }} fa-fw"></i>
                      <span>{{ $word->category->name }}</span>
                    </li>

                    <li>
                      <i class="fa fa-user fa-fw"></i>
                      <span>{{ $word->user->name }}</span>
                    </li>

                    <li>
                      <i class="fa fa-link fa-fw"></i>
                      <span>{{ $word->short_url}}</span>
                    </li>
                  </ul>
                </footer>
              </a>
            </div>
            @endforeach
            <!-- END words item -->

          </div>

          <footer>
            {{ $words->links() }}
          </footer>
        </div>
      </section>
      @endif
      <!-- END Recent words -->

      <!-- Categories -->
      <section class=" bg-alt">
        <div class="container">
          <header class="section-header">
            <span>Kategori</span>
            <h2>Menampilkan Kategori Acak</h2>
            <p>Kategori acak akan berubah setiap harinya</p>
          </header>

          <div class="category-grid">
            @foreach ($categories as $category)
            <a href="{{ route('glosarium.category.show', $category->slug) }}">
              <i class="{{ $category->metadata['icon'] }} fa-fw"></i>
              <h6>
                {{ $category->name }} <br>
                <small>{{ number_format($category->words_count, 0, ',', '.') }} kata</small>
              </h6>

              <p>{{ str_limit($category->description, 120) }}</p>
            </a>
            @endforeach
          </div>

        </div>
      </section>
      <!-- END Categories -->


      <!-- Newsletter -->
      <section class="bg-img text-center" style="background-image: url(assets/img/bg-facts.jpg)">
        <div class="container">
          <h2><strong>Berlangganan</strong></h2>
          <h6 class="font-alt">Berlangganan nawala untuk mendapatkan informasi terbaru</h6>
          <br><br>
          <form class="form-subscribe" method="post" action="{{ route('newsletter.subscriber.subscribe') }}">
            {{ csrf_field() }}
            {{ method_field('post') }}

            <div class="input-group">
              <input type="text" name="email" class="form-control input-lg" placeholder="Alamat pos-el kamu">
              <span class="input-group-btn">
                <button class="btn btn-success btn-lg" type="submit">Berlangganan</button>
              </span>
            </div>
          </form>
        </div>
      </section>
      <!-- END Newsletter -->


    </main>
    <!-- END Main container -->


    <!-- Site footer -->
    <footer class="site-footer">

      @include('layouts.partials.footer')

    </footer>
    <!-- END Site footer -->


    <!-- Back to top button -->
    <a id="scroll-up" href="#"><i class="ti-angle-up"></i></a>
    <!-- END Back to top button -->

    <!-- Scripts -->
    <script src="{{ asset('js/app.min.js') }}"></script>
    <script src="{{ asset('js/custom.js') }}"></script>

  </body>
</html>
