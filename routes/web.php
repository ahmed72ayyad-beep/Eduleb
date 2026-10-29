<?php

use App\Http\Controllers\BlogsController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\dashboard\ApplicationController;
use App\Http\Controllers\dashboard\blogController as dashboard_BlogController;
use App\Http\Controllers\dashboard\coursesController;
use App\Http\Controllers\dashboard\CoursesController as dashboard_CoursesController;
use App\Http\Controllers\dashboard\dashboardController;
use App\Http\Controllers\dashboard\FAQController as Dashboard_FAQController;
// use App\Http\Controllers\dashboard\instructorsController as dashboard_InstructorController;
use App\Http\Controllers\dashboard\instructorDashboardController;
use App\Http\Controllers\dashboard\StudentController;
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

Route::get('/dashboard', [dashboardController::class, 'index'])->name('dashboard')->middleware(['auth', 'verified']);

Route::prefix('dashboard')->name('dashboard.')->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('courses', [dashboard_CoursesController::class, 'index'])->name('courses.index');
    Route::get('courses/{value}/search', [dashboard_CoursesController::class, 'search'])->name('courses.index.search');
    Route::get('courses/create', [dashboard_CoursesController::class, 'create'])->name('courses.create');
    Route::get('courses/{course}/edit', [dashboard_CoursesController::class, 'edit'])->name('courses.edit');
    Route::put('courses/{course}', [dashboard_CoursesController::class, 'update'])->name('courses.update');
    Route::delete('courses/{course}', [dashboard_CoursesController::class, 'destroy'])->name('courses.destroy');
    Route::post('courses/create/', [dashboard_CoursesController::class, 'store'])->name('courses.store');
    Route::resource('users', usersController::class);
    Route::post('users/update_Role', [usersController::class, 'update_role'])->name('users.update_role');
    Route::get('users/{user}/search', [usersController::class, 'search'])->name('users.search');
    Route::resource('blogs', dashboard_BlogController::class);
    Route::get('/blogs/search/{query}', [dashboard_BlogController::class, 'search'])->name('blogs.search');
    Route::resource('FAQs', Dashboard_FAQController::class);
    Route::get('FAQs/{FAQ}/search', [Dashboard_FAQController::class, 'search'])->name('FAQs.search');
    Route::put('applications/approve/{application}', [ApplicationController::class, 'approve'])->name('application.approve');
    Route::put('applications/reject/{application}', [ApplicationController::class, 'reject'])->name('application.reject');
    // Route::
});

Route::prefix('dashboard')->name('dashboard.')->middleware(['auth'])->group(function () {
    Route::get('instructors/create', [InstructorController::class, 'create'])->name('instructors.create');
    Route::post('instructors/', [InstructorController::class, 'store'])->name('instructors.store');
    Route::delete(' instructors/{instructor}', [InstructorController::class, 'desapplications/troy'])->name('instructors.destroy');
});

Route::middleware('auth')->group(function () {

    Route::get('notify/{notify}/mark_as_readed', [mainController::class, 'mark_as_readed'])->name('notify.mark_as_readed');
    Route::delete('notify/{notify}/delete_notification', [mainController::class, 'delete_notification'])->name('notify.delete_notification');
    Route::get('instructors/apply', [InstructorController::class, 'instructor_apply'])->name('instructor.apply');
    Route::post('instructors/apply', [InstructorController::class, 'instructor_apply_data']);
});

Route::name('student.')->middleware('auth')->group(function () {
    Route::resource('applications', ApplicationController::class);
});
Route::prefix('student')->name('student.')->middleware(['auth', 'role:student'])->group(function () {
    // Route::get("overview/",[StudentController::class,"overview"])->name("overview");
    Route::get('myCourses/', [StudentController::class, 'myCourses'])->name('myCourses');
    Route::get('myCourses/{course}/', [StudentController::class, 'show'])->name('myCourses.show');
    Route::get('reviews/', [StudentController::class, 'reviews'])->name('reviews');
});
// Route::get("applications/", [ApplicationController::class, "applications"])->name("applications")->middleware("auth");
Route::get('notifications/', [StudentController::class, 'notifications'])->middleware('auth')->name('notifications');
Route::middleware(['auth', 'role:student'])->controller(CourseController::class)->group(function () {
    Route::post('courses/{course}/enroll', 'course_enrollment')->name('courses.enroll');
    Route::get('/courses/payment/success', [CourseController::class, 'paymentSuccess'])->name('course.payment.success');
    Route::delete('/enrollments/{enrollment}/refund', [coursesController::class, 'cancelAndRefund'])
        ->name('enrollments.refund');
    Route::get('/courses/payment/cancel', fn() => redirect()->route('dashboard')->with('error', 'Payment cancelled.'))->name('course.payment.cancel');
});

Route::prefix('instructor')->name('instructor.')->middleware(['auth', 'role:instructor'])->controller(instructorDashboardController::class)->group(function () {
    Route::get('students/', 'students')->name('students');
    Route::get('reviews/', 'reviews')->name('reviews');
    Route::get('courses/', 'courses')->name('courses');
    Route::get('courses/create', 'course_create')->name('courses.create');
    Route::get('courses/store', 'course_store')->name('courses.store');
    Route::get('lesson_studio/', 'lesson_studio')->name('lesson_studio');
});

Route::get('home/', [mainController::class, 'index'])->name('home');
Route::post('home/search', [mainController::class, 'search'])->name('home.search');
// Route::post("home/search_result", [mainController::class, 'search_result'])->name("home.search_result");
Route::get('about/', [mainController::class, 'about'])->name('about');
Route::get('FAQ/', [FAQController::class, 'index'])->name('FAQ.index');
Route::get('thank/', [mainController::class, 'thank'])->name('thank');
Route::get('contact/', [mainController::class, 'contact'])->name('contact');
Route::post('contact/', [mainController::class, 'contact_data']);
Route::get('pricing/', [mainController::class, 'pricing'])->name('pricing');

Route::get('instructors/', [InstructorController::class, 'index'])->name('instructors.index');
Route::get('instructors/{instructor}', [InstructorController::class, 'show'])->name('instructors.show');

Route::controller(CourseController::class)->group(function () {
    Route::get('courses/', 'index')->name('courses.index');
    Route::get('courses/{course}', 'show')->name('courses.show');
});

Route::resource('blogs', BlogsController::class);
Route::resource('blogs.comments', CommentController::class)->shallow();

Route::resource('/tags', TagController::class);
Route::get('dashboard/courses/instructors/{instructor}/search', [InstructorController::class, 'search'])->name('instructors.search');
Route::get('dashboard/courses/{course}/instructors/{instructor}/search', [InstructorController::class, 'search2'])->name('instructors.search2');

Route::resource('courses.review', ReviewController::class)->shallow();

// Route::resource("instructors",InstructorController::class);

Route::middleware('auth')->group(function () {
    Route::controller(CourseController::class)->group(function () {
        Route::get('courses/{course}/edit', 'edit')->name('courses.edit');
        // Route::get("courses/categories/{categorie}", 'show_categorie_courses')->name("courses.categories");
        Route::put('courses/{course}', 'update')->name('courses.update');
        Route::get('courses/create', 'create')->name('courses.create');
        Route::post('courses/', 'store')->name('courses.store');
        Route::delete('courses/{course}', 'destroy')->name('courses.destroy');
    });
    // Route::resource('blogs', BlogsController::class);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
require __DIR__ . '/auth.php';

// Route::get("sssss/",function () {
// return view('student.profile');
// });
