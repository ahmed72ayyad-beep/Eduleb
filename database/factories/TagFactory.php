<?php

namespace Database\Factories;


use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<odel=Tag>
 */
class TagFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->randomElement([
                'Programming',
                'Web Development',
                'Mobile Development',
                'Data Science',
                'Artificial Intelligence',
                'Cybersecurity',
                'Database',
                'Business',
                'Marketing',
                'Design',
                'Photography',
                'Languages',
            ]),
            "image" => "assets/img/e"  . fake()->randomElement([1, 2, 3, 4, 5, 6, 7, 8, 9]) . ".png"
        ];
    }
}
