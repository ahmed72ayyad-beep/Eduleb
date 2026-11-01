<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Support\Facades\Gate;

class StudentController extends Controller
{
    public function myCourses()
    {
        return view('student.courses.index');
    }

    public function show(Course $course)
    {
        Gate::authorize('view_lesson', $course);

        return view('student.courses.show', compact('course'));
    }

    public function lessons(Course $course)
    {
        Gate::authorize('view_lesson', $course);
        $course->load(['LiveLectures', 'Recordedlectures', 'instructor']);

        return view('student.courses.lessons', compact('course'));
    }

    public function reviews()
    {

        // $reviews=Auth::user()->reviews
        return view('student.reviews.index');
    }

    public function notifications()
    {
        return view('student.notifications.index');
    }
}
