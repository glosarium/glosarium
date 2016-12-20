<div class="form-group {{ $errors->has('category') ? 'has-error' : '' }}">
    {{ Form::label('category_id', trans('word.field.category')) }} *
    {{ Form::select('category_id', $categories, null, ['class' => 'form-control']) }}
    <span class="help-block">{{ $errors->first('category_id') }}</span>
</div>

<div class="form-group {{ $errors->has('alias') ? 'has-error' : '' }}">
    {{ Form::label('alias', trans('word.field.alias')) }}
    {{ Form::text('alias', null, ['class' => 'form-control', 'placeholder' => trans('word.placeholder.alias')]) }}
    <span class="help-block">{{ $errors->first('alias') }}</span>
</div>

<div class="form-group {{ $errors->has('lang') ? 'has-error' : '' }}">
    {{ Form::label('lang', trans('word.field.lang')) }} *
    {{ Form::text('lang', null, ['class' => 'form-control']) }}
    <span class="help-block">{{ $errors->first('lang') }}</span>
</div>

<div class="form-group {{ $errors->has('foreign') ? 'has-error' : '' }}">
    {{ Form::label('foreign', trans('word.field.foreign')) }} *
    {{ Form::text('foreign', null, ['class' => 'form-control']) }}
    <span class="help-block">{{ $errors->first('foreign') }}</span>
</div>

<div class="form-group {{ $errors->has('locale') ? 'has-error' : '' }}">
    {{ Form::label('locale', trans('word.field.locale')) }} *
    {{ Form::text('locale', null, ['class' => 'form-control']) }}
    <span class="help-block">{{ $errors->first('locale') }}</span>
</div>

<hr>

<p><sup>*</sup> @lang('word.required')</p>

<div class="form-group">
    {{ Form::submit(trans('word.btn.save'), ['class' => 'btn btn-primary']) }}
</div>
