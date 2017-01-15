<li class="index"><a href="{{ route('index') }}"><strong> <i class="fa fa-home"></i> Beranda</strong></a></li>
<li class="dropdown glosarium">
  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" >Glosarium <span class="caret"></span></a>
  <ul class="dropdown-menu" role="menu">
    <li><a href="{{ route('glosarium.word.index') }}">Indeks Kata</a></li>
    <li><a href="{{ route('glosarium.category.index') }}">Semua Kategori</a></li>
  </ul>
</li>
<li class="dropdown">
  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" >Kamus <span class="caret"></span></a>
  <ul class="dropdown-menu" role="menu">
      <li><a href="#">KBBI (Beta)</a></li>
      <li><a href="#">Kamus Daerah (Akan Datang)</a></li>
  </ul>
</li>
<li class="contact"><a href="{{ route('contact.form') }}">Kontak</a></li>
