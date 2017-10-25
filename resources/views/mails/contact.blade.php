@component('mail::message')
# Halo {{ config('app.name') }}

Kamu mendapat pesan dari {{ $message->from }} dengan subjek "{{ $message->subject }}". Adapun isi pesannya adalah sebagai berikut:

@component('mail::panel')
> {{ $message->text }}
@endcomponent

@component('mail::button', ['url' => route('contact.show', ['message' => $encryptedId])])
Lihat Pesan pada Peramban
@endcomponent

Terima kasih,<br>
{{ config('app.name') }}
@endcomponent
