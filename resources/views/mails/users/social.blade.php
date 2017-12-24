@component('mail::message')
# Halo {{ $provider->user->name }},

Akun kamu di {{ config('app.name') }} dengan alamat email {{ $provider->user->email }} telah dihubungkan dengan akun {{ config('auth.socials')[$driver] }}.

Terima kasih,<br>
{{ config('app.name') }}
@endcomponent
