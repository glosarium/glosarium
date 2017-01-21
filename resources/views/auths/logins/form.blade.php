@extends('layouts.app')

@section('content')
<div class="panel panel-md">
    <div class="panel-body">
        <div class="row">
            <div class="col-md-12">
                <!-- buttons top -->
                <p><a href="#" class="btn btn-primary btn-theme btn-block"><i class="fa fa-facebook pull-left bordered-right"></i> Login with Facebook</a></p>
                <p><a href="#" class="btn btn-danger btn-theme btn-block"><i class="fa fa-google-plus pull-left bordered-right"></i> Login with Google</a></p>
                <!-- end buttons top -->
                <div class="white-space-10"></div>
                <p class="text-center"><span class="span-line">OR</span></p>
                <!-- form login -->
                <form action="{{ url('login') }}" method="post">
                    {{ csrf_field() }}

                    <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                        <label>Alamat Surel</label>
                        <input v-model="forms.email" name="email" type="email" class="form-control" placeholder="">
                    </div>
                    <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                        <label>Katasandi</label>
                        <input v-model="forms.password" name="password" type="password" class="form-control" placeholder="">
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-xs-6">
                                <div class="checkbox flat-checkbox">
                                    <label>
                                    <input name="remember" type="checkbox">
                                    <span class="fa fa-check"></span>
                                    Ingatkan saya
                                    </label>
                                </div>
                            </div>
                            <div class="col-xs-6 text-right">
                                <p class="help-block"><a href="#password-modal" data-toggle="modal">Lupa katasandi?</a></p>
                            </div>
                        </div>
                    </div>
                    <div class="form-group no-margin">
                        <button class="btn btn-theme btn-lg btn-t-primary btn-block">Masuk</button>
                    </div>
                </form>
                <!-- form login -->
            </div>
        </div>
    </div>
</div>
<div class="white-space-20"></div>
<div class="text-center color-white">Bukan kontributor? &nbsp; <a href="{{ url('register') }}" class="link-white"><strong>Buat akun gratis!</strong></a></div>

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
                        <input v-model="forms.emailForgot" type="email" class="form-control" name="email" autocomplete="off" v-bind:disabled="isDisabled">
                        <span v-if="errors && errors.emailForgot" class="label label-danger">@{{ errors.emailForgot[0] }}</span>
                    </div>
                </div>
                <div class="modal-footer">
                    <i v-if="loading" class="fa fa-spinner fa-spin"></i>
                    <button v-bind:disabled="isDisabled" type="button" class="btn btn-default btn-theme" data-dismiss="modal">Tutup</button>
                    <button v-bind:disabled="isDisabled" type="submit" class="btn btn-success btn-theme">Kirim</button>
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
                isDisabled: false,
                forms: {
                    _token: Laravel.csrfToken,
                    email: null,
                    password: null,
                    emailForgot: null
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
                        _token: this.forms._token,
                        email: this.forms.emailForgot
                    };

                    this.loading = true;
                    this.errors = null;
                    this.passwordAlerts = {
                        message: null
                    };
                    this.isDisabled = true;

                    this.$http.post(e.target.action, forms).then(function(response){
                        this.passwordAlerts.message = response.body.message;

                        this.loading = false;
                        this.isDisabled = false;
                        this.forms.emailForgot = null;
                    }, function(response){
                        this.errors.emailForgot = response.body.email;

                        this.loading = false;
                        this.isDisabled = false;
                    })
                }
            }
        })
    </script>
@endpush
