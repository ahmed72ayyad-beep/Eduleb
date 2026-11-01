<?php

namespace App\Policies;

use App\Models\Course;
use App\Models\User;

class CoursePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Course $course): bool
    {
        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Course $course): bool
    {
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Course $course): bool
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Course $course): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Course $course): bool
    {
        return false;
    }

    public function refund(User $user, Course $course): bool
    {
        // 1. جلب بيانات التسجيل من جدول الـ Pivot
        $enrollment = $user->courses()->where('course_id', $course->id)->first();
        // 2. التحقق من وجود التسجيل ورقم الـ enrollment_id
        if (! $enrollment || ! $enrollment->pivot->enrollment_id) {
            return false;
        }
        // dump($enrollment);
        // dd("عديت النروكمينت");

        // 3. التحقق أن تاريخ التسجيل لم يمضِ عليه أكثر من أسبوعين (14 يوماً)
        // dd($enrollment->pivot);
        $enrollmentDate = $enrollment->pivot->enrolled_at; // تاريخ وقت الشراء والتسجيل

        // dump($enrollmentDate->diffInDays(now()));
        // إذا كان الفارق بين وقت التسجيل والوقت الحالي أقل من أو يساوي 14 يوماً
        return $enrollmentDate->diffInDays(now()) <= 14;
    }

    public function create_lesson(User $user, Course $course): bool
    {
        return $user->instructor?->id === $course->instructor_id;
    }

    public function update_lesson(User $user, Course $course): bool
    {
        return $user->instructor?->id === $course->instructor_id;
    }

    public function delete_lesson(User $user, Course $course): bool
    {
        return $user->instructor?->id === $course->instructor_id;
    }

    public function view_lesson(User $user, Course $course): bool
    {
        return $user->hasRole('student') && $course->students()->where('users.id', $user->id)->exists();
    }
}
