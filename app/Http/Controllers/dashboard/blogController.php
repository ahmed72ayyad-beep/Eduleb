<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBlogRequest;
use App\Http\Requests\UpdateBlogRequest;
use App\Models\Blog;
use App\Models\Comment;
use App\Models\Tag;
use App\Models\User;
use App\Notifications\UpdatePost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class blogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $blogs_num = Blog::all()->count();
        $writers_num = User::role('writer')->count();
        $tags_num = Tag::all()->count();
        $comments_num = Comment::all()->count();
        $blogs = Blog::latest()->get();
        $tags = Tag::all();

        return view("dashboard.blogManagement.index", compact("blogs_num", "writers_num", "tags_num", "comments_num", "blogs", "tags"));
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
    public function store(StoreBlogRequest $request)
    {
        // dd($request);
        // 1 : Store Files :
        $path = $request->file("image")->store("uploads/blogs");

        // 2 : create record :
        $blog = Blog::create([
            "title" => $request->title,
            "sub_title" => $request->sub_title,
            "subject" => $request->subject,
            "image" => $path,
            "content" => $request->content,
            "author_id" => Auth::id(),
        ]);
        $blog->tags()->attach($request->tags);
        flash()->success("Added Sucssesfully");
        return redirect()->back();
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
    public function update(UpdateBlogRequest $request, Blog $blog)
    {
        $path = $blog->image;
        if ($request->hasFile("image")) {
            File::delete($blog->image);
            $path = $request->file('image')->store("uploads/blogs");
        }

        $blog->update([
            "title" => $request->title,
            "sub_title" => $request->sub_title,
            "subject" => $request->subject,
            "image" => $path,
            "content" => $request->content,
        ]);

        $blog->tags()->sync($request->tags);
        flash()->success("Updated Sucssesfully");
        if (Auth::id() != $blog->author->id) {
            # code...
            $blog->author->notify(new UpdatePost($blog->author, Auth::user()->name, $blog->id));
        }
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog $blog)
    {
        File::delete($blog->image);
        $blog->delete();
        flash()->success("Deleted Sucssesfully");
        return redirect()->back();
    }
    public function search(Request $request)
    {
        $query = $request->get('query');

        $blogs = Blog::with('author')
            ->where('title', 'LIKE', "%{$query}%")
            ->orWhereHas('author', function ($q) use ($query) {
                $q->where('name', 'LIKE', "%{$query}%");
            })
            ->latest()
            ->get();

        // إرجاع النتائج بصيغة JSON مع تضمين اسم الكاتب لتسهيل عرضه في القائمة
        $results = $blogs->map(function ($blog) {
            return [
                'id' => $blog->id,
                'title' => $blog->title,
                'author_name' => $blog->author->name ?? 'Admin'
            ];
        });

        return response()->json($results);
    }
}
