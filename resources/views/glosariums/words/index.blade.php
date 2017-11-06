@extends('layouts.app')

@section('header')
<header class="page-header bg-img" style="background-image: url({{ asset('assets/img/bg-banner1.jpg') }});">
    <div class="container page-name">
        <h1 class="text-center">Jelajahi Kata</h1>
        <p class="lead text-center">Jelajahi kata demi kata di Glosarium Indonesia.</p>
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
                    <button class="btn btn-primary" type="submit">Saring</button>
                </div>
            </div>
        </form>
    </div>
</header>
@endsection

@section('content')
<section class="no-padding-top bg-alt">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <br>
                <h5>Menampilkan {{ number_format($words->total(), 0, ',', '.') }} total kata</h5>
            </div>
            @foreach ($words as $word)
            <div class="col-xs-12">
                <a class="item-block" href="{{ route('glosarium.word.show', [
                    'category' => $word->category->slug,
                    'slug' => $word->slug
                ]) }}">
                    <header>
                        <div class="hgroup">
                            <h4>{{ $word->origin }} <span class="label label-info">{{ $word->lang }}</span></h4>
                            <h5>{{ $word->locale }}</h5>
                        </div>
                        <time datetime="2016-03-10 20:00">34 min ago</time>
                    </header>

                    @if (! empty($word->description))
                    <div class="item-body">
                       <p>{{ $word->description['description'] }}
                    </div>
                    @endif

                    <footer>
                        <ul class="details cols-3">
                            <li>
                                <i class="{{ $word->category->metadata['icon'] }} fa-fw"></i>
                                <span>{{ $word->category->name }}</span>
                            </li>
                            
                            <li>
                                <i class="fa fa-user fa-fw"></i>
                                <span>{{ ! empty($word->user) ? $word->user->name : 'Anonim' }}</span>
                            </li>
                            
                            @if($word->short_url)
                            <li>
                                <i class="fa fa-link fa-fw"></i>
                                <span>{{ $word->short_url }}</span>
                            </li>
                            @endif
                        </ul>
                    </footer>
                </a>
            </div>
            @endforeach
        </div>
        <!-- Page navigation -->
        <nav>
            {{ $words->links() }}
        </nav>
        <!-- END Page navigation -->
    </div>
</section>
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