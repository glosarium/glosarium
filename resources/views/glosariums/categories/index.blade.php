@extends('layouts.app')

@push('metadata')
    <meta name="author" content="{{ config('app.name') }}">
    <meta name="description" content="@lang('glosarium.categoryAll', [
        'category' => $categories->implode('name', ', ')
    ])">

    <meta property="og:title" content="{{ $title }}">
    <meta property="og:description" content="@lang('glosarium.categoryAll', [
        'category' => $categories->implode('name', ', ')
    ])">
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
                <div class="col-sm-6  ">
                    @if (request('keyword'))
                    <p><strong class="color-black">Hasil pencarian untuk "{{ request('keyword') }}"</strong></p>
                    @endif
                </div>
                <div class="col-sm-6">
                    <p class="text-right">
                        Halaman {{ $categories->currentPage() }} menampilkan {{ $categories->perPage() }} dari {{ number_format($categories->total(), 0, ',', '.') }} kategori
                    </p>
                </div>
            </div>
            <!-- end desc top -->
            <!-- item list -->
            <div class="box-list">
                @foreach ($categories as $category)
                <div class="item">
                    <div class="row">
                        <div class="col-md-1 hidden-sm hidden-xs">
                            <div class="img-item"><h2><i class="fa fa-globe"></i></h2></div>
                        </div>
                        <div class="col-md-11">
                            <h3 class="no-margin-top">
                                <a href="{{ route('glosarium.category.show', ['category' => $category->slug]) }}" class="">{{ $category->name }}</a>
                            </h3>
                            <h5><span class="color-black">{{ number_format($category->words_count, 0, ',', '.') }} kata</span></h5>
                            @if (auth()->check() and auth()->user()->type == 'admin')
                                <p class="editable text-truncate" contenteditable="true" data-id="{{ $category->id }}" data-field="description">{{ !empty($category->description) ? $category->description : 'Klik di sini untuk memperbarui deskripsi.' }}</p>
                            @else
                                <p class="text-truncate">{{ $category->description }}</p>
                            @endif
                            <div>
                                <span class="color-white-mute">{{ $category->updated_at->diffForHumans() }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- pagination -->
            <nav >
                {{ $categories->appends(['keyword' => request('keyword')])->links() }}
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
        $(() => {
            $('li.glosarium').addClass('active');
        });

        new Vue({
            el: '#content',
            data: {
                loading: false,
                words: null
            },

            mounted() {
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
                }

            }
        })
    </script>
@endpush
