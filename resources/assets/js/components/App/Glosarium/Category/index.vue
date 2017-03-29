<template>
	<div class="block-section-sm box-list-area">
         <!-- desc top -->
         <div class="row hidden-xs" v-cloak>
            <div class="col-sm-6 ">
               <p v-if="keyword" class="color-black">
                  <strong>@lang('glosarium.category.searchResult') "{{ keyword }}"</strong>
               </p>
               <p v-else class="color-black">Indeks Kategori</p>
            </div>
            <div v-if="categories.total >= 1" class="col-sm-6">
               <p class="text-right" v-cloak>
                  Menampilkan {{ categories.from }} sampai {{ categories.to }} dari total {{ categories.total }} kategori.
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
                        <a :href="category.url" class="">{{ category.name }}</a>
                        <a href="#"><i class="fa fa-link color-white-mute font-1x"></i></a>
                     </h3>
                     <h5><span class="color-black">{{ category.words_count.toLocaleString('id-ID') }} kata</span></h5>
                     <p class="text-truncate">{{ category.description }}</p>
                     <div>
                        <span class="color-white-mute">{{ category.updated_diff }}</span>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <nav v-if="categories.next_page_url">
            <button :disabled="loading" @click.prevent="loadMore(categories.next_page_url)" class="btn btn-t-primary btn-theme btn-block">
            @lang('glosarium.category.btn.load') <loader :show="loading"></loader>
            </button>
         </nav>
      </div>
</template>

<script>
   export default {
      props: {
         limit: {
            type: Number,
            default: 10
         }
      },

      data() {
         return {
            loading: false,
            categories: [],
            keyword: ''
         }
      },

      mounted() {
         const params = {
            limit: this.limit
         }

         this.loading = true;
         axios.get(routes.glosariumCategoryPaginate, {params}).then(response => {
            this.categories = response.data;

            this.loading = false;
         })
      },

      methods: {

      }
   }
</script>