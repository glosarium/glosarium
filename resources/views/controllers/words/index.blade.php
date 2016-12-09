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
<meta property="og:image" content="{{ asset($image) }}" />
@endpush

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            @include('partials.ad-billboard')
            <hr>
        </div>
    </div>

    <div class="row search-box">
        <div class="col-md-12 text-center">
            <div id="custom-search-input">
                <form action="{{ route('index') }}" method="GET" role="form">

                    <div class="form-group">
                        <input id="word" type="text" name="kata" class="search-query form-control" placeholder="@lang('word.placeholder.search', ['total' => number_format($wordTotal, 0, ',', '.')])" />
                    </div>

                    <div class="form-group search-button">
                        <button class="btn btn-primary">Penelusuran Glosarium</button>
                    </div>

                    <p>
                        Temukan juga Glosarium untuk:
                        <a href="{{ route('word.random') }}">Kata Acak</a>,
                        <a href="{{ route('word.category') }}">Kata Terbaru</a>
                    </p>

                </form>
            </div>
        </div>
    </div>

    @if (isset($words) AND $words->total() >= 1)
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">@lang('word.found', ['total' => number_format($words->total(), 0, ',', '.')])</div>
                    <div class="panel-body">

                        <ul class="list-group">
                            @foreach ($words as $word)
                                <li class="list-group-item">
                                    @include('controllers.words.partials.content')
                                </li>
                            @endforeach
                        </ul>

                        {{ $words->appends(['kata' => request('kata')])->links() }}
                    </div>
                </div>
            </div>
        </div>
    @endif
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
        {
          "@context": "http://schema.org",
          "@type": "WebSite",
          "url": "{{ route('index') }}",
          "potentialAction": {
            "@type": "SearchAction",
            "target": "{{ route('index') }}?kata={kata}",
            "query-input": "required name=kata"
          }
        }
    </script>
@endpush
