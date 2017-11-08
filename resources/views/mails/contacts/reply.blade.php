@component('mail::message')
# Halo

Terima kasih telah mengirim pesan ke {{ config('app.name') }}. Berikut balasan terkait pesan yang telah kamu kirim.

@component('mail::panel')
    {{ $message->text }}
@endcomponent

Salam kami,<br>
{{ config('app.name') }}
@endcomponent
