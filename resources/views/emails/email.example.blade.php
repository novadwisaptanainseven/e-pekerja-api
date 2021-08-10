@component('mail::message')
# Introduction

The body of your message.

<ul>
  <li>One</li>
  <li>Two</li>
  <li>Three</li>
</ul>

@component('mail::button', ['url' => ''])
Button Text
@endcomponent

@component('mail::panel', ['url' => ''])
{{ $req->pesan }}
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
