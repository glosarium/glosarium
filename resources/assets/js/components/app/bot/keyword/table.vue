<template>
   <div class="panel panel-default">
      <div class="panel-heading">Katakunci Bot</div>
      <div class="panel-body">
         <div class="table-responsive">
            <table class="table table-bordered">
               <thead>
                  <tr>
                     <th>No.</th>
                     <th>Katakunci</th>
                     <th>Pesan</th>
                     <th>Deskripsi</th>
                  </tr>
               </thead>
               <tbody>
                  <tr v-for="(keyword, index) in keywords.data">
                     <td>{{ keywords.from + index }}</td>
                     <td>{{ keyword.keyword }}</td>
                     <td width="500">{{ keyword.message }}</td>
                     <td>{{ keyword.description }}</td>
                  </tr>
               </tbody>
            </table>
         </div>
      </div>
   </div>
</template>

<script>
   export default {
      data() {
         return {
            url: '/admin/bot/keyword/paginate',
            keywords: []
         }
      },

      mounted() {
         this.paginate(this.url);
      },

      methods: {
         paginate(url, params = {}) {
            axios.get(url, {params}).then(response => {
               this.keywords = response.data;
            });
         }
      }
   }
</script>