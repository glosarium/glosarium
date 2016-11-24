@if (File::exists($path = storage_path('tool/ga-analytic.txt')))
	{!! File::get($path) !!}
@endif
