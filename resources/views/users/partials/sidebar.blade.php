<div class="col-md-3 col-sm-3">
    <div class="block-section text-center ">
        <img src="https://www.gravatar.com/avatar/{{ md5(auth()->user()->email) }}?s=150" class="img-rounded" alt="{{ auth()->user()->name }}">
        <div class="white-space-20"></div>
        <h4>{{ auth()->user()->name }}</h4>
        <div class="white-space-20"></div>
        <ul class="list-unstyled">
            <li><a href="my_alerts.html"> Profil Saya </a></li>
            <li><a href="{{ route('user.notification.index') }}"> Notifikasi ({{ auth()->user()->unreadNotifications->count() }})</a></li>
            <li><a href="change_password.html"> Ubah Sandi Lewat</a></li>
        </ul>
        <div class="white-space-20"></div>
        <a href="#" class="btn  btn-line soft btn-theme btn-pill btn-block">Tambah Glosarium</a>
    </div>
</div>
