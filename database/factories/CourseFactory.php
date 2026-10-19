<?php

namespace Database\Factories;

use App\Models\Course;
use App\Models\Instructor;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Course>
 */
class CourseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $fake = fake()->numberBetween(1, 12);
        $fake2 = fake()->numberBetween(1, 60);
        $x = $fake > 1 ?  $fake . " Hours" : $fake . " Hour";
        $x2 = $fake2 > 1 ? $fake2 . " Min" : $fake2 . " Mins";

        return [
            'type' => fake()->randomElement([
                'Development',
                'Design',
                'Business',
                'Marketing',
            ]),

            'title' => fake()->words(3,true),

            'sub_title' => fake()->sentence(6),
                "instructor_id"=>fake()->randomElement(Instructor::all())->id,
            'star_num' => fake()->numberBetween(1, 5),

            'outer_image' => 'assets/img/course/' . fake()->numberBetween(1, 6) . '.png',

            'inner_image' => 'assets/img/course/' . fake()->numberBetween(1, 6) . '.png',

            'duration' => $x ." ". $x2,

            'date' => fake()->dateTimeBetween('-6 months', 'now'),

            'price' => fake()->numberBetween(10, 200) . '.99',
            'total_lectures' => fake()->numberBetween(10, 80),

            'description' => fake()->paragraph(8),

            'overview' => fake()->paragraphs(5, true),

            'curriculum' => fake()->paragraphs(8, true),

            'available_seats' => fake()->numberBetween(10, 100),
        ];
    }
}
