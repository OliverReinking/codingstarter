<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestNewsletterRegister extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $rules = [];

        $rules['name'] = ['nullable', 'max:100'];
        $rules['email'] = ['required', 'email', 'max:100'];
        $rules['agreementPrivacy'] = ['accepted'];

        return $rules;
    }

    public function messages()
    {
        return [
            'agreementPrivacy.accepted'             => 'Die Zustimmung zur "Datenschutzerklärung für unsere Newsletter" ist notwendig.',
        ];
    }
}
