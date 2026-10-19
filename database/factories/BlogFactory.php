<?php

namespace Database\Factories;

use App\Models\Blog;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Blog>
 */
class BlogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
"author_id"=>fake()->randomElement(User::all())->id,
"subject"=>fake()->word(),
"title"=>fake()->words(2,true),
"sub_title"=>fake()->sentence(6),
"content"=>fake()->paragraph(9),
"image"=> 'assets/img/blog/'.fake()->randomElement([1,2,3,4,5,6]).".jpg",

        ];
    }
}
