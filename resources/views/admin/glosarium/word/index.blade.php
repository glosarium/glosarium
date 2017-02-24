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
                            <input class="form-control" value="{{ request('keyword') }}" name="keyword" placeholder="Cari glosarium..." >
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

    @if ($words->total() >= 1)
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>@lang('glosarium.field.origin')</th>
                        <th>@lang('glosarium.field.locale')</th>
                        <th>@lang('glosarium.field.category')</th>
                        <th>#</th>
                        <th>@lang('glosarium.field.actions')</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($words as $word)
                        <tr>
                            <td>
                                <span class="label label-default">{{ $word->lang }}</span>
                                <a href="{{ $word->url }}">{{ $word->origin }}</a>
                            </td>
                            <td><span class="label label-default">id</span> {{ $word->locale }}</td>
                            <td>{{ $word->category->name }}</td>
                            <td><i class="fa fa-{{ $word->is_published ? 'square text-success' : 'square text-danger' }}"></i></td>
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

    {{ $words->links() }}
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
