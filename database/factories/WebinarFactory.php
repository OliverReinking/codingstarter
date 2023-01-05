<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Support\Str;
use App\Models\Administration;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Blog>
 */
class WebinarFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $event_date = Carbon::now()->addMinutes($this->faker->numberBetween(1000, 1000000));
        $event_start = "16:00";
        $webinar_image_id = $this->faker->numberBetween(1, 6);
        //
        $words = random_int(3, 5);
        $title = $this->faker->sentence($words, true);
        //
        $words = random_int(10, 25);
        $description = $this->faker->sentence($words, true);
        //
        $access = $this->faker->url();
        //
        return [
            'company_id' => Administration::ADMIN_CODINGSTARTER_ID,
            'webinar_image_id' => $webinar_image_id,
            'event_date' => $event_date,
            'event_start' => $event_start,
            'title' => $title,
            'description' => $description,
            'access' => $access,
        ];
    }
}

