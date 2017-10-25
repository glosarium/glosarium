<!-- Top section -->
<div class="container">
  <div class="row">
    <div class="col-sm-12 col-md-6">
      <h6>Sekilas</h6>
      <p class="text-justify">Glosarium adalah suatu daftar alfabetis istilah dalam suatu ranah pengetahuan tertentu yang dilengkapi dengan definisi untuk istilah-istilah tersebut. Biasanya glosarium ada di bagian akhir suatu buku dan menyertakan istilah-istilah dalam buku tersebut yang baru diperkenalkan atau paling tidak, tak umum ditemukan.</p>

      <p>Aplikasi Glosarium dikembangkan oleh <a href="https://www.yugo.myd.id">Dedy Yugo Purwanto</a>.</p>
    </div>

    <div class="col-xs-6 col-md-3">
      <h6>Tautan Utama</h6>
      <ul class="footer-links">
        <li><a href="page-about.html">Tentang Kami</a></li>
        <li><a href="page-about.html">Blog</a></li>
        <li><a href="page-faq.html">Jelajahi Kata</a></li>
        <li><a href="{{ route('glosarium.category.index') }}">Semua Kategori</a></li>
        <li><a href="{{ route('contact.form') }}">Kontak</a></li>
      </ul>
    </div>

    <div class="col-xs-6 col-md-3">
      <h6>Tautan Lain</h6>
      <ul class="footer-links">
        <li><a href="job-list.html">Doumentasi API/APA</a></li>
        <li><a href="https://www.github.com/glosarium/glosarium" target="_blank">Kontribusi di Github</a></li>
        <hr>
        @guest
        <li><a href="{{ route('login') }}">Masuk</a></li>
        <li><a href="{{ route('register') }}">Daftar Sebagai Kontributor</a></li>
        <li><a href="job-list.html">Lupa Sandi Lewat</a></li>
        @endguest
        @auth
        <li><a href="">Dasbor ({{ auth()->user()->name }})</a></li>
        <li><a href="">Ubah Sandi Lewat</a></li>
        <li><a href="{{ route('logout') }}">Keluar</a></li>
        @endauth
      </ul>
    </div>
  </div>

  <hr>
</div>
<!-- END Top section -->

<!-- Bottom section -->
<div class="container">
  <div class="row">
    <div class="col-md-8 col-sm-6 col-xs-12">
      <p class="copyright-text">Hak Cipta &copy; {{ date('Y') }} Dilindungi Undang-undang.</p>
    </div>

    <div class="col-md-4 col-sm-6 col-xs-12">
      <ul class="social-icons">
        <li><a class="facebook" href="#"><i class="fa fa-facebook"></i></a></li>
        <li><a class="twitter" href="#"><i class="fa fa-twitter"></i></a></li>
        <li><a class="dribbble" href="#"><i class="fa fa-dribbble"></i></a></li>
        <li><a class="linkedin" href="#"><i class="fa fa-linkedin"></i></a></li>
        <li><a class="instagram" href="https://www.instagram.com/glosariumid"><i class="fa fa-instagram"></i></a></li>
      </ul>
    </div>
  </div>
</div>
<!-- END Bottom section -->
