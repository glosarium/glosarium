@extends('layouts.app')

@section('header')
<header class="page-header bg-img size-lg" style="background-image: url(assets/img/bg-banner2.jpg)">
    <div class="container no-shadow">
        <h1 class="text-center">Glosarium Kata ({{ number_format($words->total(), 0, ',', '.') }})</h1>
        <p class="lead text-center">Daftar kata yang tersimpan dalam pangkalan data glosarium.</p>
    </div>
</header>
@endsection

@section('content')
<main>

    <section>
        <div class="container">
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
                                <a href=""><i class="fa fa-edit fa-fw"></i></a>
                                <a href=""><i class="fa fa-trash fa-fw"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{ $words->links() }}
        </div>
    </section>

</main>
@endsection