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
   v-on:search="search"
   placeholder="@lang('glosarium.category.placeholder.search')"
   :loading="loading"
   >
</search>
@endsection

@section('content')
<vue-progress-bar></vue-progress-bar>
<div class="row">
   <div class="col-md-9">
      <!-- box listing -->
      <div class="block-section-sm box-list-area">
         @if (Agent::isMobile())
         <div class="row">
            @include('partials.ads.responsive')
         </div>
         @endif
         <!-- desc top -->
         <div class="row hidden-xs" v-cloak>
            <div class="col-sm-6 ">
               <p v-if="keyword" class="color-black">
                  <strong>@lang('glosarium.category.searchResult') "@{{ keyword }}"</strong>
               </p>
               <p v-else class="color-black">{{ $title }}</p>
            </div>
            <div v-if="categories.total >= 1" class="col-sm-6">
               <p class="text-right" v-cloak>
                  Menampilkan @{{ categories.from }} sampai @{{ categories.to }} dari total @{{ categories.total }} kategori.
               </p>
            </div>
         </div>
         <!-- end desc top -->
         <div v-if="categories.total <= 0" class="alert alert-info" v-cloak>
            @lang('glosarium.category.notFound')
         </div>
         <!-- item list -->
         <div class="box-list" v-cloak>
            <div v-for="category in categories.data" class="item">
               <div class="row">
                  <div class="col-md-1 hidden-sm hidden-xs">
                     <div v-if="category.metadata.icon" class="img-item">
                        <h2><i :class="category.metadata.icon"></i></h2>
                     </div>
                  </div>
                  <div class="col-md-11">
                     <h3 class="no-margin-top">
                        <a :href="category.url" class="">@{{ category.name }}</a>
                        <a href="#"><i class="fa fa-link color-white-mute font-1x"></i></a>
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
         <nav v-if="categories.next_page_url">
            <button :disabled="loading" @click.prevent="loadMore(categories.next_page_url)" class="btn btn-t-primary btn-theme btn-block">
            @lang('glosarium.category.btn.load') <i v-if="loading" class="fa fa-spin fa-spinner"></i>
            </button>
         </nav>
      </div>
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
            <h5 class="no-margin-top font-bold margin-b-20 " ><a href="#latest-words" data-toggle="collapse" >@lang('glosarium.category.latestWord') <i class="fa ic-arrow-toogle fa-angle-right pull-right"></i> </a></h5>
            <div v-if="words" class="collapse in" id="latest-words" v-cloak>
               <div class="list-area">
                  <ul class="list-unstyled">
                     <li v-for="word in words">
                        <a :href="word.url">
                        <i v-if="word.category.metadata" :class="[word.category.metadata.icon, 'fa-fw']"></i>
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

<script src="{{ asset('js/glosarium/category.index.js') }}"></script>
@endpush
