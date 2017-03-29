<template>
	<form @submit.prevent="send" :action="action" method="post">
        {{ csrf_field() }}

        <div v-bind:class="['form-group', errors.email ? 'has-error' : '']">
            <label>{{ trans('contact.form.email') }}</label>
            @if (auth()->check())
                <input disabled="" type="email" name="email" class="form-control disabled" value="{{ auth()->user()->email }}">
            @else
                <input v-model="forms.email" :disabled="loading" name="email" type="email" class="form-control" value="{{ old('email') }}">
            @endif

            <span v-if="errors.email" class="label label-danger">@{{ errors.email[0] }}</span>
        </div>

        <div v-bind:class="['form-group', errors.subject ? 'has-error' : '']">
            <label>{{ trans('contact.form.subject') }}</label>
            <input v-model="forms.subject" :disabled="loading" name="subject" type="text" class="form-control" value="{{ old('subject') }}">

            <span v-if="errors.subject" class="label label-danger">@{{ errors.subject[0] }}</span>
        </div>

        <div v-bind:class="['form-group', errors.message ? 'has-error' : '']">
            <label>{{ trans('contact.form.message') }}</label>
            <textarea v-model="forms.message" :disabled="loading" name="message" class="form-control" rows="6" value="{{ old('message') }}"></textarea>

            <span v-if="errors.message" class="label label-danger">@{{ errors.message[0] }}</span>
        </div>

        <div class="form-group text-center">
            <div class="white-space-10"></div>
            <button :disabled="loading" type="submit" class="btn btn-theme btn-lg btn-long btn-t-primary btn-pill">{{ trans('contact.btn.send') }} <loader :show="loading"></loader></button>
        </div>
    </form>
</template>

<script>
	export default {
		data() {
	        return {
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
	}
</script>