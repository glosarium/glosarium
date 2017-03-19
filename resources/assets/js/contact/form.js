$(function(){
    $('li.contact').addClass('active');
});

let forms = {
    email: null,
    subject: null,
    message: null
}

let contact = new Vue({
    el: '#content',
    data: {
        loading: false,
        errors: {
            subject: null,
            email: null,
            message: null
        },
        forms: forms,
        alerts: {
            type: null,
            title: null,
            message: null
        }
    },

    methods: {

        beforeSend: function() {
            this.loading = true;

            this.alerts = {
                type: null,
                message: null
            }
        },

        afterSend: function() {
            this.forms = forms;
            this.errors = {
                email: null,
                subject: null,
                message: null
            };

            this.loading = false;
        },

        send: function(e) {
            this.$Progress.start();
            this.beforeSend();

            axios.post(e.target.action, this.forms).then(response => {
                this.alerts = {
                    type: 'success',
                    title: response.data.title,
                    message: response.data.message
                };

                this.$Progress.finish();
                this.afterSend();

            }).catch(error => {
                if (error.response.status == 422) {
                    this.errors = error.response.data;
                }
                else {
                    this.alerts = {
                        type: 'danger',
                        message: 'Kesalahan Internal Server'
                    }
                }

                this.$Progress.fail();
                this.loading = false;
            })
        }
    }
});