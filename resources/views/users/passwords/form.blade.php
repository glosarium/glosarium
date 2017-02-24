@extends('layouts.app')

@section('content')

@include('users.partials.sidebar')

<div class="col-md-10 col-sm-10">
<!-- Block side right -->
<div class="block-section box-side-account">
    <h3 class="no-margin-top">{{ $title }}</h3>
    <hr/>
    <div class="row">
        <div class="col-md-7">

        	@include('partials.message')

            <form action="{{ route('user.password.update') }}" method="post">
            	{{ csrf_field() }}

                <div class="form-group {{ $errors->has('current_password') ? 'has-error' : '' }}">
                    <label>Sandi Lewat Sekarang</label>
                    <input name="current_password" type="password" class="form-control">
                </div>
                <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                    <label>Sandi Lewat Baru</label>
                    <input name="password" type="password" class="form-control">
                </div>
                <div class="form-group {{ $errors->has('password_confirmation') ? 'has-error' : '' }}">
                    <label>Konfirmasi Sandi Lewat</label>
                    <input name="password_confirmation" type="password" class="form-control">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-theme btn-t-primary">Ubah Sandi Lewat</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- end Block side right -->
@endsection
