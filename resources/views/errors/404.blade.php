@extends('layouts.app')

@section('header')
<header class="page-header bg-img" style="background-image: url(assets/img/bg-banner1.jpg)">
    <div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-12 header-detail">
        <div class="hgroup">
            <h1>404</h1>
            <h3>{{ $exception->getMessage() }}</h3>
        </div>
        <hr>
        <p class="lead">
			Halaman yang kamu cari tidak ditemukan atau sudah dihapus sebelumnya. <a href="{{ route('home') }}">Kembali ke Beranda</a>.
        </p>
        </div>
    </div>
    </div>
</header>
@endsection

@section('content')

@endsection