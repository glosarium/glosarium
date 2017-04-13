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
      <div class="panel panel-default">
         <div class="panel-heading">Selamat datang!</div>
         <div class="panel-body">
            <p>Halo {{ ucwords(auth()->user()->name) }}, <br> Terima kasih telah bergabung dengan Glosarium Indonesia. Pada halaman kontributor, Anda dapat berkontribusi dengan menambahkan kata baru dengan mengklik <a href="{{ route('glosarium.word.create') }}">tautan ini</a>. Kontribusi Anda sangat membantu dalam perkembangan aplikasi Glosarium Indonesia.</p>

            <p>Anda juga dapat mnegubah <a href="{{ route('user.password.form') }}">sandi lewat</a> dan membaca <a href="{{ route('user.notification.index') }}">notifikasi</a> yang masuk pada akun Anda.</p>

            <p>Jika Anda menemukan kesalahan aplikasi, ada pertanyaan, saran maupun kritik, jangan sungkan untuk menyampaikannya melalui <a href="{{ route('contact.form') }}">formulir kontak</a>.</p>

            <p>Hormat kami.</p>
         </div>
      </div>
   </div>
</div>
<!-- end Block side right -->
@endsection
