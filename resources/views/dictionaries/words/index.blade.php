@extends('layouts.app')

@section('heading')
    @include('dictionaries.partials.search')
@endsection

@section('content')
    <div class="row">
        <div class="col-md-9">
            <!-- box listing -->
            <div class="block-section-sm box-list-area">
                <!-- item list -->
                <div v-if="word" class="box-list">
                    <div class="item">
                        <div class="row">
                            <div class="col-md-1 hidden-sm hidden-xs">
                                <div class="img-item"><h2><i class="fa fa-globe"></i></h2></div>
                            </div>
                            <div class="col-md-11">
                                <h3 class="no-margin-top">
                                    <a href="">@{{ word.word }}</a> <small>@{{ word.spell }}</small>
                                </h3>
                                <hr>
                                <div v-if="word.descriptions.length >= 1" class="descriptions">
                                    <h4>Arti Kata</h4>
                                    <ol>
                                        <li v-for="description in word.descriptions">@{{ description.text }}</li>
                                    </ol>
                                </div>

                                <div>
                                    <span class="color-white-mute">@{{ word.updated_diff }}</span>
                                </div>

                                <hr>
                                <a v-bind:href="word.url" class="btn btn-default" target="_blank"><i class="fa fa-external-link"> </i> @{{ word.url }}</a>
                            </div>
                        </div>
                    </div>
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
        });

        var buttons = {

        }

        var app = new Vue({
            el: '#app',
            data: {
                forms: {
                    _token: Laravel.csrfToken,
                    keyword: null
                },
                inputs: {
                    keyword: {
                        class: null,
                        disabled: false
                    }
                },
                buttons: {
                    search: {
                        label: 'Cari',
                        class: null
                    }
                },
                word: null
            },

            methods: {

                searchWord: function() {
                    var url = '{{ route('dictionary.national.search') }}';
                    var vm = this;

                    this.buttons.search = {
                        label: 'Sedang mencari...',
                        class: 'disabled'
                    };

                    this.inputs.keyword = {
                        class: 'disabled',
                        disabled: true
                    };

                    $.post(url, this.forms, function(response){
                        vm.$set(vm, 'word', response.word);

                        vm.$set(vm, 'buttons', {
                            search: {
                                label: 'Cari',
                                class: null
                            }
                        });

                        vm.$set(vm, 'inputs', {
                            keyword: {
                                class: null,
                                disabled: false
                            }
                        });

                    }, 'json');
                }

            }
        })
    </script>
@endpush
