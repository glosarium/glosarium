@extends('layouts.app')

@push('metadata')
<meta name="title" content="{{ config('app.name') }}">
<meta name="description" content="{{ config('app.description') }}">
<meta name="author" content="{{ config('app.name') }}">

<meta property="og:title" content="{{ config('app.name') }}" />
<meta property="og:description" content="{{ config('app.description') }}" />
<meta property="og:author" content="{{ config('app.name') }}" />
<meta property="og:url" content="{{ url()->current() }}" />
<meta property="og:locale" content="id_ID" />
<meta property="og:site_name" content="{{ config('app.name') }}" />
@endpush

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            @include('controllers.words.partials.ad-billboard')
        </div>

        <div class="col-md-12 col-sm-12">
            <div class="panel panel-primary">
                <div class="panel-heading">{{ $title or config('app.name') }}</div>
                <div class="panel-body">

                <div class="row">
                    @foreach ($categories->chunk(15) as $chunk)
                        <div class="col-md-4">
                            <ul>
                            @foreach ($chunk as $category)
                                <li><a href="{{ route('word.category.show', [$category->slug]) }}">{{ $category->name }}</a></li>
                            @endforeach
                            </ul>
                        </div>
                    @endforeach
                </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
