@if (File::exists($path = storage_path('ad/billboard.txt')))
	{!! File::get($path) !!}
@endif
