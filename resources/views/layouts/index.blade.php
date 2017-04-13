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
                @include('partials/analytic')
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
                                @include('layouts.partials.menu')
                            </ul>
                            <ul class="nav navbar-nav navbar-right">
                                @if (auth()->check())
                                <li class="dropdown">
                                    <a href="#" class="link-profile dropdown-toggle"  data-toggle="dropdown" >
                                    <img src="https://www.gravatar.com/avatar/{{ md5(auth()->user()->email) }}" alt="{{ auth()->user()->name }}" class="img-profile"> &nbsp; {{ auth()->user()->name }} ({{ auth()->user()->role_name }}) <b class="caret"></b>
                                    </a>
                                    <ul class="dropdown-menu" role="menu">
                                        <li><a href="{{ url('user/#/dashboard') }}">@lang('user.dashboard')</a></li>
                                        <li><a href="{{ url('user/#/notification') }}">Notifikasi <span class="badge">{{ auth()->user()->unreadNotifications->count() }}</span></a></li>
                                        <li><a href="{{ url('user/#/password') }}">Ubah Sandi Lewat</a></li>
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
                <div class="container">
                    <div class="col-md-12">
                        <app-search v-if="app.search" placeholder=""></app-search>
                        <app-title v-else
                            url="{{ route('glosarium.word.index') }}"
                            img="{{ asset('images/glosarium.png') }}"
                        ></app-title>
                    </div>
                </div>
            </header>
            <!-- end main-header -->

            <!-- body-content -->
            <div class="body-content clearfix">
                <div class="bg-color1" id="content">
                    <div class="container">
                        <router-view></router-view>
                    </div>
                </div>
            </div>
            <!--end body-content -->

            <!-- main-footer -->
            @include('layouts.partials.footer')
            <!-- end main-footer -->
        </div>
        <!-- end wrapper page -->

        @include('layouts.partials.js')

        <script src="{{ asset('js/app.js') }}"></script>

        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="{{ asset('js/jquery.easing.js') }}"></script>

        <!-- jQuery Bootstrap -->
        <script src="{{ asset('js/bootstrap.js') }}"></script>

        <!-- Lightbox -->
        <script src="{{ asset('js/magnific-popup.js') }}"></script>

        <!-- Theme JS -->
        <script src="{{ asset ('js/theme.js') }}"></script>

        <!-- Router -->
        <script src="{{ asset('js/router/glosarium.js') }}"></script>

        @stack('js')
    </body>
</html>
