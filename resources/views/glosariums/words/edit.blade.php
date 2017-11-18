@extends('layouts.app')

@section('header')
<header class="page-header">
    <div class="container page-name">
        <h1 class="text-center">Sunting Kata</h1>
        <p class="lead text-center">Kata yang disunting, akan masuk kembali ke moderasi dan butuh persetujuan admin untuk ditampilkan ke publik.</p>
    </div>
    <div class="container">
        <div class="row">

            <div class="col-sm-12">
                @include('partials.message')
            </div>
            
            <form method="post" action="{{ route('glosarium.word.update', $word->slug) }}">
                {{ csrf_field() }}
                {{ method_field('put') }}
                <div class="form-group col-xs-12 col-sm-6 {{ !$errors->has('origin') ?: 'has-error' }}">
                    <label>Kata asal dalam bahasa asing</label>
                    <input type="text" name="origin" value="{{ old('origin', $word->origin) }}" class="form-control input-lg" autofocus="true">
                    <span class="help-block">{{ $errors->first('origin') }}</span>
                </div>
                <div class="form-group col-xs-12 col-sm-6 {{ !$errors->has('locale') ?: 'has-error' }}">
                    <label>Kata dalam bahasa lokal</label>
                    <input type="text" name="locale" value="{{ old('locale', $word->locale) }}" class="form-control input-lg">
                    <span class="help-block">{{ $errors->first('locale') }}</span>
                </div>
                <div class="form-group col-xs-12 col-sm-12 {{ !$errors->has('category_id') ?: 'has-error' }}">
                    <label>Kategori</label>
                    <select class="form-control input-lg" name="category_id">
                        <option>Pilih Kategori</option>
                        @foreach($categories as $value => $label)
                        <option value="{{ $value }}" {{ $word->category->slug == $value ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                    <span class="help-block">{{ $errors->first('category_id') }}</span>
                </div>
                <div class="form-group col-xs-12 {{ !$errors->has('description') ?: 'has-error' }}">
                    <label>Deskripsi</label>
                    <textarea name="description" class="form-control" rows="3" placeholder="Deskripsi singkat mengenai padanan kata dalam bahasa Indonesia">{{ old('description', $word->description['description']) }}</textarea>
                    <span class="help-block">{{ $errors->first('description') }}</span>
                </div>
                <div class="form-group col-xs-12 {{ !$errors->has('source') ?: 'has-error' }}">
                    <label>Sumber informasi</label>
                    <input type="text" value="{{ old('source', $word->source) }}" class="form-control" placeholder="Sumber informasi, bisa dalam bentuk tautan atau penjelasan singkat">
                    <span class="help-block">{{ $errors->first('source') }}</span>
                </div>
        </div>
        <div class="button-group">
            <div class="action-buttons">
                <div class="upload-button">
                    <a href="{{ route('glosarium.word.contribute') }}" class="btn btn-default btn-white">Kembali</a>
                    <button type="submit" class="btn btn-primary">Ubah Kata</button>
                </div>
            </div>
        </div>
        </form>
    </div>
</header>
@endsection
