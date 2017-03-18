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
      <div class="col-md-12">
         <form action="{{ route('admin.word.update', [$word->id]) }}" method="post" class="form-horizontal">
            <div class="panel panel-default">
               <div class="panel-heading">{{ $title }}</div>
               <div class="panel-body">
                  @include('partials.message')
                  {{ csrf_field() }}
                  {{ method_field('put') }}
                  <div class="form-group {{ $errors->has('category') ? 'has-error' : '' }}">
                     <label class="control-label col-md-3">@lang('glosarium.word.field.category')</label>
                     <div class="col-md-5">
                        <select name="category" class="form-control">
                        @foreach ($categories as $value => $label)
                        <option value="{{ $value }}" {{ $value == $word->category_id ? 'selected="true"' : '' }}>{{ $label }}</option>
                        @endforeach
                        </select>
                        <span class="label label-danger">{{ $errors->first('category') }}</span>
                     </div>
                  </div>
                  <div class="form-group {{ $errors->has('lang') ? 'has-error' : '' }}">
                     <label class="control-label col-md-3">@lang('glosarium.word.field.lang')</label>
                     <div class="col-md-3">
                        <input type="text" name="lang" value="{{ old('lang', $word->lang) }}" class="form-control" placeholder="id, en, ar, ...">
                        <span class="label label-danger">{{ $errors->first('lang') }}</span>
                     </div>
                  </div>
                  <div class="form-group {{ $errors->has('origin') ? 'has-error' : '' }}">
                     <label class="control-label col-md-3">@lang('glosarium.word.field.origin')</label>
                     <div class="col-md-5">
                        <input type="text" name="origin" value="{{ old('name', $word->origin) }}" class="form-control">
                        <span class="label label-danger">{{ $errors->first('origin') }}</span>
                     </div>
                  </div>
                  <div class="form-group {{ $errors->has('locale') ? 'has-error' : '' }}">
                     <label class="control-label col-md-3">@lang('glosarium.word.field.locale')</label>
                     <div class="col-md-5">
                        <input type="text" name="locale" value="{{ old('locale', $word->locale) }}" class="form-control">
                        <span class="label label-danger">{{ $errors->first('locale') }}</span>
                     </div>
                  </div>
                  <div class="form-group {{ $errors->has('publish') ? 'has-error' : '' }}">
                     <label class="control-label col-md-3">@lang('glosarium.word.field.published')</label>
                     <div class="col-md-5">
                        <div class="radio">
                           <label><input type="radio" name="publish" value="1" {{ $word->is_published == 1 ? 'checked="true"' : '' }}>@lang('global.yes')</label>
                        </div>
                        <div class="radio">
                           <label><input type="radio" name="publish" value="0" {{ $word->is_published == 0 ? 'checked="true"' : '' }}>@lang('global.no')</label>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="panel-footer">
                  <button type="submit" class="btn btn-theme btn-t-primary">@lang('global.btn.update')</button>
                  <a href="{{ route('admin.word.index') }}" class="btn btn-default btn-theme">@lang('global.btn.back')</a>
               </div>
            </div>
         </form>
      </div>
   </div>
</div>
<!-- end Block side right -->
@endsection
