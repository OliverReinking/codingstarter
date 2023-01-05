<?php

namespace App\Http\Requests;

use Laravel\Fortify\Rules\Password;
use Illuminate\Foundation\Http\FormRequest;

class RegisterUserRequest extends FormRequest
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
        $rules['password'] = ['required', 'string', new Password, 'confirmed'];

        return $rules;
    }

}
