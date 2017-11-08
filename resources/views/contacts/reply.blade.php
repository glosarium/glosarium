@extends('layouts.app')

@section('header')
<header class="page-header bg-img">
    <div class="container page-name">
        <h1 class="text-center">Balas Pesan</h1>
    </div>
    <div class="container">
        <div class="row">

            @include('partials.message')

            <form method="post" action="{{ route('contact.submit', $message->id) }}">
                {{ csrf_field() }}
                {{ method_field('post') }}

                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            {{ $message->from }}
                        </div>
                        <div class="panel-body">
                            {{ $message->text }}
                        </div>
                    </div>
                </div>

                <div class="form-group col-xs-12 col-sm-12 {{ !$errors->has('subject') ?: 'has-error' }}">
                    <label>Subjek</label>
                    <input type="text" name="subject" value="{{ old('subject', 'Balasan: '.$message->subject) }}" class="form-control">
                    <span class="help-block">{{ $errors->first('subject') }}</span>
                </div>
                <div class="form-group col-xs-12 {{ !$errors->has('message') ?: 'has-error' }}">
                    <label>Pesan Balasan</label>
                    <textarea name="message" class="form-control" rows="5" autofocus="true">{{ old('message') }}</textarea>
                    <span class="help-block">{{ $errors->first('message') }}</span>
                </div>
        </div>
        <div class="button-group">
            <div class="action-buttons">
                <div class="upload-button">
                    <a href="{{ route('contact.index') }}" class="btn btn-white">Kembali</a>
                    <button type="submit" class="btn btn-primary">Kirim Pesan</button>
                </div>
            </div>
        </div>
        </form>
    </div>
</header>
@endsection