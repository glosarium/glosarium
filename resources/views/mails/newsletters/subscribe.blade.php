@component('mail::message')
# Halo, {{ $subscriber->name }}

Terima kasih telah memilih untuk berlangganan nawala di {{ config('app.name') }}. Untuk memastikan bahwa kamu benar-benar ingin mendapatkan pembaruan terbaru di {{ config('app.name') }}, klik tautan di bawah untuk mengkonfirmasi pos-el kamu.

@component('mail::button', ['url' => route('newsletter.subscriber.confirm', ['key' => $encryptedEmail])])
Konfirmasi Pos-el
@endcomponent

Terima kasih,<br>
{{ config('app.name') }}
@endcomponent
