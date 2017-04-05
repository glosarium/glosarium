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
      <transition>
        <keep-alive>
          <router-view></router-view>
        </keep-alive>
      </transition>
   </div>
</div>
<!-- end Block side right -->
@endsection

@push('js')
   <script src="{{ asset('js/router/user.js') }}"></script>
@endpush
