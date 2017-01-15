@extends('layouts.app')

@section('heading')
    @include('partials/glosariums/hero')
@endsection

@section('content')
<div class="row text-center">
    <div class="col-md-4">
        <h3 class="font-2x ">{{ number_format($total['glosarium'], 0, ',', '.') }} ({{ number_format($total['category'], 0, ',', '.') }})</h3>
        <h4 class="color-text">Glosarium &amp; Kategori</h4>
    </div>
    <div class="col-md-4">
        <h3 class="font-2x ">{{ number_format($total['dictionary'], 0, ',', '.')}}</h3>
        <h4 class="color-text">Kosata Kamus</h4>
    </div>
    <div class="col-md-4">
        <h3 class="font-2x ">{{ number_format($total['user'], 0, ',', '.') }}</h3>
        <h4 class="color-text">Pengguna</h4>
    </div>
</div>
@endsection

@push('js')
<script>
    $(function(){
        $('#content').removeClass('bg-color2')
            .addClass('block-section bg-color1');

        $('li.index').addClass('active')
    })
</script>
@endpush
