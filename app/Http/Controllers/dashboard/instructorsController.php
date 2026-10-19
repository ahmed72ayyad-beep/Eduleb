<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreInstructorRequest;
use App\Models\Instructor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class instructorsController extends Controller
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
        Auth::user()->syncRoles(["instructor"]);

        // 3- redirect to profile :
        return redirect(route("dashboard"));
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
