<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{







    public function myCourses()
    {
        return view("student.courses.index");
    }

    public function show(Course $course)
    {
        return view("student.courses.show", compact("course"));
    }
    public function reviews()
    {

        // $reviews=Auth::user()->reviews
        return view("student.reviews.index");
    }









    public function notifications()
    {
        return view("student.notifications.index");
    }
}
