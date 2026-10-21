<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCourseRequest;
use App\Http\Requests\UpdateCourseRequest;
use App\Models\Course;
use App\Notifications\courseEnroll;
use Illuminate\Http\Request; // تأكد أنها Illuminate\Http\Request وليست Support\Facades\Request
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Stripe\Stripe;
use Stripe\Checkout\Session; // مهم جداً لاستخدام جلسات سترايب

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $courses = Course::with(["reviews.user", "tags", "instructor"])->latest()->get();

        foreach ($courses as $course) {
            $total = 0;
            $reviews_num = $course->reviews->count();
            if ($reviews_num != 0) {
                foreach ($course->reviews as $review) {
                    $total += $review->star_num;
                }

                $course->update([
                    "star_num" => $total / $course->reviews->count(),
                ]);
            }
        }
        return view("Course.courses", compact('courses'));
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
    public function store(StoreCourseRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Course $course)
    {
        $course->load(["reviews.user", "tags.courses", "instructor", "students"]);

        $related_courses = Course::where("type", "like", $course->type)->where("id", "!=", $course->id)->get();
        return view("Course.course_details", compact("course", "related_courses"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Course $course)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCourseRequest $request, Course $course)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course $course)
    {
        //
    }

    /**
     * Handle course enrollment and redirect to Stripe Checkout.
     */
    public function course_enrollment(Request $request, Course $course)
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));

        try {
            $session = Session::create([
                'line_items' => [[
                    'price_data' => [
                        'currency' => 'usd',
                        'product_data' => [
                            'name' => $course->title,
                        ],
                        'unit_amount' => $course->price * 100, // السعر بالسنت
                    ],
                    'quantity' => 1,
                ]],
                'mode' => 'payment',
                'success_url' => route('course.payment.success', ['course_id' => $course->id]),
                'cancel_url' => route('course.payment.cancel'),
            ]);

            return redirect()->away($session->url);
        } catch (\Exception $e) {
            return back()->with('error', "Check Your Data,Internet Connection");
        }
    }

    /**
     * Handle successful payment and store enrollment in course_user.
     */
    public function paymentSuccess(Request $request)
    {
        Auth::user()->courses()->syncWithoutDetaching($request->course_id);
        Auth::user()->notify(new courseEnroll(Auth::user()->name,Course::find($request->course_id)->title,route("student.myCourses")));

        return redirect()->route('dashboard')->with('success', 'Payment successful! You are now enrolled.');
    }
}
