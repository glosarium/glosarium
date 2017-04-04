@extends('layouts.app')

@push('metadata')
<meta name="author" content="{{ config('app.name') }}">
<meta property="og:title" content="{{ $title }}">
<meta property="og:url" content="{{ url()->current() }}">
<meta property="og:author" content="{{ config('app.name') }}">
<meta property="og:image" content="{{ $imagePath }}">
@endpush

@section('heading')
<search
   placeholder="@lang('glosarium.category.placeholder.search')"
   >
</search>
@endsection

@section('content')
<vue-progress-bar></vue-progress-bar>
<div class="row">
   <div class="col-md-9">
      <!-- box listing -->
      <glosarium-category-index :limit="10"></glosarium-category-index>
      <!-- end box listing -->
   </div>
   <div class="col-md-3">
      <div class="block-section-sm side-right">
         @if (Agent::isDesktop())
         <div class="row text-center">
            @include('partials.ads.300x250')
         </div>
         @endif
         <div class="result-filter">
            <glosarium-word-latest :limit="10"></glosarium-word-latest>
         </div>
      </div>
   </div>
</div>
@endsection

@push('js')
   <script src="{{ asset('js/bus.js') }}"></script>
@endpush
