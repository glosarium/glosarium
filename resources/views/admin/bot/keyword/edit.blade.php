@extends('layouts.app')

@section('heading')
  @include('partials.title')
@stop

@section('content')

@include('user.partial.sidebar')
<div class="col-md-10 col-sm-10">
<!-- Block side right -->
<div class="block-section box-side-account">
   <div class="row">
      <div class="col-md-12">
         <form action="{{ route('admin.keyword.update', [$keyword->id]) }}" method="post" class="form-horizontal">
            <div class="panel panel-default">
               <div class="panel-heading">{{ $title }}</div>
               <div class="panel-body">

                  @include('partials.message')

                  {{ csrf_field() }}
                  {{ method_field('put') }}

                  <div class="form-group {{ $errors->has('keyword') ? 'has-error' : '' }}">
                     <label class="control-label col-md-3">@lang('bot.keyword.field.keyword')</label>
                     <div class="col-sm-3">
                        <input readonly="true" type="text" name="keyword" value="{{ old('keyword', $keyword->keyword) }}" class="form-control">
                        <span class="label label-danger">{{ $errors->first('keyword') }}</span>
                     </div>
                  </div>

                  <div class="form-group {{ $errors->has('message') ? 'has-error' : '' }}">
                     <label class="control-label col-md-3">@lang('bot.keyword.field.message')</label>
                     <div class="col-sm-9">
                        <textarea name="message" class="form-control" rows="5">{{ old('message', $keyword->message) }}</textarea>
                        <span class="label label-danger">{{ $errors->first('message') }}</span>
                     </div>
                  </div>

                  <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
                     <label class="control-label col-md-3">@lang('bot.keyword.field.description')</label>
                     <div class="col-sm-9">
                        <textarea name="description" class="form-control" rows="5">{{ old('description', $keyword->description) }}</textarea>
                        <span class="label label-danger">{{ $errors->first('description') }}</span>
                     </div>
                  </div>
               </div>
               <div class="panel-footer">
                  <button type="submit" class="btn btn-theme btn-t-primary">@lang('global.btn.update')</button>
                  <a href="{{ route('admin.keyword.index') }}" class="btn btn-default btn-theme">@lang('global.btn.back')</a>
               </div>
            </div>
         </form>
      </div>
   </div>
</div>
<!-- end Block side right -->
@endsection
