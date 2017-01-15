@extends('layouts.app')

@section('heading')
    @include('partials/glosariums/search', ['totalWord' => $totalWord])
@endsection

@section('content')
<div class="row">
    <div class="col-md-9">
        <!-- box item details -->
        <div class="block-section box-item-details">
            <div class="row">
                <div class="col-md-12">
                    <p class="text-right"><a href="{{ route('glosarium.word.index') }}">Kembali ke indeks &raquo;</a></p>
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-body">

                    <h2 class="">{{ $word->origin }} <small class="label label-default">{{ $word->lang }}</small></h2>
                    <hr>
                    <h3>{{ $word->locale }}</h3>
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
        <div class="block-section " id="affix-box">
            <div class="text-right">
                <p><a href="#" class="btn btn-theme btn-line dark btn-block-xs">Aplly WIth Linkedin</a></p>
                <p><a href="#modal-apply"  data-toggle="modal" class="btn btn-theme btn-t-primary btn-block-xs">Apply This Job</a></p>
                <p><a href="#" class="btn btn-theme btn-t-primary btn-block-xs">Login to Save This Job</a></p>
                <p><a href="#map-toogle" id="btn-map-toogle" data-toggle="collapse" class="btn btn-theme btn-t-primary btn-block-xs">Ofice Location</a></p>
                <p>Bagikan ke media sosial<span class="space-inline-10"></span>:</p>
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
        })
    </script>
@endpush
