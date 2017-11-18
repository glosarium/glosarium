@extends('layouts.app')

@section('header')
<header class="page-header bg-img size-lg" style="background-image: url(assets/img/bg-banner2.jpg)">
    <div class="container no-shadow">
        <h1 class="text-center">Kata Dihapus ({{ number_format($words->total(), 0, ',', '.') }})</h1>
        <p class="lead text-center">Daftar kata yang telah dihapus. Di halaman ini, kamu dapat mengembalikan kata untuk ditampilkan di pencarian.</p>
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
                </div>
            </div>
            <hr>
            
            @if($words->total() <= 0)
                <div class="alert alert-info">
                    <strong>Info.</strong><br>
                    Tidak ada kata yang dihapus.
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
                                <a href="{{ route('glosarium.word.restore', $word->slug) }}" title="Kembalikan kata"><i class="fa fa-refresh fa-fw"></i></a>
                                <a href="{{ route('glosarium.word.delete', $word->slug) }}" title="Hapus selamanya"><i class="fa fa-trash fa-fw"></i></a>
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