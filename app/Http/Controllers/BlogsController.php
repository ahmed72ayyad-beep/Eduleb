<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Comment;
use Illuminate\Http\Request;

class BlogsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $blogs = Blog::with(["comments.user", "author", "tags"])->latest()->get();
        // dd($blogs);
        return view("Blog.blogs", compact("blogs"));
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
        //♦
    }

    /**
     * Display the specified resource.
     */
    public function show(Blog $blog)
    {

        $blog->load(["author", "tags", "comments"]);
        // dd($blog);
        $popular_blogs = Blog::withCount("comments")->where("id","!=",$blog->id)->orderBy("comments_count","desc")->limit(6)->get();

        // dd($popular_blogs);
        $comments = Comment::with("user")->where("blog_id", $blog->id)->simplePaginate(4);
        return view("Blog.blog_single", compact("blog", "comments","popular_blogs"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Blog $blog)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Blog $blog)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog $blog)
    {
        //
    }
}
