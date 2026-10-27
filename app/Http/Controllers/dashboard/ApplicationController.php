<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreApplicationRequest;
use App\Http\Requests\UpdateApplicationRequest;
use App\Models\Application;
use App\Models\Course;
use App\Models\Instructor;
use App\Models\User;
use App\Notifications\newRole;
use App\Notifications\Support;
use App\Rules\minWords;
use DateTime;
use Illuminate\Http\Request; // هذا هو الصحيح
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class ApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::user()->hasRole("admin")) {
            $applications = Application::with("user")->latest()->get();
            $approvedThisMonthCount = Application::where("state", "Accpted")->whereMonth("reviewed_at", now()->month)->count();
            $awaitingReview = Application::where("state", "pending")->count();
            $approvedCount = Auth::user()->applications->where("state", "accpted")->count();
            $averageReviewTime = Application::whereNotNull('reviewed_at')
                ->selectRaw('AVG(TIMESTAMPDIFF(HOUR, created_at, reviewed_at)) as average_time')
                ->value('average_time');
            // dd($averageReviewTime);
            return view("application.applicationsAdmin", compact("applications", "approvedCount", "approvedThisMonthCount", "awaitingReview", "averageReviewTime"));
        } elseif (Auth::user()->hasRole("student")) {
            $applications = Application::latest()->get();
            $pendingCount = Auth::user()->applications->where("state", "pending")->count();
            return view("application.applicationsStudent", compact("applications", "pendingCount"));
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // return view("ap");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request);
        switch ($request->type) {
            case 'instructor_application':
                $request->validate([
                    "type" => ["required", "in:course_support,instructor_application"],
                    "major" => ["required"],
                    "job_title" => ["required"],
                    "phone" => ["required", "numeric", "min_digits:10"],
                    "portfolio_link" => ["required", "url"],
                    "description" => ["required", new minWords(20)],
                    "personal_image" => ["nullable", "image", "mimes:png,jpg", "max:6000"],
                    "CV" => ['required', "mimes:pdf", "max:10000"]
                ]);
                $personal_image = null;
                $data = $request->except(["personal_image", "CV", "type"]);
                // dd($request->file("personal_image"));
                if ($request->hasFile("personal_image")) {
                    $personal_image = $request->file("personal_image")->store("uploads/applications");
                }
                $CV = $request->file("CV")->store("uploads/applications");
                $data["CV"] = $CV;
                $data["personal_image"] = $personal_image;
                // dd($data);
                Application::create([
                    "type" => $request->type,
                    "content" => $data,
                    "user_id" => Auth::id(),

                ]);
                break;
            case 'course_support':
                // dd("sssssssssss");
                $request->validate([
                    "msg" => ["required"],
                    "course_id" => ["required"],
                    "type" => ["required"],
                ]);
                Application::create([
                    "content" => ["msg" => $request->msg],
                    "type" => $request->type,
                    "target_id" => $request->course_id,
                    "user_id" => Auth::id()

                ]);
                break;

            default:
                //
                break;
        }
        flash()->success("Sended To The Admins Sucssesfully");
        return redirect(route("student.applications.index"));
    }

    /**
     * Display the specified resource.
     */
    public function show(Application $application)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Application $application)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateApplicationRequest $request, Application $application)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Application $application)
    {
        if ($application->type == "instructor_application") {
            if ($application->content["personal_image"] != null) {
                # code...
                File::delete($application->content["personal_image"]);
            }

            File::delete($application->content["CV"]);
        }
        $application->delete();
        flash()->success("Deleted Sucssesfully");

        return redirect()->back();
    }

    public function approve(Request $request, Application $application)
    {
        $application->load("user");
        // dd($application);
        switch ($application->type) {
            case 'course_support':
                $course = Course::find($application->target_id);
                $application->user->courses()->syncWithoutDetaching($course);

                $application->update([
                    "state" => "Accpted",
                    "reviewed_at" => new DateTime()
                ]);
                $application->user->notify(new Support($application->user->name, $course, route("courses.show", $course->id), $application->state));
                flash()->success("Accpted Sucssesfully");
                return redirect()->back();

                break;
            case 'instructor_application':
                // dd("ssssssss");
                // dd(User::find($application->user_id));
                $user = $application->user;
                $isThereProf = Instructor::where("user_id", $user->id)->first();
                // dd($isThereProf);
                if ($isThereProf == null) {
                    Instructor::create([
                        "name" => $user->name,
                        "major" => $application->content["major"],
                        "personal_image" => $application->content["personal_image"] ?? $user->image,
                        "email" => $user->email,
                        "description" => $application->content["description"],
                        "phone" => $application->content["phone"],
                        "portfolio_link" => $application->content["portfolio_link"],
                        "user_id" => $user->id,
                        "job_title" => $application->content["job_title"],
                    ]);
                    $user->syncRoles(["instructor"]);
                } else {
                    $user->syncRoles(["instructor"]);
                }
                $application->update([
                    "state" => "Accpted",
                    "reviewed_at" => now(),
                ]);

                $user->notify(new newRole("instructor", $user));
                flash()->success("Accpted Sucssesfully");
                return redirect()->back();

                break;
            default:
                abort(404);
                break;
        }
    }

    public function reject(Application $application)
    {
        $application->load("user");
        $user = User::find($application->user->id);

        $application->update([
            "state" => "rejected",
            "reviewed_at" => now(),
        ]);

        $user->notify(new newRole("instructor", $user));
        flash()->success("rejected Sucssesfully");
        return redirect()->back();
    }
}
