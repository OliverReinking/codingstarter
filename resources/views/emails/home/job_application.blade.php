@component('mail::message')
# Neue Bewerbung

Es liegt eine neue Bewerbung vor.<br>

## Bewerberdaten

### Persönliche Daten
*{{ $job_application_values->first_name }} {{ $job_application_values->last_name }}*

Mail: {{ $job_application_values->email }}<br>
Telefon: {{ $job_application_values->phone }}<br>
Geschlecht: {{ $job_application_values->gender }}<br>
Kontinent: {{ $job_application_values->continent }}<br>

### Sprachen
<ul>
    @foreach ($job_application_values->languages as $language)
        <li>{{ $language }}</li>
    @endforeach
</ul>

## Dein Auftrag
Bitte beantworte die Bewerbung schnellstmöglich!
@endcomponent
