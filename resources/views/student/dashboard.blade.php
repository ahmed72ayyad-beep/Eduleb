<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-1 sm:flex-row sm:items-end sm:justify-between">
            <div>
                <p class="text-sm font-semibold uppercase tracking-wide text-indigo-600">Your learning space</p>
                <h1 class="mt-1 text-2xl font-bold text-slate-900">Welcome back, {{ auth()->user()->name }}</h1>
            </div>
            <a href="{{ route('courses.index') }}"
                class="text-sm font-semibold text-indigo-700 hover:text-indigo-900">Explore courses <span
                    aria-hidden="true">&rarr;</span></a>
        </div>
    </x-slot>

    @php
        $student = auth()->user();
        $enrolledCourses = $courses ?? $student->courses;
        $studentReviews = $reviews ?? $student->reviews;
        $unreadCount = $student->unreadNotifications->count();
    @endphp

    <main class="min-h-screen bg-slate-50 px-4 py-8 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-7xl">
            {{-- @include('student.partials.navigation') --}}

            <section
                class="relative isolate overflow-hidden rounded-2xl bg-slate-900 px-6 py-8 text-white sm:px-10 sm:py-10">
                <div
                    class="absolute inset-y-0 right-0 hidden w-1/2 bg-gradient-to-l from-indigo-800/70 to-transparent md:block">
                </div>
                <div class="relative max-w-2xl">
                    <p class="text-sm font-semibold uppercase tracking-widest text-emerald-300">Keep your momentum</p>
                    <h2 class="mt-3 text-3xl font-bold leading-tight sm:text-4xl">Small lessons. Real progress.</h2>
                    <p class="mt-3 max-w-xl text-sm leading-6 text-slate-300">Pick up where you left off or find a new
                        subject that moves you forward.</p>
                    <a href="{{ route('courses.index') }}"
                        class="mt-6 inline-flex items-center gap-2 rounded-lg bg-emerald-300 px-4 py-2.5 text-sm font-bold text-slate-900 transition hover:bg-emerald-200">Browse
                        courses <span aria-hidden="true">&rarr;</span></a>
                </div>
                <div class="absolute -bottom-12 right-8 hidden h-40 w-40 rotate-12 border border-white/10 md:block">
                </div>
                <div
                    class="absolute -bottom-8 right-28 hidden h-28 w-28 -rotate-12 border border-emerald-300/30 md:block">
                </div>
            </section>

            <section class="mt-6 grid grid-cols-1 gap-4 sm:grid-cols-3" aria-label="Learning summary">
                <div class="rounded-xl border border-slate-200 bg-white p-5">
                    <p class="text-sm font-medium text-slate-500">Enrolled courses</p>
                    <p class="mt-2 text-3xl font-bold text-slate-900">{{ $enrolledCourses->count() }}</p>
                    <a href="{{ url('/student/courses') }}"
                        class="mt-3 inline-block text-sm font-semibold text-indigo-700 hover:text-indigo-900">View
                        learning plan &rarr;</a>
                </div>
                <div class="rounded-xl border border-slate-200 bg-white p-5">
                    <p class="text-sm font-medium text-slate-500">Reviews written</p>
                    <p class="mt-2 text-3xl font-bold text-slate-900">{{ $studentReviews->count() }}</p>
                    <a href="{{ url('/student/reviews') }}"
                        class="mt-3 inline-block text-sm font-semibold text-indigo-700 hover:text-indigo-900">See your
                        reviews &rarr;</a>
                </div>
                <div class="rounded-xl border border-slate-200 bg-white p-5">
                    <p class="text-sm font-medium text-slate-500">Unread notifications</p>
                    <p class="mt-2 text-3xl font-bold text-slate-900">{{ $unreadCount }}</p>
                    <a href="{{ url('/student/notifications') }}"
                        class="mt-3 inline-block text-sm font-semibold text-indigo-700 hover:text-indigo-900">Open
                        notifications &rarr;</a>
                </div>
            </section>

            <section class="mt-10">
                <div class="mb-4 flex items-center justify-between gap-4">
                    <div>
                        <p class="text-sm font-semibold uppercase tracking-wide text-emerald-700">Your classroom</p>
                        <h2 class="mt-1 text-xl font-bold text-slate-900">Continue learning</h2>
                    </div>
                    <a href="{{ url('/student/courses') }}"
                        class="text-sm font-semibold text-indigo-700 hover:text-indigo-900">All courses &rarr;</a>
                </div>

                @if ($enrolledCourses->isNotEmpty())
                    <div class="grid grid-cols-1 gap-5 md:grid-cols-2 xl:grid-cols-3">
                        @foreach ($enrolledCourses->take(3) as $course)
                            <article class="overflow-hidden rounded-xl border border-slate-200 bg-white">
                                <div class="h-36 bg-slate-200">
                                    @if ($course->outer_image)
                                        <img src="{{ asset($course->outer_image) }}" alt="{{ $course->title }}"
                                            class="h-full w-full object-cover">
                                    @else
                                        <div
                                            class="flex h-full items-end bg-gradient-to-br from-indigo-700 to-slate-900 p-5 text-white">
                                            <span class="text-xs font-semibold uppercase tracking-widest">Eduleb
                                                course</span></div>
                                    @endif
                                </div>
                                <div class="p-5">
                                    <p class="text-xs font-semibold uppercase tracking-wide text-emerald-700">
                                        {{ $course->instructor->name ?? 'Eduleb instructor' }}</p>
                                    <h3 class="mt-2 text-lg font-bold text-slate-900">{{ $course->title }}</h3>
                                    <p class="mt-2 line-clamp-2 text-sm leading-6 text-slate-600">
                                        {{ $course->sub_title ?? $course->description }}</p>
                                    <a href="{{ url('/student/courses/' . $course->id) }}"
                                        class="mt-4 inline-flex items-center gap-2 text-sm font-bold text-indigo-700 hover:text-indigo-900">Open
                                        course <span aria-hidden="true">&rarr;</span></a>
                                </div>
                            </article>
                        @endforeach
                    </div>
                @else
                    <div class="rounded-xl border border-dashed border-slate-300 bg-white px-6 py-10 text-center">
                        <p class="text-lg font-semibold text-slate-900">Your first course is waiting</p>
                        <p class="mt-2 text-sm text-slate-600">Explore the catalog and enroll in a course to start
                            building your learning plan.</p>
                        <a href="{{ route('courses.index') }}"
                            class="mt-5 inline-flex rounded-lg bg-indigo-700 px-4 py-2.5 text-sm font-bold text-white hover:bg-indigo-800">Explore
                            courses</a>
                    </div>
                @endif
            </section>
        </div>
    </main>
</x-app-layout>
