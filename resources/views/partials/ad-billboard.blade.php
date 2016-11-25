@if (BrowserDetect::isMobile())
	@if (File::exists($path = storage_path('ad/responsive.txt')))
		{!! File::get($path) !!}
	@endif
@else
	@if (File::exists($path = storage_path('ad/billboard.txt')))
		{!! File::get($path) !!}
	@endif
@endif
