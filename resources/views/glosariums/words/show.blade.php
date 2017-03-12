@extends('layouts.app')

@push('metadata')
    <meta name="author" content="{{ config('app.name') }}">
    <meta name="description" content="Arti glosari {{ $word->origin }} adalah {{ $word->locale }}">

    <meta property="og:title" content="{{ $word->origin }} - {{ $word->locale }}">
    <meta property="og:description" content="{{ $description }}">
    <meta property="og:author" content="{{ ! empty($word->user) ? $word->user->name : config('app.name')  }}">
    <meta property="og:url" content="{{ route('glosarium.word.show', [$word->category->slug, $word->slug]) }}">
    <meta property="og:image" content="{{ $imagePath }}">
@endpush

@section('heading')
    @include('glosariums.partials.search', ['totalWord' => $totalWord])
@endsection

@section('content')
<div class="row">
    <div class="col-md-9">
        <!-- box item details -->
        <div class="block-section box-item-details">

            @if (Agent::isMobile())
                <div class="row">
                    @include('partials.ads.responsive')
                </div>
            @endif

            <div class="panel panel-default" style="margin-top: -15px;">
                <div class="panel-body">
                    <div class="col-md-6" style="border-right: 1px solid #ddd; margin-top: 10px">
                        <h3 class="">{{ $word->origin }}</h3><span class="label label-default">{{ $word->lang }}</span>
                    </div>
                    <div class="col-md-6" style="margin-top:10px">
                        <h3>{{ $word->locale }}</h3>
                        <span class="label label-default">{{ config('app.locale') }}</span>
                    </div>

                    <div class="col-md-12">

                        <hr>

                        <div class="btn-group" style="margin-bottom: 20px;">
                            <button class="btn btn-default btn-sm">
                                <i class="fa fa-heart"></i> 0
                            </button>
                            <button class="btn btn-default btn-sm">
                                <i class="fa fa-thumbs-up"></i> 0
                            </button>
                            <button class="btn btn-default btn-sm">
                                <i class="fa fa-thumbs-down"></i> 0
                            </button>
                        </div>

                        @foreach ($wikipedias as $p => $pages)
                            @if ($p == 2)
                                <p>{{ $pages[0] }}</p>
                            @endif

                            @if ($p == 3)
                                <a href="{{ route('link.external', ['url' => Crypt::encrypt($pages[0])]) }}" target="_blank">{{ $pages[0] }}</a>
                            @endif

                        @endforeach


                        @if (empty($wikipedias))
                            <p>Deskripsi tidak ditemukan dalam Wikipedia.org.</p>
                        @endif
                    </div>
                </div>
            </div>

            <div class="job-meta">
                <ul class="list-inline {{ Agent::isMobile() ? 'text-center' : '' }}">
                    <li><i class="{{ $word->category->metadata['icon'] }}"></i> {{ $word->category->name }}</li>
                    <li><i class="fa fa-link"></i> <a href="{{ route('link.redirect', $link->hash) }}" class="">{{ route('link.redirect', $link->hash) }}</a></li>
                </ul>
            </div>

            @include('partials.disqus', ['slug' => $word->slug])
        </div>
        <!-- end box item details -->
    </div>
    <div class="col-md-3">
        <!-- box affix right -->
        <div class="block-section-sm side-right">

            @if (Agent::isDesktop())
                <div class="row text-center">
                    @include('partials.ads.300x250')
                </div>
            @endif

            <div class="result-filter">
                <h5 class="no-margin-top font-bold margin-b-20 " ><a href="#same-words" data-toggle="collapse" >Dalam Kategori <i class="fa ic-arrow-toogle fa-angle-right pull-right"></i> </a></h5>

                <ul v-cloak v-if="categories" class="list-unstyled" id="same-words">
                    <li v-for="word in categories">
                        <a :href="word.url">@{{ word.category.name }}</a>
                    </li>
                </ul>

                <hr>

                <h5>@lang('glosarium.shares')</h5>
                <p class="share-btns">
                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ url()->current() }}" class="btn btn-primary"><i class="fa fa-facebook"></i></a>
                    <a href="https://twitter.com/home?status=Arti kata {{ $word->origin }} pada {{ config('app.name') }} adalah {{ $word->locale }}. {{ url()->current() }}" class="btn btn-info"><i class="fa fa-twitter"></i></a>
                    <a href="https://plus.google.com/share?url={{ url()->current() }}" class="btn btn-danger"><i class="fa fa-google-plus"></i></a>
                    {{-- <a href="#" class="btn btn-warning"><i class="fa fa-envelope"></i></a> --}}
                </p>
            </div>
        </div>
        <!-- box affix right -->
    </div>
</div>

@endsection

@push('js')
    <script>
        $(function(){
            $('li.glosarium').addClass('active')
        });

        const words = {!! json_encode([
            'locale' => $word->locale,
            'origin' => $word->origin,
            'lang' => $word->lang
        ]) !!}

        let glosarium = new Vue({
            el: '#content',
            data: {
                total: 0,
                words: words,
                categories: null
            },

            mounted() {
                this.sameCategory();
            },

            methods: {

                total() {
                    let url = '{{ route('glosarium.word.total') }}';

                    this.$http.get(url).then(response => {
                        this.total = response.body.total;
                    });
                },

                sameCategory() {
                    let url = '{{ route('glosarium.word.same') }}';

                    this.$http.post(url, {origin: this.words.origin}).then(response => {
                        this.categories = response.body.words;
                    }, response => {

                    });
                }
            }
        })
    </script>
@endpush
