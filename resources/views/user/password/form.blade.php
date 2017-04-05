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
         <div class="panel panel-default">
            <div class="panel-heading">{{ $title }}</div>
            <div class="panel-body">
               <user-password action="{{ route('user.password.update') }}"></user-password>
            </div>
         </div>
      </div>
   </div>
</div>
<!-- end Block side right -->
@endsection

@push('js')
   <script src="{{ asset('js/bus.js') }}"></script>
@endpush
