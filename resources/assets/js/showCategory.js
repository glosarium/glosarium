$(() => {
    $('li.glosarium').addClass('active');

    $('ul.pagination').addClass('pagination-theme no-margin');
});

new Vue({
    el: '#app',
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
        this.getCategory(categories.all);

        const url = categories.word.category + '/' + category.slug;
        this.getWord(url);
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
        },

        search(keyword) {
            const url = categories.word.category + '/' + category.slug + '?keyword=' + keyword;
            this.getWord(url);
        }

    }
});