@extends('layouts.app')

@section('content')

@include('users.partials.sidebar')

<div class="col-md-10 col-sm-10">
<!-- Block side right -->
<div class="block-section box-side-account">
    <h3 class="no-margin-top">{{ $title }}</h3>
    <hr>

    <div class="row">
        <div class="col-md-12">
            <!-- form search -->
            <form class="form-search-list" method="get" action="{{ url()->current() }}">
                <div class="row">
                    <div class="col-sm-10 col-xs-12 ">
                        <div class="form-group">
                            <input class="form-control" value="{{ request('keyword') }}" name="keyword" placeholder="Cari kategori glosarium..." >
                        </div>
                    </div>
                    <div class="col-sm-2 col-xs-12 ">
                        <div class="form-group">
                            <button class="btn btn-block btn-theme  btn-success">@lang('glosarium.btn.search')</button>
                        </div>
                    </div>
                </div>
            </form>
            <!-- form search -->
        </div>
    </div>

    @if ($categories->total() >= 1)
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>@lang('category.field.name')</th>
                        <th>@lang('category.field.description')</th>
                        <th>@lang('category.field.totalWord')</th>
                        <th>@lang('category.field.actions')</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $category)
                        <tr>
                            <td>
                                @if (isset($category->metadata['icon']))
                                    <i class="{{ $category->metadata['icon'] }}"></i>
                                @endif
                                {{ $category->name }}
                            </td>
                            <td>{{ str_limit($category->description, 60) }}</td>
                            <td class="text-right">{{ number_format($category->words_count, 0, ',', '.') }}</td>
                            <td>
                                <a href="" class="btn btn-xs btn-info">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <a href="" class="btn btn-xs btn-danger">
                                    <i class="fa fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-info">@lang('glosarium.notFound')</div>
            </div>
        </div>
    @endif

    <div class="row">
        <div class="col-md-12">
            <ul class="list-unstyled">
                <li><i class="fa fa-square text-success"></i> Dipublikasikan</li>
                <li><i class="fa fa-square text-warning"></i> Menunggu Persetujuan</li>
                <li><i class="fa fa-square text-danger"></i> Belum Dipublikasikan</li>
            </ul>
        </div>
    </div>

    {{ $categories->links() }}
</div>
<!-- end Block side right -->
@endsection

@push('js')
    <script>
        $(() => {
            $('ul.pagination').addClass('pagination-theme no-margin');
        })
    </script>
@endpush
