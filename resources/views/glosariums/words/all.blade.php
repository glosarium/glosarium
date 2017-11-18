@extends('layouts.app')

@section('header')
<header class="page-header bg-img" style="background-image: url({{ asset('assets/img/bg-banner1.jpg') }});">
    <div class="container page-name">
        <h1 class="text-center">Kata ({{ number_format($words->total(), 0, ',', '.') }})</h1>
        <p class="lead text-center">Daftar kata yang tersimpan dalam pangkalan data glosarium.</p>
    </div>
    <div class="container">
        <form action="{{ url()->current() }}" method="get">

            <div class="row">
                <div class="form-group col-xs-12 col-sm-8">
                    <input type="text" name="katakunci" class="form-control" value="{{ request('katakunci') }}" placeholder="Katakunci dalam bahasa asing atau dalam bahasa lokal">
                </div>
                <div class="form-group col-xs-12 col-sm-4">
                    <select name="kategori[]" class="form-control selectpickers" multiple>
                        @foreach($categories as $slug => $name)
                            <option value="{{ $slug }}">{{ $name }}</option>
                        @endforeach
                    </select>
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

            @include('partials.message')
            
            <div class="row">
                <div class="col-xs-12 text-right">
                    <br>
                    <a class="btn btn-primary btn-sm" href="{{ route('glosarium.word.moderation') }}">Moderasi Kata</a>
                    <a class="btn btn-white btn-sm" href="{{ route('glosarium.word.trash') }}">Tong Sampah</a>
                </div>
            </div>
            <hr

            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Kata asal</th>
                            <th>Kata lokal</th>
                            <th>Kategori</th>
                            <th>Kontributor</th>
                            <th>Status</th>
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
                            <td>{{ $word->is_published ? 'Dipublikasikan' : 'Moderasi'}}
                            <td>{{ $word->created_at->format('d M Y H:i') }}</td>
                            <td class="actions">
                                <a href="{{ route('glosarium.word.edit', $word->slug) }}" title="Sunting kata"><i class="fa fa-edit fa-fw"></i></a>
                                <a href="{{ route('glosarium.word.destroy', $word->slug) }}" title="Buang ke tong sampah"><i class="fa fa-trash fa-fw"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $words->links() }}
            </div>
        </div>
    </section>

</main>
@endsection

@push('js')
<script>
    $(function(){
        $('.selectpickers').selectpicker({
            noneSelectedText: 'Tidak ada kategori dipilih'
        })
    })
</script>
@endpush