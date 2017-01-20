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
        <link href="{{ asset('vendor/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">

        <!-- Icons -->
        <link href="{{ asset('vendor/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">

        <!-- lightbox -->
        <link href="{{ asset('vendor/magnific-popup/dist/magnific-popup.css') }}" rel="stylesheet">

        <!-- Themes styles-->
        <link href="{{ asset('css/theme.css') }}" rel="stylesheet">
        @stack('css')

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

        @if (app()->environment('production', 'testing'))
            @include('partials/piwik')
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
                <div class="bg-color2" id="content">
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
                                <li><a href="{{ route('index') }}">Beranda</a></li>
                                <li><a href="{{ route('contact.form') }}">Kontak Kami</a></li>
                            </ul>
                        </div>
                        <div class="col-sm-6 ">
                            <p class="text-center-xs hidden-lg hidden-md hidden-sm">Stay Connect</p>
                            <div class="socials text-right text-center-xs">
                                <a href="#"><i class="fa fa-facebook"></i></a>
                                <a href="#"><i class="fa fa-twitter"></i></a>
                                <a href="#"><i class="fa fa-youtube-play"></i></a>
                                <a href="#"><i class="fa fa-linkedin"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
            <!-- end main-footer -->
        </div>
        <!-- end wrapper page -->

        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="{{ asset('vendor/jquery/dist/jquery.min.js') }}"></script>
        <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>

        <!-- jQuery Bootstrap -->
        <script src="{{ asset('vendor/bootstrap/dist/js/bootstrap.min.js') }}"></script>

        <!-- Lightbox -->
        <script src="{{ asset('vendor/magnific-popup/dist/jquery.magnific-popup.min.js') }}"></script>

        <!-- Theme JS -->
        <script src="{{ asset ('js/theme.js') }}"></script>

        <!-- External VueJS -->
        <script src="{{ asset('vendor/vue/dist/vue.min.js') }}"></script>
        <script src="{{ asset('vendor/vue-resource/dist/vue-resource.min.js') }}"></script>

        <script>
            window.Laravel = <?php echo json_encode(['csrfToken' => csrf_token(), 'env' => app()->environment()]); ?>;

            $(function(){
              $('a.logout').click(function(){
                $('#logout-form').submit();
                return false;
              })
            })
        </script>

        @stack('js')
    </body>
</html>