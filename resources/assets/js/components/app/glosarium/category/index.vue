<template>
   <div class="row">
      <div class="col-md-9">

	<div class="block-section-sm box-list-area">
         <!-- desc top -->
         <div class="row hidden-xs" v-cloak>
            <div class="col-sm-6 ">
               <p v-if="keyword" class="color-black">
                  <strong>Hasil pencarian untuk "{{ keyword }}"</strong>
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
            Kategori glosarium tidak ditemukan.
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
                        <router-link :to="category | url">
                          {{ category.name }}
                        </router-link>
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
            Muat lebih banyak... <loader :show="loading"></loader>
            </button>
         </nav>
      </div>
      </div>
      <div class="col-md-3">
         <div class="block-section-sm side-right">
            <div class="result-filter">
               <glosarium-word-latest :limit="10"></glosarium-word-latest>
            </div>
         </div>
      </div>
   </div>
</template>

<script>
   const title = 'Indeks Kategori';
   const description = 'Indeks kategori dalam glosarium bahasa Indonesia.';

   export default {
      name: 'GlosariumCategoryIndex',

      head: {
         title: {
            inner: title
         },
         meta: [
            {
               name: 'description',
               content: description
            },
            {
               name: 'twitter:title',
               content: title
            },
            {
               property: 'og:title',
               content: title
            },
            {
               property: 'og:description',
               content: description
            }
         ]
      },
      
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
        // enable search form
        this.$root.$data.app.search = true;

         const params = {
            limit: this.limit
         }

         this.loading = true;
         axios.get('/glosarium/category/paginate', {params}).then(response => {
            this.categories = response.data;

            this.loading = false;
         });

         this.$bus.$on('search', keyword => {
            this.getCategory(routes.glosariumCategoryPaginate, {
               keyword: keyword
            });
         });
      },

      methods: {
         getCategory(url, params = {}) {
            this.$Progress.start();
            axios.get(url, {params}).then(response => {
                this.categories = response.data;
                this.loading = false;

                this.$Progress.finish();
            }, response => {
                this.loading = false;

                this.$Progress.fail();
            });
         },

         loadMore(url) {
            this.loading = true;

            axios.get(url).then(response => {
                let body = response.data;

                this.categories = {
                    next_page_url: body.next_page_url,
                    prev_page_url: body.prev_page_url,
                    from: body.from,
                    to: body.to,
                    per_page: body.per_page,
                    current_page: body.current_page,
                    last_page: body.last_page,
                    total: body.total,
                    data: this.categories.data
                };

                let index = 0;
                for(index in response.data.data) {
                    this.categories.data.push(response.data.data[index]);
                }

                this.loading = false;
            });
        }
      },

      filters: {
        url(category) {
          return {
            name: 'glosarium.category.show',
            params: {
              slug: category.slug
            }
          }
        }
      }
   }
</script>