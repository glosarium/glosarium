@extends('layouts.app')

@section('heading')
  @include('partials.title')
@stop

@section('content')
@include('user.partial.sidebar')
<div class="col-md-10 col-sm-10">
<!-- Block side right -->
<div class="block-section box-side-account">
   <div class="row">
      <div class="alert alert-warning">
         <strong>Peringatan</strong>
         <p>Jangan memberitahukan token pada pihak yang tidak berwenang, dan simpan token pada tempat yang aman.</p>
      </div>

      <div class="form-group">
            <textarea class="form-control" rows="5" readonly="true">{{ $token }}</textarea>
      </div>
      <button class="btn btn-default">
         Salin Token
      </button>

      <hr>

      <p>Untuk penggunakan Antarmuka Pemrograman Aplikasi yang disediakan oleh Glosarium, pengembang dapat mempelajarinya pada halaman <a href="{{ route('api.index') }}">dokumentasi APA</a>. </p>
   </div>
</div>
<!-- end Block side right -->
@endsection
