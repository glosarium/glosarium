@extends('layouts.app')

@section('content')

@include('users.partials.sidebar')

<div class="col-md-10 col-sm-10">
<!-- Block side right -->
<div class="block-section box-side-account">
  <div class="row">
    <div class="col-md-12">


      <form action="{{ route('glosarium.category.update', [$category->slug]) }}" method="post" class="form-horizontal">
        {{ csrf_field() }}
        {{ method_field('put') }}
      <div class="panel panel-default">
        <div class="panel-heading">{{ $title }}</div>
        <div class="panel-body">

      @include('partials.message')

      <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
          <label class="control-label col-md-3">@lang('glosarium.category.field.name')</label>
          <div class="col-md-5">
            <input type="text" name="name" value="{{ old('name', $category->name) }}" class="form-control">
            <span class="label label-danger">{{ $errors->first('name') }}</span>
          </div>
        </div>

        <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
          <label class="control-label col-md-3">@lang('glosarium.category.field.description')</label>
          <div class="col-md-9">
            <textarea name="description" class="form-control" rows="10">{{ old('description', $category->description) }}</textarea>
          <span class="label label-danger">{{ $errors->first('description') }}</span>
          </div>
        </div>

        <div class="form-group {{ $errors->has('publish') ? 'has-error' : '' }}">
          <label class="control-label col-md-3">@lang('glosarium.category.field.published')</label>
          <div class="col-md-5">
            <div class="radio">
            <label><input type="radio" name="publish" value="1" checked="{{ $category->is_published == 1 }}">@lang('global.yes')</label>
            </div>
          <div class="radio">
            <label><input type="radio" name="publish" value="0">@lang('global.no')</label>
          </div>
          </div>
        </div>
        </div>
        <div class="panel-footer">
          <button type="submit" class="btn btn-theme btn-t-primary">
            @lang('global.btn.update')
          </button>
            <a href="{{ url('admin/glosarium/category') }}" class="btn btn-default btn-theme">
              @lang('global.btn.back')
            </a>
        </div>
      </div>
</form>


    </div>
  </div>
</div>
<!-- end Block side right -->
@endsection
