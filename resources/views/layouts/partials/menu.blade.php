<router-link :to="{ name: 'index' }" tag="li" active-class="active">
	<a href="#">
		<i class="fa fa-home"></i>
		Beranda
	</a>
</router-link>

<router-link :to="{ name: 'glosarium.category.index' }" tag="li" active-class="active">
	<a href="#">
		Kategori
	</a>
</router-link>

<router-link :to="{ name: 'contact' }" tag="li" active-class="active">
	<a href="#">
		Kontak
	</a>
</router-link>

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
