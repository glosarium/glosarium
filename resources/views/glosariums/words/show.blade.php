@extends('layouts.app')

@push('metadata')
    <meta name="author" content="{{ config('app.name') }}">
    <meta name="description" content="Arti glosari {{ $word->origin }} adalah {{ $word->locale }}">

    <meta property="og:title" content="{{ $word->origin }} - {{ $word->locale }}">
    <meta property="og:description" content="Arti glosari {{ $word->origin }} adalah {{ $word->locale }}">
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

            <div class="panel panel-default">
                <div class="panel-body">

                    <h2 class="">{{ $word->origin }} <small class="label label-default">{{ $word->lang }}</small></h2>

                    <h3>{{ $word->locale }}</h3>
                    <hr>

                    <h4>Arti per kata</h4>

                    @foreach ($dictionaries as $dictionary)
                        <h5>{{ $dictionary->word }}</span></h5>
                        @if ($dictionary->descriptions->count() >= 1)
                            <ol>
                                @foreach ($dictionary->descriptions as $description)
                                    <li>
                                        @if (! empty($description->type))
                                            <span>{{ $description->type->name }}</span>
                                        @endif
                                        {{ $description->text }}
                                    </li>
                                @endforeach
                            </ol>
                        @else
                            <ul>
                                <li>Belum ada arti untuk kata {{ $dictionary->word }}.</li>
                            </ul>
                        @endif
                    @endforeach
                </div>
            </div>

            <div class="job-meta">
                <ul class="list-inline">
                    <li><i class="fa fa-briefcase"></i> {{ $word->category->name }}</li>
                    @if (! empty($word->user))
                        <li><i class="fa fa-user"></i> {{ $word->user->name }}</li>
                    @endif
                    <li><i class="fa fa-eye"></i> Dilihat 0 kali</li>
                </ul>
            </div>
        </div>
        <!-- end box item details -->
    </div>
    <div class="col-md-3">
        <!-- box affix right -->
        <div class="block-section-sm side-right" id="affix-box">
            <div class="result-filter">
                <h5 class="no-margin-top font-bold margin-b-20 " ><a href="#same-words" data-toggle="collapse" >Dalam Kategori <i class="fa ic-arrow-toogle fa-angle-right pull-right"></i> </a></h5>

                <ul v-if="categories" class="list-unstyled" id="same-words">
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
