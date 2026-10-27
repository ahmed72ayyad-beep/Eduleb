<?php

namespace App\Http\Controllers;

use App\Http\Requests\instructorApplyQrquest;
use App\Http\Requests\StoreInstructorRequest;
use App\Http\Requests\UpdateInstructorRequest;
use App\Models\Instructor;
use Illuminate\Support\Facades\Auth;

class InstructorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $instructors = Instructor::with(["courses"])->get();
        // dd($instructor);
        return view("instructor.instructors", compact("instructors"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("dashboard.instructorManagement.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreInstructorRequest $request)
    {

        // dd($request);
        // 1 - Store the image :
        $path = $request->file("personal_image")->store("uploads/courses");


        // 2 - create the instructor record  :
        Instructor::create([
            "major" => $request->major,
            "personal_image" => $path,
            "job_title" => $request->job_title,
            "portfolio_link" => $request->portfolio_link,
            "description" => $request->description,
            "phone" => $request->phone,
            "user_id" => Auth::id(),
            "name" => Auth::user()->name,
            "email" => Auth::user()->email,
        ]);
        Auth::user()->update([
            "image" => $request->personal_image,
        ]);
        Auth::user()->syncRoles(["instructor"]);

        // 3- redirect to profile :
        return redirect(route("dashboard"));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $instructor)
    {
        // dd($instructor);
        $instructor = Instructor::with(["courses"])->find($instructor);

        // dd($instructor);
        return view("instructor.instructor_detail", compact("instructor"));
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
    public function update(UpdateInstructorRequest $request, Instructor $instructor)
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



    public function search(string $instructor)
    {
        $instructor1 = Instructor::where("name", "like", "%" . $instructor . "%")->orWhere("id", $instructor)->get();
        // dd($instructor1);
        return $instructor1;
    }
    public function search2(string $course, string $instructor)
    {
        $instructor1 = Instructor::where("name", "like", "%" . $instructor . "%")->orWhere("id", $instructor)->get();
        // dd($instructor1);
        return $instructor1;
    }


    public function instructor_apply()
    {
        return view("application.instructor_apply");
    }









    public function instructor_apply_data(instructorApplyQrquest $request) {}
}
