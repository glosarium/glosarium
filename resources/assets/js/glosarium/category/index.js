$(() => {
    $('li.category').addClass('active');
});

var category = new Vue({
    el: '#app',
    data: {
        categories: [],
        loading: false,
        loadingWord: false,
        words: null,
        nextUrl: null,
        keyword: ''
    },

    mounted() {
        this.getCategory(routes.glosariumCategoryPaginate);
        this.getWord(routes.glosariumWordLatest);
    },

    methods: {

        getWord(url) {
            this.loadingWord = true;

            axios.post(url, {limit: 15}).then(response => {

                this.words = response.data.words;

                this.loadingWord = false;
            }, response => {

                this.loadingWord = false;
            });
        },

        getCategory(url) {
            this.$Progress.start();

            axios.get(url).then(response => {

                this.categories = response.data;

                this.loading = false;

                this.$Progress.finish();
            }, response => {
                this.loading = false;

                this.$Progress.fail();
            });
        },

        loadMore(url) {
            this.loading = true;

            axios.get(url).then(response => {
                let body = response.data;

                this.categories = {
                    next_page_url: body.next_page_url,
                    prev_page_url: body.prev_page_url,
                    from: body.from,
                    to: body.to,
                    per_page: body.per_page,
                    current_page: body.current_page,
                    last_page: body.last_page,
                    total: body.total,
                    data: this.categories.data
                };

                let index = 0;
                for(index in response.data.data) {
                    this.categories.data.push(response.data.data[index]);
                }

                this.loading = false;
            });
        },

        search(keyword) {
            this.keyword = keyword;
            
            this.$Progress.start();
            this.loading = true;

            const url = categories.index + '?keyword=' + keyword;

            axios.get(url).then(response => {
                this.categories = response.data;

                this.$Progress.finish();
                this.loading = false;
            }).catch(e => {
                this.$Progress.fail();
                this.loading = false;
            });
        }
    }
});