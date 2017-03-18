@extends('layouts.app')

@section('heading')
  @include('partials.title')
@stop

@section('content')
@include('users.partials.sidebar')
<div class="col-md-10 col-sm-10">
<!-- Block side right -->
<div class="block-section box-side-account">
   <div class="row">
      <form action="{{ route('user.password.update') }}" method="post" class="form-horizontal">
         {{ csrf_field() }}
         <div class="panel panel-default">
            <div class="panel-heading">{{ $title }}</div>
            <div class="panel-body">
               @include('partials.message')
               <div class="form-group {{ $errors->has('current_password') ? 'has-error' : '' }}">
                  <label class="control-label col-md-3">@lang('user.field.currentPassword')</label>
                  <div class="col-md-5">
                     <input name="current_password" type="password" class="form-control">
                     <span class="label label-danger">{{ $errors->first('current_password') }}</span>
                  </div>
               </div>
               <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                  <label class="control-label col-md-3">@lang('user.field.password')</label>
                  <div class="col-md-5">
                     <input name="password" type="password" class="form-control">
                     <span class="label label-danger">{{ $errors->first('password') }}</span>
                  </div>
               </div>
               <div class="form-group {{ $errors->has('password_confirmation') ? 'has-error' : '' }}">
                  <label class="control-label col-md-3">@lang('user.field.confirmPassword')</label>
                  <div class="col-md-5">
                     <input name="password_confirmation" type="password" class="form-control">
                     <span class="label label-danger">{{ $errors->first('password_confirmation') }}</span>
                  </div>
               </div>
            </div>
            <div class="panel-footer">
               <button type="submit" class="btn btn-theme btn-t-primary">
               @lang('user.btn.changePassword')
               </button>
            </div>
         </div>
      </form>
   </div>
</div>
<!-- end Block side right -->
@endsection
