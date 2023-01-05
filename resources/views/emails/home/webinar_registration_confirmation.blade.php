@component('mail::message')
# Bestätigung deiner Webinar-Anmeldung für das Webinar {{ $registrationvalues->title }}

Hallo,
<br>
herzlichen Dank für deine Webinar-Anmeldung.
<br>
## Deine Anmeldedaten lauten:

Anrede: {{ $registrationvalues->salutation_name }}
<br>
Vorname: {{ $registrationvalues->first_name }}
<br>
Nachname: {{ $registrationvalues->last_name }}
<br>
Mailadresse: {{ $registrationvalues->email }}
<br>
Telefon-Nr: {{ $registrationvalues->phone }}

## Webinar-Informationen:

Webinar: {{ $registrationvalues->title }}
Beschreibung: {!! $registrationvalues->description !!}
Beginn: {{ formatDateLocale($registrationvalues->event_date) }}, {{ $registrationvalues->event_start }}

Bitte rufe am Tag der Veranstaltung im Browser den folgenden Link auf:
<a href="{{ $registrationvalues->access }}" >{{ $registrationvalues->access }}</a>

Wir freuen uns auf deine Teilnahme.

@endcomponent
