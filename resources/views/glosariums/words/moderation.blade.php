@extends('layouts.app')

@section('header')
<header class="page-header bg-img size-lg" style="background-image: url(assets/img/bg-banner2.jpg)">
    <div class="container no-shadow">
        <h1 class="text-center">Moderasi Kata ({{ number_format($words->total(), 0, ',', '.') }})</h1>
        <p class="lead text-center">Daftar kata yang dikirim oleh kontributor dan dibutuhkan moderasi untuk tampil di pencarian.</p>
    </div>
</header>
@endsection

@section('content')
<main>

    <section>
        <div class="container">

            <div class="row">

                @include('partials.message')

                <div class="col-xs-12 text-right">
                    <br>
                    <a class="btn btn-primary btn-sm" href="{{ route('glosarium.word.all') }}">Semua Kata</a>
                    <a class="btn btn-white btn-sm" href="{{ route('glosarium.word.trash') }}">Tong Sampah</a>
                </div>
            </div>
            <hr>
            
            @if($words->total() <= 0)
                <div class="alert alert-info">
                    <strong>Info</strong><br>
                    Belum ada kata yang membutuhkan moderasi.
                </div>
            @endif

            @if ($words->total() >= 1)
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Kata asal</th>
                            <th>Kata lokal</th>
                            <th>Kategori</th>
                            <th>Kontributor</th>
                            <th>Dibuat</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($words as $word)
                        <tr>
                            <td><a href="{{ route('glosarium.word.show', [$word->category->slug, $word->slug]) }}">{{ $word->origin }}</a></td>
                            <td>{{ $word->locale }}</td>
                            <td><a href="{{ route('glosarium.category.show', $word->category->slug) }}">{{ $word->category->name }}</a></td>
                            <td><a href="{{ route('user.profile.show', $word->user->username) }}">{{ $word->user->name }}</a></td>
                            <td>{{ $word->created_at->format('d/m/Y H:i') }}</td>
                            <td class="actions">
                                <a href="{{ route('glosarium.word.publish', $word->slug) }}" title="Setujui kata {{ $word->origin }} ({{ $word->locale }})"><i class="fa fa-check fa-fw"></i></a>
                                <a href="{{ route('glosarium.word.edit', $word->slug) }}"><i class="fa fa-edit fa-fw"></i></a>
                                <a href="{{ route('glosarium.word.destroy', $word->slug) }}"><i class="fa fa-trash fa-fw"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @endif

            {{ $words->links() }}
        </div>
    </section>

</main>
@endsection