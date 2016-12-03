@extends('layouts.app')

@push('metadata')
<meta name="title" content="{{ trans('word.apa') }}">
<meta name="description" content="{{ config('app.description') }}">
<meta name="author" content="{{ config('app.name') }}">

<meta property="og:title" content="{{ trans('word.apa') }}" />
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

        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading">{{ $title or null }}</div>
                <div class="panel-body">

                    {!! $page !!}

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
