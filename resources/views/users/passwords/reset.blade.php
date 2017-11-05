{{ debug($errors)}}
@extends('layouts.auth')
@section('content')
<div class="login-block">
    <h1>Setel Ulang Sandi Lewat</h1>
    <form action="{{ url('password/reset') }}" method="post">
        {{ csrf_field() }}
        {{ method_field('post') }}

        <input type="hidden" name="token" value="{{ $token }}">

        @include('partials.validation')

        <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon"><i class="ti-email"></i></span>
                <input type="email" name="email" class="form-control" placeholder="Alamat pos-el" value="{{ old('email', $email) }}" autofocus="true">
            </div>
        </div>
        <hr class="hr-xs"/>
        <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon"><i class="ti-key"></i></span>
                <input type="password" name="password" class="form-control" placeholder="Sandi lewat baru">
            </div>
        </div>
        <hr class="hr-xs"/>
        <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon"><i class="ti-key"></i></span>
                <input type="password" name="password_confirmation" class="form-control" placeholder="Konfirmasi sandi lewat" autofocus="true">
            </div>
        </div>
        <button class="btn btn-primary btn-block" type="submit">Setel Ulang</button>
    </form>
</div>
<div class="login-links">
    <a class="pull-left" href="{{ route('login') }}">Masuk</a>
    <a class="pull-right" href="{{ route('home') }}">Beranda</a>
</div>
@endsection