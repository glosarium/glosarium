@extends('layouts.app')

@section('content')

@include('users.partials.sidebar')

<div class="col-md-10 col-sm-10">
<!-- Block side right -->
<div class="block-section box-side-account">
  <h3 class="no-margin-top">{{ $title }}</h3>
  <hr/>
  <div class="row">
    <div class="col-md-7">

      @include('partials.message')

      <form action="{{ route('admin.word.store') }}" method="post">
        {{ csrf_field() }}
        {{ method_field('post') }}

        <div class="form-group {{ $errors->has('category') ? 'has-error' : '' }}">
          <label>Kategori</label>
          <select name="category" class="form-control">
            @foreach ($categories as $value => $label)
              <option value="{{ $value }}" {{ $value == old('category') ? 'selected="true"' : '' }}>{{ $label }}</option>
            @endforeach
          </select>
          <span class="label label-danger">{{ $errors->first('category') }}</span>
        </div>

        <div class="form-group {{ $errors->has('lang') ? 'has-error' : '' }}">
          <label>Bahasa Asal</label>
          <input type="text" name="lang" value="{{ old('lang') }}" class="form-control">
          <span class="label label-danger">{{ $errors->first('lang') }}</span>
        </div>

        <div class="form-group {{ $errors->has('origin') ? 'has-error' : '' }}">
          <label>Kata Asal</label>
          <input type="text" name="origin" value="{{ old('name') }}" class="form-control">
          <span class="label label-danger">{{ $errors->first('origin') }}</span>
        </div>

        <div class="form-group {{ $errors->has('locale') ? 'has-error' : '' }}">
          <label>Kata Lokal</label>
          <input type="text" name="locale" value="{{ old('locale') }}" class="form-control">
          <span class="label label-danger">{{ $errors->first('locale') }}</span>
        </div>

        <div class="form-group {{ $errors->has('publish') ? 'has-error' : '' }}">
          <label>Dipublikasikan</label>
          <div class="radio">
            <label><input type="radio" name="publish" value="1" {{ old('publish') == 1 ? 'checked="true"' : '' }}>Ya</label>
            </div>
          <div class="radio">
            <label><input type="radio" name="publish" value="0" {{ old('publish') == 0 ? 'checked="true"' : '' }}>Tidak</label>
          </div>
        </div>

        <div class="form-group">
          <button type="submit" class="btn btn-theme btn-t-primary">@lang('global.btn.save')</button>
            <a href="{{ route('admin.word.index') }}" class="btn btn-default btn-theme">@lang('global.btn.back')</a>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- end Block side right -->
@endsection
