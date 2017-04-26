<template>
   <div class="row">
      <vue-progress-bar></vue-progress-bar>
      <div class="col-md-9">
         <!-- box listing -->
         <div class="block-section-sm box-list-area">
            <!-- desc top -->
            <div class="row hidden-xs" v-cloak>
               <div class="col-sm-6  ">
                  <p v-if="keyword">
                     <strong class="color-black">Hasil pencarian untuk "{{ keyword }}"</strong>
                  </p>
               </div>
               <div class="col-sm-6">
                  <p v-if="words.data" class="text-right" v-cloak>
                     Menampilkan {{ words.from }} sampai {{ words.to }} dari total {{ words.total}} kata.
                  </p>
               </div>
            </div>
            <!-- end desc top -->
            <div class="panel panel-default">
               <div class="panel-heading">
               <h2>{{ category.name }}</h2>
               </div>
               <div class="panel-body">
                  <p v-if="category.description">
                     {{ category.description }}
                  </p>
               </div>
            </div>

            <alert :show="! words.data" type="info" v-cloak>
               Kata tidak ditemukan dalam kategori {{ category.name }}.
            </alert>   

            <pagination :data="words"></pagination>

            <!-- item list -->
            <div class="box-list" v-cloak>
               <div v-for="(word, index) in words.data" class="item">
                  <div class="row">
                     <div class="col-md-1 hidden-xs hidden-sm">
                        <div v-if="word.category.metadata.icon" class="img-item">
                           <h2><i :class="word.category.metadata.icon"></i></h2>
                        </div>
                     </div>
                     <div class="col-md-11">
                        <h3 class="no-margin-top">
                           <router-link :to="{
                                 name: 'glosarium.word.show',
                                 params: {
                                    category: word.category.slug,
                                    word: word.slug
                                 }
                              }">
                              {{ word.origin }}
                           </router-link>
                           <small>
                              <a :href="word.short_url" class="color-white-mute"><i class="fa fa-link"></i></a>
                           </small>
                        </h3>
                        <h5><span class="color-black">{{ word.locale }}</span> - <span><a :href="word.category.url" class="color-white-mute">{{ word.category.name }}</a></span></h5>

                        <p v-if="word.description" class="text-description">
                           {{ word.description.description }}
                        </p>

                        <div>
                           <span class="color-white-mute">{{ word.updated_diff }}</span>
                        </div>
                     </div>
                  </div>
               </div>
            </div>

            <pagination :data="words"></pagination>
         </div>
         <!-- end box listing -->
      </div>
      <div class="col-md-3">
         <div class="block-section-sm side-right">
            <div class="result-filter">
               <h5 class="no-margin-top font-bold margin-b-20 " >
                  <a href="#category" data-toggle="collapse" >
                     Kategori
                     <loader :show="loading"></loader>
                     <i class="fa ic-arrow-toogle fa-angle-right pull-right"></i>
                  </a>
               </h5>
               <glosarium-category-all></glosarium-category-all>
            </div>
         </div>
      </div>
   </div>
</template>

<script>
   export default {
      name: 'CategoryShow',
      data() {
         return {
            loading: false,
            keyword: '',
            url: '/glosarium/category/show',
            category: {},
            words: []
         }
      },
      mounted() {
         // show search form
         this.$root.$data.app.search = true;

         // get category detail
         const slug = this.$route.params.slug;
         axios.get(this.url, { params : { slug: slug }}).then(response => {
            this.category = response.data;

            // get words
            this.paginate('/glosarium/word/paginate', {
               category: this.category.slug
            });
         });
      },

      methods: {
         paginate(url, params = {}) {
            this.$Progress.start();

            axios.get(url, {params}).then(response => {
               this.words = response.data;
               this.$Progress.finish();
            }).catch(error => {
               this.$Progress.fail();
            });
         } 
      },

      filters: {
         url(word) {
            return {
               name: 'glosarium.word.show',
               params: {
                  category: word.category.slug,
                  word: word.slug
               }
            }
         }
      }
   }
</script>