@extends('layouts.app')

@section('heading')
    @include('partials.glosariums.title', [
        'title' => $title
    ])
@endsection

@section('content')


<h2 class="text-center">Bantu kami berkembang!<br/>
    <small>Sampaikan salam, kritik dan saran untuk kemajuan</small>
</h2>
<div class="white-space-20"></div>
<div class="row">
    <div class="col-md-8 col-md-offset-2">

        @include('partials.message')

        <!-- form contact -->
        <form action="{{ route('contact.post') }}" method="post">
            {{ csrf_field() }}

            <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                <label>Surel</label>
                <input name="email" type="email" class="form-control" value="{{ old('email') }}">
            </div>
            <div class="form-group {{ $errors->has('subject') ? 'has-error' : '' }}">
                <label>Subjek</label>
                <input name="subject" type="text" class="form-control" value="{{ old('subject') }}">
            </div>
            <div class="form-group {{ $errors->has('message') ? 'has-error' : '' }}">
                <label>Pesan</label>
                <textarea name="message" class="form-control" rows="6" value="{{ old('message') }}"></textarea>
            </div>
            <div class="form-group text-center">
                <div class="white-space-10"></div>
                <button type="submit" class="btn btn-theme btn-lg btn-long btn-t-primary btn-pill">Kirim Pesan</button>
            </div>
        </form>
        <!-- end form contact -->
    </div>
</div>
@endsection

@push('js')
    <script>
        $(function(){
            $('li.contact').addClass('active');
        })
    </script>
@endpush
