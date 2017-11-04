@extends('layouts.app')

@section('header')
<header class="page-header bg-img size-xl overlay-light" style="background-image: url({{ $image->source_url }})">
    <div class="container no-shadow">
        <h1 class="text-center">{{ $post->title->rendered }}</h1>
        <p class="lead text-center">
            <time datetime="{{ Carbon\Carbon::parse($post->modified)->format('Y-m-d H:i:s') }}">
                {{ Carbon\Carbon::parse($post->modified)->diffForHumans() }}
            </time>
        </p>
    </div>
</header>
@endsection

@section('content')
<main class="container blog-page">
    <div class="row">
        <div class="col-md-8 col-lg-9">
            <article class="post">
                <div class="blog-content">
                    {!! $post->content->rendered !!}
                </div>
                <ul class="post-meta">
                    <li>
                        <strong>Kategori: </strong>
                        @foreach($post->_embedded->{'wp:term'}[0] as $category)
                            @php
                                $categoryCollection[] = '<a href="'. route('blog.index', ['kategori' => $category->slug]) .'">'. $category->name .'</a>';
                            @endphp
                        @endforeach

                        {!! implode(', ', $categoryCollection) !!}.
                    </li>
                    <li>
                        <strong>Tag: </strong>
                        @foreach($post->_embedded->{'wp:term'}[1] as $tag)
                            @php
                                $tagCollection[] = '<a href="'. route('blog.index', ['tag' => $tag->slug]) .'">'.$tag->name.'</a>'; 
                            @endphp
                        @endforeach

                        {!! implode(', ', $tagCollection) !!}.
                    </li>
                </ul>
                <div id="comments">
                    <header>
                        <h3>Komentar <span class="txt-gray">(<span class="disqus-comment-count" data-disqus-url="{{ url()->current() }}"></span>)</span></h3>
                    </header>
                    @include('partials.disqus.comment', [
                        'url' => url()->current(),
                        'id' => $post->id
                    ])
                </div>
            </article>
        </div>
        
        @include('blogs.sidebar')
    </div>
</main>
@endsection

@push('js')
    @include('partials.disqus.count')
@endpush