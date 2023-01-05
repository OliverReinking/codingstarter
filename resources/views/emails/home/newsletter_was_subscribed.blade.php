@component('mail::message')
# Newsletter {{ $newsletter_values->newsletter_name }}

Hallo,
<br>
herzlichen Dank für die Abonnierung des Newsletters {{ $newsletter_values->newsletter_name }}.
<br>
## Mailbestätigung

Bitte bestätige das Abonnement des Newsletters:
<br>
<a href="{{ $newsletter_values->verified_subscription_link_url }}">{{ $newsletter_values->verified_subscription_link_text }}</a>

## Newsletter abbestellen
Du kannst den Newsletter auch abbestellen, klicke hierzu einfach hier:
<a href="{{ $newsletter_values->cancelled_subscription_link_url }}">{{ $newsletter_values->cancelled_subscription_link_text }}</a>

@endcomponent
