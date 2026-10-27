<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCourseRequest;
use App\Http\Requests\UpdateCourseRequest;
use App\Models\Course;
use App\Models\Instructor;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Pest\Mutate\Mutators\Math;
use Pest\Mutate\Mutators\Math\RoundToCeil;

use function Pest\Laravel\json;

class coursesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $courses = Course::with(["students", "reviews", "tags", "instructor"])->latest()->simplePaginate(20);
        $tags = Tag::with(["blogs", "courses"])->get();
        // dd(ceil(2.2));
        $courses_num = Course::all()->count();
        return view("dashboard.courseManagement.index", compact("courses", "tags", "courses_num"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tags = Tag::all();
        return view("dashboard.courseManagement.create", compact("tags"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCourseRequest $request)
    {
        // 1 : Store the files :
        if ($request->hasFile("inner_image") && $request->hasFile("outer_image")) {
            $inner_path = $request->file("inner_image")->store("uploads/courses");
            $outer_path = $request->file("outer_image")->store("uploads/courses");
        } elseif ($request->hasFile("inner_image")) {
            $inner_path = $request->file("inner_image")->store("uploads/courses");
            $outer_path = $inner_path;
        } else {
            $outer_path = $request->file("outer_image")->store("uploads/courses");
            $inner_path = $outer_path;
        }



        // 2: Create the course :
        $course = Course::create([
            'title'          => $request->title,
            'sub_title'      => $request->sub_title,
            'instructor_id'  => $request->instructor_id,
            'type'           => $request->type,
            'price'          => $request->price,
            'duration'       => $request->duration,
            'total_lectures' => $request->total_lectures,
            'date'           => $request->date,
            'available_seats' => $request->available_seats,
            'certification'  => $request->certification,
            'overview'       => $request->overview,
            'description'    => $request->description,
            'curriculum'     => $request->curriculum,
            'outer_image'    => $outer_path,
            'inner_image'    => $inner_path,
            'star_num'    => 0,

        ]);
        $course->tags()->attach($request->tags);
        //3 : Redirect the User To Courses :
        return redirect(route("dashboard.courses.index"));
    }




    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Course $course)
    {
        $course->load(["instructor", "tags"]);
        $tags=Tag::all();
        return view("dashboard.courseManagement.edit", compact("course","tags"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCourseRequest $request, Course $course)
    {

        // dd($request);
        $inner_path = $course->inner_image;
        $outer_path = $course->outer_image;
        // 1 : File Handle :

        if ($request->hasFile("inner_image")) {
            File::delete(public_path($course->inner_image));
            $inner_path = $request->file("inner_image")->store("uploads/courses");
        }
        if ($request->hasFile("outer_image")) {
            File::delete(public_path($course->outer_image));
            $outer_path = $request->file("outer_image")->store("uploads/courses");
        }

        // 2  : Update The data :


        $course->update([
            'title'          => $request->title,
            'sub_title'      => $request->sub_title,
            'instructor_id'  => $request->instructor_id,
            'type'           => $request->type,
            'price'          => $request->price,
            'duration'       => $request->duration,
            'total_lectures' => $request->total_lectures,
            'date'           => $request->date,
            'available_seats' => $request->available_seats,
            'certification'  => $request->certification,
            'overview'       => $request->overview,
            'description'    => $request->description,
            'curriculum'     => $request->curriculum,
            'outer_image'    => $outer_path,
            'inner_image'    => $inner_path,
            'star_num'    => 0,

        ]);
        $course->tags()->sync($request->tags);
        //3 : Redirect the User To Courses :
        return redirect(route("dashboard.courses.index"));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course $course)
    {
        // dd($course);
        if ($course->inner_image != null) {
            File::delete(public_path($course->inner_image));
        }
        if ($course->outer_image != null) {
            # code...
            File::delete(public_path($course->outer_image));
        }
        $course->delete();
        return redirect(route("dashboard.courses.index"));
    }



    public function search(string $value)
    {
        $instructors = Instructor::where("name", "like",  "%" . $value . "%")->get();
        $courses = Course::where("title", "like", "%" . $value . "%")->get();
        $instructors->load("courses.instructor");
        $courses->load("instructor");
        // dd($instructors);
        return [$instructors, $courses];
    }
}
