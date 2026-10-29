<?php

use App\Models\User;
use Spatie\Permission\Models\Role;

test('instructor workspace routes render inside the app layout', function () {
    Role::findOrCreate('instructor', 'web');
    $instructor = User::factory()->create();
    $instructor->assignRole('instructor');

    foreach (
        [
            'instructor.overview' => 'Welcome,',
            'instructor.students' => 'Students',
            'instructor.reviews' => 'Reviews',
            'instructor.courses' => 'My courses',
        ] as $routeName => $pageHeading
    ) {
        $this->actingAs($instructor)
            ->get(route($routeName))
            ->assertSuccessful()
            ->assertSee('Instructor workspace')
            ->assertSee($pageHeading);
    }

    $this->actingAs($instructor)
        ->get(route('dashboard'))
        ->assertSuccessful()
        ->assertSee('Instructor workspace')
        ->assertSee('Teaching summary');

    foreach (['lessons' => 'Lesson studio', 'profile' => 'Instructor profile'] as $page => $heading) {
        $this->actingAs($instructor)
            ->get(route('dashboard', ['page' => $page]))
            ->assertSuccessful()
            ->assertSee('Instructor workspace')
            ->assertSee($heading);
    }
});
