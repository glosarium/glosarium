@extends('layouts.app')

@section('heading')
  @include('partials.title')
@stop

@section('content')
@include('users.partials.sidebar')
<div class="col-md-10 col-sm-10">
<!-- Block side right -->
<div class="block-section box-side-account">
   <div class="row">
      <div class="col-md-12">
         <div class="panel panel-default">
            <div class="panel-heading">
               {{ $title }}
               <a href="{{ route('admin.word.create') }}" class="pull-right btn btn-sm btn-default btn-theme">
               <i class="fa fa-plus"></i>
               </a>
            </div>
            <div class="panel-body">
               <!-- form search -->
               <form class="form-search-list" method="get" action="{{ url()->current() }}">
                  <div class="row">
                     <div class="col-md-10 col-xs-12 ">
                        <div class="form-group">
                           <input class="form-control" value="{{ request('keyword') }}" name="keyword" placeholder="Cari kata dalam glosarium..." >
                        </div>
                     </div>
                     <div class="col-md-2 col-xs-12 ">
                        <div class="form-group">
                           <button class="btn btn-block btn-theme  btn-default">
                           <i class="fa fa-search fa-fw"></i>
                           </button>
                        </div>
                     </div>
                  </div>
               </form>
               <!-- form search -->
               @if ($words->total() >= 1)
               <div class="table-responsive">
                  <table class="table table-bordered">
                     <thead>
                        <tr>
                           <th>@lang('glosarium.word.field.origin')</th>
                           <th>@lang('glosarium.word.field.locale')</th>
                           <th>@lang('glosarium.word.field.category')</th>
                           <th>#</th>
                           <th width="80">@lang('glosarium.word.field.actions')</th>
                        </tr>
                     </thead>
                     <tbody>
                        @foreach ($words as $word)
                        <tr>
                           <td>
                              <span class=" col-md-1 label label-default">{{ $word->lang }}</span>
                              <span class="col-md-11"><a href="{{ $word->url }}">{{ $word->origin }}</a></span>
                           </td>
                           <td>
                              <span class="col-md-1 label label-default">id</span>
                              <span class="col-md-11">{{ $word->locale }}</span>
                           </td>
                           <td>{{ $word->category->name }}</td>
                           <td><i class="fa fa-{{ $word->is_published ? 'square text-success' : 'square text-danger' }}"></i></td>
                           <td>
                              <a href="{{ $word->edit_url }}" class="btn btn-xs btn-info">
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
               <ul class="list-inline list-unstyled">
                  <li><i class="fa fa-square text-success"></i> @lang('glosarium.word.field.published')</li>
                  <li><i class="fa fa-square text-warning"></i> @lang('glosarium.word.field.pending')</li>
                  <li><i class="fa fa-square text-danger"></i> @lang('glosarium.word.field.unpublished')</li>
               </ul>
            </div>
         </div>
      </div>
   </div>
   <div class="row">
      <div class="col-md-12">
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
