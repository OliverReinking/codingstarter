<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestCreateInvitation extends FormRequest
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
        $rules['email'] = ['required', 'email', 'max:200'];

        return $rules;
    }

    public function messages()
    {
        return [

            'first_name.required'               => 'Die Angabe Vorname ist notwendig.',
            'first_name.max'                    => 'Für die Angabe Vorname sind maximal 100 Zeichen erlaubt.',
            'last_name.required'                => 'Die Angabe Nachname ist notwendig.',
            'last_name.max'                     => 'Für die Angabe Nachname sind maximal 100 Zeichen erlaubt.',
            'email.required'                    => 'Die Angabe Mailadresse ist notwendig.',
            'email.email'                       => 'Die Angabe Mailadresse ist nicht gültig.',
            'email.max'                         => 'Für die Angabe Mailadresse sind maximal 200 Zeichen erlaubt.',
        ];
    }
}
