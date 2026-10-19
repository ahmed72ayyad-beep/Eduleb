<?php

namespace Database\Seeders;

use App\Models\Blog;
use App\Models\Comment;
use App\Models\Course;
use App\Models\Instructor;
use App\Models\Review;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RolePermissionSeeder::class,
        ]);
        User::factory(20)->create()->each(function ($user) {
            $user->assignRole('student');
        });
        Instructor::factory(4)->create();

        Course::factory(10)->create();


        Review::factory(20)->create();

        Tag::factory(12)->create();
        Blog::factory(20)->create();
        Comment::factory(10)->create();
    }
}
