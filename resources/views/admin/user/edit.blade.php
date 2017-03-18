@extends('layouts.app')

@section('content')

@include('users.partials.sidebar')

<div class="col-md-10 col-sm-10">
<!-- Block side right -->
<div class="block-section box-side-account">
   <div class="row">
      <div class="col-md-12">
         <form action="{{ route('admin.user.update', [$user->id]) }}" method="post" class="form-horizontal">
            <div class="panel panel-default">
               <div class="panel-heading">{{ $title }}</div>
               <div class="panel-body">
                  @include('partials.message')
                  {{ csrf_field() }}
                  {{ method_field('put') }}

                  <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                     <label class="control-label col-md-3">@lang('user.field.name')</label>
                     <div class="col-md-5">
                        <input type="text" name="name" value="{{ old('name', $user->name) }}" class="form-control">
                        <span class="label label-danger">{{ $errors->first('name') }}</span>
                     </div>
                  </div>

                  <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                     <label class="control-label col-md-3">@lang('user.field.email')</label>
                     <div class="col-md-5">
                        <input type="text" name="email" readonly="true" value="{{ old('email', $user->email) }}" class="form-control">
                        <span class="label label-danger">{{ $errors->first('email') }}</span>
                     </div>
                  </div>

                  <div class="form-group {{ $errors->has('type') ? 'has-error' : '' }}">
                     <label class="control-label col-md-3">@lang('user.field.type')</label>
                     <div class="col-md-5">
                        <div class="radio">
                           <label>
                              <input type="radio" name="type" value="admin" {{ $user->type == 'admin' ? 'checked="true"' : '' }}>Admin
                           </label>
                        </div>
                        <div class="radio">
                           <label>
                              <input type="radio" name="type" value="contributor" {{ $user->type == 'contributor' ? 'checked="true"' : '' }}>Kontributor
                              </label>
                        </div>
                     </div>
                  </div>

                  <div class="form-group {{ $errors->has('active') ? 'has-error' : '' }}">
                     <label class="control-label col-md-3">@lang('user.field.status')</label>
                     <div class="col-md-5">
                        <div class="radio">
                           <label><input type="radio" name="active" value="1" {{ $user->is_active == 1 ? 'checked="true"' : '' }}>Aktif</label>
                        </div>
                        <div class="radio">
                           <label><input type="radio" name="active" value="0" {{ $user->is_active == 0 ? 'checked="true"' : '' }}>Tidak Aktif</label>
                        </div>
                     </div>
                  </div>

               </div>
               <div class="panel-footer">
                  <button type="submit" class="btn btn-theme btn-t-primary">@lang('global.btn.update')</button>
                  <a href="{{ route('admin.user.index') }}" class="btn btn-default btn-theme">@lang('global.btn.back')</a>
               </div>
            </div>
         </form>
      </div>
   </div>
</div>
<!-- end Block side right -->
@endsection
