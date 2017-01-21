@extends('layouts.app')

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
                <!-- item list -->
                <div v-if="word" class="box-list">
                    <div class="item">
                        <div class="row">
                            <div class="col-md-1 hidden-sm hidden-xs">
                                <div class="img-item"><h2><i class="fa fa-globe"></i></h2></div>
                            </div>
                            <div class="col-md-11">
                                <h3 class="no-margin-top">
                                    <a v-bind:href="word.url">@{{ word.word }}</a> <small>@{{ word.spell }}</small>
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
                                <a v-bind:href="word.url" id="word-link" class="btn btn-default btn-sm" target="_blank"><i class="fa fa-external-link"> </i> @{{ word.url }}</a>
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
                <div v-if="words" class="result-filter">

                    <h5 class="no-margin-top font-bold margin-b-20 " ><a href="#s_collapse_1" data-toggle="collapse" >Kata Terbaru <i v-if="loading" class="fa fa-spinner fa-spin" aria-hidden="true"></i> <i class="fa ic-arrow-toogle fa-angle-right pull-right"></i> </a></h5>

                    <div class="collapse in" id="s_collapse_1">
                        <div class="list-area">
                            <ul class="list-unstyled">
                                <li v-for="word in words">
                                    <a v-on:click.prevent="viewDetail" v-bind:data-keyword="word.word" v-bind:href="word.url">@{{ word.word }} <span class="color-white-mute">@{{ word.updated_diff }}</span></a>
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
