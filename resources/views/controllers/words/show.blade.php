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
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ route('word.detail', [$word->category->slug, $word->slug]) }}" class="btn btn-primary"><i class="fa fa-facebook fa-fw"></i></a>

                            <a href="https://twitter.com/home?status=Glosarium untuk {{ $word->locale }} lihat pada {{ url($link->hash) }}" class="btn btn-info"><i class="fa fa-twitter fa-fw"></i></a>

                            <a href="https://plus.google.com/share?url={{ route('word.detail', [$word->category->slug, $word->slug]) }}" class="btn btn-danger"><i class="fa fa-google-plus fa-fw"></i></a>

                            <a href="{{ url($link->hash) }}" class="btn btn-default"><i class="fa fa-external-link fa-fw"></i></a>
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
