@extends('layouts.app')

@section('heading')
  @include('partials.title')
@stop

@section('content')
@include('user.partial.sidebar')
<div class="col-md-10 col-sm-10">
  <div class="block-section">
    <div class="panel panel-default">
      <div class="panel-heading">Notifikasi</div>
      <div class="panel-body">
        <user-notification></user-notification>
      </div>
    </div>
  </div>
</div>
@endsection

@push('js')
  <script>
    new Vue({
      el: '#app'
    })
  </script>
@endpush
