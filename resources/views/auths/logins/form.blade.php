@extends('layouts.app')

@section('content')
<div class="panel panel-md">
    <div class="panel-body">
        <div class="row">
            <div class="col-md-12">
                <!-- buttons top -->
                <p><a href="#" class="btn btn-primary btn-theme btn-block" disabled="true"><i class="fa fa-facebook pull-left bordered-right"></i> @lang('user.loginFacebook')</a></p>
                <p><a href="#" class="btn btn-danger btn-theme btn-block" disabled="true"><i class="fa fa-google-plus pull-left bordered-right"></i> @lang('user.loginGoogle')</a></p>
                <!-- end buttons top -->
                <div class="white-space-10"></div>
                <p class="text-center"><span class="span-line">{{ trans('user.or') }}</span></p>
                <!-- form login -->
                <form v-on:submit.prevent="login" action="{{ url('login') }}" method="post">
                    {{ csrf_field() }}

                    <div v-bind:class="['form-group', errors && errors.email ? 'has-error' : '']">
                        <label>@lang('user.form.email')</label>
                        <input v-model="forms.email" :disabled="loading" name="email" type="email" class="form-control" placeholder="">
                        <span v-if="errors && errors.email" class="label label-danger">@{{ errors.email[0] }} </span>
                    </div>
                    <div v-bind:class="['form-group', errors && errors.password ? 'has-error' : '']">
                        <label>@lang('user.form.password')</label>
                        <input v-model="forms.password" :disabled="loading" name="password" type="password" class="form-control" placeholder="">
                        <span v-if="errors && errors.password" class="label label-danger">@{{ errors.password[0] }} </span>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-xs-6">
                                <div class="checkbox flat-checkbox">
                                    <label>
                                    <input v-model="forms.remember" name="remember" type="checkbox" value="1">
                                    <span class="fa fa-check"></span>
                                    @lang('user.form.remember')
                                    </label>
                                </div>
                            </div>
                            <div class="col-xs-6 text-right">
                                <p class="help-block"><a href="#password-modal" data-toggle="modal">@lang('user.forgotPassword')</a></p>
                            </div>
                        </div>
                    </div>
                    <div class="form-group no-margin">
                        <button :disabled="loading" class="btn btn-theme btn-lg btn-t-primary btn-block">@lang('user.btn.login')

                        <i v-if="loading" class="fa fa-spinner fa-spin"></i> </button>
                    </div>
                </form>
                <!-- form login -->
            </div>
        </div>
    </div>
</div>
<div class="white-space-20"></div>
<div class="text-center color-white">@lang('user.notUser') &nbsp; <a href="{{ url('register') }}" class="link-white"><strong>@lang('user.createAccount')</strong></a></div>

<div class="modal fade" id="password-modal" >
    <div class="modal-dialog">
        <div class="modal-content">

            <form v-on:submit.prevent="sendEmail" action="{{ url('password/email') }}" method="post" role="form">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" >Lupa Katasandi?</h4>
                </div>
                <div class="modal-body">

                    <div v-if="passwordAlerts.message" class="alert alert-success">
                        @{{ passwordAlerts.message }}
                    </div>

                    <div v-bind:class="['form-group', errors && errors.emailForgot ? 'has-error' : '']">
                        <label>Masukkan Alamat Surel</label>
                        <input v-model="forms.emailForgot" type="email" class="form-control" name="email" autocomplete="off" :disabled="loading">
                        <span v-if="errors && errors.emailForgot" class="label label-danger">@{{ errors.emailForgot[0] }}</span>
                    </div>
                </div>
                <div class="modal-footer">
                    <i v-if="loading" class="fa fa-spinner fa-spin"></i>
                    <button :disabled="loading" type="button" class="btn btn-t-default btn-theme" data-dismiss="modal">Tutup</button>
                    <button :disabled="loading" type="submit" class="btn btn-theme btn-t-primary">Kirim</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- end modal forgot password -->


@endsection

@push('js')
    <script>
        $(function(){
            $('#content').addClass('block-section bg-color4');
        });

        var login = new Vue({
            el: '#content',
            data: {
                loading: false,
                forms: {
                    email: null,
                    password: null,
                    emailForgot: null,
                    remember: false,
                },
                errors: {
                    emailForgot: null
                },
                passwordAlerts: {
                    message: null
                }
            },

            methods: {

                sendEmail: function(e) {
                    var forms = {
                        email: this.forms.emailForgot
                    };

                    this.loading = true;
                    this.errors = null;
                    this.passwordAlerts = {
                        message: null
                    };
                    this.disabled = true;

                    this.$http.post(e.target.action, forms).then(function(response){
                        this.passwordAlerts.message = response.body.message;

                        this.loading = false;
                        this.disabled = false;
                        this.forms.emailForgot = null;
                    }, function(response){
                        this.errors.emailForgot = response.body.email;

                        this.loading = false;
                        this.disabled = false;
                    })
                },

                beforeLogin: function() {
                    this.loading = true;
                },

                login: function(e) {
                    this.beforeLogin();

                    var forms = {
                        email: this.forms.email,
                        password: this.forms.password,
                        remember: this.forms.remember
                    };

                    this.$http.post(e.target.action, forms).then(response =>{
                        // redirect
                        console.log(response);
                        window.location = response.body.url;

                    }, function(response){
                        this.errors = response.body;

                        this.loading = false;
                    })
                }
            }
        })
    </script>
@endpush
