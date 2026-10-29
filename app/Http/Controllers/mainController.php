<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Models\Blog;
use App\Models\Course;
use App\Models\Instructor;
use App\Models\Review;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Support\Facades\Mail;

class mainController extends Controller
{
    public function index()
    {
        $student_num = User::Role("student")->count();
        $blogs = Blog::with("tags")->latest()->limit(3)->get();
        $courses_num = Course::count();
        $courses_sample = Course::limit(6)->get();
        $instructors = Instructor::limit(4)->get();
        $instructors_num = Instructor::all()->count();

        $tags = Tag::with("courses")->get();
        // dd($courses_sample);
        // dd($users_num);

        return view("index", compact("student_num", "courses_num", "courses_sample", "tags", "instructors", "instructors_num","blogs"));
    }

    public function about()
    {
        $reviews=Review::with(["user","course"])->where("star_num",">=","4")->get();
        // dd($review);
        return view("about",compact("reviews"));
    }
    public function FAQ()
    {
        return view("FAQ");
    }
    public function thank()
    {
        return view("thank");
    }
    public function pricing()
    {
        return view("pricing");
    }

    public function contact()
    {
        return view("contact");
    }
    public function contact_data(ContactRequest $request)
    {
        // env("MAIL_FROM_ADDRESS",$request->email);
        // Mail::to(env("MAIL_FROM_ADDRESS"))->repl
        return redirect(route("thank"));
    }

    public function mark_as_readed(DatabaseNotification $notify)
    {
        // dd(Auth::user()->notifications->find($id));
        // dd(DatabaseNotification::all());
        // dd($id)
        // DatabaseNotification::find()
        // dd($notify);
        $notify->update([
            "read_at" => now(),
        ]);
    }

    public function delete_notification(DatabaseNotification $notify)
    {
        $notify->delete();
        flash()->success("Deleted Sucssesfully");

        return redirect()->back();
    }

    public function search(Request $request)
    {
        $value = $request->content;
        $course = Course::where("title", $request->content)->orWhere("sub_title", $request->content)->first();
        $instructor = Instructor::with("courses")->where("name", $request->content)->first();
        // dd($instractor_courses);
        // dd($course);
        if ($course != null) {
            return redirect(route("courses.show", $course->id));
        } elseif ($instructor != null) {
            $instructor_courses = $instructor->courses;
            return view("search_result", compact("instructor", "instructor_courses"));
        } else {
            $instructor_courses = Course::where("title", "like", "%" . $request->content . "%")->orWhere("sub_title", "like", "%" . $request->content . "%")->get();
            return view("search_result", compact("value", "instructor_courses"));
        }
    }








    public function search_result() {}
}
