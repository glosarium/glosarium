<li class="index"><a href="{{ route('index') }}"><strong> <i class="fa fa-home"></i> Beranda</strong></a></li>
<li class="dropdown glosarium">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" >Glosarium <span class="caret"></span></a>
    <ul class="dropdown-menu" role="menu">
        <li><a href="{{ route('glosarium.word.index') }}">Indeks Kata</a></li>
        <li><a href="{{ route('glosarium.category.index') }}">Semua Kategori</a></li>
        <li><a href="{{ route('glosarium.word.create') }}">Tambah Kata</a></li>
    </ul>
</li>
<li class="dictionary"><a href="{{ route('dictionary.national.index') }}">Kamus Bahasa Indonesia</a></li>
<li class="contact"><a href="{{ route('contact.form') }}">Kontak</a></li>
