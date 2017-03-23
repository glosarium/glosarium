$(function(){
    $('#content').addClass('block-section bg-color4');
});

var register = new Vue({
    el: '#content',
    data: {
        loading: false,
        disabled: false,
        forms: {
            _token: Laravel.csrfToken,
            name: null,
            email: null,
            password: null,
            passwordConfirmation: null
        },
        errors : {}
    },

    methods: {

        beforeRegister: function() {
            this.loading = true;
            this.disabled = true;
        },

        afterRegister: function() {
            this.disabled = false;
            this.loading = false;
        },

        register: function(e) {
            this.$Progress.start();
            this.beforeRegister();

            axios.post(e.target.action, this.forms).then(response => {
                this.$Progress.finish();

                window.location = response.data.url;
            }).catch(e => {
                if (e.response.status == 422) {
                    this.errors = e.response.data;
                }

                this.afterRegister();

                this.$Progress.fail();
            });
        },

        checkEmail() {
            if (this.forms.email.length > 3) {
                axios.post(routes.userEmail, {email: this.forms.email}).then(response => {

                }).catch(e => {
                    if (e.response.status == 422) {
                        this.errors = {
                            email: [e.response.data.message]
                        }
                    }
                });
            }
        }

    }
})