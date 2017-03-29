<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        @stack('metadata')

        <title>{{ $title or config('app.name') }}</title>
        <!--favicon-->
        <link rel="apple-touch-icon" href="{{ asset('images/apple-touch-icon.png') }}">
        <link rel="shortcut icon" href="{{ asset('images/favicon.ico') }}" type="image/x-icon">

        <!-- bootstrap -->
        <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">

        <!-- Icons -->
        <link href="{{ asset('css/font-awesome.css') }}" rel="stylesheet">

        <!-- lightbox -->
        <link href="{{ asset('css/magnific-popup.css') }}" rel="stylesheet">

        <!-- Themes styles-->
        <link href="{{ asset('css/theme.css') }}" rel="stylesheet">
        @stack('css')

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

        @if (app()->environment('production'))
            @if ((auth()->check() and auth()->user()->type != 'admin') or ! auth()->check())
                @include('partials/piwik')
            @endif

            @include('partials.ads.level')
        @endif
    </head>
    <body>
        <!-- wrapper page -->
        <div class="wrapper" id="app">
            <!-- main-header -->
            <header class="main-header">
                <!-- main navbar -->
                <nav class="navbar navbar-default main-navbar hidden-sm hidden-xs">
                    <div class="container">
                        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                            <ul class="nav navbar-nav">
                                @include('partials.menu')
                            </ul>
                            <form id="logout-form" action="{{ url('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                            <ul class="nav navbar-nav navbar-right">
                                @if (auth()->check())
                                <li class="dropdown">
                                    <a href="#" class="link-profile dropdown-toggle"  data-toggle="dropdown" >
                                    <img src="https://www.gravatar.com/avatar/{{ md5(auth()->user()->email) }}" alt="{{ auth()->user()->name }}" class="img-profile"> &nbsp; {{ auth()->user()->name }} <b class="caret"></b>
                                    </a>
                                    <ul class="dropdown-menu" role="menu">
                                        <li><a href="#">Beranda</a></li>
                                        <li><a href="{{ route('user.notification.index') }}">Notifikasi <span class="badge">{{ auth()->user()->unreadNotifications->count() }}</span></a></li>
                                        <li><a href="{{ route('user.password.form') }}">Ubah Sandi Lewat</a></li>
                                    </ul>
                                </li>
                                <li class="link-btn"><a href="{{ url('logout') }}" class="logout"><span class="btn btn-theme  btn-pill btn-xs btn-line">Keluar</span></a></li>
                                @else
                                <li class="link-btn"><a href="{{ url('login') }}"><span class="btn btn-theme btn-pill btn-xs btn-line">Masuk</span></a></li>
                                <li class="link-btn"><a href="{{ url('register') }}"><span class="btn btn-theme  btn-pill btn-xs btn-line">Daftar Sebagai Kontributor</span></a></li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </nav>
                <!-- end main navbar -->
                <!-- mobile navbar -->
                <div class="container">
                    <nav class="mobile-nav hidden-md hidden-lg">
                        <ul class="nav navbar-nav nav-block-left">
                                @if (auth()->check())
                                <li class="dropdown">
                                    <a href="#" class="link-profile dropdown-toggle"  data-toggle="dropdown" >
                                    <img src="https://www.gravatar.com/avatar/{{ md5(auth()->user()->email) }}" alt="{{ auth()->user()->name }}" class="img-profile"> &nbsp; {{ auth()->user()->name }} <b class="caret"></b>
                                    </a>
                                    <ul class="dropdown-menu" role="menu">
                                        <li><a href="#">Beranda</a></li>
                                        <li><a href="{{ route('user.notification.index') }}">Notifikasi <span class="badge">{{ auth()->user()->unreadNotifications->count() }}</span></a></li>
                                        <li><a href="{{ route('user.password.form') }}">Ubah Sandi Lewat</a></li>
                                    </ul>
                                </li>
                                @endif
                            </ul>
                        <a href="#" class="btn-nav-toogle first">
                        <span class="bars"></span>
                        Menu
                        </a>
                        <div class="mobile-nav-block">
                            <h4>Navigasi</h4>
                            <a href="#" class="btn-nav-toogle">
                            <span class="barsclose"></span>
                            Tutup
                            </a>
                            <ul class="nav navbar-nav">
                                @include('partials.menu')
                            </ul>
                        </div>
                    </nav>
                </div>
                <!-- mobile navbar -->
                <!-- form search area-->
                @yield('heading')
            </header>
            <!-- end main-header -->

            <!-- body-content -->
            <div class="body-content clearfix">
                <div class="bg-color1" id="content">
                    <div class="container">
                        @yield('content')
                    </div>
                </div>
            </div>
            <!--end body-content -->

            <!-- main-footer -->
            <footer class="main-footer">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-6">
                            <ul class="list-inline link-footer text-center-xs">
                                <li><a href="{{ route('glosarium.word.index') }}">Beranda</a></li>
                                <li><a href="{{ route('contact.form') }}">Kontak Kami</a></li>
                                <li><a href="{{ route('page.api.index', ['beta']) }}">API (Beta)</a></li>
                                <li><a href="http://s.id/glosariumLINE">LINE@</a></li>
                                @if (app()->environment('local'))
                                    <li><a href="https://www.laravel.com">Laravel {{ $laravelVersion }}</a></li>
                                @endif
                            </ul>
                        </div>
                        <div class="col-sm-6 ">
                            <p class="text-center-xs hidden-lg hidden-md hidden-sm">Tetap Terhubung</p>
                            <div class="socials text-right text-center-xs">
                                <a href="https://facebook.com/arvernester"><i class="fa fa-facebook"></i></a>
                                <a href="https://twitter.com/arvernester"><i class="fa fa-twitter"></i></a>
                                <a href="https://id.linkedin.com/in/arvernester"><i class="fa fa-linkedin"></i></a>
                                <a href="https://instagram.com/glosariumid"><i class="fa fa-instagram"></i></a>
                                <a href="http://yugo.my.id"><i class="fa fa-rss"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
            <!-- end main-footer -->
        </div>
        <!-- end wrapper page -->

        <script>
            window.Laravel = {!! json_encode([
                'locale' => config('app.locale'),
                'csrfToken' => csrf_token(),
                'url' => env('APP_URL'),
                'auth' => auth()->check()
            ]) !!}
        </script>

        <script src="{{ asset('js/app.js') }}"></script>

        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="{{ asset('js/jquery.easing.js') }}"></script>

        <!-- jQuery Bootstrap -->
        <script src="{{ asset('js/bootstrap.js') }}"></script>

        <!-- Lightbox -->
        <script src="{{ asset('js/magnific-popup.js') }}"></script>

        <!-- Theme JS -->
        <script src="{{ asset ('js/theme.js') }}"></script>

        @stack('js')
    </body>
</html>
