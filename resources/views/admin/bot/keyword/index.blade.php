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
            <a href="{{ route('admin.keyword.create') }}" class="btn btn-default btn-sm">
               <i class="fa fa-plus fa-fw"></i>
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
                     <input class="form-control" value="{{ request('keyword') }}" name="keyword" placeholder="@lang('bot.keyword.placeholder.keyword')" >
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
         @if ($keywords->total() >= 1)
         <div class="table-responsive">
            <table class="table table-bordered">
               <thead>
                  <tr>
                     <th>@lang('bot.keyword.field.keyword')</th>
                     <th>@lang('bot.keyword.field.message')</th>
                     <th>@lang('bot.keyword.field.description')</th>
                     <th>@lang('bot.keyword.field.created')</th>
                     <th width="80">@lang('bot.keyword.field.actions')</th>
                  </tr>
               </thead>
               <tbody>
                  @foreach ($keywords as $keyword)
                  <tr>
                     <td>{{ $keyword->keyword }}</td>
                     <td>{{ $keyword->message }}</td>
                     <td>{{ $keyword->description }}</td>
                     <td>{{ $keyword->created_diff }}</td>
                     <td>
                        <a href="{{ route('admin.keyword.edit', [$keyword->id]) }}" class="btn btn-xs btn-info">
                            <i class="fa fa-edit fa-fw"></i>
                        </a>
                        <a href="{{ route('admin.keyword.destroy', [$keyword->id]) }}" class="delete btn btn-xs btn-danger">
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
               <div class="alert alert-info">@lang('bot.keyword.notFound')</div>
            </div>
         </div>
         @endif
      </div>
   </div>
   {{ $keywords->links() }}
</div>
<!-- end Block side right -->
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
