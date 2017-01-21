Vue.use(VueHead);

var app = new Vue({
    el: '#app',
    data: {
        metadata: {
            title: Dictionary.metadata.title,
            meta: [
                { name: 'description', content: Dictionary.metadata.description },
                { name: 'author', content: 'Glosarium Indonesia' }
            ]
        },
        alerts: {
            type: 'info',
            message: null
        },
        forms: {
            _token: Laravel.csrfToken,
            keyword: Dictionary.keyword
        },
        inputs: {
            keyword: {
                class: null,
                disabled: false
            }
        },
        buttons: {
            search: {
                label: 'Cari',
                class: null
            }
        },
        word: null,
        words: null
    },
    head: {
        title: function() {
            return {
                inner: this.metadata.title,
                separator: ' ',
                complement: ' '
            }
        },
        meta: function() {
            return this.metadata.meta;
        }
    },

    mounted: function() {
        if (this.forms.keyword) {
            this.preloadWord();
        }

        this.latestWords();
    },

    methods: {

        searchWord: function(el) {
            var url = Dictionary.url.search;
            var vm = this;

            this.buttons.search = {
                label: 'Mencari...',
                class: 'disabled'
            };

            this.inputs.keyword = {
                class: 'disabled',
                disabled: true
            };

            this.alerts = {
                message: null
            };

            var self = this;

            this.$http.post(el.target.action, this.forms).then(function(response){
                if (response.ok) {
                    if (response.body.word) {
                        this.word = response.body.word;

                        this.metadata.title = 'Arti Kata "' + this.word.word + '"';

                        if (this.word.descriptions.length > 0) {
                            this.metadata.meta = [
                                { name: 'description', content: this.word.descriptions[0].text }
                            ]
                        }
                    }
                    else {
                        this.alerts = {
                            type: 'info',
                            message: 'Kata "' + this.forms.keyword + '" tidak ditemukan dalam kamus.'
                        }

                        this.metadata.title = this.alerts.message;
                    }

                    this.$emit('updateHead');
                }

                this.buttons.search = {
                    label: 'Cari',
                    class: null
                };

                this.inputs.keyword = {
                    class: null,
                    disabled: false
                };
            });
        },

        latestWords: function() {
            var url = Dictionary.url.latest;

            this.$http.get(url).then(function(response){
                if (response.ok) {
                    this.words = response.body.words;
                }
            })
        },

        preloadWord: function() {
            var url = Dictionary.url.search;

            this.$http.post(url, this.forms).then(function(response){
                if (response.ok && response.body.word) {
                    this.word = response.body.word;

                    // modify metadata
                    this.metadata.title = 'Arti Kata "' + this.word.word + '"';

                    if (this.word.descriptions.length > 0) {
                        this.metadata.meta = [
                            { name: 'description', content: this.word.descriptions[0].text }
                        ]
                    }

                    this.$emit('updateHead');
                }
                else {
                    this.alerts = {
                        type: 'info',
                        message: 'Kata tidak "'+ this.forms.keyword +'" ditemukan dalam kamus.'
                    }
                }
            }, function(response){
                this.alerts = {
                    type: 'danger',
                    message: response.status + ': Terjadi kesalahan pada sistem.'
                }
            });
        },

        viewDetail: function(el) {
            this.forms.keyword = el.target.dataset.keyword;

            this.preloadWord();
            this.latestWords();
        }
    }
});