<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Http\Requests\StoreCourseRequest;
use App\Http\Requests\UpdateCourseRequest;
use Symfony\Component\HttpKernel\Debug\VirtualRequestStack;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $courses = Course::with(["reviews.user", "tags", "instructor"])->latest()->get();

        foreach ($courses as $course) {
            $total = 0;
            $reviews_num = $course->reviews->count();
            if ($reviews_num != 0) {
                foreach ($course->reviews as $review) {
                    $total += $review->star_num;
                }

                $course->update([
                    "star_num" => $total / $course->reviews->count(),
                ]);
            }
        }
        // dd($courses);
        return view("Course.courses", compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCourseRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Course $course)
    {
        $course->load(["reviews.user", "tags.courses", "instructor", "students"]);
        // dd($course);

        // $course->reviews->simplePaginate(5);

        $related_courses = Course::where("type", "like", $course->type)->where("id","!=",$course->id)->get();
        return view("Course.course_details", compact("course", "related_courses"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Course $course)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCourseRequest $request, Course $course)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course $course)
    {
        //
    }




    public function course_enrollment(Course $course)
    {
        // return view("re")
    }
    public function course_enrollment_data(Course $course)
    {
        // return view("re")
    }
}
