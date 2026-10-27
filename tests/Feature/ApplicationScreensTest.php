<?php

use App\Models\User;
use Spatie\Permission\Models\Role;

use App\Models\Application;

test('authenticated users can view application management and instructor apply screens', function () {
    Role::findOrCreate('student', 'web');
    $this->actingAs(User::factory()->create());

    $this->get(route('student.applications.index'))
        ->assertSuccessful()
        ->assertSee('My applications');

    $this->get(route('instructor.apply'))
        ->assertSuccessful()
        ->assertSee('Share what you know.');

    Role::findOrCreate('admin', 'web');
    $admin = User::factory()->create();
    $admin->assignRole('admin');

    $this->actingAs($admin)
        ->get(route('student.applications.index'))
        ->assertSuccessful()
        ->assertSee('Application review')
        ->assertSee('Maya Khoury');
});

test('student application modals dispatch the close event used by the modal component', function () {
    Role::findOrCreate('student', 'web');
    $user = User::factory()->create();
    $user->assignRole('student');

    $application = Application::create([
        'user_id' => $user->id,
        'type' => 'instructor_application',
        'state' => 'pending',
        'content' => [
            'major' => 'Computer Science',
            'phone' => '1234567890',
            'description' => 'This application is for demonstrating the modal close behavior.',
            'CV' => 'uploads/applications/sample.pdf',
        ],
    ]);

    $this->actingAs($user)
        ->get(route('student.applications.index'))
        ->assertSuccessful()
        ->assertSee("x-on:click.prevent=\"\$dispatch('close-modal', 'details-modal{$application->id}')\"");
});
