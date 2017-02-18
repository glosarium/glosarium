@extends('layouts.app')

@push('metadata')
    <meta name="author" content="{{ config('app.name') }}">
    <meta name="description" content="{{ config('app.description') }}">

    <meta property="og:title" content="{{ config('app.name') }}">
    <meta property="og:description" content="{{ config('app.description') }}">
    <meta property="og:url" content="{{ route('index') }}">
    <meta property="og:image" content="{{ $imagePath }}">
@endpush

@section('heading')
    @include('glosariums.partials.hero')
@endsection

@section('content')
<div class="row text-center">
    <div class="col-md-4">
        <h3 class="font-2x ">@{{ total.glosarium }}</h3>
        <h4 class="color-text">Glosari</h4>
    </div>
    <div class="col-md-4">
        <h3 class="font-2x">@{{ total.category }}</h3>
        <h4 class="color-text">Kategori</h4>
    </div>
    <div class="col-md-4">
        <h3 class="font-2x ">@{{ total.user }}</h3>
        <h4 class="color-text">Kontributor</h4>
    </div>
</div>
@endsection

@push('js')
<script>
    $(function(){
        $('#content').removeClass('bg-color2')
            .addClass('block-section bg-color1');

        $('li.index').addClass('active');
    });

    var home = new Vue({
        el: '#content',
        data: {
            total: {
                glosarium: 0,
                category: 0,
                dictionary: 0,
                user: 0
            }
        },

        mounted: function() {
            this.totaGlosarium();
            this.totalCategory();
            this.totalDictionary();
            this.totalUser();
        },

        methods: {

            totaGlosarium: function() {
                var url = '{{ route('glosarium.word.total') }}';

                this.$http.get(url).then(function(response){
                    this.total.glosarium = response.body.total;
                });
            },

            totalCategory: function() {
                var url = '{{ route('glosarium.category.total') }}';

                this.$http.get(url).then(function(response){
                    this.total.category = response.body.total;
                });
            },

            totalUser: function() {
                var url = '{{ route('user.user.total') }}';

                this.$http.get(url).then(function(response){
                    this.total.user = response.body.total;
                })
            }
        }
    });
</script>
@endpush
