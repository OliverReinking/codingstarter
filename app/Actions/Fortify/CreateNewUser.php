<?php

namespace App\Actions\Fortify;

use App\Models\Team;
use App\Models\User;
use App\Models\PersonCompany;
use Laravel\Jetstream\Jetstream;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    public function create(array $input)
    {
        Validator::make($input, [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
            'company_name' => ['required', 'string', 'max:100'],
            'company_street' => ['required', 'string', 'max:100'],
            'company_postcode' => ['required', 'string', 'max:20'],
            'company_city' => ['required', 'string', 'max:100'],
        ], [
            'company_name.required' => 'Bitte gebe den Unternehmensnamen ein.',
            'company_name.max' => 'Bitte gebe für den Unternehmensnamen maximal 100 Zeichen ein.',
            'company_street.required' => 'Bitte gebe die Straße de Unternehmens ein.',
            'company_street.max' => 'Bitte gebe für die Straße des Unternehmens maximal 100 Zeichen ein.',
            'company_postcode.required' => 'Bitte gebe die Postleiztahl des Unternehmens ein.',
            'company_postcode.max' => 'Bitte gebe für die Postleitzahl des Unternehmens maximal 20 Zeichen ein.',
            'company_city.required' => 'Bitte gebe die Stadt des Unternehmens ein.',
            'company_city.max' => 'Bitte gebe für die Stadt des Unternehmens maximal 100 Zeichen ein.',
        ])->validate();

        return DB::transaction(function () use ($input) {
            return tap(User::create([
                'first_name' => $input['first_name'],
                'last_name' => $input['last_name'],
                'email' => $input['email'],
                'password' => Hash::make($input['password']),
                'is_customer' => true
            ]), function (User $user) {
                // create person_companies
                $person_company = PersonCompany::create([
                    'name' => $input['company_name'],
                    'street' => $input['company_street'],
                    'country_id' => 1,
                    'postcode' => $input['company_postcode'],
                    'city' => $input['company_city'],
                    'contactperson_salutation_id' => 0,
                    'contactperson_last_name' => $user->first_name,
                    'contactperson_first_name' => $user->last_name,
                    'contactperson_email' => $user->email,
                ]);
                // create customers
                Customer::create([
                    'customer_id' => $person_company->id,
                    'company_id' => Administration::ADMIN_CODINGSTARTER_ID
                ]);
                // update data in users
                $user->is_customer = true;
                $user->customer_id = $person_company->id;
                $user->save();
            });
        });
    }

    protected function createTeam(User $user)
    {
        $user->ownedTeams()->save(Team::forceCreate([
            'user_id' => $user->id,
            'name' => explode(' ', $user->last_name, 2)[0] . "'s Team",
            'personal_team' => true,
        ]));
    }
}
