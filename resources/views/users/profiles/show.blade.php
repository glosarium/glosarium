@extends('layouts.app')

@section('header')
<header class="page-header bg-img" style="background-image: url({{ asset('assets/img/bg-banner1.jpg') }})">
    <div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-4">
            <img src="{{ $user->avatar }}" alt="{{ $user->name }}">
        </div>

        <div class="col-xs-12 col-sm-8 header-detail">
            <div class="hgroup">
                <h1>{{ $user->name }}</h1>
                <h3>{{ ucwords($user->headline) }}</h3>
            </div>
            <hr>
            <p class="lead">
            @if (!empty($user->about))
                {{ $user->about }}
            @else
                Tidak ada keterangan untuk pengguna ini.
            @endif
            </p>
            </div>
        </div>

        
        <div class="button-group">
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

            @if (auth()->check() and (auth()->user()->id == $user->id))
                <div class="action-buttons">
                    <a class="btn btn-primary" href="{{ route('user.profile.edit') }}">Ubah Profil</a>
                </div>
            @endif
        </div>
    </div>
</header>
@endsection

@section('content')

@endsection