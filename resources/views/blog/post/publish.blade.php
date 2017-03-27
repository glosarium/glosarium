@extends('layouts.app')

@section('heading')
  @include('partials.title')
@stop

@section('content')
<div class="white-space-20"></div>
<div class="row">
    <div class="col-md-10 col-md-offset-1">

    <input type="text" name="title" class="form-control">
    <hr>
    <div style="min-height: 600px" class="editor"></div>
</div>
@endsection

@push('css')
  <link rel="stylesheet" href="//cdn.jsdelivr.net/medium-editor/latest/css/medium-editor.min.css" type="text/css" media="screen" charset="utf-8">
@endpush

@push('js')
  <script src="//cdn.jsdelivr.net/medium-editor/latest/js/medium-editor.min.js"></script>
  <script>
    var editor = new MediumEditor('.editor');
  </script>
@endpush
