@extends('layouts.app')

@section('header')
<header class="page-header bg-img" style="background-image: url({{ asset('assets/img/bg-banner1.jpg') }});">
    <div class="container page-name">
        <h1 class="text-center">Kotak Masuk ({{ number_format($messages->total(), 0, ',', '.') }})</h1>
        <p class="lead text-center">Pesan yang dikirim oleh pengguna melalui halaman kontak.</p>
    </div>
    <div class="container">
        <form action="{{ url()->current() }}" method="get">

            <div class="row">
                <div class="form-group col-xs-12 col-sm-12">
                    <input type="text" name="katakunci" class="form-control" value="{{ request('katakunci') }}" placeholder="Pengirim, subjek, atau pesan...">
                </div>
            </div>
            <div class="button-group">
                <div class="action-buttons">
                    <a href="{{ url()->current() }}" class="btn btn-white">Setel Ulang</a>
                    <button class="btn btn-primary" type="submit">Saring</button>
                </div>
            </div>
        </form>
    </div>
</header>
@endsection

@section('content')
<main>

    <section>
        <div class="container">


            <div class="row">
                @include('partials.message')

                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Pengirim</th>
                                    <th>Subjek</th>
                                    <th>Kontributor</th>
                                    <th>Dikirim</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($messages as $message)
                                <tr>
                                    <td>{{ $message->from }}</td>
                                    <td>{{ $message->subject }}</td>
                                    <td>{{ $message->user ? $message->user->name : 'Tidak Terdaftar' }}</td>
                                    <td>{{ $message->created_at->format('d/m/Y H:i') }}</td>
                                    <td class="actions">
                                        <a href="{{ route('contact.reply', $message->id) }}" title="Balas pesan"><i class="fa fa-reply fa-fw"></i></a>
                                        <a href="{{ route('contact.destroy', $message->id) }}" title="Hapus pesan"><i class="fa fa-trash fa-fw"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{ $messages->links() }}
                </div>
            </div>

        </div>
    </section>

</main>
@endsection