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

                    <p>
                        <a href="{{ route('admin.word.create') }}" class="btn btn-primary">
                            @lang('word.create')
                        </a>
                    </p>

                    @if ($words->total() >= 1)
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <th>@lang('word.field.category')</th>
                                <th>@lang('word.field.alias')</th>
                                <th>@lang('word.field.foreign')</th>
                                <th>@lang('word.field.locale') <span class="label label-default">id</span> </th>
                                <th>@lang('word.field.spell')</th>
                                <th>@lang('word.field.published')</th>
                                <th>@lang('word.field.updated')</th>
                                <th class="text-right">@lang('word.field.actions')</th>
                            </thead>

                            <tbody>
                            @foreach ($words as $word)
                                <tr class="{{ $word->status == 'drafted' ? 'text-muted' : '' }} row-{{ $word->id }}">
                                    <td>
                                        <a href="{{ route('admin.word.index', ['category' => $word->category->id]) }}">
                                            {{ $word->category->name }}
                                        </a>
                                    </td>
                                    <td>
                                        <a href="#" class="alias" data-name="alias" data-value="{{ $word->alias }}" data-type="text" data-pk="{{ $word->id }}">
                                            {{ $word->alias }}
                                        </a>
                                    </td>
                                    <td>
                                        <span class="label label-default">
                                            {{ $word->lang }}
                                        </span>
                                        &nbsp;
                                        <a href="#" class="foreign" data-name="foreign" data-value="{{ $word->foreign }}" data-type="text" data-pk="{{ $word->id }}">
                                            {{ $word->foreign }}
                                        </a>
                                    </td>
                                    <td>
                                        <a href="#" class="locale" data-name="locale" data-value="{{ $word->locale }}" data-type="text" data-pk="{{ $word->id }}">
                                            {{ $word->locale }}
                                        </a>
                                    </td>
                                    <td>{{ $word->spell }}</td>
                                    <td class="text-center">
                                        @if ($word->status == 'published')
                                            <i class="fa fa-check-square-o"></i>
                                        @else
                                            <i class="fa fa-square-o"></i>
                                        @endif
                                    </td>
                                    <td class="updated-{{ $word->id }}">{{ $word->updated_at->format(config('backpack.base.default_datetime_format')) }}</td>
                                    <td class="text-right">
                                        <a href="{{ route('word.detail', [$word->category->slug, $word->slug]) }}" target="_blank" class="btn btn-default btn-xs">
                                            <i class="fa fa-eye fa-fw"></i>
                                        </a>

                                        <a href="{{ route('admin.word.edit', [$word->id]) }}" class="btn btn-primary btn-xs">
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
                    @else
                        <div class="alert alert-info">
                            Hasil pencarian tidak ditemukan atau belum ada kata yang disimpan.
                        </div>
                    @endif

                    {{ $words->appends([
                        'category' => request('category'),
                        'query' => request('query')
                    ])->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection

@push('after_css')
    <link href="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet"/>
@endpush

@push('after_script')
    <script src="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/js/bootstrap-editable.min.js"></script>

    <script>
        $(document).ready(function(){
            $.fn.editable.defaults.ajaxOptions = {type: "PUT"};

            $('.foreign, .locale, .alias').editable({
                // disabled: true,
                emptytext: '{{ trans('word.field.empty') }}',
                url: '{{ route('admin.word.updateable') }}',
                success: function(response, value){
                    if (response.isSuccess == true) {
                        $('td.updated-' + response.data.id).text(response.data.updated)
                    }
                    else {
                        alert(response.message);
                    }
                }
            });

            //make username required
            $('.foreign, .locale').editable('option', 'validate', function(v) {
                if(!v) return '@lang('word.required')';
            });
        })
    </script>
@endpush
