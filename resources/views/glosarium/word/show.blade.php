@extends('layouts.app')

@push('metadata')
<meta name="author" content="{{ config('app.name') }}">
<meta name="description" content="{{ $metaDescription }}">
<meta property="og:title" content="{{ $word->origin }} - {{ $word->locale }}">
<meta property="og:description" content="{{ $metaDescription }}">
<meta property="og:author" content="{{ ! empty($word->user) ? $word->user->name : config('app.name')  }}">
<meta property="og:url" content="{{ route('glosarium.word.show', [$word->category->slug, $word->slug]) }}">
<meta property="og:image" content="{{ $imagePath }}">
@endpush

@section('heading')
@include('partials.title')
@endsection

@section('content')
<div class="row">
   <div class="col-md-9">
      <!-- box item details -->
      <div class="block-section box-item-details">

         <div class="panel panel-default" style="margin-top: -15px;" v-cloak>
            <div class="panel-body">
               <div class="col-md-6" style="border-right: 1px solid #ddd; margin-top: 10px">
                  <h3 class="">{{ $word->origin }}</h3>
                  <span class="label label-default">@{{ word.lang }}</span>
               </div>

               <div class="col-md-6" style="margin-top:10px">
                  <h3>@{{ word.locale }}</h3>
                  <span class="label label-default">{{ config('app.locale') }}</span>
               </div>

               <div class="col-md-12">
                  <hr>
                  <div class="btn-group" style="margin-bottom: 20px;">
                     <button @click="favorite" class="btn btn-default btn-sm">
                        <i :class="['fa fa-heart', word.favorites_count >= 1 ? 'text-danger' : '']"></i>
                        @{{ word.favorites_count }}
                     </button>
                     <button @click="vote('up')" v-if="word.description" class="btn btn-default btn-sm">
                        <i :class="['fa fa-thumbs-up', word.description.vote_up >= 1 ? 'text-success' : '']"></i>
                        @{{ word.description.vote_up }}
                     </button>
                     <button @click="vote('down')" v-if="word.description" class="btn btn-default btn-sm">
                        <i :class="['fa fa-thumbs-down', word.description.vote_down >= 1 ? 'text-warning' : '']"></i>
                        @{{ word.description.vote_down }}
                     </button>
                  </div>

                  <alert :show="loginAlert" type="info" title="Halo, Orang Asing!">
                     <p>@lang('glosarium.word.loginAlert')</p>
                  </alert>

                  <alert :show="totalVote < 0" type="warning" title="Pemberitahuan!">
                     <p>@lang('glosarium.word.wrongDescription') "@{{ word.locale }}".</p>
                  </alert>


                  <div v-if="word.description">
                     <p>@{{ word.description.description }}</p>
                     <a :href="word.description.url" target="_blank" class="text-truncate">
                        @{{ word.description.url }}
                     </a>
                  </div>
                  <div v-else>
                     <p>@lang('glosarium.word.noDescription')</p>
                  </div>
               </div>
            </div>
         </div>
         <div class="job-meta" v-cloak>
            <ul class="list-inline {{ Agent::isMobile() ? 'text-center' : '' }}">
               <li>
                  <i :class="word.category.metadata.icon"></i>
                  @{{ word.category.name }}
               </li>
               <li>
                  <i class="fa fa-link"></i>
                  <a :href="word.short_url" class="">
                     @{{ word.short_url }}
                  </a>
               </li>
            </ul>
         </div>
         @include('partials.disqus', ['slug' => $word->slug])
      </div>
      <!-- end box item details -->
   </div>
   <div class="col-md-3">
      <!-- box affix right -->
      <div class="block-section-sm side-right">
         @if (Agent::isDesktop())
         <div class="row text-center">
            @include('partials.ads.300x250')
         </div>
         @endif
         <div class="result-filter">
            <h5 class="no-margin-top font-bold margin-b-20 " ><a href="#same-words" data-toggle="collapse" >@lang('glosarium.category.inCategory') <i class="fa ic-arrow-toogle fa-angle-right pull-right"></i> </a></h5>
            <ul v-cloak v-if="categories" class="list-unstyled" id="same-words">
               <li v-for="word in categories">
                  <a :href="word.url">
                    <i :class="[word.category.metadata.icon, 'fa-fw']"></i>
                    @{{ word.category.name }}
                  </a>
               </li>
            </ul>
            <hr>
            <h5>@lang('glosarium.word.shares')</h5>
            <p class="share-btns">
               <a href="https://www.facebook.com/sharer/sharer.php?u={{ url()->current() }}" class="btn btn-primary"><i class="fa fa-facebook"></i></a>
               <a href="https://twitter.com/intent/tweet?url={{ $word->short_url }}&text=Padanan kata {{ $word->origin }} dalam {{ $word->category->name }} adalah {{ $word->locale }}.&hashtags=padanan,glosarium" class="btn btn-info"><i class="fa fa-twitter"></i></a>
               <a href="https://plus.google.com/share?url={{ url()->current() }}" class="btn btn-danger"><i class="fa fa-google-plus"></i></a>
            </p>
         </div>
      </div>
      <!-- box affix right -->
   </div>
</div>
@endsection

@push('js')
<script>
   const word = {!! json_encode($word) !!};

   const words = {!! json_encode([
       'locale' => $word->locale,
       'origin' => $word->origin,
       'lang' => $word->lang
   ]) !!};
</script>

<script src="{{ asset('js/glosarium/word.show.js') }}"></script>
@endpush
