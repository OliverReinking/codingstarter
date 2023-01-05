<?php

namespace Database\Factories;

use Carbon\Carbon;
use App\Models\PersonCompany;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Chat>
 */
class ChatFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $startingValueCompany = 1000;
        $personCompanyCount = PersonCompany::count();
        //
        $chat_type_id = random_int(1, 1);
        //
        $sender_person_company_id = $startingValueCompany + random_int(0, $personCompanyCount);
        $sender_user_type_id = random_int(1, 3);
        //
        $receiver_person_company_id = $startingValueCompany + random_int(0, $personCompanyCount);
        $receiver_user_type_id = random_int(1, 3);
        //
        $chat_date = Carbon::now()->addMinutes($this->faker->numberBetween(-1000000, -1));
        //
        $read_status = random_int(0, 1);
        $read_date = Carbon::now()->addMinutes($this->faker->numberBetween(-1000000, -1));
        //
        $words = random_int(1, 100);
        $message = $this->faker->sentence($words, true);
        //
        return [
            'chat_type_id' => $chat_type_id,
            'sender_user_id' => 0,
            'sender_person_company_id' => $sender_person_company_id,
            'sender_user_type_id' => $sender_user_type_id,
            'receiver_user_id' => 0,
            'receiver_person_company_id' => $receiver_person_company_id,
            'receiver_user_type_id' => $receiver_user_type_id,
            'chat_date' => $chat_date,
            'read_status' => $read_status,
            'read_date' => $read_date,
            'message' => $message,
        ];
    }
}
