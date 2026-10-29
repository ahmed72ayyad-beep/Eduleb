@php
    $pages = [
        'overview' => 'Overview',
        'courses' => 'My courses',
        'students' => 'Students',
        'reviews' => 'Reviews',
        'lessons' => 'Lessons',
        'profile' => 'Profile',
        'course-form' => request()->query('mode') === 'edit' || isset($course) ? 'Edit course' : 'Create course',
    ];
    $activePage = request()->query('page', 'overview');
    if (!array_key_exists($activePage, $pages)) {
        $activePage = 'overview';
    }
    $instructorProfile = $instructor ?? null;
    $courseList = $courses ?? null;
    $reviewList = $reviews ?? null;
@endphp

<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between">
            <div>
                <p class="text-sm font-semibold uppercase tracking-wide text-emerald-700">Instructor workspace</p>
                <h1 class="mt-1 text-2xl font-bold text-slate-900">{{ $pages[$activePage] }}</h1>
                <p class="mt-1 text-sm text-slate-500">Welcome, {{ auth()->user()->name }}</p>
            </div>
            <a href="{{ route('instructor.courses.create') }}"
                class="inline-flex items-center justify-center gap-2 rounded-lg bg-indigo-700 px-4 py-2.5 text-sm font-semibold text-white hover:bg-indigo-800">
                <span aria-hidden="true">+</span> Create course
            </a>
        </div>
    </x-slot>

    <main class="min-h-screen bg-slate-50 px-4 py-8 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-7xl">
    <div class="space-y-8">
    <section class="relative isolate overflow-hidden rounded-xl bg-slate-900 px-6 py-8 text-white sm:px-10 sm:py-10"
        aria-labelledby="instructor-overview-heading">
        <div
            class="absolute inset-y-0 right-0 hidden w-1/2 border-l border-white/10 bg-gradient-to-l from-indigo-900/60 to-transparent md:block">
        </div>
        <div class="relative max-w-2xl">
            <p class="text-sm font-semibold uppercase tracking-widest text-emerald-300">Your teaching space</p>
            <h2 id="instructor-overview-heading" class="mt-3 text-3xl font-bold leading-tight sm:text-4xl">
                Welcome, {{ auth()->user()->name }}.
            </h2>
            <p class="mt-3 max-w-xl text-sm leading-6 text-slate-300">
                Keep your teaching profile, course activity, and learner feedback close at hand.
            </p>
            <div class="mt-6 flex flex-wrap gap-3">
                <a href="{{ route('instructor.courses') }}"
                    class="rounded-lg bg-emerald-300 px-4 py-2.5 text-sm font-bold text-slate-900 hover:bg-emerald-200">
                    View my courses
                </a>
                <a href="{{ route('instructor.reviews') }}"
                    class="rounded-lg border border-white/30 px-4 py-2.5 text-sm font-semibold text-white hover:bg-white/10">
                    View reviews
                </a>
            </div>
        </div>
    </section>

    <section aria-labelledby="teaching-summary-heading">
        <div class="mb-4">
            <p class="text-sm font-semibold uppercase tracking-wide text-emerald-700">Teaching summary</p>
            <h2 id="teaching-summary-heading" class="mt-1 text-xl font-bold text-slate-900">At a glance</h2>
        </div>
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-4">
            @foreach (['Courses', 'Enrolled students', 'Reviews', 'Average rating'] as $label)
                <article class="rounded-xl border border-slate-200 bg-white p-5">
                    <p class="text-sm font-medium text-slate-500">{{ $label }}</p>
                    <p class="mt-3 text-sm font-semibold text-slate-800">Not available</p>
                    <p class="mt-1 text-xs leading-5 text-slate-500">This dashboard view does not receive this data yet.
                    </p>
                </article>
            @endforeach
        </div>
    </section>

    <section aria-labelledby="recent-courses-heading">
        <div class="mb-4 flex flex-wrap items-end justify-between gap-3">
            <div>
                <p class="text-sm font-semibold uppercase tracking-wide text-emerald-700">Course activity</p>
                <h2 id="recent-courses-heading" class="mt-1 text-xl font-bold text-slate-900">Recent courses</h2>
            </div>
            <a href="{{ route('instructor.courses') }}"
                class="text-sm font-semibold text-indigo-700 hover:text-indigo-900">All courses &rarr;</a>
        </div>

        @if (isset($courses) && is_iterable($courses))
            @if (count($courses))
                <div class="grid grid-cols-1 gap-5 md:grid-cols-2 xl:grid-cols-3">
                    @foreach ($courses as $course)
                        <article class="overflow-hidden rounded-xl border border-slate-200 bg-white">
                            @if ($course->outer_image)
                                <img src="{{ asset($course->outer_image) }}" alt="{{ $course->title }}"
                                    class="h-40 w-full object-cover">
                            @else
                                <div class="flex h-40 items-end bg-slate-800 p-5 text-white">
                                    <span class="text-xs font-semibold uppercase tracking-widest">Course image not
                                        set</span>
                                </div>
                            @endif
                            <div class="space-y-3 p-5">
                                <div class="flex items-center justify-between gap-3">
                                    <span
                                        class="text-xs font-semibold uppercase tracking-wide text-emerald-700">{{ ucfirst($course->type) }}</span>
                                    <span
                                        class="text-sm font-bold text-slate-900">${{ number_format((float) $course->price, 2) }}</span>
                                </div>
                                <h3 class="text-lg font-bold text-slate-900">{{ $course->title }}</h3>
                                <p class="line-clamp-2 text-sm leading-6 text-slate-600">
                                    {{ $course->sub_title ?: $course->overview ?: $course->description }}</p>
                                <div
                                    class="flex flex-wrap gap-x-4 gap-y-1 border-t border-slate-100 pt-3 text-xs text-slate-500">
                                    @if ($course->duration)
                                        <span>{{ $course->duration }}</span>
                                    @endif
                                    <span>{{ $course->star_num }} / 5 rating</span>
                                </div>
                                <a href="{{ route('courses.show', $course) }}"
                                    class="text-sm font-semibold text-indigo-700 hover:text-indigo-900">View course
                                    &rarr;</a>
                            </div>
                        </article>
                    @endforeach
                </div>
            @else
                <div class="rounded-xl border border-dashed border-slate-300 bg-white px-6 py-8 text-center">
                    <p class="font-semibold text-slate-900">No courses to show</p>
                    <p class="mt-1 text-sm text-slate-600">There are no course records in the supplied collection.</p>
                </div>
            @endif
        @else
            <div class="rounded-xl border border-dashed border-slate-300 bg-white px-6 py-8 text-center">
                <p class="font-semibold text-slate-900">Course data is not connected to this view</p>
                <p class="mt-1 text-sm text-slate-600">The current instructor dashboard response does not supply a
                    course collection.</p>
            </div>
        @endif
    </section>

    <section aria-labelledby="recent-activity-heading">
        <div class="mb-4">
            <p class="text-sm font-semibold uppercase tracking-wide text-emerald-700">Learner feedback</p>
            <h2 id="recent-activity-heading" class="mt-1 text-xl font-bold text-slate-900">Recent activity</h2>
        </div>
        @if (isset($reviews) && is_iterable($reviews) && count($reviews))
            <div class="divide-y divide-slate-100 rounded-xl border border-slate-200 bg-white">
                @foreach ($reviews as $review)
                    <article class="flex flex-wrap items-start justify-between gap-3 p-4 sm:p-5">
                        <div class="min-w-0 flex-1">
                            <p class="line-clamp-2 text-sm leading-6 text-slate-700">{{ $review->content }}</p>
                            <p class="mt-2 text-xs text-slate-500">
                                {{ $review->created_at?->format('M j, Y') ?? 'Date unavailable' }}</p>
                        </div>
                        <span class="shrink-0 text-sm font-semibold text-amber-700">{{ $review->star_num }} / 5</span>
                    </article>
                @endforeach
            </div>
        @else
            <div class="rounded-xl border border-dashed border-slate-300 bg-white px-6 py-7 text-sm text-slate-600">
                Recent reviews or enrollment activity are not supplied to this dashboard view.
            </div>
        @endif
    </section>

    <section class="grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-3" aria-label="Instructor shortcuts">
        <a href="{{ route('instructor.students') }}"
            class="rounded-xl border border-slate-200 bg-white p-5 hover:border-indigo-300">
            <span class="text-xs font-semibold uppercase tracking-wide text-slate-500">Learners</span>
            <span class="mt-2 block text-lg font-bold text-slate-900">View enrolled students &rarr;</span>
        </a>
        <a href="{{ route('dashboard', ['page' => 'lessons']) }}"
            class="rounded-xl border border-slate-200 bg-white p-5 hover:border-indigo-300">
            <span class="text-xs font-semibold uppercase tracking-wide text-slate-500">Course materials</span>
            <span class="mt-2 block text-lg font-bold text-slate-900">Open lesson studio &rarr;</span>
        </a>
        <div class="rounded-xl border border-slate-200 bg-white p-5">
            <span class="text-xs font-semibold uppercase tracking-wide text-slate-500">Course setup</span>
            <p class="mt-2 text-lg font-bold text-slate-900">Create a course</p>
            <p class="mt-1 text-sm leading-5 text-slate-600">The existing create-course handler is not implemented.</p>
            <button type="button" disabled
                class="mt-4 cursor-not-allowed rounded-lg bg-slate-200 px-4 py-2.5 text-sm font-semibold text-slate-500">Unavailable</button>
        </div>
    </section>
</div>


        </div>
    </main>
</x-app-layout>
