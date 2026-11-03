<?php

use App\Models\Course;
use App\Models\Instructor;
use App\Models\User;
use Spatie\Permission\Models\Role;

test('admins can filter courses by status', function () {
    Role::findOrCreate('admin', 'web');
    $admin = User::factory()->create();
    $admin->assignRole('admin');

    Instructor::factory()->create();

    foreach (['published', 'pending', 'drafted'] as $status) {
        Course::factory()->create([
            'type' => 'online',
            'status' => $status,
        ]);
    }

    $this->actingAs($admin)
        ->get(route('dashboard.courses.index'))
        ->assertSuccessful()
        ->assertSee('id="course-status-filter"', false)
        ->assertSee('data-status="published"', false)
        ->assertSee('data-status="pending"', false)
        ->assertSee('data-status="drafted"', false)
        ->assertSee('All statuses')
        ->assertSee('No courses match these filters.');
});
