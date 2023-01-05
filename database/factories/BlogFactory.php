<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Blog>
 */
class BlogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $blog_date = Carbon::now()->addMinutes($this->faker->numberBetween(-1000000, -1));
        $blog_image_id = $this->faker->numberBetween(1, 12);
        $reading_time = $this->faker->numberBetween(1, 10);
        $blog_author_id = random_int(1, 1);
        //
        $words = random_int(3, 5);
        $title = $this->faker->sentence($words, true);
        //
        $words = random_int(10, 25);
        $summary = $this->faker->sentence($words, true);
        //
        $words = random_int(1, 1000);
        $content = $this->faker->sentence($words, true);
        //
        return [
            'blog_author_id' => $blog_author_id,
            'blog_image_id' => $blog_image_id,
            'blog_date' => $blog_date,
            'title' => $title,
            //'slug' => $slug,
            'summary' => $summary,
            'content' => $content,
            'reading_time' => $reading_time,
        ];
    }
}
