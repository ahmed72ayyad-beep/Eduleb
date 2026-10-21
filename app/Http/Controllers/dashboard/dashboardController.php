<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Course;
use App\Models\Instructor;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class dashboardController extends Controller
{

    public function index()
    {
        if (Auth::user()->hasRole("admin")) {
            # code...
            $courses_num = Course::all()->count();
            // dd($courses_num);
            $instructors_num = Instructor::all()->count();
            // dd($instructors_num);
            $users_num = User::Role("student")->count();
            // dd($users_num);
            $blogs_num = Blog::withCount("comments")->get()->count();
            // dd($blog_num);
            $courses = Course::with(["instructor", "students"])->latest()->limit(4)->get();
            // dd($courses);
            $instructors = Instructor::withCount("courses")->orderBy("courses_count", "DESC")->limit(4)->get();
            // dd($instructors);
            return view("dashboard", compact("courses_num", "instructors_num", "users_num", "blogs_num", "courses", "instructors"));
        }elseif (Auth::user()->hasRole("student")) {
                return view("student.dashboard");
        }
    }
}
