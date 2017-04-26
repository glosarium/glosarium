<template>
   <div class="row">
      <div class="col-md-9">
         <!-- box item details -->
         <div class="block-section box-item-details">

            <div class="panel panel-default" style="margin-top: -15px;" v-cloak>
               <div class="panel-body">
                  <div class="col-md-6" style="border-right: 1px solid #ddd; margin-top: 10px">
                     <h3 class="">{{ word.origin }}</h3>
                     <span class="label label-default">{{ word.lang }}</span>
                  </div>

                  <div class="col-md-6" style="margin-top:10px">
                     <h3>{{ word.locale }}</h3>
                     <span class="label label-default">id</span>
                  </div>

                  <div class="col-md-12">
                     <hr>
                     <div class="btn-group" style="margin-bottom: 20px;">
                        <button @click="favorite" class="btn btn-default btn-sm">
                           <i :class="['fa fa-heart', word.favorites_count >= 1 ? 'text-danger' : '']"></i>
                           {{ word.favorites_count }}
                        </button>
                        <button @click="vote('up')" v-if="word.description" class="btn btn-default btn-sm">
                           <i :class="['fa fa-thumbs-up', word.description.vote_up >= 1 ? 'text-success' : '']"></i>
                           {{ word.description.vote_up }}
                        </button>
                        <button @click="vote('down')" v-if="word.description" class="btn btn-default btn-sm">
                           <i :class="['fa fa-thumbs-down', word.description.vote_down >= 1 ? 'text-warning' : '']"></i>
                           {{ word.description.vote_down }}
                        </button>
                     </div>

                     <alert :show="loginAlert" type="info" title="Halo, Orang Asing!">
                        <p>Anda harus masuk atau mendaftar terlebih dahulu untuk memberikan pilihan.</p>
                     </alert>

                     <alert :show="totalVote < 0" type="warning" title="Pemberitahuan!">
                        <p>Sehubungan dengan banyaknya respon negatif, deskripsi di bawah bisa jadi tidak sesuai dengan arti kata "@{{ word.locale }}".</p>
                     </alert>

                     <div v-if="word.description">
                        <p>{{ word.description.description }}</p>
                        <a :href="word.description.url" target="_blank" class="text-truncate">
                           {{ word.description.url }}
                        </a>
                     </div>
                     <div v-else>
                        <p>Deskripsi tidak ditemukan dalam Wikipedia.org.</p>
                     </div>
                  </div>
               </div>
            </div>
            <div class="job-meta" v-cloak>
               <ul class="list-inline">
                  <li v-if="word.category">
                     <i :class="['fa fa-fw', word.category.metadata.icon]"></i>
                     <router-link :to="{
                           name: 'glosarium.category.show',
                           params: {
                              slug: word.category.slug
                           }
                        }">
                        {{ word.category.name }}
                     </router-link>
                  </li>
                  <li>
                     <i class="fa fa-link"></i>
                     <a :href="word.short_url" class="">
                        {{ word.short_url }}
                     </a>
                  </li>
               </ul>
            </div>

         </div>
         <!-- end box item details -->
      </div>
      <div class="col-md-3">
         <!-- box affix right -->
         <div class="block-section-sm side-right">
            <div class="row text-center">
               <a href="https://line.me/R/ti/p/%40ola9657y">
                  <img src="/images/line.jpg">
               </a>
            </div>

            <div class="result-filter">
               <h5 class="no-margin-top font-bold margin-b-20 " ><a href="#same-words" data-toggle="collapse" >Dalam Kategori yang Sama<i class="fa ic-arrow-toogle fa-angle-right pull-right"></i> </a></h5>
               <ul>
                  <li v-for="similar in words">
                     <router-link :to="similar | url">
                        {{ similar.origin }} ({{ similar.category.name }})
                     </router-link>
                  </li>
               </ul>
               <hr>
               <h5>Sebaran</h5>
               <p class="share-btns">
                  <a href="https://www.facebook.com/sharer/sharer.php?u=" class="btn btn-primary"><i class="fa fa-facebook"></i></a>
                  <a href="https://twitter.com/intent/tweet?url=&text=Padanan kata dalam  adalah.&hashtags=padanan,glosarium" class="btn btn-info"><i class="fa fa-twitter"></i></a>
                  <a href="https://plus.google.com/share?url=" class="btn btn-danger"><i class="fa fa-google-plus"></i></a>
               </p>
            </div>
         </div>
         <!-- box affix right -->
      </div>
   </div>
</template>

<script>
   export default {
      name: 'GlosariumWordShow',

      data() {
         return {
            url: '/glosarium/word/show',
            loginAlert: false,
            totalVote: 0,
            word: {},
            words: []
         }
      },

      mounted() {
         // disable search form
         this.$root.$data.app.search = false;

         // get word detail
         const params = {
            category: this.$route.params.category,
            word: this.$route.params.word
         }
         axios.get(this.url, {params}).then(response => {
            this.word = response.data;      

            // in same category
            const params = {
               origin: this.word.origin
            }
            axios.get('/glosarium/word/similar', {params}).then(response => {
               this.words = response.data;
            });
         }).catch(error => {
            if (! _.isEmpty(error)) {
               if (error.response.status == 404) {
                  console.error(`URL ${this.url} not found on route.`);
               }
            }
         });
      },

      methods: {
         favorite() {

         },

         vote(type) {

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