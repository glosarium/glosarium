@if (File::exists($path = storage_path('tool/fb-app.txt')))
	{!! File::get($path) !!}
@endif
