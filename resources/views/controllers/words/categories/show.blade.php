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
        <div class="col-md-12">
            @include('partials.ad-billboard')
        </div>

        <div class="col-md-12 col-sm-12">
            <div class="panel panel-primary">
                <div class="panel-heading">{{ $category->name }} ({{ number_format($words->total(), 0, ',', '.') }})</div>
                <div class="panel-body">

                <div class="row">
                    @foreach ($words->chunk(30) as $chunk)
                        <div class="col-md-4">
                            <ul>
                            @foreach ($chunk as $word)
                                <li><a href="{{ route('word.detail', [$category->slug, $word->slug]) }}">{{ $word->locale }}</a> ({{ $word->foreign }})</li>
                            @endforeach
                            </ul>
                        </div>
                    @endforeach
                </div>

                {{ $words->links() }}

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
