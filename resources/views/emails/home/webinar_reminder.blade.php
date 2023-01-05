@component('mail::message')
# Erinnerung Webinar {{ $remindervalues->title }}

Hallo {{ $remindervalues->first_name }} {{ $remindervalues->last_name }},

heute findet das Webinar <b>{{ $remindervalues->title }}</b> statt.

Das Webinar beginnt um: {{ $remindervalues->event_start }}.

Hier geht es zum Webinarraum:
<a href="{{ $remindervalues->access }}">{{ $remindervalues->access }}</a>

Wir freuen uns sehr auf Deine Teilnahme.

@endcomponent
