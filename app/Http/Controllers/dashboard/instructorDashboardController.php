<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Instructor;
use App\Models\Live_lectures;
use App\Models\Recordedlectures;
use App\Models\Review;
use App\Models\Tag;
use App\Policies\LessonPolicy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rules\Unique;

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



    public function create_lesson(Course $course)
    {
        Gate::authorize('create', [LessonPolicy::class, $course]);

        $course->load(["LiveLectures", "Recordedlectures"]);

        return view("instructor.pages.lessons", compact("course"));
    }

    public function store_lesson(Request $request, Course $course)
    {

        Gate::authorize('create', [LessonPolicy::class, $course]);
        if ($course->type == "online") {
            $request->validate([
                "title" => ["required"],
                "slide" => ["nullable", "file", "max:10000", "mimes:pdf,word,docx,pptx"],
                "description" => ["nullable", "min:20"],
                "live_url" => ["required", "url"],
                "duration_minutes" => ["nullable", "numeric"],
                "sample_activity" => ["nullable"],
                "starts_at_date" => ["date", "after:tomorrow"],
                "starts_at_time" => [],
            ]);
            $path = null;
            if ($request->hasFile("slide")) {
                $path = $request->file("slide")->store("uploads/slides");
            }
            Live_lectures::create([
                "course_id" => $course->id,
                "title" => $request->title,
                "slide" => $path,
                "description" => $request->description,
                "live_url" => $request->live_url,
                "duration_minutes" => $request->duration_minutes,
                "sample_activity" => $request->sample_activity,
                "starts_at" => $request->starts_at_date . " " . $request->starts_at_time,
            ]);
        } elseif ($course->type == "recorded") {
            $request->validate([
                "title" => ["required"],
                "slide" => ["nullable", "file", "max:10000", "mimes:pdf,word,docx,pptx"],
                "description" => ["nullable", "min:20"],
                "video_url" => ["required", "url"],
                "duration_minutes" => ["nullable", "numeric"],
                "sample_activity" => ["nullable"],

            ]);
            // dd($request);
            $path = null;
            if ($request->hasFile("slide")) {
                $path = $request->file("slide")->store("uploads/slides");
            }
            Recordedlectures::create([
                "course_id" => $course->id,
                "title" => $request->title,
                "slide" => $path,
                "description" => $request->description,
                "video_url" => $request->video_url,
                "duration_minutes" => $request->duration_minutes,
                "sample_activity" => $request->sample_activity,
            ]);
        } else {
            flash()->fails("Something went wrong");
        }
        flash()->success("Added Sucssesfully");
        return redirect()->back();
    }

    public function destroy_lesson(Course $course, string $lesson)
    {
        Gate::authorize('delete', [LessonPolicy::class, $course]);
        if ($course->type == "online") {
            $lect = Live_lectures::where("course_id", $course->id)->findOrFail($lesson);
        } else {
            $lect = Recordedlectures::where("course_id", $course->id)->findOrFail($lesson);
        }

        if ($lect->slide != "null") {

            File::delete($lect->slide);
        }
        $lect->delete();


        flash()->success("Deleted Sucssesfully");
        return redirect()->back();
    }









    public function edit_lesson(Course $course, string $lesson)
    {
        Gate::authorize('update', [LessonPolicy::class, $course]);
        if ($course->type == "online") {
            $lect = Live_lectures::with("course")->where("course_id", $course->id)->findOrFail($lesson);
        } else {
            $lect = Recordedlectures::with("course")->where("course_id", $course->id)->findOrFail($lesson);
        }
        return view("instructor.pages.lessons_edit", compact("course", "lect"));
    }





    public function update_lesson(Request $request, Course $course, string $lesson)
    {
        Gate::authorize('update', [LessonPolicy::class, $course]);
        if ($course->type == "online") {

            $lect = Live_lectures::where("course_id", $course->id)->findOrFail($lesson);

            $data = $request->validate([
                "title" => ["required"],
                "slide" => ["nullable", "file", "max:10000", "mimes:pdf,doc,docx,ppt,pptx"],
                "description" => ["nullable", "min:20"],
                "live_url" => ["required", "url"],
                "duration_minutes" => ["nullable", "numeric"],
                "sample_activity" => ["nullable"],
                "starts_at_date" => ["required", "date"],
                "starts_at_time" => ["required", "date_format:H:i"],
            ]);

            $data["starts_at"] = $data["starts_at_date"] . " " . $data["starts_at_time"];

            unset($data["starts_at_date"], $data["starts_at_time"]);
        } elseif ($course->type == "recorded") {

            $lect = Recordedlectures::where("course_id", $course->id)
                ->findOrFail($lesson);

            $data = $request->validate([
                "title" => ["required"],
                "slide" => ["nullable", "file", "max:10000", "mimes:pdf,doc,docx,ppt,pptx"],
                "description" => ["nullable", "min:20"],
                "video_url" => ["required", "url"],
                "duration_minutes" => ["nullable", "numeric"],
                "sample_activity" => ["nullable"],
            ]);
        } else {
            abort(404);
        }

        if ($request->hasFile("slide")) {

            if ($lect->slide) {
                File::delete($lect->slide);
            }

            $data["slide"] = $request->file("slide")->store("uploads/slides");
        } else {
            unset($data["slide"]);
        }

        $lect->update($data);

        flash()->success("Updated Successfully");

        return redirect()->back();
    }
}
