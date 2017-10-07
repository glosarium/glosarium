@component('mail::message')
# Terima kasih, {{ $user->name }}

Akun kamu telah dikonfirmasi. Kamu sudah dapat menggunakan layanan {{ config('app.name') }} sepenuhnya. Klik tautan di bawah untuk masuk ke akun kamu.

@component('mail::button', ['url' => route('login')])
Masuk
@endcomponent

Terima kasih,<br>
{{ config('app.name') }}
@endcomponent
