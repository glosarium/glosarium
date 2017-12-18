@extends('layouts.auth')

@section('content')
<div class="login-block">
    <h1>Daftar Sebagai Kontributor</h1>

    @include('partials.validation')

    <form action="{{ url('register') }}" method="post">
        {{ csrf_field() }} {{ method_field('post') }}

        <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon"><i class="ti-user"></i></span>
                <input type="text" name="name" class="form-control" placeholder="Nama lengkap" value="{{ old('name', session('provider') ? session('provider')->getName() : '') }}" autofocus="true">
            </div>
        </div>

        <hr class="hr-xs">

        <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon"><i class="ti-email"></i></span>
                <input type="email" name="email" class="form-control" placeholder="Alamat pos-el" value="{{ old('email') }}">
            </div>
        </div>

        <hr class="hr-xs">

        <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon"><i class="ti-unlock"></i></span>
                <input type="password" name="password" class="form-control" placeholder="Sandi lewat">
            </div>
        </div>

        <button class="btn btn-primary btn-block" type="submit">Daftar</button>

        <div class="login-footer">
            <h6>Atau masuk dengan media sosial</h6>
            <ul class="social-icons">
                <li><a class="facebook" href="{{ route('social.redirect', 'facebook') }}"><i class="fa fa-facebook"></i></a></li>
                <li><a class="twitter" href="{{ route('social.redirect', 'twitter') }}"><i class="fa fa-twitter"></i></a></li>
                <li><a class="linkedin" href="{{ route('social.redirect', 'linkedin') }}"><i class="fa fa-linkedin"></i></a></li>
                <li><a class="google-plus" href="{{ route('social.redirect', 'google') }}"><i class="fa fa-google-plus"></i></a></li>
                <li><a class="github" href="{{ route('social.redirect', 'github') }}"><i class="fa fa-github"></i></a></li>
                <li><a class="bitbucket" href="{{ route('social.redirect', 'bitbucket') }}"><i class="fa fa-bitbucket"></i></a></li>
            </ul>
        </div>

    </form>
</div>

<div class="login-links">
    <p class="text-center">Sudah punya akun? <a class="txt-brand" href="{{ route('login') }}">Masuk</a></p>
</div>
@endsection