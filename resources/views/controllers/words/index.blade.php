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
<meta property="og:image" content="{{ asset($file) }}" />
@endpush

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <div class="panel panel-primary">
                <div class="panel-body">

                    <div class="jumbotron">
                        <h2>@lang('word.welcome')</h2>
                        <p>@lang('word.headline', ['total' => number_format($wordTotal, 0, ',', '.')])</p>
                        <a href="{{ route('word.create') }}" class="btn btn-primary">@lang('word.btn.create')</a>
                    </div>

                    <div class="text-center">
                        <form action="{{ route('index') }}" method="GET" role="form" id="form-word">
                            <div class="input-group">
                                <input id="word" type="text" name="kata" value="{{ request('kata') }}" class="form-control" placeholder="@lang('word.search')" autofocus>
                                <span class="input-group-btn">
                                <button class="btn btn-primary" type="submit">@lang('word.btn.search')</button>
                                </span>
                            </div>

                        </form>
                    </div>

                    @if (isset($words) AND $words->total() >= 1)
                        <h3>@lang('word.found', ['total' => number_format($words->total(), 0, ',', '.')])</h3>

                        <hr>
                        <ul class="list-group">
                            @foreach ($words as $word)
                                <li class="list-group-item">
                                    @include('controllers.words.partials.content')
                                </li>
                            @endforeach
                        </ul>

                        {{ $words->appends(['kata' => request('kata')])->links() }}

                    @elseif (!empty(request('kata')))
                        <hr>
                        <div class="alert alert-info">@lang('word.noResult', ['keyword' => request('kata')]).</div>
                    @endif

                </div>
            </div>
        </div>

        <div class="col-md-12 col-sm-12">
            @include('controllers.words.partials.ad-billboard')
        </div>
    </div>
</div>
@endsection
