@extends('layouts.app')

@section('header')
<header class="page-header bg-img size-lg" style="background-image: url({{ asset('img/bg-banner2.jpg') }})">
  <div class="container">
    <div class="header-detail">
      <div class="hgroup">
        <h1>{{ $word->origin }} <span class="label label-info">{{ $word->lang }}</span></h1>
        <h3>{{ $word->locale }} <small>{{ $word->spell }}</small></h3>
      </div>
      <time datetime="{{ $word->created_at->format('Y-m-d H:i:s') }}">{{ $word->created_diff }}</time>
      <hr>

      @if (!empty($word->description))
        @if ($word->description->vote_down > $word->description->vote_up)
          <div class="alert alert-warning">
            <strong>Perhatian!</strong><br/>
            Dikarenakan banyaknya resensi negatif, deskripsi di bawah mungkin tidak sesuai dengan penjelasan untuk padanan kata <strong>{{ $word->locale }}</strong>.
          </div>
        @endif

        <p class="lead">{{ $word->description['description'] }}</p>
        <p>Sumber: <a href="{{ $word->description->url }}" target="_blank" title="Lihat {{ $word->description->title }} di Wikipedia ">{{ $word->description->url }}</a>.</p>
      @else
        <p class="lead">
          Belum ada deskripsi untuk padanan kata <strong>{{ $word->locale }}</strong>.
          @if (! empty($dictionaries->first()->descriptions))
            Arti per kata di bawah mungkin bisa menjelaskan padanan kata tersebut.
          @endif
        </p>

        @if (! empty($dictionaries))
          @foreach($dictionaries as $dictionary)
              <h3>{{ $dictionary->word }} <small>{{ $dictionary->pronounciation }}</small></h3>
              <ol>
                @foreach($dictionary->descriptions as $description)
                  <li>
                    {{ $description->text }}
                    @if (! empty($description->sample))
                      <span class="sample">{{ $description->sample }}</sample>
                    @endif
                    </li>
                @endforeach
              </ol>
          @endforeach
        @endif
      @endif

      <ul class="details cols-3">
        <li>
          <i class="{{ $word->category->metadata['icon'] }} fa-fw"></i>
          <span><a href="{{ route('glosarium.category.show', $word->category->slug) }}">{{ $word->category->name }}</a></span>
        </li>

        @if (! empty($word->user))
        <li>
          <i class="fa fa-user fa-fw"></i>
          <span><a href="{{ route('user.profile.show', $word->user->username) }}" title="Lihat profil {{ $word->user->name }}">{{ $word->user->name }}</a></span>
        </li>
        @endif

        @if (! empty($word->short_url))
        <li>
          <i class="fa fa-link fa-fw"></i>
          <span>{{ $word->short_url }}</span>
          <span>
            <a href="#" id="copy-url" title="Salin tautan pendek" data-clipboard-text="{{ $word->short_url }}"><i class="fa fa-copy fa-fw"></i></a>
          </span>
        </li>
        @endif
        
      </ul>

      <div class="button-group">
        <ul class="social-icons">
          <li class="title">Bagikan pada</li>
          <li><a class="facebook" href="https://www.facebook.com/sharer/sharer.php?u={{ url()->current() }}"><i class="fa fa-facebook"></i></a></li>
          <li><a class="google-plus" href="https://plus.google.com/share?url={{ url()->current() }}"><i class="fa fa-google-plus"></i></a></li>
          
          @if (empty($word->short_url))
            <li><a class="twitter" href="https://twitter.com/intent/tweet?url={{ url()->current() }}&text=Padanan kata {{ $word->origin }} ({{ $word->lang }}) adalah {{ $word->locale }}.&hashtags=glosarium,bahasa,indonesia"><i class="fa fa-twitter"></i></a></li>
          @else
            <li><a class="twitter" href="https://twitter.com/intent/tweet?url={{ $word->short_url }}&text=Padanan kata {{ $word->origin }} ({{ $word->lang }}) adalah {{ $word->locale }}.&hashtags=glosarium,bahasa,indonesia"><i class="fa fa-twitter"></i></a></li>
          @endif

          <li><a class="linkedin" href="https://www.linkedin.com/shareArticle?mini=true&url={{ url()->current() }}&title=Padanan kata {{ $word->origin }} ({{ $word->lang }}) adalah {{ $word->locale }}&summary=&source="><i class="fa fa-linkedin"></i></a></li>
        </ul>

        <div class="action-buttons">
          <div class="btn-group">
            <button type="button" class="btn btn-primary"><i class="fa fa-thumbs-up fa-fw"></i> 0</button>
            <button type="button" class="btn btn-danger"><i class="fa fa-thumbs-down fa-fw"></i> 0</button>
            <button type="button" class="btn btn-info"><i class="fa fa-bookmark fa-fw"></i> {{ $word->favorites_count }}</button>
          </div>
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
  <script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/1.7.1/clipboard.min.js"></script>
  <script>
    var clipboard = new Clipboard('#copy-url')
  </script>
@endpush
