@extends('layouts.app')

@push('metadata')
<meta name="title" content="{{ $title }}">
<meta name="description" content="{{ config('app.description') }}">
<meta name="author" content="{{ config('app.name') }}">

<meta property="og:title" content="{{ $title }}" />
<meta property="og:description" content="{{ config('app.description') }}" />
<meta property="og:author" content="{{ config('app.name') }}" />
<meta property="og:url" content="{{ url()->current() }}" />
<meta property="og:locale" content="id_ID" />
<meta property="og:site_name" content="{{ config('app.name') }}" />
<meta property="og:image" content="{{ asset($image) }}" />
@endpush

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12" style="margin-bottom: 20px;">
            @include('partials.ad-billboard')
        </div>

        <div class="col-md-7 col-sm-12">
            <div class="panel panel-primary">
                <div class="panel-heading">{{ $title or config('app.name') }}</div>
                <div class="panel-body">

                <div class="row">
                    @foreach ($categories->chunk(20) as $chunk)
                        <div class="col-md-4">
                            <ul>
                            @foreach ($chunk as $category)
                                <li>
                                    <a href="{{ route('word.category.show', [$category->slug]) }}">{{ $category->name }}</a>
                                </li>
                            @endforeach
                            </ul>
                        </div>
                    @endforeach
                </div>

                </div>
            </div>
        </div>

        <div class="col-md-5 col-sm-12">
            <div class="panel panel-default">
                <div class="panel-heading">@lang('word.new')</div>
                <div class="panel-body">
                    <ul>
                        @foreach ($words as $word)
                            <li>
                                <a href="{{ route('word.detail', [
                                    $word->category->data->slug,
                                    $word->slug
                                ]) }}">
                                    {{ $word->locale }}
                                </a>
                                <small class="text-muted">{{ $word->category->data->name }}</small>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
