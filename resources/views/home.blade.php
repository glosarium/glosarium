@extends('layouts.app')

@section('header')
<header class="page-header bg-img text-center" style="background-image: url({{ asset('assets/img/bg-banner2.jpg') }})">
    <div class="container">
        <div class="col-xs-12">
            <h1>Glosarium Indonesia</h1>
            <h5 class="font-alt">Temukan kata dalam bahasa asing maupun padanan bahasa lokal, bahasa Indonesia.</h5>
            <br>
            <form action="{{ url()->current() }}" method="get">
                <div id="faq-search" class="form-group">
                    <i class="ti-search fa-flip-horizontal1"></i>
                    <input type="text" class="form-control" name="katakunci" placeholder="Bahasa asing maupun bahasa lokal..." value="{{ request('katakunci') }}">
                </div>
            </form>
        </div>
    </div>
</header>
@endsection

@section('content')
<main>
    <!-- Recent words -->
    @if (! empty($words))
    <section class="no-padding-top bg-alt">
        <div class="container">
            <header class="section-header latest-words">
                <span>Hasil Pencarian</span>
                @if ($words->total() >= 1)
                <h2>Hasil Pencarian untuk Kata "{{ request('katakunci') }}"</h2>
                @endif
            </header>
            @if ($words->total() <= 0)
            <p>Pencarian kamu - <strong>{{ request('katakunci') }}</strong> - tidak cocok dengan kata apapun.</p>
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
                                <h4>{{ strtolower($word->origin) }} <span class="label label-info">{{ $word->lang }}</span></h4>
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
@endsection