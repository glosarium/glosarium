<li class="index"><a href="{{ route('index') }}"><strong> <i class="fa fa-home"></i> Beranda</strong></a></li>
@if (auth()->check())
<li class="create-glosarium"><a href="{{ route('glosarium.word.create') }}">Tambah Kata</a></li>
@endif
<li class="glosarium"><a href="{{ route('glosarium.word.index') }}">Glosari</a></li>
<li class="category"><a href="{{ route('glosarium.category.index') }}">Kategori</a></li>
<li class="contact"><a href="{{ route('contact.form') }}">Kontak</a></li>
