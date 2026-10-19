<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Course;
use App\Models\Tag;
use Illuminate\Http\Request;
use Mockery\ClosureWrapper;

class TagController extends Controller
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
        //
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
    public function show(Tag $tag)
    {
        $courses = Course::with(["instructor", "reviews", "students"])->where("type", "like", "%" . $tag->name . "%")->orWhere("description", "like", "%" . $tag->name . "%")->orWhere("overview", "like", "%" . $tag->name . "%")->get();
        $blogs = Blog::with(["author", "comments", "tags"])->where("subject", "like", "%" . $tag->name . "%")->orWhere("title", "like", "%" . $tag->name . "%")->orWhere("sub_title", "like", "%" . $tag->name . "%")->orWhere("content", "like", "%" . $tag->name . "%")->get();
        
        return view("categorie_single", compact("tag", "courses", "blogs"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tag $tag)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tag $tag)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tag $tag)
    {
        //
    }
}
