<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Course;

class StudentController extends Controller
{
    public function myCourses()
    {
        return view('student.courses.index');
    }

    public function show(Course $course)
    {

        return view('student.courses.show', compact('course'));
    }
    public function  lessons(Course $course)
    {
        $course->load(["LiveLectures", "Recordedlectures", "instructor"]);
        return view("student.courses.lessons", compact("course"));
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
