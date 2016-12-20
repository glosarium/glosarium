@extends('backpack::layout')

@section('header')
    <section class="content-header">
      <h1>
        {{ $word->locale }}
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url(config('backpack.base.route_prefix', 'admin')) }}">{{ config('backpack.base.project_name') }}</a></li>
        <li><a href="{{ route('admin.word.index') }}">@lang('word.index')</a></li>
        <li class="active">{{ $word->locale }} ({{ $word->foreign }})</li>
      </ol>
    </section>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-default">
                <div class="box-header with-border">
                    <div class="box-title">{{ $title }}</div>
                </div>

                <div class="panel-body">
                    @include('partials.message')

                    {{ Form::model($word, [
                        'url' => route('admin.word.update', [$word->id]),
                        'name' => 'update-word',
                        'id' => 'form-update',
                        'role' => 'form',
                        'method' => 'put'
                    ])}}

                    @include('admin.words.form')

                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
@endsection
