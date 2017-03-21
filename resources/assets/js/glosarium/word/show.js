$(function() {
  $('li.glosarium').addClass('active')
});

new Vue({
  el: '#content',
  data: {
    loginAlert: false,
    total: 0,
    words: words,
    word: word,
    categories: []
  },

  mounted() {
    this.sameCategory(routes.glosariumWordSimilar);
  },

  computed: {
    totalVote() {
      if (! word.description) {
        return 0;
      }
      
      return this.word.description.vote_up - this.word.description.vote_down;
    }
  },

  methods: {
    sameCategory(url) {
      axios.post(url, {
        origin: this.words.origin
      }).then(response => {
        this.categories = response.data;
      });
    },

    vote(type = 'up') {
      if (! Laravel.auth) {
        this.loginAlert = true;
      }
      else {
        const url = type == 'up' ? routes.glosariumDescriptionUp : routes.glosariumDescriptionDown;
        
        axios.post(url, {id: this.word.description.id}).then(response => {
          if (type == 'up') {
            this.word.description.vote_up = response.data.vote_up;
          }
          else {
            this.word.description.vote_down = response.data.vote_down;
          }
        }).catch(error => {

        });
      }
    },

    favorite() {
      axios.post(routes.glosariumFavoritePost, {slug: this.word.slug}).then(response => {
        if (response.data.success == true) {
          this.word.favorites_count += 1;
        }
      }).catch(error => {
        if (error.response.status == 401) {
          this.loginAlert = true;
        }
      });
    },
  }
})