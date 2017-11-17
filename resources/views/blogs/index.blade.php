@extends('layouts.app')

@section('header')
<header class="page-header bg-img size-lg" style="background-image: url(assets/img/bg-banner2.jpg)">
    <div class="container no-shadow">
        <h1 class="text-center">Blog</h1>
        <p class="lead text-center">{{ $info->description }}</p>
    </div>
</header>
@endsection

@section('content')
<main class="container blog-page">
    <div class="row">
        <div class="col-md-8 col-lg-9">
            @if (request('s'))
                <p class="lead">Hasil pencarian untuk katakunci: <strong>{{ request('s') }}</strong>.</p>
                <hr>
            @endif

            @foreach ($posts as $post)
            <article class="post">
                @if (isset($post->_embedded->{'wp:featuredmedia'}))
                <div class="post-media">
                    <a href="{{ route('blog.show', $post->slug) }}">
                        @php
                            $media = collect($post->_embedded->{'wp:featuredmedia'})->first();
                        @endphp
                        <img src="{{ $media->media_details->sizes->full->source_url }}" alt="{{ $media->caption->rendered }}">
                    </a>
                </div>
                @endif
                <header>
                    <h2><a href="{{ route('blog.show', $post->slug) }}">{{ $post->title->rendered }}</a></h2>
                    <time datetime="{{ Carbon\Carbon::parse($post->date)->format('Y-m-d H:i:s') }}">
                        {{ Carbon\Carbon::parse($post->date)->diffForHumans() }}
                    </time>
                </header>
                <div class="blog-content">
                    {!! $post->excerpt->rendered !!}
                </div>
                <p class="read-more">
                    <a class="btn btn-primary btn-outline" href="{{ route('blog.show', $post->slug) }}">Lanjutkan Membaca</a>
                </p>
            </article>
            @endforeach
            {{--  <nav>
                <ul class="pager">
                    <li class="previous"><a href="#"><i class="ti-arrow-left"></i> Sebelumnya</a></li>
                    <li class="next"><a href="#">Selanjutnya <i class="ti-arrow-right"></i></a></li>
                </ul>
            </nav>  --}}
        </div>
        
        @include('blogs.sidebar')
    </div>
</main>
@endsection