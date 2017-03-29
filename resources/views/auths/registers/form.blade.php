@extends('layouts.app')

@section('content')

<div class="panel panel-md">
    <div class="panel-body">
        <div class="row">
            <div class="col-md-12" v-cloak>
                <!-- buttons top -->
                <p><a href="#" class="btn btn-primary btn-theme btn-block" disabled="true"><i class="fa fa-facebook pull-left bordered-right"></i> @lang('user.loginFacebook')</a></p>
                <p><a href="#" class="btn btn-danger btn-theme btn-block" disabled="true"><i class="fa fa-google-plus pull-left bordered-right"></i> @lang('user.loginGoogle')</a></p>
                <!-- end buttons top -->
                <div class="white-space-10"></div>
                <p class="text-center"><span class="span-line">@lang('user.or')</span></p>
                <!-- form login -->
                <form v-on:submit.prevent="register" action="{{ url('register') }}" method="post">
                    {{ csrf_field() }}

                    <div v-bind:class="['form-group', errors && errors.name ? 'has-error' : '']">
                        <label>@lang('user.field.name')</label>
                        <input v-model="forms.name" v-bind:disabled="disabled" type="text" name="name" class="form-control">
                        <span v-if="errors && errors.name" class="label label-danger">@{{ _.head(errors.name) }}</span>
                    </div>

                    <div v-bind:class="['form-group', errors && errors.email ? 'has-error' : '']">
                        <label>@lang('user.field.email')</label>
                        <input v-model="forms.email" v-bind:disabled="disabled" name="email" type="email" class="form-control" placeholder="">
                        <span v-if="errors && errors.email" class="label label-danger">@{{ _.head(errors.email) }}</span>
                    </div>

                    <div v-bind:class="['form-group', errors && errors.password ? 'has-error' : '']">
                        <label>@lang('user.field.password')</label>
                        <input v-model="forms.password" v-bind:disabled="disabled" name="password" type="password" class="form-control" placeholder="">
                        <span v-if="errors && errors.password" class="label label-danger">@{{ _.head(errors.password) }}</span>
                    </div>

                    <div v-bind:class="['form-group', errors && errors.passwordConfirmation ? 'has-error' : '']">
                        <label>@lang('user.field.confirmPassword')</label>
                        <input v-model="forms.passwordConfirmation" v-bind:disabled="disabled" name="passwordConfirmation" type="password" class="form-control" placeholder="Ulangi sandi lewat">
                        <span v-if="errors && errors.passwordConfirmation" class="label label-danger">@{{ _.head(errors.passwordConfirmation) }}</span>
                    </div>

                    <div class="white-space-10"></div>
                    <div class="form-group no-margin">
                        <button v-bind:disabled="disabled" class="btn btn-theme btn-lg btn-t-primary btn-block">@lang('user.btn.register') <loader :show="loading"></loader></button>
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
    <script src="{{ asset('js/user.register.js') }}"></script>
@endpush
