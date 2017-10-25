@component('mail::message')
# Halo {{ config('app.name') }}

Saya {{ $user->name}}, baru saja menambahkan kata baru yaitu **{{ $word->origin }}** yang berarti **{{ $word->locale }}**.

Terima kasih,<br>
{{ config('app.name') }}
@endcomponent
