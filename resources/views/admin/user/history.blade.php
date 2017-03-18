@extends('layouts.app')

@section('content')

@include('users.partials.sidebar')

<div class="col-md-10 col-sm-10">
<!-- Block side right -->
<div class="block-section box-side-account">
   <div class="panel panel-default">
      <div class="panel-heading">
         {{ $title }}
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
                     <th>@lang('user.field.actions')</th>
                     <th>@lang('user.field.deleted')</th>
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
                     <td>{{ $user->deleted_at->format('d, M Y H:i') }}</td>
                     <td>
                        <a href="{{ route('admin.user.restore', [$user->id]) }}" class="btn btn-xs btn-info">
                            <i class="fa fa-undo fa-fw"></i>
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
   </div>
   {{ $users->links() }}
</div>
<!-- end Block side right -->
@endsection

@push('js')
<script>
   $(() => {
       $('ul.pagination').addClass('pagination-theme no-margin');
   });
</script>
@endpush
