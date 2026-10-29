<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Instructor;
use App\Models\Review;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class instructorDashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.instructorManagement.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Instructor $instructor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Instructor $instructor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Instructor $instructor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Instructor $instructor)
    {
        //
    }



    public function students()
    {
        $courses = Course::with(["instructor", "students.reviews"])->where("instructor_id", Instructor::where("user_id", Auth::id())->first()->id)->get();
        // dd($courses);
        // dd($courses[1]->students[0]);
        return view('instructor.pages.students', compact("courses"));
    }

    public function reviews()
    {
        $courses =  Instructor::where("user_id", Auth::id())->first()->courses;

        //    dd($courses);
      
        return view('instructor.pages.reviews');
    }

    public function courses()
    {
        $courses = Course::with(["instructor", "students"])->where("instructor_id", Instructor::where("user_id", Auth::id())->first()->id)->get();
        return view('instructor.pages.courses', compact("courses"));
    }
    public function course_create()
    {
        $tags = Tag::all();
        return view('instructor.pages.course_create', compact("tags"));
    }
    public function course_store()
    {
        return redirect()->route("student.applications.index");
    }
    public function lesson_studio()
    {
        return view('instructor.pages.lessons');
    }
}
