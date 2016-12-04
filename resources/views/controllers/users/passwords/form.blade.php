@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-7 col-sm-12">
            <div class="panel panel-default">
                <div class="panel-heading">{{ $title }}</div>
                <div class="panel-body">

                	@include('partials.message')

                    <form role="form" method="POST" action="{{ route('user.password.update') }}">
                        {{ csrf_field() }}
                        {{ method_field('post') }}

                        <div class="form-group{{ $errors->has('current_password') ? ' has-error' : '' }}">
                            <label for="current_password" class="control-label">@lang('user.field.currentPassword')</label>

                            <input id="current-password" type="password" class="form-control" name="current_password" value="{{ old('email') }}" required autofocus>

                            @if ($errors->has('current_password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('current_password') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="control-label">@lang('user.field.newPassword')</label>

                            <input id="password" type="password" class="form-control" name="password" value="{{ old('email') }}" required autofocus>

                            @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>


                        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            <label for="password_confirmation" class="control-label">@lang('user.field.passwordConfirmation')</label>

                            <input id="password-confirmation" type="password" class="form-control" name="password_confirmation" value="{{ old('email') }}" required autofocus>

                            @if ($errors->has('password_confirmation'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password_confirmation') }}</strong>
                                </span>
                            @endif
                        </div>
                        <hr>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">
                                @lang('user.btn.changePassword')
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-5 col-sm-12">
            <div class="panel panel-default">
                <div class="panel-heading">Iklan</div>
                <div class="panel-body">
                    @include('partials.ad-responsive')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
