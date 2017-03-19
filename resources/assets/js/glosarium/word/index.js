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
        keyword: '',
        alerts: {
            type: 'default',
            title: null,
            message: null
        }
    },

    mounted() {
        this.getCategory(routes.glosariumCategoryAll);

        this.getWord(routes.glosariumWordPaginate);
    },

    methods: {

        getCategory(url) {
            this.loading = true;

            axios.get(url).then(response => {

                this.categories = response.data;

                this.loading = false;
            }).catch(e => {

            });
        },

        getWord(url) {
            this.$Progress.start();

            axios.get(url).then(response => {
                this.words = response.data;

                this.$Progress.finish();
            });
        },

        search(keyword) {
            this.$Progress.start();
            this.loading = true;

            this.keyword = keyword;
            
            const url = routes.glosariumWordPaginate + '?keyword=' + keyword;

            axios.get(url).then(response => {
                this.words = response.data;

                this.$Progress.finish();
                this.loading = false;
            }).catch(e => {
                this.$Progress.fail();
                this.loading = false;
            });
        }
    }
});