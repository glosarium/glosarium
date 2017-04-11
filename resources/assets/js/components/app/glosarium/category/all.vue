<template>
    <div v-if="categories" class="collapse in" id="category">
        <div class="list-area">
            <ul class="list-unstyled" v-cloak>
                <li v-for="category in categories">
                <router-link :to="category | url">
                <i :class="[category.metadata.icon, 'fa-fw']"></i>
                {{ category.name }} ({{ category.words_count.toLocaleString('id-Id') }})
                </router-link>
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
   export default {
      name: 'glosariumCategoryAll',

      data() {
         return {
            loading: false,
            url: '/category/all',
            categories: []
         }
      },

      mounted() {
         axios.get(this.url).then(response => {
            this.categories = response.data;
         }).catch(error => {

         });
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