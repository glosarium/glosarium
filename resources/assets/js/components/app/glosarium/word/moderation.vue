<template>
   <div class="panel panel-default">
      <div class="panel-heading">
         Kata Menunggu Persetujuan
         <span class="pull-right">
            <router-link :to="{ name: 'glosarium.word.create' }" class="btn btn-default btn-sm">
               <i class="fa fa-plus fa-fw"></i>
            </router-link>
         </span>
      </div>
      <div class="panel-body">

         <div v-if="words.total <= 0" class="alert alert-info">
            Tidak ada kata yang menunggu persetujuan untuk saat ini.   
         </div>

         <div v-if="words.total >= 1" class="tabel-responsive">
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
                     <td></td>
                  </tr>
               </tbody>
            </table>
         </div>
         <pagination v-if="words.total >= 1" :data="words"></pagination>
      </div>
   </div>
</template>

<script>
   export default {
      data() {
         return {
            url: '/user/glosarium/word/moderation',
            words: []
         }
      },

      mounted() {
         this.paginate(this.url);
      },

      methods: {
         paginate(url, params = {}) {
            this.$Progress.start();

            axios.get(url, params).then(response => {
               this.words = response.data;

               this.$Progress.finish();
            });
         }
      }
   }
</script>