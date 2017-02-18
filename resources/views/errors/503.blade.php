@extends('layouts.app')

{{ debug($exception)}}

@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="text-center">
    <h1>Ups!</h1>
    <h2>{{ $exception->getMessage() }}</h2>
</div>
<!-- end text centered -->
<!-- big text error -->
<div class="big-error">{{ $exception->getStatusCode() }}</div>
<!-- end big text error -->
	</div>
</div>
@endsection

@push('js')
	<script>
		$(function(){
			$('#content').addClass('block-section');
		})
	</script>
@endpush
