@component('mail::message')
# Halo, {{ $subscriber->name }}

Terima kasih telah menggunakan layanan {{ config('app.name') }}. Kami sedih ketika kamu memutuskan untuk berhenti berlangganan nawala di {{ config('app.name') }}.

Tentu saja kamu dapat berlangganan ulang dengan mengisi alamat pos-el pada formulir nawala.

Terima kasih,<br>
{{ config('app.name') }}
@endcomponent
