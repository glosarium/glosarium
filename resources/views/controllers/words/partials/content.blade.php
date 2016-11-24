<h2>
    <a href="{{ route('word.detail', [$word->category->slug, $word->slug]) }}">{{ $word->locale }}</a>
    <br><small>{{ $word->spell }}</small>
    <small><i class="fa fa-volume-up disabled"></i></small>
</h2>
<h3>{{ $word->foreign }}</h3>
<hr>

<p>@lang('word.category') <a href="{{ route('word.category.show', [$word->category->slug]) }}">{{ $word->category->name }}</a></p>
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

	<hr>
@endif

<span class="label label-info"> <i class="fa fa-eye"></i> @lang('word.viewed', ['total' => number_format($word->views->count(), 0, ',', '.')])</span>
<span class="label label-default"><i class="fa fa-pencil"></i> @lang('word.edited', ['total' => 0])</span>
