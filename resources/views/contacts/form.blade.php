@extends('layouts.app')

@section('header')
<header class="page-header bg-img size-lg" style="background-image: url(assets/img/bg-banner2.jpg)">
    <div class="container no-shadow">
        <h1 class="text-center">Kontak Kami</h1>
        <p class="lead text-center">Sampaikan salam, kritik dan saran untuk kemajuan {{ config('app.name') }}.</p>
    </div>
</header>
@endsection

@section('content')
<section>
    <div class="container">
        <div class="row">
            @include('partials.message')
            <form method="post" action="{{ route('contact.post') }}">
                {{ csrf_field() }}
                {{ method_field('post') }}
                <div class="col-sm-12 col-md-8">

                    <h4>Formulir Kontak</h4>

                    <div class="form-group {{ !$errors->has('subject') ?: 'has-error' }}">
                        <label>Subjek</label>
                        <input type="text" name="subject" class="form-control input-lg" autofocus="true" value="{{ old('subject') }}">
                        <span class="help-block">{{ $errors->first('subject') }}</span>
                    </div>

                    <div class="form-group {{ !$errors->has('email') ?: 'has-error' }}">
                        @if (auth()->check())
                        <p class="form-control-static">Dikirim sebagai: <strong>{{ auth()->user()->name }}</strong> ({{ auth()->user()->email }})</p>
                        @else
                        <label>Alamat pos-el</label>
                        <input type="email" name="email" class="form-control input-lg" value="{{ old('email') }}">                        
                        <span class="help-block">{{ $errors->first('email') }}</span>
                        @endif
                    </div>

                    <div class="form-group {{ !$errors->has('message') ?: 'has-error' }}">
                        <label>Pesan</label>
                        <textarea class="form-control" name="message" rows="5" placeholder="Pesan &amp; kesan, serta kritik yang ingin disampaikan">{{ old('message') }}</textarea>
                        <span class="help-block">{{ $errors->first('message') }}</span>
                    </div>

                    <button type="submit" class="btn btn-primary">Kirim</button>
                </div>
            </form>

            <div class="col-sm-12 col-md-4">
                <h4>Temukan Kami di Media Sosial</h4>

                <ul class="social-icons size-sm text-center">
                    <li><a class="facebook" href="#"><i class="fa fa-facebook"></i></a></li>
                    <li><a class="twitter" href="#"><i class="fa fa-twitter"></i></a></li>
                    <li><a class="dribbble" href="#"><i class="fa fa-dribbble"></i></a></li>
                    <li><a class="linkedin" href="#"><i class="fa fa-linkedin"></i></a></li>
                    <li><a class="instagram" href="#"><i class="fa fa-instagram"></i></a></li>
                </ul>

            </div>
        </div>

    </div>
</section>
@endsection