@extends('layouts.app')

@section('header')
<header class="page-header bg-img size-lg" style="background-image: url({{ asset('assets/img/bg-banner2.jpg') }})">
    <div class="container no-shadow">
        <h1 class="text-center">Tentang Kami</h1>
        <p class="lead text-center">{{ config('app.description') }}.</p>
    </div>
</header>
@endsection

@section('content')
<section>
    <div class="container">
        <h5>Apa itu Glosarium?</h5>
        <p>Glosarium adalah suatu daftar alfabetis istilah dalam suatu ranah pengetahuan tertentu yang dilengkapi dengan definisi untuk istilah-istilah tersebut. Biasanya glosarium ada di bagian akhir suatu buku dan menyertakan istilah-istilah dalam buku tersebut yang baru diperkenalkan atau paling tidak, tak umum ditemukan. Glosarium dwibahasa adalah daftar istilah dalam satu bahasa yang didefinisikan dalam bahasa lain atau diberi sinonim (atau paling tidak sinonim terdekat) dalam bahasa lain.</p>
        <p>Dalam pengertian yang lebih umum, suatu glosarium berisi penjelasan konsep-konsep yang relevan dengan bidang ilmu atau kegiatan tertentu. Dalam pengertian ini, glosarium terkait dengan ontologi. glorasium juga dapat dikatakan sebagai daftar bentuk abjad yang terangkum dalam sebuah buku makalah dll yang memiliki arti dan kadang daftarnya sesuai urutan abjad biasanya juga sering ditemukan di akhir halaman.Glosarium sangat membantu untuk menemukan arti dari kata2 yang sulit.</p>
    </div>
</section>

<section class="bg-alt">
    <div class="container">
        <header class="section-header">
            <span>Siapa Kami</span>
            <h2>Tim Kontributor</h2>
            <p>Kontributor yang meluangkan waktunya untuk mengembangkan {{ config('app.name') }}</p>
        </header>
        <div class="row equal-team-members">
            @foreach ($users as $user)
            <div class="col-xs-12 col-sm-6 col-md-4">
                <div class="team-member">
                    <h5>
                        <a href="{{ route('user.profile.show', $user->username) }}" title="Lihat profil {{ $user->name }}">{{ $user->name }}</a>
                        <small>{{ $user->headline ? $user->headline : 'Kontributor' }}</small>
                    </h5>
                    <img src="{{ $user->avatar }}" alt="{{ $user->name }}">
                    <ul class="social-icons">
                        @if ($user->website)
                            <li><a class="git" target="_blank" href="{{ $user->website }}"><i class="fa fa-link"></i></a></li>
                        @endif

                        @if ($user->twitter)
                            <li><a class="twitter" target="_blank" href="{{ $user->twitter_link }}"><i class="fa fa-twitter"></i></a></li>
                        @endif

                        @if ($user->facebook)
                            <li><a class="facebook" target="_blank" href="{{ $user->facebook }}"><i class="fa fa-facebook"></i></a></li>
                        @endif

                        @if ($user->instagram)
                            <li><a class="instagram" target="_blank" href="{{ $user->instagram_link }}"><i class="fa fa-instagram"></i></a></li>
                        @endif
                    </ul>
                    <p>{{ $user->about }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endsection