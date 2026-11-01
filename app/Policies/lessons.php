<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Course;

class LessonPolicy
{
    public function create(User $user, Course $course): bool
    {
        return $user->instructor?->id === $course->instructor_id;
    }

    public function update(User $user, Course $course): bool
    {
        return $user->instructor?->id === $course->instructor_id;
    }

    public function delete(User $user, Course $course): bool
    {
        return $user->instructor?->id === $course->instructor_id;
    }
}
