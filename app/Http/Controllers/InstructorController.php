<?php

namespace App\Http\Controllers;

use App\Models\Instructor;
use App\Http\Requests\StoreInstructorRequest;
use App\Http\Requests\UpdateInstructorRequest;

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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreInstructorRequest $request)
    {
        //
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
}
