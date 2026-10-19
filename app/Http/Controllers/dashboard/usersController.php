<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Instructor;
use App\Models\User;
use App\Notifications\newRole;
use Illuminate\Http\Request;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Spatie\Permission\Models\Role;

class usersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::with(["courses"])->get();
        $roles = Role::all();
        // dd($users);
        return view("dashboard.usersManagement.index", compact("users", "roles"));
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
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {

        if ($user->image != null) {
            File::delete($user->image);
        }

        $user->delete();
        return redirect()->back();
    }
    public function update_role(Request $request)
    {
        $user = User::find($request->user_id);
        if ($request->role == "instructor") {
            // dd(Instructor::where("user_id",$request->user_id)->first());
            if (Instructor::where("user_id", $request->user_id)->first() != null) {
                $user->syncRoles([$request->role]);
                $user->notify(new newRole($request->role, $user));
            } else {
                $user->notify(new newRole($request->role, $user,route("dashboard.instractors.create")));
            }
        } else {
            $user->syncRoles([$request->role]);
            $user->notify(new newRole($request->role, $user));
        }
    }


    public function search(string $user)
    {
        $users = User::where("name", "like", "%" . $user . "%")->orWhere("id", $user)->get();
        return $users;
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
}
