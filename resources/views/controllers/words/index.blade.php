@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">{{ $title or null }}</div>
                <div class="panel-body">
                    <div class="text-center">
                        <form action="{{ route('index') }}" method="GET" role="form" id="form-word">
                            <div class="input-group">
                                <input type="text" name="kata" value="{{ request('kata') }}" class="form-control" placeholder="@lang('word.search')">
                                <span class="input-group-btn">
                                <button class="btn btn-primary" type="submit">@lang('word.btn.search')</button>
                                </span>
                            </div>

                        </form>
                    </div>

                    @if (isset($words) AND $words->total() >= 1)
                        <hr>
                        <ul class="list-group">
                            @foreach ($words as $word)
                                <li class="list-group-item">
                                    <h2>
                                        <a href="{{ route('word.detail', [$word->slug]) }}">({{ $word->origin }}) {{ $word->glosarium }}</a>
                                        <small>{{ $word->spell }}</small>
                                        <small><i class="fa fa-volume-up"></i></small>
                                    </h2>
                                    <h3>{{ $word->type->name }} ({{ $word->type->description }})</h3>

                                    @if (! empty($word->descriptions))
                                        <ul>
                                            @foreach ($word->descriptions as $description)
                                                <li>{{ $description->description }}</li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </li>
                            @endforeach
                        </ul>

                        {{ $words->appends(['kata' => request('kata')])->links() }}
                    @elseif (!empty(request('kata')))
                        <hr>
                        <div class="alert alert-info">Tidak ada hasil pencarian untuk "{{ request('kata') }}".</div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
