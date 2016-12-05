<h2>
    <a href="{{ route('word.detail', [$word->category->slug, $word->slug]) }}">{{ $word->locale }}</a>
    <br><small>{{ $word->spell }}</small>
    <small><i class="fa fa-volume-up disabled"></i></small>
</h2>
<h3>
    {{ $word->foreign }}
    <small>
        <span class="label label-default">
            {{ $word->lang }}
        </span>
    </small>
</h3>

<h5>@lang('word.category') <a href="{{ route('word.category.show', [$word->category->slug]) }}">{{ $word->category->name }}</a></h5>
@if (! empty($word->type))
<h3>{{ $word->type->name }} ({{ $word->type->description }})</h3>
@endif

@if (! empty($word->descriptions))
    <ul>
        @foreach ($word->descriptions as $description)
            <li>
            	@if (! empty($description->type))
            		(<strong>{{ $description->type->name }}</strong>)
            	@endif
            	{{ $description->description }}
            </li>
        @endforeach
    </ul>
@endif

<hr>

@include('partials.ad-link')

<span class="label label-info"> <i class="fa fa-fw fa-eye"></i> {{ number_format($word->views->count(), 0, ',', '.') }}</span>
<span class="label label-default"><i class="fa fa-fw fa-pencil"></i> 0</span>
