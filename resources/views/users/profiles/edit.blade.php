@extends('layouts.app')

@section('header')
<form action="{{ route('user.profile.update') }}" method="post">
    {{ csrf_field() }}
    {{ method_field('put') }}
    <header class="page-header">
        <div class="container page-name">
            <h1 class="text-center">Ubah Profil</h1>
            <p class="lead text-center">Profil publik dapat dibaca oleh pengguna lain.</p>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-4">
                    <div class="form-group">
                        <img alt="{{ auth()->user()->name }}" class="img-responsive" src="{{ $user->avatar }}" width="400">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-8">
                    <div class="form-group">
                        <input type="text" name="name" class="form-control input-lg" placeholder="Name" value="{{ old('name', $user->name) }}">
                    </div>
                    <div class="form-group">
                        <input type="text" name="headline" class="form-control" placeholder="Mahasiswa, Pekerja, Polisi Bahasa, dan lainnya" value="{{ old('headline', $user->headline) }}">
                    </div>
                    <div class="form-group">
                        <textarea class="form-control" name="about" rows="3" placeholder="Rincian singkat tentang kamu">{{ old('about', $user->about) }}</textarea>
                    </div>

                    <hr class="hr-lg">
                    <h6>Informasi Lainnya</h6>
                    <div class="row">
                        <div class="form-group col-xs-12 col-sm-12">
                            <div class="input-group input-group-sm">
                                <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                <input type="text" value="{{ $user->email }}" class="form-control" placeholder="Email address" disabled>
                            </div>
                        </div>
                        <div class="form-group col-xs-12 col-sm-12">
                            <p class="form-control-static">Informasi di bawah dapat dikosongkan apabila tidak ingin ditampilkan ke publik.</p>
                        </div>
                        <div class="form-group col-xs-12 col-sm-6 {{ !$errors->has('website') ?: 'has-error' }}">
                            <div class="input-group input-group-sm">
                                <span class="input-group-addon"><i class="fa fa-globe"></i></span>
                                <input type="text" name="website" value="{{ old('website', $user->website) }}" class="form-control" placeholder="Alamat website" maxlength="100">
                            </div>
                        </div>
                        <div class="form-group col-xs-12 col-sm-6 {{ !$errors->has('twitter') ?: 'has-error' }}">
                            <div class="input-group input-group-sm">
                                <span class="input-group-addon"><i class="fa fa-twitter"></i></span>
                                <input type="text" name="twitter" value="{{ old('twitter', $user->twitter) }}" class="form-control" placeholder="Nama pengguna Twitter (cth: glosariumid)" maxlength="15">
                            </div>
                        </div>
                        <div class="form-group col-xs-12 col-sm-6 {{ !$errors->has('instagram') ?: 'has-error' }}">
                            <div class="input-group input-group-sm">
                                <span class="input-group-addon"><i class="fa fa-instagram"></i></span>
                                <input type="text" name="instagram" value="{{ old('instagram', $user->instagram) }}" class="form-control" placeholder="Nama pengguna Instagram (cth: glosariumid)" maxlength="20">
                            </div>
                        </div>
                        <div class="form-group col-xs-12 col-sm-6 {{ !$errors->has('facebook') ?: 'has-error' }}">
                            <div class="input-group input-group-sm">
                                <span class="input-group-addon"><i class="fa fa-facebook"></i></span>
                                <input type="text" name="facebook" value="{{ old('facebook', $user->facebook) }}" class="form-control" placeholder="Tautan profil Facebook" maxlength="100">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="button-group">
                <div class="action-buttons">
                    <div class="upload-button">
                        <button type="submit" class="btn btn-block btn-primary">Simpan Profil</button>
                    </div>
                </div>
            </div>
        </div>
    </header>
</form>
@endsection

@section('content')
<main>

    <section>
        <div class="container">

            @include('partials.message')

            <div class="row">
                <div class="panel panel-default">
                    <div class="panel-heading">Media Sosial Terhubung</div>

                    <div class="panel-body">
                            @foreach(config('auth.socials') as $social => $alias)
                                @if(array_key_exists($social, $providers))
                                    <span class="fa-stack fa-lg">
                                        <i class="fa fa-square-o fa-stack-2x"></i>
                                        <i class="fa fa-{{ $social }} fa-stack-1x"></i>
                                    </span>
                                    {{ $providers[$social]['name'] }}
                                    @if(! empty($providers[$social]['email']))
                                        ({{ $providers[$social]['email'] }})
                                    @endif
                                @else
                                    <span class="fa-stack fa-lg">
                                        <i class="fa fa-square-o fa-stack-2x"></i>
                                        <i class="fa fa-{{ $social }} fa-stack-1x"></i>
                                    </span>
                                    Belum terhubung
                                @endif
                                <br>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

</main>
@endsection