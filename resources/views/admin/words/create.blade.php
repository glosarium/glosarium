@extends('backpack::layout')

@section('header')
    <section class="content-header">
      <h1>
        {{ $title }}
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url(config('backpack.base.route_prefix', 'admin')) }}">{{ config('backpack.base.project_name') }}</a></li>
        <li><a href="{{ route('admin.word.index') }}">@lang('word.index')</a></li>
        <li class="active">@lang('word.create')</li>
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
                    {{ Form::open([
                        'route' => 'admin.word.store',
                        'name' => 'create-word',
                        'id' => 'form-create',
                        'role' => 'form'
                    ])}}

                    @include('admin.words.form')

                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
@endsection
