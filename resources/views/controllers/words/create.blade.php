@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">{{ $title or null }}</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('word.store') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
                            <label for="type" class="col-md-4 control-label">@lang('word.field.type')</label>
                            <div class="col-md-6">
                                <select name="type" id="type" class="form-control">
                                    @foreach ($types as $type)
                                        <option value="{{ $type->id }}">{{ $type->name }} ({{ $type->description }})</option>
                                    @endforeach
                                </select>
                                <span class="help-block">{{ $errors->first('type') }}</span>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('origin') ? ' has-error' : '' }}">
                            <label for="origin" class="col-md-4 control-label">@lang('word.field.origin')</label>

                            <div class="col-md-6">
                                <input id="origin" type="text" class="form-control" name="origin" value="{{ old('origin') }}" required>
                                <span class="help-block">{{ $errors->first('origin') }}</span>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('glosarium') ? ' has-error' : '' }}">
                            <label for="glosarium" class="col-md-4 control-label">@lang('word.field.glosarium')</label>

                            <div class="col-md-6">
                                <input id="glosarium" type="text" class="form-control" name="glosarium" value="{{ old('glosarium') }}" required autofocus>

                                <span class="help-block">{{ $errors->first('glosarium') }}</span>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('spell') ? ' has-error' : '' }}">
                            <label for="spell" class="col-md-4 control-label">@lang('word.field.spell')</label>

                            <div class="col-md-6">
                                <input id="spell" type="text" class="form-control" name="spell" value="{{ old('spell') }}" required autofocus>

                                <span class="help-block">{{ $errors->first('spell') }}</span>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                            <label for="description" class="col-md-4 control-label">@lang('word.field.description')</label>

                            <div class="col-md-6">
                                <textarea name="descriptions" class="form-control">{{ old('descriptions') }}</textarea>

                                <span class="help-block">{{ $errors->first('descriptions') }}</span>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    @lang('word.btn.save')
                                </button>
                            </div>
                        </div>
                    </form>
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
