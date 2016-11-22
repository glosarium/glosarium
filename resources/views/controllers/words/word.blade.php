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
<meta property="og:image" content="{{ asset(sprintf('image/%s/%s', substr($word->slug, 0, 1), $file)) }}" />
<meta property="og:site_name" content="{{ config('app.name') }}" />
@endpush

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-sm-12">
            <div class="panel panel-primary">
                <div class="panel-heading">{{ $title or null }}</div>

                <div class="panel-body">
                    <h2>
                        ({{ $word->origin }}) {{ $word->glosarium }}
                        <small>{{ $word->spell }}</small>
                    </h2>
                    <h3>{{ $word->type->name }} ({{ $word->type->description }})</h3>

                    @if (! empty($word->descriptions))
                        <ul>
                            @foreach ($word->descriptions as $description)
                                <li>{{ $description->description }}</li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-md-4 col-sm-12">
            <div class="panel panel-default">
                <div class="panel-heading">@lang('word.contribution')</div>
                <div class="panel-body">
                    <p>Bantu kami berkembang dengan berkontribusi menambahkan kata baru.</p>
                    <a href="{{ route('word.create') }}" class="btn btn-primary">@lang('word.create')</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
