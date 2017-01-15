@extends('layouts.app')

@section('heading')
    @include('partials.glosariums.search', ['totalWord' => $totalWord])
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
                            <div class="img-item"><img src="{{ asset('images/company-logo/1.jpg') }}" alt=""></div>
                        </div>
                        <div class="col-md-11">
                            <h3 class="no-margin-top">
                                <a href="{{ route('glosarium.word.show', [$word->category->slug, $word->slug]) }}" class="">{{ $word->origin }}</a>
                                <a href="{{ Hashids::encode($word->id) }}"><i class="fa fa-link color-white-mute font-1x"></i></a>
                            </h3>
                            <h5><span class="color-black">{{ $word->locale }}</span> - <span class="color-white-mute">{{ $word->category->name }}</span></h5>
                            <ol>
                                @foreach ($word->descriptions as $description)
                                <li>{{ $description->description }}</li>
                                @endforeach
                            </ol>
                            <div>
                                <span class="color-white-mute">{{ $word->updated_at->diffForHumans() }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <!-- form get alert -->
            <div class="get_alert">
                <h4>Get email updates for the latest <span class=" ">PHP jobs in United States</span></h4>
                <form>
                    <div class="row">
                        <div class="col-md-9">
                            <div class="form-group">
                                <label>My Email</label>
                                <input class="form-control" placeholder="Enter Email">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="hidden-sm hidden-xs ">&nbsp;</label>
                                <button class="btn btn-theme btn-success btn-block">Activate</button>
                            </div>
                        </div>
                    </div>
                    <small>You can cancel email alerts at any time.</small>
                </form>
            </div>
            <!-- end form get alert -->
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
                <h5 class="no-margin-top font-bold margin-b-20 " ><a href="#s_collapse_1" data-toggle="collapse" >Kategori <i class="fa ic-arrow-toogle fa-angle-right pull-right"></i> </a></h5>
                <div class="collapse in" id="s_collapse_1">
                    <div class="list-area">
                        <ul class="list-unstyled">
                            @foreach ($categories as $category)
                            <li class>
                                <a href="{{ route('glosarium.word.index', ['category' => $category->slug]) }}" class="{{ $category->slug }}">
                                    {{ $category->name }} ({{ number_format($category->words_count, 0, ',', '.') }})
                                </a>
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


@push('js')
    <script>
        $(function(){
            $('li.glosarium').addClass('active')
        })
    </script>
@endpush
