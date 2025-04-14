@component('mail::message')
# Nouveau message de l'administration

**Sujet:** {{ $subject }}

{{ $content }}

@component('mail::button', ['url' => url('/')])
Accéder à la plateforme
@endcomponent

Cordialement,<br>
{{ config('app.name') }}
@endcomponent