<?php

namespace Database\Factories;

use App\Models\Course;
use App\Models\Review;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Review>
 */
class ReviewFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        return [
            'user_id' => fake()->randomElement(User::all())->id,
            'course_id' => fake()->randomElement(Course::all())->id,

            'content' => fake()->paragraph(),

            'star_num' => fake()->numberBetween(1, 5),
        ];
    }
}
