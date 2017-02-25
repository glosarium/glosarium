<li class="glosarium"><a href="{{ route('glosarium.word.index') }}"><strong> <i class="fa fa-home"></i> @lang('glosarium.title')</strong></a></li>
@if (auth()->check())
<li class="create-glosarium"><a href="{{ route('glosarium.word.create') }}">Tambah Kata</a></li>
@endif
<li class="category"><a href="{{ route('glosarium.category.index') }}">@lang('category.title')</a></li>
<li class="contact"><a href="{{ route('contact.form') }}">@lang('contact.title')</a></li>
