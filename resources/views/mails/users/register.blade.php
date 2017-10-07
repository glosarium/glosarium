@component('mail::message')
# Halo, {{ $user->name }}

Terima kasih telah mendaftar di {{ config('app.name') }}. Tinggal satu langkah lagi agar akun kamu dapat digunakan sepenuhnya.

Silakan klik tautan di bawah untuk mengkonfirmasi akun kamu.

@component('mail::button', ['url' => route('user.confirm', ['key' => $encryptedEmail])])
Konfirmasi Akun
@endcomponent

Terima kasih,<br>
{{ config('app.name') }}
@endcomponent
