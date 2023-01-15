<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestAdminStoreAndUpdateWebinar extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $rules = [];

        $rules['company_id'] = ['required', 'exists:person_companies,id'];
        $rules['webinar_image_id'] = ['required', 'exists:webinar_images,id'];
        $rules['title'] = ['required', 'max:200'];
        $rules['description'] = ['required', 'min:10'];
        $rules['access'] = ['required', 'url'];
        $rules['access_start'] = ['required', 'url'];
        $rules['access_moderator'] = ['required', 'url'];
        $rules['event_date'] = ['required', 'date'];
        $rules['event_start'] = ['required', 'max:100'];
        //
        return $rules;
    }

    public function messages()
    {
        return [
            'company_id.required'           => 'Bitte gebe das zugehörige Unternehmen ein.',
            'company_id.exists'             => 'Das ausgewählte Unternehmen ist nicht vorhanden.',
            'webinar_image_id.required'     => 'Bitte wähle ein Webinarbild aus.',
            'webinar_image_id.exists'       => 'Das ausgewählte Webinarbild ist nicht vorhanden.',
            'title.required'                => 'Bitte gebe den Namen des Webinars ein.',
            'title.max'                     => 'Für die Eingabe Namen des Webinars stehen maximal 200 Zeichen zur Verfügung.',
            'description.required'          => 'Bitte gebe die Beschreibung des Webinars ein.',
            'description.min'               => 'Bitte gebe für die Beschreibung des Webinars mindestens 10 Zeichen ein.',
            'access.required'               => 'Bitte gebe den Link zum Webinarraum ein.',
            'access.url'                    => 'Für die Eingabe des Links zum Webinarraums ist eine gültige Webadresse erforderlich.',
            'access_start.required'         => 'Bitte gebe den Link zum Startseite des Webinarraums ein.',
            'access_start.url'              => 'Für die Eingabe des Links zur Startseite des Webinarraums ist eine gültige Webadresse erforderlich.',
            'access_moderator.required'     => 'Bitte gebe den Link zum Webinarraum für den Moderator ein.',
            'access_moderator.url'          => 'Für die Eingabe des Links zum Webinarraum für den Moderator ist eine gültige Webadresse erforderlich.',
            'event_date.required'           => 'Bitte gebe das Veranstaltungsdatum ein.',
            'event_date.date'               => 'Bitte ein gültiges Veranstaltungsdatum ein.',
            'event_start.required'          => 'Bitte gebe die Uhrzeit der Veranstaltung ein.',
            'event_start.max'               => 'Bitte gebe für die Uhrzeit der Veranstaltung maximal 100 Zeichen ein.',
        ];
    }
}
