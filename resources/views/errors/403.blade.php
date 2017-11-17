@extends('layouts.app')

@section('header')
<header class="page-header bg-img" style="background-image: url(assets/img/bg-banner1.jpg)">
    <div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-12 header-detail">
        <div class="hgroup">
            <h1>403</h1>
            <h3>Hak akses ditolak.</h3>
        </div>
        <hr>
        <p class="lead">
			Kamu tidak punya hak akses untuk membuka halaman ini.
            <a href="{{ route('contact.form') }}">Kontak kami</a> jika kamu mengalami kendala seputar penggunaan aplikasi.
        </p>

        <p>
            <i class="fa fa-home"></i> 
            <a href="{{ route('home') }}">Kembali ke Beranda</a>
        </p>
        </div>
    </div>
    </div>
</header>
@endsection

@section('content')

@endsection