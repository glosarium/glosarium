$(function(){
   $('li.glosarium').addClass('active')
});

new Vue({
   el: '#content',
   data: {
       total: 0,
       words: words,
       categories: []
   },

   mounted() {
       this.sameCategory(routes.glosariumWordSimilar);
   },

   methods: {    
       sameCategory(url) {
         axios.post(url, {origin: this.words.origin}).then(response => {
             this.categories = response.data;
         });
       }
   }
})