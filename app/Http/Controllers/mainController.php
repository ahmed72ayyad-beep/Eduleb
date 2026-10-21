<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Models\Course;
use App\Models\Instructor;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Support\Facades\Mail;

class mainController extends Controller
{
    public function index()
    {
        $users_num = User::count();
        $courses_num = Course::count();
        $courses_sample = Course::limit(6)->get();
        $instructors = Instructor::limit(4)->get();
        $tags = Tag::with("courses")->get();
        // dd($courses_sample);
        // dd($users_num);

        return view("index", compact("users_num", "courses_num", "courses_sample", "tags", "instructors"));
    }

    public function about()
    {
        return view("about");
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
}
