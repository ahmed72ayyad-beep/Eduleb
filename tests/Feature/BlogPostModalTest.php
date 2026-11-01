<?php

use App\Models\User;
use Spatie\Permission\Models\Role;

test('admins can see the add-post modal on the public blog listing', function () {
    Role::findOrCreate('admin', 'web');
    $admin = User::factory()->create();
    $admin->assignRole('admin');

    $this->actingAs($admin)
        ->get(route('blogs.index'))
        ->assertSuccessful()
        ->assertSee('data-open-blog-post-modal', false)
        ->assertSee('id="blog-post-modal"', false)
        ->assertSee(route('dashboard.blogs.store'), false)
        ->assertSee('name="image"', false)
        ->assertSee('name="content"', false);
});

test('non-admin users do not see the add-post modal', function () {
    Role::findOrCreate('student', 'web');
    $student = User::factory()->create();
    $student->assignRole('student');

    $this->actingAs($student)
        ->get(route('blogs.index'))
        ->assertSuccessful()
        ->assertDontSee('data-open-blog-post-modal', false)
        ->assertDontSee('id="blog-post-modal"', false);
});
