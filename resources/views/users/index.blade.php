@extends('layouts.app') @section('header')
<header class="page-header bg-img size-lg" style="background-image: url(assets/img/bg-banner2.jpg)">
    <div class="container no-shadow">
        <h1 class="text-center">Kontributor</h1>
        <p class="lead text-center">Daftar kontributor yang terdaftar di {{ config('app.name') }}.</p>
    </div>
</header>
@endsection @section('content')
<main>

    <section>
        <div class="container">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Nama lengkap</th>
                            <th>Nama pengguna</th>
                            <th>Alamat pos-el</th>
                            <th>Grup</th>
                            <th>Tanggal Daftar</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr>
                            <td><a href="{{ route('user.profile.show', $user->username) }}">{{ $user->name }}</a></td>
                            <td>{{ $user->username }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->type == 'contributor' ? 'Kontributor' : 'Admin' }}</td>
                            <td>{{ $user->created_at }}</td>
                            <td class="actions">
                                <a href=""><i class="fa fa-edit fa-fw"></i></a>
                                <a href=""><i class="fa fa-trash fa-fw"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{ $users->links() }}
        </div>
    </section>

</main>
@endsection