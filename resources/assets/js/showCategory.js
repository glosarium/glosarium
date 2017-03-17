$(() => {
    $('li.category').addClass('active');

    $('ul.pagination').addClass('pagination-theme no-margin');
});

new Vue({
    el: '#app',
    data: {
        loading: false,
        categories: [],
        words: [],
        keyword: '',
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

            axios.get(url).then(response => {
                this.categories = response.data;

                this.loading = false;
            }).catch(response => {
                this.alerts = {
                    type: 'danger',
                    message: 'Kesalahan Server Internal.'
                }

                this.loading = false;
            });
        },

        getWord(url) {
            this.loading = true;
            this.$Progress.start();

            axios.get(url).then(response => {
                this.words = response.data;

                this.loading = false;
                this.$Progress.finish();
            }).catch(e => {
                this.$Progress.fail();
            });
        },

        search(keyword) {
            this.keyword = keyword;
            
            const url = categories.word.category + '/' + category.slug + '?keyword=' + keyword;
            this.getWord(url);
        }

    }
});