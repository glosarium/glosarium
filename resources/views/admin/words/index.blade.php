@extends('backpack::layout')

@section('header')
    <section class="content-header">
      <h1>
        @lang('word.title')
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url(config('backpack.base.route_prefix', 'admin')) }}">{{ config('backpack.base.project_name') }}</a></li>
        <li class="active">@lang('word.index')</li>
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

                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <th>@lang('word.field.category')</th>
                                <th>@lang('word.field.foreign')</th>
                                <th>@lang('word.field.locale')</th>
                                <th>@lang('word.field.spell')</th>
                                <th>@lang('word.field.updated')</th>
                                <th class="text-right">@lang('word.field.actions')</th>
                            </thead>

                            <tbody>
                            @foreach ($words as $word)
                                <tr class="{{ $word->status == 'drafted' ? 'text-muted' : '' }}">
                                    <td>
                                        <a href="{{ route('admin.word.index', ['category' => $word->category->id]) }}">
                                            {{ $word->category->name }}
                                        </a>
                                    </td>
                                    <td>
                                        <span class="label label-default">
                                            {{ $word->lang }}
                                        </span>
                                        &nbsp;
                                        {{ $word->foreign }}
                                    </td>
                                    <td>{{ $word->locale }}</td>
                                    <td>{{ $word->spell }}</td>
                                    <td>{{ $word->updated_at->format(config('backpack.base.default_datetime_format')) }}</td>
                                    <td class="text-right">
                                        <a href="{{ route('admin.word.show', [$word->id]) }}" class="btn btn-default btn-xs">
                                            <i class="fa fa-search fa-fw"></i>
                                        </a>

                                        <a href="{{ route('admin.word.show', [$word->id]) }}" class="btn btn-primary btn-xs">
                                            <i class="fa fa-edit fa-fw"></i>
                                        </a>

                                        <a href="{{ route('admin.word.destroy', [$word->id]) }}" class="btn btn-danger btn-xs">
                                            <i class="fa fa-trash fa-fw"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                    {{ $words->appends(['category' => request('category')])->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
