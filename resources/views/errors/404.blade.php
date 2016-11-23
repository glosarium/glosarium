@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            @include('controllers.words.partials.ad-billboard')
        </div>

        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading">Halaman tidak ditemukan</div>
                <div class="panel-body text-center">
                    <h2>Ups! 404</h2>
                    <p>Halaman yang Anda tuju tidak ditemukan atau sudah dihapus sebelumnya.</p>
                    <a href="{{ route('index') }}" class="btn btn-primary"><i class="fa fa-home"></i> Beranda</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
