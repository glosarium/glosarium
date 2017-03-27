@extends('layouts.app')

@section('heading')
<search
   v-on:search="search"
   placeholder="@lang('glosarium.word.placeholder.search')"
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
         <h3>Kata Baru Minggu Ini</h3>
            <div class="box-list" v-cloak>
         @foreach (range(1, 10) as $loop)
            <div class="item">
               <div class="row">
                  <div class="col-md-1 hidden-xs hidden-sm">
                     <div class="img-item">
                        <h2><i class="fa fa-globe fa-fw"></i></h2>
                     </div>
                  </div>
                  <div class="col-md-11">
                     <h3 class="no-margin-top">
                        <a href="">Selfie</a>
                        <small>
                        <a href="">Swafoto</a>
                        </small>
                     </h3>
                     <h5><span class="color-black">Selfie</span> - <span><a href="" class="color-white-mute">Teknologi Informasi</a></span></h5>

                     <p class="text-truncate">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                     tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.</p>

                     <div>
                        <span class="color-white-mute">3 hari yang lalu</span>
                     </div>
                  </div>
               </div>
            </div>
         @endforeach
         </div>
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
            <h5 class="no-margin-top font-bold margin-b-20 " >
               <a href="#category" data-toggle="collapse" >
                  @lang('glosarium.category.category')
                  <loader :show="loading"></loader>
                  <i class="fa ic-arrow-toogle fa-angle-right pull-right"></i>
               </a>
            </h5>
            <div v-if="categories" class="collapse in" id="category">
               <div class="list-area">
                  <ul class="list-unstyled" v-cloak>
                     <li v-for="category in categories">
                        <a :href="category.url">
                        <i :class="[category.metadata.icon, 'fa-fw']"></i>
                        @{{ category.name }} (@{{ category.words_count.toLocaleString('id-Id') }})
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
   <script type="text/javascript">
      new Vue({
         el: '#app',
         data: {
            loading: false,
            keyword: '',
            categories: []
         },

         mounted() {
            this.getCategory(routes.glosariumCategoryAll);
         },

         methods: {
            getCategory(url) {
               axios.get(url).then(response => {
                  this.categories = response.data;
               })
            },

            search(keyword) {
               this.keyword = keyword;
            }
         }
      })
   </script>
@endpush
