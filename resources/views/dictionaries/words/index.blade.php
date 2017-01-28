@extends('layouts.app')

@push('metadata')
    <meta name="description" content="Layanan gratis mencari definisi sebuah kata berdasarkan standar Kamus Besar Bahasa Indonesia.">
    <meta name="author" content="{{ config('app.name') }}">

    <meta property="og:name" content="{{ $title }}">
    <meta property="og:url" content="{{ route('dictionary.national.index') }}">
    <meta property="og:description" content="Layanan gratis mencari definisi sebuah kata berdasarkan standar Kamus Besar Bahasa Indonesia.">
    <meta property="og:image" content="{{ $imagePath }}">
@endpush

@section('heading')
    @include('dictionaries.partials.search')
@endsection

@section('content')
    <div class="row">
        <div class="col-md-9">
            <!-- box listing -->
            <div class="block-section-sm box-list-area">

                <div v-if="alerts.message" v-bind:class="['alert', 'alert-' + alerts.type]">
                    @{{ alerts.message }}
                </div>

                <div v-if="!word" class="box-list">
                    <div class="item">
                        <div class="row">
                            <div class="col-md-12">
                                <h3 class="no-margin-top">Selamat Datang!</h3>
                                <div class="descriptions">
                                    {{ config('app.name') }} adalah laman tidak resmi pencarian kata dalam Kamus Besar Bahasa Indonesia (KBBI)
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- item list -->
                <div v-if="word" class="box-list">
                    <div class="item">
                        <div class="row">
                            <div class="col-md-12">
                                <h3 class="no-margin-top">
                                    <a v-bind:href="word.url">@{{ word.word }}</a> <small>@{{ word.spell }}</small>
                                </h3>
                                <hr>
                                <div v-if="word.descriptions.length >= 1" class="descriptions">
                                    <h4>Arti Kata</h4>
                                    <ol>
                                        <li v-for="description in word.descriptions">
                                            <span v-if="description.type" class="color-white-mute">
                                                (@{{ description.type.name }})
                                            </span>
                                            @{{ description.text }}
                                        </li>
                                    </ol>
                                </div>

                                <div v-if="word.url" class="btn-group">
                                    <a v-bind:href="word.url" class="btn btn-sm btn-default">
                                        <i class="fa fa-external-link"></i>
                                        @{{ word.url }}
                                    </a>
                                    <button class="btn btn-sm btn-primary">Salin</button>
                                </div>

                                <hr>
                                @include('partials.ads.responsive')
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <!-- end box listing -->
        </div>
        <div class="col-md-3">
            <div class="block-section-xs side-right">

                <div v-if="words" class="result-filter">

                    <h5 class="no-margin-top font-bold margin-b-20 " ><a href="#s_collapse_1" data-toggle="collapse" >Kata Terbaru <i v-if="loading" class="fa fa-spinner fa-spin" aria-hidden="true"></i> <i class="fa ic-arrow-toogle fa-angle-right pull-right"></i> </a></h5>

                    <div class="collapse in" id="s_collapse_1">
                        <div class="list-area">
                            <ul class="list-unstyled">
                                <li v-for="word in words">
                                    <a @click.prevent="viewDetail" :data-keyword="word.word" :href="word.url">@{{ word.word }} <span class="color-white-mute">(@{{ word.updated_diff }})</span></a>
                                </li>
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
            $('li.dictionary').addClass('active');
        });

        window.Dictionary = {!! json_encode($jsVars) !!};
    </script>

    <script src="{{ asset('vendor/vue-head/vue-head.js') }}"></script>
    <script src="{{ asset('js/dictionary.js') }}"></script>
@endpush
