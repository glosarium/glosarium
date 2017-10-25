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
            <input type="text" name="keyword" class="form-control" value="{{ request('keyword') }}" placeholder="Katakunci kategori">
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
        <div class="row item-blocks-connected">

        <div class="col-xs-12">
            <br>
                <h5>Menampilkan {{ $categories->total() }} kategori
            <br>
        </div>

        @foreach ($categories as $category)
        <div class="col-xs-12">
            <a class="item-block" href="{{ route('glosarium.category.show', $category->slug) }}">
                <header>                    
                    <div class="hgroup">
                    <h4> <i class="fa-fw {{ $category->metadata['icon'] }}"></i> {{ $category->name }}</h4>
                    <h5>{{ number_format($category->words_count, 0, ',', '.') }} kata</h5>
                    <p class="lead">{{ $category->description }}</p>
                    </div>
                </header>
            </a>
        </div>
        @endforeach

        </div>


        <!-- Page navigation -->
        <nav class="text-center">
            {{ $categories->links() }}
        </nav>
        <!-- END Page navigation -->


    </div>
    </section>
@endsection