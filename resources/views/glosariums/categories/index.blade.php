@extends('layouts.app')

@push('metadata')
    <meta name="author" content="{{ config('app.name') }}">

    <meta property="og:title" content="{{ $title }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:author" content="{{ config('app.name') }}">
    <meta property="og:image" content="{{ $imagePath }}">
@endpush

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
                <div class="col-sm-6 ">
                    @if (request('keyword'))
                        <p><strong class="color-black">Hasil pencarian untuk "{{ request('keyword') }}"</strong></p>
                    @else
                        {{ $title }}
                    @endif
                </div>
                <div class="col-sm-6">
                    <p class="text-right" v-cloak>
                        Menampilkan @{{ categories.from }} sampai @{{ categories.to }} dari total @{{ categories.total }} kategori.
                    </p>
                </div>
            </div>
            <!-- end desc top -->

            <nav >
                <ul class="pagination pagination-theme no-margin">
                    <li v-if="categories.prev_page_url">
                        <a :href="categories.prev_page_url" @click.prevent="getCategory(categories.prev_page_url)">@lang('pagination.previous')</a>
                    </li>
                    <li v-if="categories.next_page_url">
                        <a :href="categories.next_page_url" @click.prevent="getCategory(categories.next_page_url)">@lang('pagination.next')</a>
                    </li>
                </ul>
            </nav>

            <!-- item list -->
            <div class="box-list" v-cloak>
                <div v-for="category in categories.data" class="item">
                    <div class="row">
                        <div class="col-md-1 hidden-sm hidden-xs">
                            <div class="img-item"><h2><i class="fa fa-globe"></i></h2></div>
                        </div>
                        <div class="col-md-11">
                            <h3 class="no-margin-top">
                                <a :href="category.url" class="">@{{ category.name }}</a>
                            </h3>
                            <h5><span class="color-black">@{{ category.words_count.toLocaleString('id-ID') }} kata</span></h5>

                            <p class="text-truncate">@{{ category.description }}</p>

                            <div>
                                <span class="color-white-mute">@{{ category.updated_diff }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- pagination -->
            <nav >
                <ul class="pagination pagination-theme no-margin">
                    <li v-if="categories.prev_page_url">
                        <a :href="categories.prev_page_url" @click.prevent="getCategory(categories.prev_page_url)">@lang('pagination.previous')</a>
                    </li>
                    <li v-if="categories.next_page_url">
                        <a :href="categories.next_page_url" @click.prevent="getCategory(categories.next_page_url)">@lang('pagination.next')</a>
                    </li>
                </ul>
            </nav>
            <!-- pagination -->
        </div>
        <!-- end box listing -->
    </div>
    <div class="col-md-3">
        <div class="block-section-sm side-right">
            <div class="result-filter">
                <h5 class="no-margin-top font-bold margin-b-20 " ><a href="#latest-words" data-toggle="collapse" >Kata Paling Baru <i class="fa ic-arrow-toogle fa-angle-right pull-right"></i> </a></h5>

                <div v-if="words" class="collapse in" id="latest-words">
                    <div class="list-area">
                        <ul class="list-unstyled">
                            <li v-for="word in words">
                                <a :href="word.url">
                                    @{{ word.origin }} (@{{ word.locale }})
                                </a>
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
        window.categories = {!! json_encode($js) !!};
    </script>

    <script>
        $(() => {
            $('li.category').addClass('active');
        });

        new Vue({
            el: '#content',
            data: {
                categories: [],
                loading: false,
                words: null
            },

            mounted() {
                this.getCategory(categories.api.index);
                this.getWord();
            },

            methods: {

                getWord() {
                    let url = '{{ route('glosarium.word.latest') }}';

                    this.$http.post(url).then(response => {

                        this.words = response.body.words;

                        this.loading = false;
                    }, response => {

                        this.loading = false;
                    });
                },

                getCategory(url) {
                    this.$http.get(url).then(response => {

                        this.categories = response.body;

                        this.updateMetadata(this.categories);

                        this.loading = false;
                    }, response => {
                        this.loading = false;
                    });
                }
            }
        })
    </script>
@endpush
