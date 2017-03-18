@extends('layouts.app')

@section('heading')
  @include('partials.title')
@stop

@section('content')

@include('users.partials.sidebar')

<div class="col-md-10 col-sm-10">
<!-- Block side right -->
<div class="block-section box-side-account">
   <div class="panel panel-default">
      <div class="panel-heading">
         {{ $title }}
         <span class="pull-right">
            <a href="{{ route('admin.user.history') }}" class="btn btn-default btn-sm">
               <i class="fa fa-fw fa-history"></i>
            </a>
         </span>
      </div>
      <div class="panel-body">

         @include('partials.message')

         <!-- form search -->
         <form class="form-search-list" method="get" action="{{ url()->current() }}">
            <div class="row">
               <div class="col-sm-10 col-xs-12 ">
                  <div class="form-group">
                     <input class="form-control" value="{{ request('keyword') }}" name="keyword" placeholder="Cari kontributor..." >
                  </div>
               </div>
               <div class="col-sm-2 col-xs-12 ">
                  <div class="form-group">
                     <button class="btn btn-block btn-theme  btn-default">
                     <i class="fa fa-search fa-fw"></i>
                     </button>
                  </div>
               </div>
            </div>
         </form>
         <!-- form search -->
         @if ($users->total() >= 1)
         <div class="table-responsive">
            <table class="table table-bordered">
               <thead>
                  <tr>
                     <th>@lang('user.field.name')</th>
                     <th>@lang('user.field.email')</th>
                     <th>@lang('user.field.type')</th>
                     <th class="text-center">#</th>
                     <th>@lang('user.field.actions')</th>
                  </tr>
               </thead>
               <tbody>
                  @foreach ($users as $user)
                  <tr>
                     <td>
                        <a href="#">{{ $user->name }}</a>
                     </td>
                     <td>{{ $user->email }}</td>
                     <td>{{ ucfirst($user->type) }}</td>
                     <td class="text-center"><i class="fa fa-{{ $user->is_active ? 'square text-success' : 'square text-danger' }}"></i></td>
                     <td>
                        <a href="{{ route('admin.user.edit', [$user->id]) }}" class="btn btn-xs btn-info">
                            <i class="fa fa-edit fa-fw"></i>
                        </a>
                        <a href="{{ route('admin.user.destroy', [$user->id]) }}" class="delete btn btn-xs btn-danger">
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
         <ul class="list-inline">
            <li><i class="fa fa-square text-success"></i> Aktif</li>
            <li><i class="fa fa-square text-danger"></i> Tidak Aktif</li>
         </ul>
      </div>
   </div>
   {{ $users->links() }}
</div>
<!-- end Block side right -->

<form id="delete-form" method="post">
    {{ csrf_field() }}
    {{ method_field('delete') }}
</form>
@endsection

@push('js')
<script>
   $(() => {
       $('ul.pagination').addClass('pagination-theme no-margin');
       $('a.delete').click(function(){
         $('#delete-form').attr('action', $(this).attr('href')).submit();
         return false;
       });
   });
</script>
@endpush
