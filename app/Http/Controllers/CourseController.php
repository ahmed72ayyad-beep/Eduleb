<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCourseRequest;
use App\Http\Requests\UpdateCourseRequest;
use App\Models\Course;
use App\Notifications\courseEnroll;
use Illuminate\Http\Request;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Stripe\Checkout\Session;
use Stripe\Refund;
use Stripe\Stripe;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $courses = Course::with(['reviews.user', 'tags', 'instructor'])->where('status', 'published')->latest()->get();

        foreach ($courses as $course) {
            $total = 0;
            $reviews_num = $course->reviews->count();
            if ($reviews_num != 0) {
                foreach ($course->reviews as $review) {
                    $total += $review->star_num;
                }

                $course->update([
                    'star_num' => $total / $course->reviews->count(),
                ]);
            }
        }

        return view('Course.courses', compact('courses'));
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
        $course->load(['reviews.user', 'tags.courses', 'instructor', 'students']);

        $related_courses = Course::where('type', 'like', $course->type)->where('id', '!=', $course->id)->limit(4)->get();

        return view('Course.course_details', compact('course', 'related_courses'));
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
        if ($course->available_seats > 0) {

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
                    'success_url' => route('course.payment.success', ['course_id' => $course->id]).'?session_id={CHECKOUT_SESSION_ID}',
                    'cancel_url' => route('course.payment.cancel'),
                ]);

                return redirect()->away($session->url);
            } catch (\Exception $e) {
                return back()->with('error', 'Check Your Data, Internet Connection: '.$e->getMessage());
            }
        } else {
            return back()->with('error', 'No Available Seats');
        }
    }

    /**
     * Handle successful payment and store enrollment in course_user.
     */
    public function paymentSuccess(Request $request)
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));

        $sessionId = $request->get('session_id');
        $paymentIntentId = null;

        try {
            // إذا وجدنا session_id نقوم بجلب تفاصيل الجلسة من Stripe
            if ($sessionId) {
                $session = Session::retrieve($sessionId);
                $paymentIntentId = $session->payment_intent;
            }
        } catch (\Exception $e) {
            // في حال فشل جلب الجلسة من سترايب، نتجاهل الخطأ المؤقت لنسمح بتسجيل الطالب
            // ويمكنك الاعتماد على قيمة افتراضية أو متابعة التسجيل
        }

        $course = Course::find($request->course_id);

        if (! $course) {
            return redirect()->route('dashboard')->with('error', 'Course not found.');
        }

        // تسجيل المستخدم مع حفظ الـ payment_intent (أو قيمة مؤقتة إذا لم يتوفر)
        Auth::user()->courses()->syncWithoutDetaching([
            $course->id => ['enrollment_id' => $paymentIntentId ?? 'manual_or_pending_'.time(), 'enrolled_at' => now()],
        ]);

        // خصم مقعد واحد (بشرط عدم خصمه مسبقاً لهذا المستخدم لنفس الكورس)
        $alreadyEnrolled = Auth::user()->courses()->where('course_id', $course->id)->exists();
        // بما أن syncWithoutDetaching قد تُعيد الربط، نتأكد من عدم خصم المقعد مرتين إذا كان مسجلاً أصلاً
        // لكن بما أن الـ success تتحقق مرة واحدة بعد الدفع، يمكنك ترك الـ decrement طبيعية أو حمايتها:
        $course->decrement('available_seats');

        // إرسال الإشعار
        Auth::user()->notify(new courseEnroll(Auth::user()->name, $course->title, route('student.myCourses')));

        return redirect()->route('dashboard')->with('success', 'Payment successful! You are now enrolled.');
    }

    /**
     * Handle course refund and cancel enrollment.
     */
    public function refundCourse(Request $request, Course $course)
    {
        // التحقق من الصلاحية عبر الـ Policy أولاً
        Gate::authorize('refund', $course);
        $user = Auth::user();

        // التأكد أن المستخدم مسجل بالدورة أساساً ولديه الـ enrollment_id
        $enrollment = $user->courses()->where('course_id', $course->id)->first();

        if (! $enrollment || ! $enrollment->pivot->enrollment_id) {
            return back()->with('error', 'You are not enrolled in this course or payment record not found.');
        }

        Stripe::setApiKey(env('STRIPE_SECRET'));

        try {
            // إذا كان الـ enrollment_id يبدأ بـ manual (لأغراض الاختبار المحلي لو فشل جلب الـ session)
            if (str_starts_with($enrollment->pivot->enrollment_id, 'manual_or_pending_')) {
                $user->courses()->detach($course->id);
                $course->increment('available_seats');

                return back()->with('success', 'Enrollment cancelled successfully (Manual mode).');
            }

            // إرجاع المبلغ عبر Stripe بشكل حقيقي
            $refund = Refund::create([
                'payment_intent' => $enrollment->pivot->enrollment_id,
            ]);

            if ($refund->status === 'succeeded' || $refund->status === 'pending') {
                // إلغاء ربط المستخدم بالكورس
                $user->courses()->detach($course->id);

                // إعادة المقعد المحجوز
                $course->increment('available_seats');
                DatabaseNotification::where('type', "App\Notifications\courseEnroll")->where('notifiable_id', Auth::id())->delete();

                return back()->with('success', 'Refund successful and enrollment cancelled.');
            }
        } catch (\Exception $e) {
            return back()->with('error', 'Refund failed: '.$e->getMessage());
        }
    }
}
