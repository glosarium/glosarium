<template>
   <div class="panel panel-default">
      <div class="panel-heading">
         Kategori <loader :show="loading"></loader>
      </div>
      <div class="panel-body">

         <search placeholder="Cari kategori..."></search>

         <div v-if="categories" class="table-responsive">
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
                     <td>
                        <router-link :to="{ name: 'glosarium.category.edit', params: { slug: category.slug }}" class="btn btn-info btn-xs">
                           <i class="fa fa-edit fa-fw"></i>
                        </router-link>
                        <button-delete :url="categories.delete_url"></button-delete>
                     </td>
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
            loading: false,
            alert: {},
            url: '/admin/glosarium/category/paginate',
            categories: []
         }
      },

      mounted() {
         this.paginate(this.url)
      },

      methods: {
         paginate(url) {
            this.loading = true;

            axios.get(url).then(response => {
               this.categories = response.data

               this.loading = false;
            });
         }
      }
   }
</script>