@extends('layouts.app')

@section('header')
<header class="page-header bg-img size-lg" style="background-image: url({{ asset('img/bg-banner1.jpg') }})">
  <div class="container no-shadow">
    <h3 class="text-center"><span class="{{ $category->metadata['icon'] }}"></span></h3>
    <h1 class="text-center">{{ $category->name }}</h1>
    <p class="lead text-center">{{ $category->description }}</p>
  </div>
</header>
@endsection

@section('content')
<section class="no-padding-top bg-alt">
  <div class="container">
    <div class="row item-blocks-condensed">

      <div class="col-xs-12 text-right">
        <br>
        <a class="btn btn-primary btn-sm" href="company-add.html">Tambah Kata Baru</a>
      </div>


      @foreach ($words as $word)
      <!-- Words item -->
      <div class="col-xs-12">
        <a class="item-block" href="{{ route('glosarium.word.show', [
          $word->category->slug,
          $word->slug,
          'word' => request('word'),
          'page' => request('page')
        ]) }}" title="Lihat rincian untuk {{ $word->origin }}">
          <header>
            <div class="hgroup">
              <h4>{{ strtolower($word->oritgin) }} <span class="label label-success">{{ $word->lang }}</span></h4>
              <h5>{{ strtolower($word->locale) }}</h5>
            </div>
            <time datetime="2016-03-10 20:00">{{ $word->created_diff }}</time>
          </header>

          @if (! empty($word->description))
          <div class="item-body">
            <p>{{ $word->description['description'] }}</p>
          </div>
          @endif

          <footer>
            <ul class="details cols-3">
              <li>
                <i class="fa fa-user fa-fw"></i>
                <span>{{ $word->user->name }}</span>
              </li>

              <li>
                <i class="fa fa-link fa-fw"></i>
                <span>{{ $word->short_url}}</span>
              </li>

              <li>
                <i class="fa fa-thumbs-up fa-fw"></i>
                <span>{{ $word->favorites_count }} Favorit</span>
              </li>
            </ul>
          </footer>
        </a>
      </div>
      <!-- END Words item -->
      @endforeach

      <div class="col-md-12">
        {{ $words->links() }}
      </div>

    </div>
  </div>
</section>
@endsection
