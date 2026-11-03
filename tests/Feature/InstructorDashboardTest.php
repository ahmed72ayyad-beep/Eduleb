<?php

use App\Models\Course;
use App\Models\Instructor;
use App\Models\User;
use Spatie\Permission\Models\Role;

test('instructor workspace routes render inside the app layout', function () {
    Role::findOrCreate('instructor', 'web');
    $instructor = User::factory()->create();
    $instructor->assignRole('instructor');
    Instructor::factory()->create(['user_id' => $instructor->id]);

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

test('instructor dashboard shows instructor-specific statistics and recent reviews', function () {
    Role::findOrCreate('instructor', 'web');
    $instructorUser = User::factory()->create();
    $instructorUser->assignRole('instructor');
    $instructor = Instructor::factory()->create(['user_id' => $instructorUser->id]);
    $student = User::factory()->create();
    $otherInstructor = Instructor::factory()->create();

    $course = Course::factory()->create([
        'instructor_id' => $instructor->id,
        'title' => 'Instructor-owned course',
        'type' => 'online',
    ]);
    $secondCourse = Course::factory()->create([
        'instructor_id' => $instructor->id,
        'title' => 'Second instructor course',
        'type' => 'recorded',
    ]);
    $otherCourse = Course::factory()->create([
        'instructor_id' => $otherInstructor->id,
        'title' => 'Another instructor course',
        'type' => 'online',
    ]);

    $course->students()->attach($student->id);
    $secondCourse->students()->attach($student->id);

    $course->reviews()->create([
        'user_id' => $student->id,
        'content' => 'Helpful and clear lessons.',
        'star_num' => 4,
    ]);
    $secondCourse->reviews()->create([
        'user_id' => $student->id,
        'content' => 'Excellent course content.',
        'star_num' => 5,
    ]);
    $otherCourse->reviews()->create([
        'user_id' => $student->id,
        'content' => 'A review belonging to another instructor.',
        'star_num' => 1,
    ]);

    $this->actingAs($instructorUser)
        ->get(route('instructor.dashboard'))
        ->assertSuccessful()
        ->assertSee('href="'.route('instructor.dashboard').'"', false)
        ->assertSee('data-stat="courses"', false)
        ->assertSee('data-stat="students"', false)
        ->assertSee('data-stat="reviews"', false)
        ->assertSee('data-stat="rating"', false)
        ->assertSee('>2</p>', false)
        ->assertSee('>1</p>', false)
        ->assertSee('4.5')
        ->assertSee('Instructor-owned course')
        ->assertSee('Helpful and clear lessons.')
        ->assertSee('Excellent course content.')
        ->assertDontSee('Another instructor course')
        ->assertDontSee('A review belonging to another instructor.');
});
