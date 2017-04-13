<template>
   <div class="panel panel-default">
      <div class="panel-heading">
         Kata <loader :show="loading"></loader>
         <span class="pull-right">
            <router-link :to="{ name: 'glosarium.word.create' }" class="btn btn-default btn-sm">
               <i class="fa fa-plus fa-fw"></i>
            </router-link>
         </span>
      </div>
      <div class="panel-body">
         <search placeholder="Cari kata..."></search>

         <div v-if="words" class="tabel-responsive">
            <table class="table table-bordered">
               <thead>
                  <tr>
                     <th>#</th>
                     <th>Kategori</th>
                     <th>Kata Asal</th>
                     <th>Translasi</th>
                     <th>Aksi</th>
                  </tr>
               </thead>
               <tbody>
                  <tr v-for="(word, index) in words.data">
                     <td>{{ words.from + index }}</td>
                     <td>{{ word.category.name }}</td>
                     <td>{{ word.origin }}</td>
                     <td>{{ word.locale }}</td>
                     <td>
                        <router-link :to="{ name: 'glosarium.word.edit', params: {slug: word.slug} }" class="btn btn-xs btn-info">
                           <i class="fa fa-edit fa-fw"></i>
                        </router-link>
                     </td>
                  </tr>
               </tbody>
            </table>
         </div>
         <pagination :data="words"></pagination>
      </div>
   </div>
</template>

<script>
   export default {
      data() {
         return {
            loading: false,
            url: '/user/glosarium/word/paginate',
            words: []
         }
      },

      mounted() {
         this.paginate(this.url);

         // on search
         this.$bus.$on('search', keyword => {
            const params = {
               keyword: keyword
            }
            this.paginate(this.url, params);
         });

         // on pagination
         this.$bus.$on('pagination', url => {
            this.paginate(url);
         });
      },

      methods: {
         paginate(url, params = {}) {
            this.loading = true;
            axios.get(url, {params}).then(response => {
               this.words = response.data;
               this.loading = false;
            });
         }
      }
   }
</script>