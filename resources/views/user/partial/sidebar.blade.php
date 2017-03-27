<div class="col-md-2 col-sm-2">
    <div class="block-section">
        <div class="text-center">
            <img src="https://www.gravatar.com/avatar/{{ md5(auth()->user()->email) }}?s=150" class="img-rounded" alt="{{ auth()->user()->name }}">
        </div>

        <div class="white-space-20"></div>
        <h3 class="text-center">{{ auth()->user()->name }}</h3>

        <div class="white-space-20"></div>

        <ul class="list-unstyled">
            @if (auth()->user()->type == 'admin')
                <li><a href="{{ route('admin.word.index') }}">Kata</a></li>
                <li><a href="{{ route('admin.word.moderation') }}">Moderasi Kata</a>
                @if (isset($totalModeration))
                <span class="badge badge-default">{{ $totalModeration }}</span>
                @endif
                </li>
                <li><a href="{{ route('admin.category.index') }}">Kategori</a></li>
                <li><a href="{{ route('admin.user.index') }}">Kontributor</a></li>
                <li><a href="{{ route('admin.keyword.index') }}">@lang('bot.keyword.title')</a></li>
                <li></li>
                <hr>
            @endif

            <li><a href="{{ route('user.account.token') }}">@lang('user.token')</a></li>

            <li><a href="{{ route('user.notification.index') }}"> Notifikasi <span class="badge badge-warning">{{ auth()->user()->unreadNotifications->count() }}</span></a></li>
            <li><a href="{{ route('user.password.form') }}"> Ubah Sandi Lewat</a></li>
        </ul>
        <div class="white-space-20"></div>
        <a href="{{ route('glosarium.word.create') }}" class="btn  btn-line soft btn-theme btn-pill btn-block">Tambah Glosari</a>
    </div>
</div>
