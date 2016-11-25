@if (File::exists($path = storage_path('ad/responsive.txt')))
	{!! File::get($path) !!}
@endif
