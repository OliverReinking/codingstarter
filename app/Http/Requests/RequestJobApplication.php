<?php

namespace App\Http\Requests;

use App\Rules\Language;
use Illuminate\Foundation\Http\FormRequest;

class RequestJobApplication extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $rules = [];

        $rules['first_name'] = ['required', 'max:50'];
        $rules['last_name'] = ['required', 'max:50'];
        $rules['email'] = ['required', 'email'];
        $rules['phone'] = ['required', 'max:50'];
        $rules['birthday'] = ['nullable', 'date'];
        $rules['gender'] = ['in:female,male,divers'];
        $rules['continent'] = ['in:Africa,Antarctica,Asia,Australia/Ocenia,Europe,North America,South America'];
        $rules['fileCurriculumVitae'] = ['required', 'file'];
        $rules['languages'] = [new Language];

        return $rules;
    }
}
