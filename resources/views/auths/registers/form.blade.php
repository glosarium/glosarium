@extends('layouts.app')

@section('content')

<div class="panel panel-md">
    <div class="panel-body">
        <div class="row">
            <div class="col-md-12">
                <!-- buttons top -->
                <p><a href="#" class="btn btn-primary btn-theme btn-block" disabled="true"><i class="fa fa-facebook pull-left bordered-right"></i> Register with Facebook</a></p>
                <p><a href="#" class="btn btn-danger btn-theme btn-block" disabled="true"><i class="fa fa-google-plus pull-left bordered-right"></i> Register with Google</a></p>
                <!-- end buttons top -->
                <div class="white-space-10"></div>
                <p class="text-center"><span class="span-line">ATAU</span></p>
                <!-- form login -->
                <form v-on:submit.prevent="register" action="{{ url('register') }}" method="post">
                    {{ csrf_field() }}

                    <div v-bind:class="['form-group', errors && errors.name ? 'has-error' : '']">
                        <label>Nama Lengkap</label>
                        <input v-model="forms.name" v-bind:disabled="disabled" type="text" name="name" class="form-control">
                        <span v-if="errors && errors.name" class="label label-danger">@{{ errors.name[0] }}</span>
                    </div>

                    <div v-bind:class="['form-group', errors && errors.email ? 'has-error' : '']">
                        <label>Alamat Surel</label>
                        <input v-model="forms.email" v-bind:disabled="disabled" name="email" type="email" class="form-control" placeholder="">
                        <span v-if="errors && errors.email" class="label label-danger">@{{ errors.email[0] }}</span>
                    </div>

                    <div v-bind:class="['form-group', errors && errors.password ? 'has-error' : '']">
                        <label>Sandi Lewat</label>
                        <input v-model="forms.password" v-bind:disabled="disabled" name="password" type="password" class="form-control" placeholder="">
                        <span v-if="errors && errors.password" class="label label-danger">@{{ errors.password[0] }}</span>
                    </div>

                    <div v-bind:class="['form-group', errors && errors.passwordConfirmation ? 'has-error' : '']">
                        <label>Konfirmasi Sandi Lewat</label>
                        <input v-model="forms.passwordConfirmation" v-bind:disabled="disabled" name="passwordConfirmation" type="password" class="form-control" placeholder="Ulangi sandi lewat">
                        <span v-if="errors && errors.passwordConfirmation" class="label label-danger">@{{ errors.passwordConfirmation[0] }}</span>
                    </div>

                    <div class="white-space-10"></div>
                    <div class="form-group no-margin">
                        <button v-bind:disabled="disabled" class="btn btn-theme btn-lg btn-t-primary btn-block">Daftar <i v-if="loading" class="fa fa-spinner fa-spin"></i></button>
                    </div>
                </form>
                <!-- form login -->
            </div>
        </div>
    </div>
</div>
<div class="white-space-20"></div>
<div class="text-center color-white">Dengan mendaftar sebagai kontributor, <br> Anda setuju dengan <strong><a href="#" class="color-white">Syarat dan Kondisi</a></strong> yang berlaku di {{ config('app.name') }}.</div>
@endsection

@push('js')
    <script>
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
                    this.beforeRegister();

                    this.$http.post(e.target.action, this.forms).then(function(response){

                        window.location = response.body.url;

                    }, function(response){
                        this.errors = response.body;

                        this.afterRegister();
                    });
                }

            }
        })
    </script>
@endpush
