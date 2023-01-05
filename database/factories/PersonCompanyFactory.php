<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class PersonCompanyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $zufall_natural_person = random_int(1, 100);
        //
        $country_id = random_int(1, 20);
        $contactperson_salutation_id = random_int(1, 3);
        //
        $streetName = $this->faker->streetName();
        $city = $this->faker->city();
        $postcode = $this->faker->postcode();
        //
        $first_name = $this->faker->firstName();
        $last_name = $this->faker->lastName();
        $company = $this->faker->company();
        //
        if ($zufall_natural_person > 20) {
            $is_natural_person = true;
            $name = $first_name . ' ' . $last_name;
        } else {
            $is_natural_person = false;
            $name = $company;
        }
        //
        return [
            'is_natural_person' => $is_natural_person,
            'name' => $name,
            'street' => $streetName,
            'country_id' => $country_id,
            'postcode' => $postcode,
            'city' => $city,
            'contactperson_salutation_id' => $contactperson_salutation_id,
            'contactperson_first_name' => $first_name,
            'contactperson_last_name' => $last_name,
            'contactperson_phone' => $this->faker->phoneNumber(),
            'contactperson_email' => $this->faker->email(),
            'bankconnection_iban' => $this->faker->iban(),
            'bankconnection_accountholder' => $name,
            'billing_address' => $name,
            'billing_address_line_2' => null,
            'billing_street' => $streetName,
            'billing_country_id' => $country_id,
            'billing_postcode' => $postcode,
            'billing_city' => $city,
        ];
    }
}
