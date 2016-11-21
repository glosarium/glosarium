@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">{{ $title or null }}</div>

                <div class="panel-body">
                    <h2>
                        ({{ $word->origin }}) {{ $word->glosarium }}
                        <small>{{ $word->spell }}</small>
                    </h2>
                    <h3>{{ $word->type->name }} ({{ $word->type->description }})</h3>

                    @if (! empty($word->description))
                        <ul>
                            @foreach ($word->descriptions as $description)
                                <li>{{ $description->description }}</li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
