<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestWebinarRegister extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $rules = [];

        $rules['first_name'] = ['required', 'max:100'];
        $rules['last_name'] = ['required', 'max:100'];
        $rules['email'] = ['required', 'email', 'max:100'];
        $rules['phone'] = ['required', 'max:100'];
        $rules['agreementPrivacy'] = ['accepted'];

        return $rules;
    }

    public function messages()
    {
        return [
            'first_name.required'                   => 'Bitte gebe den Vornamen des Anwenders ein.',
            'first_name.max'                        => 'Bitte gebe für den Vornamen des Anwenders maximal 200 Zeichen ein.',
            //
            'last_name.required'                    => 'Bitte gebe den Nachnamen des Anwenders ein.',
            'last_name.max'                         => 'Bitte gebe für den Nachnamen des Anwenders maximal 200 Zeichen ein.',
            //
            'email.required'                        => 'Bitte gebe die Mailadressee des Anwenders ein.',
            'email.email'                           => 'Bitte gebe eine gültig Mailadresse ein.',
            'email.max'                             => 'Bitte gebe für die Mailadressee maximal 100 Zeichen ein.',
            //
            'agreementPrivacy.accepted'             => 'Die Zustimmung zur "Datenschutzerklärung für unsere Webinare" ist notwendig.',
        ];
    }
}
