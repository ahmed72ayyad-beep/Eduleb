<?php

use App\Http\Controllers\BlogsController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\dashboard\blogController as dashboard_BlogController;
use App\Http\Controllers\dashboard\CoursesController as dashboard_CoursesController;
use App\Http\Controllers\dashboard\dashboardController;
use App\Http\Controllers\dashboard\FAQController as Dashboard_FAQController;
use App\Http\Controllers\dashboard\instructorsController as dashboard_InstructorController;
use App\Http\Controllers\dashboard\usersController;
use App\Http\Controllers\FAQController;
use App\Http\Controllers\InstructorController;
use App\Http\Controllers\mainController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\TagController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});




Route::get('/dashboard', [dashboardController::class, "index"])->name("dashboard")->middleware(['auth', 'verified']);


Route::prefix("dashboard")->name("dashboard.")->middleware("auth")->group(function () {
    Route::get("courses", [dashboard_CoursesController::class, "index"])->name("courses.index");
    Route::get("courses/{value}/search", [dashboard_CoursesController::class, "search"])->name("courses.index.search");
    Route::get("courses/create", [dashboard_CoursesController::class, "create"])->name("courses.create");
    Route::get("courses/{course}/edit", [dashboard_CoursesController::class, "edit"])->name("courses.edit");
    Route::put("courses/{course}", [dashboard_CoursesController::class, "update"])->name("courses.update");
    Route::delete("courses/{course}", [dashboard_CoursesController::class, "destroy"])->name("courses.destroy");
    Route::post("courses/create/", [dashboard_CoursesController::class, "store"])->name("courses.store");
    Route::resource('users', usersController::class);
    Route::post("users/update_Role", [usersController::class, "update_role"])->name("users.update_role");
    Route::get("users/{user}/search", [usersController::class, "search"])->name("users.search");
    Route::get("notify/{notify}/mark_as_readed", [usersController::class, "mark_as_readed"])->name("notify.mark_as_readed");
    Route::resource("instractors", dashboard_InstructorController::class);
    Route::resource("blogs", dashboard_BlogController::class);
    Route::get('/blogs/search/{query}', [dashboard_BlogController::class, 'search'])->name('blogs.search');

    Route::resource("FAQs", dashboard_FAQController::class);
    Route::get("FAQs/{FAQ}/search", [dashboard_FAQController::class, "search"])->name("FAQs.search");




});






Route::get("home/", [mainController::class, 'index'])->name("home");
Route::get("about/", [mainController::class, 'about'])->name("about");
Route::get("FAQ/", [FAQController::class, 'index'])->name("FAQ.index");
Route::get("thank/", [mainController::class, 'thank'])->name("thank");
Route::get("contact/", [mainController::class, 'contact'])->name("contact");
Route::post("contact/", [mainController::class, 'contact_data']);
Route::get("pricing/", [mainController::class, 'pricing'])->name("pricing");



Route::controller(CourseController::class)->group(function () {
    Route::get("courses/", 'index')->name("courses.index");
    Route::get("courses/{course}", 'show')->name("courses.show");
});

Route::resource("blogs", BlogsController::class);
Route::resource("blogs.comments", CommentController::class)->shallow();

Route::resource("/tags", TagController::class);
Route::resource('instractors', InstructorController::class);
Route::get("dashboard/courses/instructors/{instructor}/search", [InstructorController::class, "search"])->name("instructors.search");
Route::get("dashboard/courses/{course}/instructors/{instructor}/search", [InstructorController::class, "search2"])->name("instructors.search2");

Route::resource('courses.review', ReviewController::class)->shallow();





Route::middleware("auth")->group(function () {
    Route::controller(CourseController::class)->group(function () {
        Route::get("courses/{course}/edit", 'edit')->name("courses.edit");
        // Route::get("courses/categories/{categorie}", 'show_categorie_courses')->name("courses.categories");
        Route::put("courses/{course}", 'update')->name("courses.update");
        Route::get("courses/create", 'create')->name("courses.create");
        Route::post("courses/", 'store')->name("courses.store");
        Route::delete("courses/{course}", 'destroy')->name("courses.destroy");
        Route::get("courses/{course}/enroll", 'course_enrollment')->name("courses.enroll");
        Route::post("courses/{course}/enroll", 'course_enrollment_data');
    });
    // Route::resource('blogs', BlogsController::class);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
