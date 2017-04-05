<div class="col-md-2 col-sm-2">
    <div class="block-section">
        <div class="text-center">
            <img src="https://www.gravatar.com/avatar/{{ md5(auth()->user()->email) }}?s=150" class="img-rounded" alt="{{ auth()->user()->name }}">
        </div>

        <div class="white-space-20"></div>
        <h3 class="text-center">{{ auth()->user()->name }}</h3>

        <div class="white-space-20"></div>

        <ul class="list-unstyled">
            @can('show', \App\Glosarium\Word::class)
                <li><a href="{{ route('admin.word.index') }}">Kata</a></li>
            @endcan

            @can('moderation', \App\Glosarium\Word::class)
                <li><a href="{{ route('admin.word.moderation') }}">Moderasi Kata</a>
                @if (isset($totalModeration))
                <span class="badge badge-default">{{ $totalModeration }}</span>
                @endif
            </li>
            @endif

            @can('show', \App\Glosarium\Category::class)
                <li><router-link :to="{ name: 'glosarium.category' }">Kategori</router-link></li>
            @endcan

            @can('show', \App\User::class)
                <li><router-link :to="{ name: 'contributor' }">Kontributor</router-link></li>
            @endcan

            @can('show', \App\Bot\Keyword::class)
            <li><router-link :to="{ name: 'bot.keyword' }">Katakunci Bot</router-link></li>
            @endcan

            @if (auth()->user()->type == 'admin')
                <hr>
            @endif

            <li><router-link :to="{ name: 'user.dashboard' }">Dasbor</router-link></li>
            <li><router-link :to="{ name: 'user.notification' }">Notifikasi</router-link></li>
            <li><router-link :to="{ name: 'user.password' }">Ubah Sandi Lewat</router-link></li>
        </ul>
        <div class="white-space-20"></div>
        <a href="{{ route('glosarium.word.create') }}" class="btn  btn-line soft btn-theme btn-pill btn-block">Tambah Glosari</a>
    </div>
</div>
