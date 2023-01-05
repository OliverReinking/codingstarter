@component('mail::message')
# Einladung

Hallo {{ $invitation_values->first_name }} {{ $invitation_values->last_name }},
<br>
du wurdest als Teammitglied eingeladen
<br>

@if ($invitation_values->application == config('codingstarter.application.administration'))
von der Administration
<br>
@endif

@if ($invitation_values->application == config('codingstarter.application.company'))
vom Unternehmen
<br>
@endif

@if ($invitation_values->application == config('codingstarter.application.customer'))
vom Kunden
<br>
@endif

{{ $invitation_values->company_name }}
<br>
{{ $invitation_values->company_street }}
<br>
{{ $invitation_values->company_postcode }} {{ $invitation_values->company_city }}
<br>

## Bestätigung der Einladung

Wenn du die Einladung annehmen möchtest, klicke bitte auf den folgenden Link:
<br>
<a href="{{ $invitation_values->accept_invitation_link_url }}">{{ $invitation_values->accept_invitation_link_text }}</a>
<br>
<br>
Möchtest du die Einladung nicht annehmen, musst du nichts weiter unternehmen.
@endcomponent
