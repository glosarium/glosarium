@extends('layouts.app')

@section('header')
<header class="page-header">
    <div class="container page-name">
        <h1 class="text-center">Ajukan Kata Baru</h1>
        <p class="lead text-center">Sebagai kontributor, kata yang kamu ajukan harus melalui tahap moderasi.</p>
    </div>
    <div class="container">
        <div class="row">
            <form method="post" action="{{ route('glosarium.word.store') }}">
                {{ csrf_field() }}
                {{ method_field('post') }}

                <div class="form-group col-xs-12 col-sm-6 {{ !$errors->has('origin') ?: 'has-error' }}">
                    <input type="text" name="origin" value="{{ old('origin') }}" class="form-control input-lg" placeholder="Kata dalam bahasa asing">
                    <span class="help-block">{{ $errors->first('origin') }}</span>
                </div>
                <div class="form-group col-xs-12 col-sm-6 {{ !$errors->has('locale') ?: 'has-error' }}">
                    <input type="text" name="locale" value="{{ old('locale') }}" class="form-control input-lg" placeholder="Kata dalam bahasa lokal">
                    <span class="help-block">{{ $errors->first('locale') }}</span>
                </div>
                <div class="form-group col-xs-12 col-sm-12 {{ !$errors->has('category_id') ?: 'has-error' }}">
                    <select class="form-control input-lg" name="category_id">
                        <option>Pilih Kategori</option>
                        @foreach($categories as $value => $label)
                            <option value="{{ $value }}">{{ $label }}</option>
                        @endforeach
                    </select>
                    <span class="help-block">{{ $errors->first('category_id') }}</span>
                </div>
                <div class="form-group col-xs-12 {{ !$errors->has('description') ?: 'has-error' }}">
                    <textarea name="description" class="form-control" rows="3" placeholder="Deskripsi singkat mengenai padanan kata dalam bahasa Indonesia">{{ old('description') }}</textarea>
                    <span class="help-block">{{ $errors->first('description') }}</span>
                </div>
                <div class="form-group col-xs-12 {{ !$errors->has('source') ?: 'has-error' }}">
                    <input type="text" value="{{ old('source') }}" class="form-control" placeholder="Sumber informasi, bisa dalam bentuk tautan atau penjelasan singkat">
                    <span class="help-block">{{ $errors->first('source') }}</span>
                </div>
            </div>
            <div class="button-group">
                <div class="action-buttons">
                    <div class="upload-button">
                        <button type="submit" class="btn btn-block btn-primary">Kirim Pengajuan Kata</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</header>
@endsection
