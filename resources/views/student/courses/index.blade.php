<x-app-layout>
    <x-slot name="header">
        <p class="text-sm font-semibold uppercase tracking-wide text-indigo-600">Student dashboard</p>
        <h1 class="mt-1 text-2xl font-bold text-slate-900">My courses</h1>
    </x-slot>

    @php
        $student = auth()->user();
        $enrolledCourses = $courses ?? $student->courses;
    @endphp

    <main class="min-h-screen bg-slate-50 px-4 py-8 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-7xl">
            <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between">
                <div>
                    <p class="text-sm text-slate-500">A home for everything you are learning.</p>
                    <h2 class="mt-1 text-xl font-bold text-slate-900">{{ $enrolledCourses->count() }}
                        {{ \Illuminate\Support\Str::plural('course', $enrolledCourses->count()) }} enrolled</h2>
                </div>
                <a href="{{ route('courses.index') }}"
                    class="inline-flex w-fit items-center gap-2 rounded-lg border border-slate-300 bg-white px-4 py-2.5 text-sm font-semibold text-slate-800 hover:border-indigo-400 hover:text-indigo-700">Explore
                    catalog <span aria-hidden="true">&rarr;</span></a>
            </div>

            @if ($enrolledCourses->isNotEmpty())
                <div class="grid grid-cols-1 gap-5 md:grid-cols-2 xl:grid-cols-3">
                    @foreach ($enrolledCourses as $course)
                        <article class="overflow-hidden rounded-xl border border-slate-200 bg-white">
                            <div class="h-44 bg-slate-200">
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
                                <div class="flex items-center justify-between gap-3">
                                    <p class="text-xs font-semibold uppercase tracking-wide text-emerald-700">
                                        {{ $course->instructor->name ?? 'Eduleb instructor' }}</p>
                                    <span
                                        class="shrink-0 rounded-full bg-slate-100 px-2.5 py-1 text-xs font-semibold text-slate-600">{{ $course->total_lectures ?? 'Self-paced' }}{{ $course->total_lectures ? ' lessons' : '' }}</span>
                                </div>
                                <h3 class="mt-3 text-lg font-bold text-slate-900">{{ $course->title }}</h3>
                                <p class="mt-2 line-clamp-3 text-sm leading-6 text-slate-600">
                                    {{ $course->sub_title ?? $course->description }}</p>
                                <div class="mt-5 flex flex-wrap items-center justify-between gap-3 border-t border-slate-100 pt-4">
                                    <span
                                        class="text-xs text-slate-500">{{ $course->duration ?? 'Learn at your pace' }}</span>
                                    <div class="flex flex-wrap items-center gap-3">
                                        <a href="{{ route('student.myCourses.show', $course->id) }}"
                                            class="text-sm font-bold text-indigo-700 hover:text-indigo-900">Course details
                                            &rarr;</a>
                                            <form action="{{ route("enrollments.refund") }}"></form>
                                        <button type="button"
                                            class="rounded-md border border-red-300 px-3 py-1.5 text-sm font-semibold text-red-700 hover:border-red-400 hover:bg-red-50">
                                            Cancel enrollment
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>
            @else
                <section class="rounded-xl border border-dashed border-slate-300 bg-white px-6 py-14 text-center">
                    <span
                        class="mx-auto flex h-12 w-12 items-center justify-center rounded-full bg-emerald-100 text-xl font-bold text-emerald-800"
                        aria-hidden="true">+</span>
                    <h2 class="mt-4 text-xl font-bold text-slate-900">No enrolled courses yet</h2>
                    <p class="mx-auto mt-2 max-w-md text-sm leading-6 text-slate-600">Find a topic you are curious about
                        and add your first course to your learning plan.</p>
                    <a href="{{ route('courses.index') }}"
                        class="mt-5 inline-flex rounded-lg bg-indigo-700 px-4 py-2.5 text-sm font-bold text-white hover:bg-indigo-800">Browse
                        courses</a>
                </section>
            @endif
        </div>
    </main>
</x-app-layout>
