@extends('layouts.app') @section('header')
<header class="page-header bg-img">
    <div class="container page-name">
        <h1 class="text-center">Ubah Sandi Lewat</h1>
    </div>
    <div class="container">
        <div class="row">

            <div class="col-md-12">
                @include('partials.message')
            </div>

            <form method="post" action="{{ route('user.password.update') }}">
                {{ csrf_field() }}
                {{ method_field('post') }}

                @if(! empty(auth()->user()->password))
                <div class="form-group col-xs-12 col-sm-12 {{ !$errors->has('current_password') ?: 'has-error' }}">
                    <label>Sandi lewat lama</label>
                    <input type="password" name="current_password" class="form-control" autofocus="true">
                    <span class="help-block">{{ $errors->first('current_password') }}</span>
                </div>
                @endif
                
                <div class="form-group col-xs-12 col-sm-6 {{ !$errors->has('password') ?: 'has-error' }}">
                    <label>Sandi lewat baru</label>
                    <input type="password" name="password" class="form-control">
                    <span class="help-block">{{ $errors->first('password') }}</span>
                </div>

                <div class="form-group col-xs-12 col-sm-6 {{ !$errors->has('password_confirmation') ?: 'has-error' }}">
                    <label>Konfirmasi sandi lewat</label>
                    <input type="password" name="password_confirmation" class="form-control">
                    <span class="help-block">{{ $errors->first('password_confirmation') }}</span>
                </div>
        </div>
        <div class="button-group">
            <div class="action-buttons">
                <div class="upload-button">
                    <button type="submit" class="btn btn-block btn-primary">
                        {{ ! empty(auth()->user()->password) ? 'Ubah Sandi Lewat' : 'Setel Sandi Lewat' }}
                    </button>
                </div>
            </div>
        </div>
        </form>
    </div>
</header>
@endsection