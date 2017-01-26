@extends('layouts.app')

@push('metadata')
    <meta name="author" content="{{ config('app.name') }}">
    <meta name="description" content="Arti glosari {{ $word->origin }} adalah {{ $word->locale }}">

    <meta property="og:title" content="{{ $word->origin }} - {{ $word->locale }}">
    <meta property="og:description" content="Arti glosari {{ $word->origin }} adalah {{ $word->locale }}">
    <meta property="og:author" content="{{ config('app.name') }}">
    <meta property="og:url" content="{{ route('glosarium.word.show', [$word->category->slug, $word->slug]) }}">
@endpush

@section('heading')
    @include('partials/glosariums/search', ['totalWord' => $totalWord])
@endsection

@section('content')
<div class="row">
    <div class="col-md-9">
        <!-- box item details -->
        <div class="block-section box-item-details">

            @include('partials.ads.responsive')
            <hr>

            <div class="panel panel-default">
                <div class="panel-body">

                    <h2 class="">{{ $word->origin }} <small class="label label-default">{{ $word->lang }}</small></h2>

                    <h3>{{ $word->locale }}</h3>
                    <hr>

                    <h4>Arti per kata</h4>

                    @foreach ($dictionaries as $dictionary)
                        <h5>{{ $dictionary->word }}</h5>
                        @if ($dictionary->descriptions->count() >= 1)
                            <ul>
                                @foreach ($dictionary->descriptions as $description)
                                    <li>
                                        @if (! empty($description->type))
                                            <span>{{ $description->type->name }}</span>
                                        @endif
                                        {{ $description->text }}
                                    </li>
                                @endforeach
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
                    <li><i class="fa fa-eye"></i> Dilihat 10 kali</li>
                </ul>
            </div>
        </div>
        <!-- end box item details -->
    </div>
    <div class="col-md-3">
        <!-- box affix right -->
        <div class="block-section-sm side-right" id="affix-box">
            <div>
                <h5>Dalam Kategori</h5>
                <ul class="list-unstyled">
                    @foreach ($categories as $category)
                        <li><a href="">{{ $category->name }}</a></li>
                    @endforeach
                </ul>
                <hr>

                <h6>Bagikan ke media sosial</h6>
                <p class="share-btns">
                    <a href="#" class="btn btn-primary"><i class="fa fa-facebook"></i></a>
                    <a href="#" class="btn btn-info"><i class="fa fa-twitter"></i></a>
                    <a href="#" class="btn btn-danger"><i class="fa fa-google-plus"></i></a>
                    <a href="#" class="btn btn-warning"><i class="fa fa-envelope"></i></a>
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

        let glosarium = new Vue({
            el: '#content',
            data: {
                total: 0
            },

            mounted() {

            },

            methods: {

                total() {
                    let url = '{{ route('glosarium.word.total') }}';

                    this.$http.get(url).then(response => {
                        this.total = response.body.total;
                    });
                }

            }
        })
    </script>
@endpush
