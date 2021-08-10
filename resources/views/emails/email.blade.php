@component('mail::message')
# Halo {{ $req->nama }}

@component('mail::panel', ['url' => ''])
{{ $req->pesan }}
@endcomponent

Terimakasih,<br>
{{ config('app.name') }}
@endcomponent
