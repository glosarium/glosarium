@extends('layouts.app')

@section('heading')
    @include('partials.dictionaries.search')
@endsection

@section('content')
    <div class="row">
        <div class="col-md-9">
            <!-- box listing -->
            <div class="block-section-sm box-list-area">
                <!-- desc top -->
                <div class="row hidden-xs">
                    <div class="col-sm-12 ">
                        @if (request('keyword'))
                        <p><strong class="color-black">Hasil pencarian untuk "{{ request('keyword') }}"</strong></p>
                        @endif
                    </div>
                </div>
                <!-- end desc top -->
                <!-- item list -->
                <div class="box-list">
                    @if (empty($word))
                        <h3>Tidak ada hasil pencarian.</h3>
                        <hr>
                    @else
                        <div class="item">
                            <div class="row">
                                <div class="col-md-1 hidden-sm hidden-xs">
                                    <div class="img-item"><h2><i class="fa fa-globe"></i></h2></div>
                                </div>
                                <div class="col-md-11">
                                    <h3 class="no-margin-top">
                                        <a href="{{ route('dictionary.national.index', ['keyword' => $word->slug]) }}">
                                            {{ ucfirst($word->word) }}
                                            <small>{{ $word->spell }}</small>
                                        </a>
                                    </h3>
                                    @if (! empty($word->descriptions) and $word->descriptions->count() >= 1)
                                        <div class="descriptions">
                                            <hr>
                                            <h4>Arti Kata</h4>
                                            <ol>
                                                @foreach ($word->descriptions as $description)
                                                    <li>{{ $description->text }}</li>
                                                @endforeach
                                            </ol>
                                        </div>
                                    @endif
                                    <div>
                                        <span class="color-white-mute">{{ $word->updated_at->diffForHumans() }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>

                @include('newsletters.partials.subscribe')
            </div>
            <!-- end box listing -->
        </div>
        <div class="col-md-3">
            <div class="block-section-sm side-right">
                <div class="result-filter">

                    <h5 class="no-margin-top font-bold margin-b-20 " ><a href="#s_collapse_1" data-toggle="collapse" >Kata Terbaru <i class="fa ic-arrow-toogle fa-angle-right pull-right"></i> </a></h5>
                    <div class="collapse in" id="s_collapse_1">
                        <div class="list-area">
                            <ul class="list-unstyled">
                                @foreach ($words as $word)
                                    <li class="{{ $word->slug }}">
                                        <a href="{{ route('dictionary.national.index', ['keyword' => $word->slug]) }}">{{ ucfirst($word->word ) }}</a> (<small class="color-black">{{ $word->created_at->diffForHumans() }}</small>)
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

@if (! empty($word))
    @push('metadata')
        <meta property="og:title" content="{{ sprintf('Arti Kata "%s"', $word->word) }}">
        <meta property="og:locale" content="'id_ID">
        <meta property="og:url" content="{{ url('dictionary/'.$word->slug) }}">
        @if (isset($imagePath))
            <meta property="og:image" content="{{ $imagePath }}">
        @endif
    @endpush

    @push('structured-data')
        {{-- expr --}}
    @endpush
@endif


@push('js')
    <script>
        $(function(){
            $('li.dictionary').addClass('active');

            $('#dictionary-search-form').submit(function(){
                $(this).attr('action', '');

                $(this).attr('action', '{{ url()->current() }}/' + $('#keyword').val());
                $(this).submit();
            })
        })
    </script>
@endpush
