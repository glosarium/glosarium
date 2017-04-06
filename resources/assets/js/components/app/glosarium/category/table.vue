<template>
   <div class="panel panel-default">
      <div class="panel-heading">Kategori</div>
      <div class="panel-body">
         <div class="table-responsive">
            <table class="table table-bordered">
               <thead>
                  <tr>
                     <th>#</th>
                     <th>Kategori</th>
                     <th>Deskripsi</th>
                     <th>Aksi</th>
                  </tr>
               </thead>

               <tbody>
                  <tr v-for="(category, index) in categories.data">
                     <td>{{ categories.from + index }}</td>
                     <td>{{ category.name }}</td>
                     <td>{{ category.summary }}</td>
                     <td></td>
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
            url: '/admin/glosarium/category/paginate',
            categories: []
         }
      },

      mounted() {
         this.paginate(this.url)
      },

      methods: {
         paginate(url) {
            axios.get(url).then(response => {
               this.categories = response.data
            });
         }
      }
   }
</script>