@extends('layouts.app')

@section('heading')
  @include('partials.title')
@stop

@section('content')

@include('user.partial.sidebar')
<div class="col-md-10 col-sm-10">
<!-- Block side right -->
<div class="block-section box-side-account">
   <div class="row">
      <div class="col-md-12">
         <div class="panel panel-default">
            <div class="panel-heading">{{ $title }}</div>
            <div class="panel-body">
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
                           <button class="btn btn-block btn-theme btn-default">
                           <i class="fa fa-search fa-fw"></i>
                           </button>
                        </div>
                     </div>
                  </div>
               </form>
               <!-- form search -->
               @if ($categories->total() >= 1)
               <div class="table-responsive">
                  <table class="table table-bordered">
                     <thead>
                        <tr>
                           <th>@lang('glosarium.category.field.name')</th>
                           <th>@lang('glosarium.category.field.description')</th>
                           <th>@lang('glosarium.category.field.totalWord')</th>
                           <th>@lang('glosarium.category.field.published')</th>
                           <th>@lang('glosarium.category.field.actions')</th>
                        </tr>
                     </thead>
                     <tbody>
                        @foreach ($categories as $category)
                        <tr>
                           <td>
                              @if (isset($category->metadata['icon']))
                              <i class="{{ $category->metadata['icon'] }} fa-fw"></i>
                              @endif
                              {{ $category->name }}
                           </td>
                           <td>
                              <a href="#">
                              <i class="fa fa-info-circle fa-fw"></i>
                              </a>
                              {{ str_limit($category->description, 40) }}
                           </td>
                           <td class="text-right">{{ number_format($category->words_count, 0, ',', '.') }}</td>
                           <td class="text-center">
                              <span class="fa fa-square {{ $category->is_published ? 'text-success' : 'text-danger' }}"></span>
                           </td>
                           <td>
                              <a href="{{ $category->edit_url }}" class="btn btn-xs btn-info">
                              <i class="fa fa-edit fa-fw"></i>
                              </a>
                              <a href="" class="btn btn-xs btn-danger">
                              <i class="fa fa-trash fa-fw"></i>
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
            </div>
            <div class="panel-footer">
               <ul class="list-unstyled list-inline">
                  <li><i class="fa fa-square text-success"></i> Dipublikasikan</li>
                  <li><i class="fa fa-square text-warning"></i> Menunggu Persetujuan</li>
                  <li><i class="fa fa-square text-danger"></i> Belum Dipublikasikan</li>
               </ul>
            </div>
         </div>
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
