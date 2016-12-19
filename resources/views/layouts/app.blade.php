<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @stack('metadata')

    <title>{{ $title or config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('vendor/gsdk/bootstrap3/css/bootstrap.min.css') }}">
    {{-- <link rel="stylesheet" href="{{ asset('vendor/gsdk/bootstrap3/css/bootstrap-theme.min.css') }}"> --}}
    <link rel="stylesheet" href="{{ asset('vendor/gsdk/assets/css/gsdk.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/gsdk/assets/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    @stack('css')
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name', 'Laravel') }}
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="{{ route('word.category') }}">Kategori</a></li>
                        <li><a href="{{ route('word.random') }}">@lang('word.random')</a></li>
                        <li><a href="{{ route('word.create') }}">@lang('word.create')</a></li>
                        <li><a href="{{ route('word.api') }}">@lang('word.api')</a></li>
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                            <li><a href="{{ url('/login') }}">@lang('user.login')</a></li>
                            <li><a href="{{ url('/register') }}">@lang('user.register')</a></li>
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{ route('user.password.form') }}">@lang('user.changePassword')</a>
                                    </li>
                                    <li>
                                        <a href="{{ url('/logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            @lang('user.logout')
                                        </a>

                                        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>

        @yield('content')
    </div>

    <!-- Scripts -->
    <script type="text/javascript" src="{{ asset('vendor/gsdk/jquery/jquery-1.10.2.js') }}"></script>
    <script type="text/javascript" src="{{ asset('vendor/gsdk/bootstrap3/js/bootstrap.min.js') }}" /></script>
    <script type="text/javascript" src="{{ asset('vendor/gsdk/assets/js/gsdk-checkbox.js') }}"></script>
    <script type="text/javascript" src="{{ asset('vendor/gsdk/assets/js/gsdk-radio.js') }}"></script>
    <script type="text/javascript" src="{{ asset('vendor/gsdk/assets/js/gsdk-bootstrapswitch.js') }}"></script>
    <script type="text/javascript" src="{{ asset('vendor/gsdk/assets/js/get-shit-done.js') }}"></script>

    @stack('js')
    @stack('script')

    @include('partials.ga-analytic')
    @include('partials.fb-app')

    @stack('structured-data')
    <script type="application/ld+json">
        {
          "@context": "http://schema.org",
          "@type": "WebSite",
          "name": "{{ config('app.name')}} ",
          "alternateName": "{{ config('app.description') }}",
          "url": "{{ route('index') }}"
        }
    </script>
</body>
</html>
