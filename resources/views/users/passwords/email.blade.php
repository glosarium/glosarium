@extends('layouts.auth')
@section('content')
<div class="login-block">
    <h1>Lupa Sandi Lewat?</h1>
    <form action="{{ route('password.email') }}" method="post">
        {{ csrf_field() }}
        {{ method_field('post') }}

        <p class="lead">Pos-el berisi instruksi cara mengubah sandi lewat akan dikirim ke alamat pos-el terdaftar.</p>

        @include('partials.validation')

        <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon"><i class="ti-email"></i></span>
                <input type="email" name="email" class="form-control" placeholder="Alamat pos-el" autofocus="true">
            </div>
        </div>
        <button class="btn btn-primary btn-block" type="submit">Kirim Instruksi</button>
    </form>
</div>
<div class="login-links">
    <a class="pull-left" href="{{ route('login') }}">Masuk</a>
    <a class="pull-right" href="{{ route('home') }}">Beranda</a>
</div>
@endsection