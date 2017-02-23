@extends('layouts.app')

@section('heading')
    @include('glosariums.partials.search', ['totalWord' => $totalWord])
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
                    @else
                        <p><strong class="color-black">{{ $title }}</strong></p>
                    @endif
                </div>
                <div class="col-sm-6" v-cloak>
                    <p class="text-right">
                        Menampilkan @{{ words.from }} sampai @{{ words.to }} dari total @{{ words.total}} kata.
                    </p>
                </div>
            </div>
            <!-- end desc top -->

            <nav v-cloak>
                <ul class="pagination pagination-theme no-margin">
                    <li v-if="words.prev_page_url">
                        <a class="disabled" @click.prevent="getWord(words.prev_page_url)" :href="words.prev_page_url">@lang('pagination.previous')</a>
                    </li>
                    <li v-if="words.next_page_url">
                        <a :disabled="loading" @click.prevent="getWord(words.next_page_url)" :href="words.next_page_url">@lang('pagination.next')</a>
                    </li>
                </ul>
            </nav>

            <!-- item list -->
            <div class="box-list" v-cloak>
                <div v-for="(word, index) in words.data" class="item">
                    <div class="row">
                        <div class="col-md-1 hidden-xs hidden-sm">
                            <div v-if="word.category.metadata.icon" class="img-item">
                                <h2><i :class="word.category.metadata.icon"></i></h2>
                            </div>
                        </div>
                        <div class="col-md-11">
                            <h3 class="no-margin-top">
                                <a :href="word.url" class="">@{{ word.origin }}</a>
                                <small>
                                    <a :href="word.short_url" class="color-white-mute"><i class="fa fa-link"></i></a>
                                </small>
                            </h3>
                            <h5><span class="color-black">@{{ word.locale }}</span> - <span><a :href="word.category.url" class="color-white-mute">@{{ word.category.name }}</a></span></h5>
                            <div>
                                <span class="color-white-mute">@{{ word.updated_diff }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <nav v-cloak>
                <ul class="pagination pagination-theme no-margin">
                    <li v-if="words.prev_page_url">
                        <a :disabled="loading" @click.prevent="getWord(words.prev_page_url)" :href="words.prev_page_url">@lang('pagination.previous')</a>
                    </li>
                    <li v-if="words.next_page_url">
                        <a :disabled="loading" @click.prevent="getWord(words.next_page_url)" :href="words.next_page_url">@lang('pagination.next')</a>
                    </li>
                </ul>
            </nav>

        </div>
        <!-- end box listing -->
    </div>
    <div class="col-md-3">
        <div class="block-section-sm side-right">

            <div class="row">
                @include('partials.ads.300x250')
            </div>

            <div class="result-filter">
                <h5 class="no-margin-top font-bold margin-b-20 " >
                    <a href="#category" data-toggle="collapse" >
                        Kategori <loader :show="loading"></loader> <i class="fa ic-arrow-toogle fa-angle-right pull-right"></i>
                    </a>
                </h5>

                <div v-if="categories" class="collapse in" id="category">
                    <div class="list-area">
                        <ul class="list-unstyled" v-cloak>
                            <li v-for="category in categories">
                                <a :href="category.url">@{{ category.name }} (@{{ category.words_count.toLocaleString('id-Id') }})</a>
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
        window.words = {!! json_encode($js) !!};
    </script>
    <script src="{{ asset('js/word.js') }}"></script>
@endpush
