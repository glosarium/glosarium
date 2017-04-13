@extends('layouts.app')

@section('heading')
  @include('partials.title')
@stop

@section('content')

@include('user.partial.sidebar')

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

        <admin-search
          action="user/index"
          placeholder="Cari kontributor..."
        ></admin-search>

        <user-index :limit="20"></user-index>

      </div>
      <div class="panel-footer">
         <ul class="list-inline">
            <li><i class="fa fa-square text-success"></i> Aktif</li>
            <li><i class="fa fa-square text-danger"></i> Tidak Aktif</li>
         </ul>
      </div>
   </div>
   <pagination></pagination>
</div>
<!-- end Block side right -->
@endsection

@push('js')
<script>
  $(function(){
    $('ul.pagination').addClass('pagination-theme no-margin');
       $('a.delete').click(function(){
         $('#delete-form').attr('action', $(this).attr('href')).submit();
         return false;
       });
  });
</script>

<script src="{{ asset('js/bus.js') }}"></script>
@endpush
