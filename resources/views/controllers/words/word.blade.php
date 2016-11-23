@extends('layouts.app')

@push('metadata')
<meta name="title" content="{{ $word->glosarium }}">
@if (isset($word->descriptions) and $word->descriptions->count() >= 1)
<meta name="description" content="{{ $word->descriptions->first()->description }}">
@endif
<meta name="author" content="{{ config('app.name') }}">

<meta property="og:title" content="{{ $word->glosarium }}" />
@if (isset($word->descriptions) and $word->descriptions->count() >= 1)
<meta property="og:description" content="{{ $word->descriptions->first()->description }}" />
@endif
<meta property="og:author" content="{{ config('app.name') }}" />
<meta property="og:url" content="{{ url()->current() }}" />
<meta property="og:locale" content="id_ID" />
<meta property="og:image" content="{{ asset($path.$file) }}" />
<meta property="og:site_name" content="{{ config('app.name') }}" />
@endpush

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-7 col-sm-12">
            <div class="panel panel-primary">
                <div class="panel-heading">{{ $title or null }}</div>

                <div class="panel-body">
                    @include('controllers.words.partials.content')
                </div>
            </div>
        </div>

        <div class="col-md-5 col-sm-12">
            <div class="panel panel-default">
                <div class="panel-heading">Iklan</div>
                <div class="panel-body">
                    @include('controllers.words.partials.ad-responsive')
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">Kategori</div>
                <div class="panel-body">
                    <ul>
                        @foreach ($categories as $category)
                            <li><a href="{{ route('word.category', [$category->slug]) }}">{{ $category->name }}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
