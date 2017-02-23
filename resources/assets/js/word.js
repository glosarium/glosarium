$(() => {
    $('li.glosarium').addClass('active');

    $('ul.pagination').addClass('pagination-theme no-margin');
});

new Vue({
    el: '#content',
    data: {
        loading: false,
        categories: [],
        words: [],
        alerts: {
            type: 'default',
            title: null,
            message: null
        }
    },

    mounted() {
        this.getCategory(words.api.allCategory);

        if (words.route == 'glosarium.word.index') {
            this.getWord(words.api.wordIndex);
        }
    },

    methods: {

        getCategory(url) {
            this.loading = true;

            this.$http.get(url).then(response => {

                this.categories = response.body;

                this.loading = false;

            }, response => {
                this.alerts = {
                    type: 'danger',
                    message: 'Kesalahan Server Internal.'
                }

                this.loading = false;
            });
        },

        getWord(url) {
            this.loading = true;

            this.$http.get(url).then(response => {
                this.words = response.body;

                this.loading = false;
            });
        }

    }
});