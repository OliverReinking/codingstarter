<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestUpdatePersonCompany extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $rules = [];

        if (!$this->is_natural_person) {
            $rules['name'] = ['required', 'max:255'];
        }

        $rules['name'] = ['required', 'max:100'];
        $rules['street'] = ['required', 'max:100'];
        $rules['country_id'] = ['required', 'exists:countries,id'];
        $rules['postcode'] = ['required', 'max:100'];
        $rules['city'] = ['required', 'max:100'];
        $rules['contactperson_salutation_id'] = ['nullable', 'exists:salutations,id'];
        $rules['contactperson_first_name'] = ['nullable', 'max:100'];
        $rules['contactperson_last_name'] = ['nullable', 'max:100'];
        $rules['contactperson_phone'] = ['nullable', 'max:100'];
        $rules['contactperson_email'] = ['nullable', 'email', 'max:100'];
        $rules['consent_sepa_direct_debit'] = ['nullable', 'boolean'];
        $rules['bankconnection_iban'] = ['required', 'max:35'];
        $rules['bankconnection_accountholder'] = ['required', 'max:30'];
        $rules['billing_address'] = ['nullable', 'max:100'];
        $rules['billing_address_line_2'] = ['nullable', 'max:100'];
        $rules['billing_street'] = ['nullable', 'max:100'];
        $rules['billing_country_id'] = ['nullable', 'exists:countries,id'];
        $rules['billing_postcode'] = ['nullable', 'max:100'];
        $rules['billing_city'] = ['nullable', 'max:100'];

        return $rules;
    }

    public function messages()
    {
        return [
            'name.required'                         => 'Bitte gebe den Namen des Unternehmens ein.',
            'name.max'                              => 'Für die Eingabe des Namen des Unternehmens stehen maximal 100 Zeichen zur Verfügung.',
            //
            'street.required'                       => 'Bitte gebe die Straße ein.',
            'street.max'                            => 'Für die Eingabe der Straße stehen maximal 100 Zeichen zur Verfügung.',
            'country_id.required'                   => 'Bitte gebe das Land ein.',
            'country_id.exists'                     => 'Die Eingabe Land ist nicht gültig',
            'postcode.required'                     => 'Bitte gebe die Postleitzahl ein.',
            'postcode.max'                          => 'Für die Eingabe der Postleitzahl stehen maximal 100 Zeichen zur Verfügung.',
            'city.required'                         => 'Bitte gebe die Stadt ein.',
            'city.max'                              => 'Für die Eingabe der Stadt stehen maximal 100 Zeichen zur Verfügung.',
            //
            'bankconnection_iban.required'          => 'Bitte gebe die IBAN-Nr ein.',
            'bankconnection_iban.max'               => 'Für die Eingabe der IBAN-Nr stehen maximal 35 Zeichen zur Verfügung.',
            'bankconnection_accountholder.required' => 'Bitte gebe den Kontoinhaber ein.',
            'bankconnection_accountholder.max'      => 'Für die Eingabe des Kontoinhabers stehen maximal 30 Zeichen zur Verfügung.',
            //
            'contactperson_first_name.max'          => 'Für die Eingabe des Vornamens des Kunden stehen maximal 100 Zeichen zur Verfügung.',
            'contactperson_last_name.max'           => 'Für die Eingabe des Nachnamens des Kunden stehen maximal 100 Zeichen zur Verfügung.',
            'contactperson_phone.max'               => 'Für die Eingabe der Telefon-nr des Kunden stehen maximal 100 Zeichen zur Verfügung.',
            //
            'contactperson_email.email'             => 'Bitte gebe eine gültige Mailadresse der Kontaktperson ein.',
            'contactperson_email.required'          => 'Bitte gebe die Mailadresse der Kontaktperson ein.',
            'contactperson_email.max'               => 'Für die Eingabe der Mailadresse der Kontaktperson stehen maximal 100 Zeichen zur Verfügung.',
        ];
    }
}
