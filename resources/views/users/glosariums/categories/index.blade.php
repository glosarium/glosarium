@extends('layouts.app')

@section('header')
<header class="page-header bg-img size-lg" style="background-image: url(assets/img/bg-banner2.jpg)">
    <div class="container no-shadow">
        <h1 class="text-center">Glosarium Kategori ({{ $categories->total() }})</h1>
        <p class="lead text-center">Daftar kategori yang tersimpan dalam pangkalan data glosarium..</p>
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
                            <th>Nama kategori</th>
                            <th>Jumlah kata</th>
                            <th>Dibuat</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($categories as $category)
                        <tr>
                            <td><a href="{{ route('glosarium.category.index') }}">{{ $category->name }}</a></td>
                            <td class="text-right">{{ number_format($category->words_count, 0, ',', '.') }} kata</td>
                            <td>{{ $category->created_at->format('d/m/Y H:i') }}</td>
                            <td class="actions">
                                <a href=""><i class="fa fa-edit fa-fw"></i></a>
                                <a href=""><i class="fa fa-trash fa-fw"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{ $categories->links() }}
        </div>
    </section>

</main>
@endsection