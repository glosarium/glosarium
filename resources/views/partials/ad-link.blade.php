@if (File::exists($path = storage_path('ad/link.txt')))
	{!! File::get($path) !!}
@endif
