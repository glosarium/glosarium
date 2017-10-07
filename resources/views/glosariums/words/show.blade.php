@extends('layouts.app')

@section('header')
<header class="page-header bg-img size-lg" style="background-image: url({{ asset('img/bg-banner2.jpg') }})">
  <div class="container">
    <div class="header-detail">
      <div class="hgroup">
        <h1>{{ $word->origin }} <span class="label label-info">{{ $word->lang }}</span></h1>
        <h3>{{ $word->locale }}</h3>
      </div>
      <time datetime="{{ $word->created_at->format('Y-m-d H:i:s') }}">{{ $word->created_diff }}</time>
      <hr>

      @if (!empty($word->description))
        <p class="lead">{{ $word->description['description'] }}</p>
      @else
        <p class="lead">Beluma ada deskripsi untuk padanan kata <strong>{{ $word->locale }}</strong>.</p>
      @endif

      <ul class="details cols-3">
        <li>
          <i class="{{ $word->category->metadata['icon'] }} fa-fw"></i>
          <span>{{ $word->category->name }}</span>
        </li>

        <li>
          <i class="fa fa-user fa-fw"></i>
          <span><a href="#" title="Lihat profil {{ $word->user->name }}">{{ $word->user->name }}</a></span>
        </li>

        <li>
          <i class="fa fa-link fa-fw"></i>
          <span>{{ $word->short_url }} <a href="#"><i class="fa fa-copy fa-fw"></i></a></span>
        </li>
      </ul>

      <div class="button-group">
        <ul class="social-icons">
          <li class="title">Bagikan pada</li>
          <li><a class="facebook" href="#"><i class="fa fa-facebook"></i></a></li>
          <li><a class="google-plus" href="#"><i class="fa fa-google-plus"></i></a></li>
          <li><a class="twitter" href="#"><i class="fa fa-twitter"></i></a></li>
          <li><a class="linkedin" href="#"><i class="fa fa-linkedin"></i></a></li>
        </ul>

        <div class="action-buttons">
          <a href="{{ route('home', [
            'word' => request('word'),
            'page' => request('page'),
            'source' => $word->slug
          ]) }}" class="btn btn-success">
            Kembali
          </a>
          <a class="btn btn-info" href="#" disabled="true">
              <i class="fa fa"></i>
              Favorit
          </a>
        </div>
      </div>

    </div>
  </div>
</header>
@endsection

@section('content')
  <section class="no-padding-top">
    <div class="container">
      <h3 class="text-center">Diskusi Tentang Padanan Kata "{{ $word->locale }}"</h3>

      @include('partials.disqus.comment', [
        'url' => route('glosarium.word.show', [
          $word->category->slug,
          $word->slug
        ]),
        'id' => sha1($word->id)
      ])
    </div>
  </section>
@endsection

@push('js')
  <script id="dsq-count-scr" src="//glosarium.disqus.com/count.js" async></script>
@endpush
