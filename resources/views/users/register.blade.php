@extends('layouts.auth')

@section('content')
<div class="login-block">
  <a href="{{ route('home') }}" title="Kembali ke Beranda">
    <img src="{{ asset('img/logo.png') }}" alt="{{ config('app.name') }}">
  </a>
  <h1>Daftar Sebagai Kontributor</h1>

  <form action="#">

    <div class="form-group">
      <div class="input-group">
        <span class="input-group-addon"><i class="ti-user"></i></span>
        <input type="text" class="form-control" placeholder="Nama Lengkap">
      </div>
    </div>

    <hr class="hr-xs">

    <div class="form-group">
      <div class="input-group">
        <span class="input-group-addon"><i class="ti-email"></i></span>
        <input type="text" class="form-control" placeholder="Pos-el">
      </div>
    </div>

    <hr class="hr-xs">

    <div class="form-group">
      <div class="input-group">
        <span class="input-group-addon"><i class="ti-unlock"></i></span>
        <input type="password" class="form-control" placeholder="Sandi Lewat">
      </div>
    </div>

    <button class="btn btn-primary btn-block" type="submit">Daftar</button>

    <div class="login-footer">
      <h6>Atau daftar dengan sosial media</h6>
      <ul class="social-icons">
        <li><a class="facebook" href="#"><i class="fa fa-facebook"></i></a></li>
        <li><a class="twitter" href="#"><i class="fa fa-twitter"></i></a></li>
        <li><a class="linkedin" href="#"><i class="fa fa-linkedin"></i></a></li>
      </ul>
    </div>

  </form>
</div>

<div class="login-links">
  <p class="text-center">Sudah punya akun? <a class="txt-brand" href="{{ route('login') }}">Masuk</a></p>
</div>
@endsection
