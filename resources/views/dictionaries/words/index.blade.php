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
                    <div class="col-sm-6  ">
                        @if (request('keyword'))
                        <p><strong class="color-black">Hasil pencarian untuk "{{ request('keyword') }}"</strong></p>
                        @endif
                    </div>
                    <div class="col-sm-6">
                        <p class="text-right">
                            Halaman {{ $words->currentPage() }} menampilkan {{ $words->perPage() }} dari {{ number_format($words->total(), 0, ',', '.') }} kata
                        </p>
                    </div>
                </div>
                <!-- end desc top -->
                <!-- item list -->
                <div class="box-list">
                    @foreach ($words as $word)
                    <div class="item">
                        <div class="row">
                            <div class="col-md-1 hidden-sm hidden-xs">
                                <div class="img-item"><h2><i class="fa fa-globe"></i></h2></div>
                            </div>
                            <div class="col-md-11">
                                <h3 class="no-margin-top">
                                    <a href="{{ route('dictionary.national.show', ['category' => $word->slug]) }}">{{ $word->word }}</a>
                                </h3>
                                <p></p>
                                <div>
                                    <span class="color-white-mute">{{ $word->updated_at->diffForHumans() }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                @include('newsletters.partials.subscribe')

                <!-- pagination -->
                <nav >
                    {{ $words->appends(['keyword' => request('keyword')])->links() }}
                </nav>
                <!-- pagination -->
            </div>
            <!-- end box listing -->
        </div>
        <div class="col-md-3">
            <div class="block-section-sm side-right">
                <div class="result-filter">

                </div>
            </div>
        </div>
    </div>
@endsection
