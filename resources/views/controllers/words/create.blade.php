@extends('layouts.app')

{{ debug($errors) }}

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-7 col-sm-12">
            <div class="panel panel-primary">
                <div class="panel-heading">{{ $title or null }}</div>
                <div class="panel-body">

                    <div class="alert alert-info">@lang('word.createInfo')</div>

                    @if (session()->has('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <form role="form" method="POST" action="{{ route('word.store') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('category') ? ' has-error' : '' }}">
                            <label for="category" class="control-label">@lang('word.field.category')</label>
                            <select name="category" id="category" class="form-control">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                            <span class="help-block">{{ $errors->first('type') }}</span>
                        </div>

                        <div class="form-group{{ $errors->has('foreign') ? ' has-error' : '' }}">
                            <label for="foreign" class="control-label">@lang('word.field.foreign')</label>

                            <input id="foreign" type="text" class="form-control" name="foreign" value="{{ old('foreign') }}" required>

                            <span class="help-block">{{ $errors->first('foreign') }}</span>
                        </div>

                        <div class="form-group{{ $errors->has('locale') ? ' has-error' : '' }}">
                            <label for="locale" class="control-label">@lang('word.field.locale')</label>

                            <input id="locale" type="text" class="form-control" name="locale" value="{{ old('locale') }}" required autofocus>

                            <span class="help-block">{{ $errors->first('locale') }}</span>
                        </div>

                        <hr>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">
                                @lang('word.btn.save')
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-5 col-sm-12">
            <div class="panel panel-default">
                <div class="panel-heading">Iklan</div>
                <div class="panel-body">
                    @include('controllers.words.partials.ad-responsive')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
@endpush

@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
@endpush

@push('script')
    <script>
        $(function(){
            $('#type').select2()
        })
    </script>
@endpush
