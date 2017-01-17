@extends('layouts.app')

@section('content')

<div class="panel panel-md">
    <div class="panel-body">
        <div class="row">
            <div class="col-md-12">
                <!-- buttons top -->
                <p><a href="#" class="btn btn-primary btn-theme btn-block"><i class="fa fa-facebook pull-left bordered-right"></i> Register with Facebook</a></p>
                <p><a href="#" class="btn btn-danger btn-theme btn-block"><i class="fa fa-google-plus pull-left bordered-right"></i> Register with Google</a></p>
                <!-- end buttons top -->
                <div class="white-space-10"></div>
                <p class="text-center"><span class="span-line">OR</span></p>
                <!-- form login -->
                <form action="{{ url('register') }}" method="post">
                    {{ csrf_field() }}

                    <div class="form-group {{ $errors->has('name') ? 'has-error': '' }}">
                        <label>Nama Lengkap</label>
                        <input type="text" name="name" class="form-control">
                    </div>

                    <div class="form-group {{ $errors->has('email') ? 'has-error': '' }}">
                        <label>Alamat Surel</label>
                        <input name="email" type="email" class="form-control" placeholder="">
                    </div>

                    <div class="form-group {{ $errors->has('password') ? 'has-error': '' }}">
                        <label>Katasandi</label>
                        <input name="password" type="password" class="form-control" placeholder="">
                    </div>

                    <div class="form-group {{ $errors->has('password_confirmation') ? 'has-error': '' }}">
                        <label>Konfirmasi Katasandi</label>
                        <input name="password_confirmation" type="password" class="form-control" placeholder="Ulangi kata sandi">
                    </div>

                    <div class="white-space-10"></div>
                    <div class="form-group no-margin">
                        <button class="btn btn-theme btn-lg btn-t-primary btn-block">Daftar</button>
                    </div>
                </form>
                <!-- form login -->
            </div>
        </div>
    </div>
</div>
<div class="white-space-20"></div>
<div class="text-center color-white">Dengan mendaftar sebagai kontributor, <br> Anda setuju dengan <strong><a href="#" class="color-white">Syarat dan Kondisi</a></strong> yang berlaku di {{ config('app.name') }}.</div>
@endsection

@push('js')
    <script>
        $(function(){
            $('#content').addClass('block-section bg-color4');
        })
    </script>
@endpush
