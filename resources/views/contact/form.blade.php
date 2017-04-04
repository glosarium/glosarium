@extends('layouts.app')

@push('metadata')
    <meta name="title" content="{{ trans('contact.sendMessage') }}">
    <meta name="author" content="{{ config('app.name') }}">
    <meta name="description" content="{{ trans('contact.description') }}">

    <meta property="og:title" content="{{ trans('contact.sendMessage') }}">
    <meta property="og:site_name" content="{{ config('app.name') }}">
    <meta property="og:description" content="{{ trans('contact.description') }}">
    <meta property="og:url" content="{{ route('contact.form') }}">
    <meta property="og:image" content="{{ $imagePath }}">
@endpush

@section('heading')
    @include('partials.title')
@endsection

@section('content')
<vue-progress-bar></vue-progress-bar>

<h2 class="text-center">{{ trans('contact.heading') }}<br/>
    <small>{{ trans('contact.subheading') }}</small>
</h2>
<div class="white-space-20"></div>
<div class="row">
    <div class="col-md-8 col-md-offset-2" v-cloak>

        <!-- form contact -->
        <contact-form action="{{ route('contact.post') }}"></contact-form>
        <!-- end form contact -->
    </div>
</div>
@endsection

@push('js')
    <script src="{{ asset('js/bus.js') }}"></script>
@endpush
