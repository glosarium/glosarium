<template>
	<form @submit.prevent="send" :action="action" method="post">

        <div :class="['form-group', errors.email ? 'has-error' : '']">
            <label>Pos-El (Pos Elektronik)</label>
            <input :disabled="auth" v-model="state.email" type="text" class="form-control">
            <span v-if="errors.email" class="label label-danger">{{ getError(errors.email) }}</span>
        </div>

        <div :class="['form-group', errors.subject ? 'has-error' : '']">
            <label>Subjek</label>
            <input v-model="state.subject" :disabled="loading" type="text" class="form-control">

            <span v-if="errors.subject" class="label label-danger">{{ getError(errors.subject) }}</span>
        </div>

        <div :class="['form-group', errors.message ? 'has-error' : '']">
            <label>Pesan</label>
            <textarea v-model="state.message" :disabled="loading" class="form-control" rows="6"></textarea>

            <span v-if="errors.message" class="label label-danger">{{ getError(errors.message) }}</span>
        </div>

        <div class="form-group text-center">
            <div class="white-space-10"></div>
            <button :disabled="loading" type="submit" class="btn btn-theme btn-lg btn-long btn-t-primary btn-pill">Kirim Pesan <loader :show="loading"></loader></button>
        </div>
    </form>
</template>

<script>
	export default {
		props: {
			action: String
		},
		data() {
	        return {
                auth: false,
	        	loading: false,
		        errors: {
		            subject: null,
		            email: null,
		            message: null
		        },
		        state: {
                    email: '',
                    subject: '',
                    message: ''
                },
		        alerts: {
		            type: null,
		            title: null,
		            message: null
		        }
	        }
	    },

        mounted() {
            this.auth = Laravel.auth;

            if (Laravel.auth) {
                this.state.email = Laravel.user.email;
            }
        },

	    methods: {

            getError(object) {
                return _.head(object);
            },

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
	}
</script>