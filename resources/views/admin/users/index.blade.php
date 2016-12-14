@extends('backpack::layout')

@section('header')
    <section class="content-header">
      <h1>
        @lang('user.title')
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url(config('backpack.base.route_prefix', 'admin')) }}">{{ config('backpack.base.project_name') }}</a></li>
        <li class="active">@lang('user.index')</li>
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

                    @if ($users->total() >= 1)
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <th>@lang('user.field.name')</th>
                                <th>@lang('user.field.email')</th>
                                <th>@lang('user.field.updated')</th>
                                <th>@lang('user.field.created')</th>
                                <th class="text-right">@lang('user.field.actions')</th>
                            </thead>

                            <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>
                                        {{ $user->name }}
                                        @if ($user->id == auth()->id())
                                            <small class="label label-info">
                                                Akun Anda!
                                            </small>
                                        @endif
                                    </td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->updated_at->format(config('backpack.base.default_datetime_format')) }}</td>
                                    <td>{{ $user->created_at->format(config('backpack.base.default_datetime_format')) }}</td>
                                    <td class="text-right">
                                        <a href="{{ route('admin.user.show', [$user->id]) }}" class="btn btn-default btn-xs">
                                            <i class="fa fa-search fa-fw"></i>
                                        </a>

                                        <a href="{{ route('admin.user.show', [$user->id]) }}" class="btn btn-default btn-xs">
                                            <i class="fa fa-unlock-alt fa-fw"></i>
                                        </a>

                                        <a href="{{ route('admin.user.show', [$user->id]) }}" class="btn btn-primary btn-xs">
                                            <i class="fa fa-edit fa-fw"></i>
                                        </a>

                                        <a href="{{ route('admin.user.show', [$user->id]) }}" class="btn btn-danger btn-xs">
                                            <i class="fa fa-trash fa-fw"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    @else
                        <div class="alert alert-info">
                            Hasil pencarian tidak ditemukan atau belum ada kata yang disimpan.
                        </div>
                    @endif

                    {{ $users->appends(['query' => request('query')])->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection