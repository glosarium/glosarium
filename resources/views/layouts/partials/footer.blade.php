<footer class="main-footer">
    <div class="container">
        <div class="row">
            <div class="col-sm-6">
                <ul class="list-inline link-footer text-center-xs">
                    <li>
                    <router-link :to="{ name: 'index' }">Beranda</router-link>
                    </li>
                    <li><a href="{{ route('contact.form') }}">Kontak Kami</a></li>
                    <li><a href="{{ route('page.api.index', ['beta']) }}">API (Beta)</a></li>
                    <li><a href="http://s.id/glosariumLINE">LINE@</a></li>
                    @if (app()->environment('local'))
                        <li><a href="https://www.laravel.com">Laravel {{ $laravelVersion }}</a></li>
                    @endif
                </ul>
            </div>
            <div class="col-sm-6 ">
                <p class="text-center-xs hidden-lg hidden-md hidden-sm">Tetap Terhubung</p>
                <div class="socials text-right text-center-xs">
                    <a href="https://facebook.com/arvernester"><i class="fa fa-facebook"></i></a>
                    <a href="https://twitter.com/arvernester"><i class="fa fa-twitter"></i></a>
                    <a href="https://id.linkedin.com/in/arvernester"><i class="fa fa-linkedin"></i></a>
                    <a href="https://instagram.com/glosariumid"><i class="fa fa-instagram"></i></a>
                    <a href="http://yugo.my.id"><i class="fa fa-rss"></i></a>
                </div>
            </div>
        </div>
    </div>
</footer>
