@extends('layouts.app')

@section('header')
<header class="page-header bg-img" style="background-image: url(assets/img/bg-banner1.jpg)">
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

        @if (auth()->check() and (auth()->user()->id == $user->id))
        <div class="button-group">
          <div class="action-buttons">
            <a class="btn btn-success" href="{{ route('user.profile.edit') }}">Ubah Profil</a>
          </div>
        </div>
        @endif
    </div>
</header>
@endsection

@section('content')

@endsection