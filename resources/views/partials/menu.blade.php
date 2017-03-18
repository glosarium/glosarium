<li class="glosarium"><a href="{{ route('glosarium.word.index') }}"><strong> <i class="fa fa-home"></i> @lang('glosarium.word.glossary')</strong></a></li>
@if (auth()->check())
<li class="create-glosarium"><a href="{{ route('glosarium.word.create') }}">Tambah Kata</a></li>
@endif
<li class="category"><a href="{{ route('glosarium.category.index') }}">@lang('glosarium.category.index')</a></li>
<li class="contact"><a href="{{ route('contact.form') }}">@lang('contact.title')</a></li>

@if (Auth::check())
	<li class="logout visible-sm visible-xs">
		<a href="{{ url('logout') }}" class="logout">Keluar</a>
	</li>
@else
	<li class="login visible-sm visible-xs">
		<a href="{{ route('login') }}">Masuk</a>
	</li>
	<li class="register visible-sm visible-xs">
		<a href="{{ url('register') }}">Daftar Kontributor</a>
	</li>
@endif
