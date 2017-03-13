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
      <form action="{{ route('glosarium.category.update', [$category->slug]) }}" method="post">
        {{ csrf_field() }}
        {{ method_field('put') }}

        <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
          <label>Nama Kategori</label>
            <input type="text" name="name" value="{{ old('name', $category->name) }}" class="form-control">
            <span class="label label-danger">{{ $errors->first('name') }}</span>
        </div>

        <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
          <label>Deksripsi</label>
          <textarea name="description" class="form-control" rows="10">{{ old('description', $category->description) }}</textarea>
          <span class="label label-danger">{{ $errors->first('description') }}</span>
        </div>

        <div class="form-group {{ $errors->has('publish') ? 'has-error' : '' }}">
          <label>Dipublikasikan</label>
          <div class="radio">
            <label><input type="radio" name="publish" value="1" checked="{{ $category->is_published == 1 }}">Ya</label>
            </div>
        <div class="radio">
          <label><input type="radio" name="publish" value="0">Tidak</label>
        </div>
        </div>

        <div class="form-group">
          <button type="submit" class="btn btn-theme btn-t-primary">Perbarui</button>
            <a href="{{ url('admin/glosarium/category') }}" class="btn btn-default btn-theme">Kembali</a>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- end Block side right -->
@endsection
