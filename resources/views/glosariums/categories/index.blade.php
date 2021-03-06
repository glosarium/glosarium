@extends('layouts.app')

@section('header')
<header class="page-header bg-img" style="background-image: url({{ asset('assets/img/bg-banner1.jpg') }});">
    <div class="container page-name">
    <h1 class="text-center">Semua Kategori</h1>
    <p class="lead text-center">Menampilkan semua kategori glosarium. Gunakan pencarian untuk mendapatkan data yang kamu butuhkan.</p>
    </div>

    <div class="container">
    <form action="{{ url()->current() }}" method="get">

        <div class="row">
            <div class="form-group col-xs-12 col-sm-12">
            <input type="text" name="katakunci" class="form-control" value="{{ request('katakunci') }}" placeholder="Katakunci kategori">
            </div>
        </div>

        <div class="button-group">
            <div class="action-buttons">
                <button type="submit" class="btn btn-primary">Saring</button>
            </div>
        </div>

    </form>

    </div>

</header>
@endsection

@section('content')
<section class="no-padding-top bg-alt">
    <div class="container">
        <div class="row">

        <div class="col-xs-12">
            <br>
                <h5>Menampilkan {{ $categories->total() }} kategori
            <br>
        </div>

        @if($categories->total() <= 0)
            <div class="col-xs-12">
                <p>Pencarian kamu - <strong>{{ request('katakunci') }}</strong> - tidak cocok dengan kata apapun.</p>
                <p>Saran:</p>
                <ul>
                    <li>Pastikan semua kata dieja dengan benar.</li>
                    <li>Coba kata kunci yang lain.</li>
                    <li>Coba kata kunci yang lebih umum.</li>
                    <li>Coba kurangi kata kunci.</li>
                </ul>
            </div>
        @endif

        @foreach ($categories as $category)
        <div class="col-xs-12">
            <a class="item-block" href="{{ route('glosarium.category.show', $category->slug) }}">
                <header>
                <div class="hgroup">
                    <h4>{{ $category->name }}</h4>
                    <h5><i class="{{ $category->metadata['icon'] }} fa-fw"></i></h5>
                </div>
                <span class="open-position">{{ number_format($category->words_count, 0, ',', '.') }} kata dalam kategori</span>
                </header>

                <div class="item-body">
                <p>{{ $category->description }}</p>
                </div>
            </a>
        </div>
        @endforeach

        </div>


        <!-- Page navigation -->
        <nav>
            {{ $categories->links() }}
        </nav>
        <!-- END Page navigation -->


    </div>
    </section>
@endsection