@extends('layouts.auth')

@section('content')
<div class="login-block">
  <a href="{{ route('home') }}" title="Kembali ke Beranda">
  </a>
  <h1>Masuk ke Akun Kamu</h1>

  <form action="{{ route('login') }}" method="post">
    {{ csrf_field() }}
    {{ method_field('post') }}

    <div class="form-group">
      <div class="input-group">
        <span class="input-group-addon"><i class="ti-email"></i></span>
        <input type="email" name="email" class="form-control" placeholder="Pos-el">
      </div>
    </div>

    <hr class="hr-xs">

    <div class="form-group">
      <div class="input-group">
        <span class="input-group-addon"><i class="ti-unlock"></i></span>
        <input type="password" name="password" class="form-control" placeholder="Sandi Lewat">
      </div>
    </div>

    <button class="btn btn-primary btn-block" type="submit">Login</button>

    <div class="login-footer">
      <h6>Atau masuk dengan sosial media</h6>
      <ul class="social-icons">
        <li><a class="facebook" href="#"><i class="fa fa-facebook"></i></a></li>
        <li><a class="twitter" href="#"><i class="fa fa-twitter"></i></a></li>
        <li><a class="linkedin" href="#"><i class="fa fa-linkedin"></i></a></li>
      </ul>
    </div>

  </form>
</div>

<div class="login-links">
  <a class="pull-left" href="user-forget-pass.html">Lupa sandi lewat?</a>
  <a class="pull-right" href="{{ route('register') }}">Daftar akun baru</a>
</div>
@endsection
