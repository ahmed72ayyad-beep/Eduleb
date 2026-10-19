<?php

namespace Database\Factories;

use App\Models\Blog;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Comment>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "content"=>fake()->paragraph(),
            "user_id"=>fake()->randomElement(User::all())->id,
            "blog_id"=>fake()->randomElement(Blog::all())->id,
        ];
    }
}
