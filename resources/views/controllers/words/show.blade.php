@extends('layouts.app')

@push('metadata')
<meta name="title" content="{{ $word->locale }}">
@if (isset($word->descriptions) and $word->descriptions->count() >= 1)
<meta name="description" content="{{ $word->descriptions->first()->description }}">
@endif
<meta name="author" content="{{ config('app.name') }}">

<meta property="og:title" content="{{ $word->locale }}" />
@if (isset($word->descriptions) and $word->descriptions->count() >= 1)
<meta property="og:description" content="{{ $word->descriptions->first()->description }}" />
@else
<meta property="og:description" content="{{ config('app.description') }}" />
@endif
<meta property="og:author" content="{{ config('app.name') }}" />
<meta property="og:url" content="{{ url()->current() }}" />
<meta property="og:locale" content="id_ID" />
<meta property="og:image" content="{{ asset($image) }}" />
<meta property="og:site_name" content="{{ config('app.name') }}" />
@endpush

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-7 col-sm-12">
            <div class="panel panel-primary">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            <form action="{{ route('index') }}" method="GET" role="form" id="form-word">
                                <div class="input-group">
                                    <input id="word" type="text" name="kata" value="{{ request('kata') }}" class="form-control" placeholder="@lang('word.search')">
                                    <span class="input-group-btn">
                                    <button class="btn btn-primary" type="submit">@lang('word.btn.search')</button>
                                    </span>
                                </div>

                            </form>
                        </div>
                    </div>

                    <hr>

                    @include('controllers.words.partials.content')

                    <div class="row">
                        <div class="col-md-12">
                            <h4>Bagikan:</h4>
                            <div
                              class="fb-like"
                              data-share="true"
                              data-width="450"
                              data-show-faces="true">
                            </div>

                            @if (view()->exists('partials.disqus'))
                                @include('partials.disqus', [
                                    'slug' => $word->slug
                                ])
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-5 col-sm-12">
            <div class="panel panel-default">
                <div class="panel-heading">Iklan</div>
                <div class="panel-body">
                    @include('partials.ad-responsive')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
    <script src=" {{ asset('components/devbridge-autocomplete/dist/jquery.autocomplete.min.js') }}"></script>
@endpush

@push('script')
    <script>
        $(function(){
            $('#word').autocomplete({
                serviceUrl: '{{ route('word.search') }}',
                minChars: 3,
                groupBy: 'category',
                onSelect: function(suggestion) {
                    $(location).attr('href', suggestion.data.url)
                }
            })
        })
    </script>
@endpush

@push('structured-data')
    <script type="application/ld+json">
        {!! json_encode([
            '@context' => 'http://schema.org',
            '@type' => 'BreadcrumbList',
            'itemListElement' => [
                [
                    '@type' => 'ListItem',
                    'position' => 1,
                    'item' => [
                        '@type' => 'Thing',
                        '@id' => route('word.category.show', [$word->category->slug]),
                        'name' => $word->category->name,
                        'image' => asset('image/category/'.$word->category->slug.'.jpg')
                    ]
                ],
                [
                    '@type' => 'ListItem',
                    'position' => 2,
                    'item' => [
                        '@type' => 'Thing',
                        '@id' => route('word.detail', [$word->category->slug, $word->slug]),
                        'name' => $word->locale,
                        'image' => asset($image)
                    ]
                ]
            ]
        ]) !!}
    </script>
@endpush
