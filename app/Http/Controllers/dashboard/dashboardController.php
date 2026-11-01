<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Course;
use App\Models\Instructor;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Pest\Mutate\Mutators\Math\RoundToCeil;

class dashboardController extends Controller
{
    public function index()
    {
        if (Auth::user()->hasRole('admin')) {
            // code...
            $courses_num = Course::all()->count();
            // dd($courses_num);
            $instructors_num = Instructor::all()->count();
            // dd($instructors_num);
            $users_num = User::Role('student')->count();
            // dd($users_num);
            $blogs_num = Blog::withCount('comments')->get()->count();
            // dd($blog_num);
            $courses = Course::with(['instructor', 'students'])->latest()->limit(4)->get();
            // dd($courses);
            $instructors = Instructor::withCount('courses')->orderBy('courses_count', 'DESC')->limit(4)->get();

            // dd($instructors);
            return view('dashboard', compact('courses_num', 'instructors_num', 'users_num', 'blogs_num', 'courses', 'instructors'));
        } elseif (Auth::user()->hasRole('student')) {
            return view('student.dashboard');
        } elseif (Auth::user()->hasRole('instructor')) {
            $instructor = Instructor::with("courses.students")->where("user_id", Auth::id())->firstOrFail();
            $courses1 = $instructor->courses;
            $student_num = 0;
            $review_num = 0;
            $review_sum = 0;
            if ($courses1->count() > 0) {
                # code...
                foreach ($courses1 as $course) {
                    // dump($course->students);
                    if ($course->reviews->count() > 0) {
                        foreach ($course->reviews as $review) {
                            $review_sum = $review_sum + $review->star_num;
                        }
                    }
                    $review_num = $course->reviews->count() + $review_num;
                    $student_num = $course->students->count() + $student_num;
                }
            }
            $courses = Course::where("instructor_id", $instructor->id)->limit("3")->get();
            // dd($stu dent_num);
            // dd($review_num);
            if ($review_num > 0) {
                # code...
                $instructor_rate = $review_sum / $review_num;
            } else {
                $instructor_rate = $review_sum / 1;
            }
            // dd();
            $courses_num = $courses1->count();
            $instructor_rate = round($instructor_rate, 2);

            return view('instructor.dashboard', compact("student_num", "courses_num", "review_num", "instructor_rate", "courses"));
        }
    }
}
