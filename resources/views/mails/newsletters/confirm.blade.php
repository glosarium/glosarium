@component('mail::message')
# Halo, {{ $subscriber->name }}

Kamu telah berlangganan mengkonfirmasi langganan nawala di {{ config('app.name') }}. Kapan saja, kamu dapat menglik pada tautan di bawah untuk berhenti berlangganan.

@component('mail::button', ['url' => route('newsletter.subscriber.unsubscribe', ['key' => $encryptedEmail])])
Berhenti Langganan
@endcomponent

Terima kasih,<br>
{{ config('app.name') }}
@endcomponent
