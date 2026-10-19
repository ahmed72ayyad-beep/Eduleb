<?php

namespace Database\Factories;

use App\Models\Instructor;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Instructor>
 */
class InstructorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {




        return [
            'name' => fake()->name(),

            'major' => fake()->randomElement([
                'Web Development',
                'Data Science',
                'Artificial Intelligence',
                'Business Administration',
                'Digital Marketing',
                'Graphic Design',
                'Photography',
                'Cybersecurity',
                'Mobile Development',
                'English Language',
                'Project Management',
                'Computer Science',
            ]),

            'personal_image' => 'assets/img/team/team' . fake()->numberBetween(1, 4) . '.jpg',

            'email' => fake()->unique()->safeEmail(),

            'description' => fake()->paragraph(3),

            'phone' => fake()->phoneNumber(),
            // "user_id"=>fake()->unique()->randomElement(User::role("instructor")->get())->id,
            'portfolio_link' => fake()->url(),
            "job_title"=>fake()->jobTitle(),
        ];
    }
}
