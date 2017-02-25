$(() => {
    $('li.category').addClass('active');
});

var category = new Vue({
    el: '#app',
    data: {
        categories: [],
        loading: false,
        words: null,
        nextUrl: null
    },

    mounted() {
        this.getCategory(categories.index);
        this.getWord();
    },

    methods: {

        getWord() {
            let url = categories.word.latest;

            this.$http.post(url).then(response => {

                this.words = response.body.words;

                this.loading = false;
            }, response => {

                this.loading = false;
            });
        },

        getCategory(url) {
            this.$http.get(url).then(response => {

                this.categories = response.body;

                this.loading = false;
            }, response => {
                this.loading = false;
            });
        },

        loadMore(url) {
            this.loading = true;

            this.$http.get(url).then(response => {
                let body = response.body;

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
                for(index in response.body.data) {
                    this.categories.data.push(response.body.data[index]);
                }

                this.loading = false;
            });
        },

        search(keyword) {
            const url = categories.api.index + '?keyword=' + keyword;

            this.$http.get(url).then(response => {
                this.categories = response.body;
            });
        }
    }
});