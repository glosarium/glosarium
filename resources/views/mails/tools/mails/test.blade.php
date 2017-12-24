@component('mail::message')
# Halo

Pos ini merupakan ujicoba untuk memastikan SMTP sudah sesuai dengan semestinya. Jika kamu melihat pos ini, maka sudah tidak ada masalah dengan konfigurasi SMTP.

@component('mail::button', ['url' => route('home')])
Menuju ke Website
@endcomponent

Terima kasih,<br>
{{ config('app.name') }}
@endcomponent
