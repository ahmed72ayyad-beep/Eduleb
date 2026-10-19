<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends Factory<User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // $this->assignRole("student");
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'image' => "assets/img/blog/" . random_int(1, 6) . ".jpg",
            "description" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent ultricies quam nisi, vel gravida enim accumsan id. Praesent justo quam, auctor et lorem in, pulvinar ornare orci.",
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn(array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
