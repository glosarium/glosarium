<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1"> {!! SEO::generate() !!}

    <!-- Styles -->
    <link href="{{ asset('css/app.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">

    <!-- Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Oswald:100,300,400,500,600,800%7COpen+Sans:300,400,500,600,700,800%7CMontserrat:400,700'
        rel='stylesheet' type='text/css'>

    <!-- Favicons -->
    <link rel="icon" href="{{ asset('img/favicon.ico') }}">
</head>

<body class="nav-on-header smart-nav">

    <!-- Navigation bar -->
    <nav class="navbar">
        <div class="container">

            <!-- Logo -->
            <div class="pull-left">
                <a class="navbar-toggle" href="#" data-toggle="offcanvas"><i class="ti-menu"></i></a>

                <div class="logo-wrapper">
                    <a class="logo" href="{{ route('home') }}"></a>
                    <a class="logo-alt" href="{{ route('home') }}"></a>
                </div>

            </div>
            <!-- END Logo -->

            @guest
            <!-- User account -->
            <div class="pull-right user-login">
                <a class="btn btn-sm btn-primary" href="{{ route('login') }}">Masuk</a> atau <a href="{{ route('register') }}">Daftar sebagai Kontributor</a>
            </div>
            <!-- END User account -->
            @endguest
            
            @auth
            <!-- User account -->
            <div class="pull-right">

                <div class="dropdown user-account">
                    <a class="dropdown-toggle" href="#" data-toggle="dropdown">
                        <img src="{{ auth()->user()->avatar }}" alt="{{ auth()->user()->name }}">
                    </a>

                    <ul class="dropdown-menu dropdown-menu-right">
                        {{--  <li><a href="">Dasbor ({{ auth()->user()->name }})</a></li>  --}}
                        <li><a href="{{ route('user.profile.show', auth()->user()->username) }}">Profil Saya</a></li>
                        <li><a href="{{ route('glosarium.word.contribute') }}">Kontribusi Kata</a> </li>
                        <li><a href="{{ route('user.password.edit') }}">Ubah Sandi Lewat</a></li>
                        <li><a href="{{ route('logout') }}">Keluar</a></li>
                    </ul>
                </div>

            </div>
            <!-- END User account -->
            @endauth

            <!-- Navigation menu -->
            <ul class="nav-menu">
                <li><a href="{{ route('home') }}">Beranda</a></li>
                <li><a href="{{ route('glosarium.word.index') }}">Jelajahi Kata</a></li>
                <li><a href="{{ route('glosarium.category.index') }}">Kategori</a></li>
                <li><a href="{{ route('blog.index') }}">Blog</a></li>
                <li><a href="{{ route('page.about') }}">Tentang Kami</a></li>
                <li><a href="{{ route('contact.form') }}">Kontak</a></li>

                @if(auth()->check() and auth()->user()->type == 'admin')
                    <li>
                        <a href="#">Administrasi</a>
                        <ul>
                            <li><a href="{{ route('glosarium.word.all') }}">Kata</a></li>
                            <li><a href="{{ route('user.glosarium.category.index') }}">Kategori</a></li>
                            <li><a href="{{ route('dictionary.word.index') }}">Kamus</a></li>
                            <li><a href="{{ route('user.index') }}">Kontributor</a></li>
                            <li><a href="{{ config('services.blog.url') }}wp-admin">Blog</a></li>
                            <li><a href="{{ route('contact.index') }}">Kotak Masuk (Kontak)</a></li>
                            <li><a href="{{ url('horizon') }}">Horizon (Antrian)</a></li>
                            <li><a href="{{ url('log-viewer') }}">Log Kesalahan</a></li>
                        </ul>
                    </li>
                @endif
            </ul>
            <!-- END Navigation menu -->

        </div>
    </nav>
    <!-- END Navigation bar -->


    <!-- Page header -->
    @yield('header')
    <!-- END Page header -->


    <!-- Main container -->
    <main>

        @yield('content')

    </main>
    <!-- END Main container -->


    <!-- Site footer -->
    <footer class="site-footer">

        @include('layouts.partials.footer')

    </footer>
    <!-- END Site footer -->


    <!-- Back to top button -->
    <a id="scroll-up" href="#" title="Kembali ke atas"><i class="ti-angle-up"></i></a>
    <!-- END Back to top button -->

    <!-- Scripts -->
    <script src="{{ asset('js/app.min.js') }}"></script>
    <script src="{{ asset('js/custom.js') }}"></script>

    @stack('js')

</body>

</html>