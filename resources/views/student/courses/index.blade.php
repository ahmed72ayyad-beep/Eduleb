<x-app-layout>
    <x-slot name="header">
        <p class="text-xs font-bold uppercase tracking-widest text-emerald-700">Student dashboard</p>
        <h1 class="mt-1 w-fit border-b-2 border-amber-500 pb-1 text-2xl font-bold text-slate-900">My courses</h1>
    </x-slot>

    @php
        $student = auth()->user();
        $enrolledCourses = $courses ?? $student->courses;
    @endphp

    <main
        class="min-h-screen bg-gradient-to-b from-emerald-50 via-slate-50 to-[#f4f7f2] px-4 py-8 sm:px-6 sm:py-10 lg:px-8">
        <div class="mx-auto max-w-7xl">
            <div
                class="mb-8 grid gap-5 border-b border-emerald-900/10 pb-7 sm:grid-cols-[minmax(0,1fr)_auto] sm:items-end">
                <div class="border-l-[3px] border-amber-500 pl-4 sm:pl-5">
                    <p class="text-xs font-bold uppercase tracking-widest text-emerald-800">Your learning, in progress
                    </p>
                    <h2 class="mt-2 text-2xl font-bold leading-tight text-slate-950 sm:text-3xl">Pick up where you left
                        off.</h2>
                    <p class="mt-3 inline-flex items-center gap-2 text-sm font-medium text-slate-600">
                        <span
                            class="inline-flex h-8 min-w-8 items-center justify-center rounded-sm bg-amber-100 px-2 text-sm font-bold text-amber-900">{{ $enrolledCourses->count() }}</span>
                        {{ \Illuminate\Support\Str::plural('course', $enrolledCourses->count()) }} in your learning plan
                    </p>
                </div>
                <a href="{{ route('courses.index') }}"
                    class="inline-flex w-fit items-center gap-2 rounded-md bg-emerald-800 px-4 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-emerald-900 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-emerald-800 sm:justify-self-end">Explore
                    catalog <span aria-hidden="true">&rarr;</span></a>
            </div>

            @if ($enrolledCourses->isNotEmpty())
                <div class="grid grid-cols-1 items-stretch gap-5 md:grid-cols-2 xl:grid-cols-3">
                    @foreach ($enrolledCourses as $course)
                        <article
                            class="group flex h-full flex-col overflow-hidden rounded-lg border border-slate-200 border-t-2 border-t-emerald-700 bg-white shadow-sm transition duration-200 hover:-translate-y-1 hover:shadow-lg">
                            <div class="relative aspect-[16/9] overflow-hidden bg-slate-200">
                                @if ($course->outer_image)
                                    <img src="{{ asset($course->outer_image) }}" alt="{{ $course->title }}"
                                        class="h-full w-full object-cover transition duration-500 group-hover:scale-105">
                                @else
                                    <div
                                        class="flex h-full flex-col justify-between bg-gradient-to-br from-emerald-900 via-emerald-800 to-teal-700 p-5 text-white">
                                        <span
                                            class="text-xs font-bold uppercase tracking-widest text-emerald-100">Eduleb
                                            / Learning</span>
                                        <span
                                            class="line-clamp-2 text-xl font-bold leading-snug">{{ $course->title }}</span>
                                    </div>
                                @endif
                                <span
                                    class="absolute left-4 top-4 rounded-sm bg-white/95 px-2.5 py-1 text-xs font-bold capitalize text-emerald-900 shadow-sm">
                                    {{ $course->pivot->state }}
                                </span>
                            </div>
                            <div class="flex flex-1 flex-col p-5">
                                <div class="flex flex-wrap items-center justify-between gap-2">
                                    <p
                                        class="min-w-0 truncate text-xs font-semibold uppercase tracking-wide text-emerald-800">
                                        {{ $course->instructor->name ?? 'Eduleb instructor' }}</p>
                                    <span
                                        class="shrink-0 rounded-sm bg-emerald-50 px-2.5 py-1 text-xs font-semibold text-emerald-900">{{ $course->total_lectures ?? 'Self-paced' }}{{ $course->total_lectures ? ' lessons' : '' }}</span>
                                </div>
                                <h3 class="mt-3 min-h-14 line-clamp-2 text-lg font-bold leading-7 text-slate-950">
                                    {{ $course->title }}</h3>
                                <p class="mt-2 min-h-[4.5rem] line-clamp-3 text-sm leading-6 text-slate-600">
                                    {{ $course->sub_title ?? $course->description }}</p>

                                <div
                                    class="mt-auto flex flex-wrap items-center justify-between gap-3 border-t border-slate-100 pt-4">
                                    <span
                                        class="text-xs font-medium text-slate-500">{{ $course->duration ?? 'Learn at your pace' }}</span>
                                    <div class="flex flex-wrap items-center gap-2">
                                        <a href="{{ route('student.myCourses.show', $course->id) }}"
                                            class="inline-flex items-center gap-1 rounded-md bg-emerald-800 px-3 py-2 text-sm font-bold text-white transition hover:bg-emerald-900 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-emerald-800">
                                            <span> Course details</span>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                                viewBox="0 0 24 24" fill="none">
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                    d="M13.4697 5.46967C13.7626 5.17678 14.2374 5.17678 14.5303 5.46967L20.5303 11.4697C20.8232 11.7626 20.8232 12.2374 20.5303 12.5303L14.5303 18.5303C14.2374 18.8232 13.7626 18.8232 13.4697 18.5303C13.1768 18.2374 13.1768 17.7626 13.4697 17.4697L18.1893 12.75H4C3.58579 12.75 3.25 12.4142 3.25 12C3.25 11.5858 3.58579 11.25 4 11.25H18.1893L13.4697 6.53033C13.1768 6.23744 13.1768 5.76256 13.4697 5.46967Z"
                                                    fill="currentColor" />
                                            </svg></a>
                                        {{-- @dd($course->pivot->id) --}}
                                        <form action="{{ route('enrollments.refund', $course->pivot->id) }}">
                                            <button type="button"
                                                class="rounded-md border border-rose-200 px-3 py-2 text-sm font-semibold text-rose-700 transition hover:border-rose-300 hover:bg-rose-50 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-rose-700">
                                                Cancel enrollment
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>
            @else
                <section
                    class="rounded-lg border border-dashed border-emerald-300 bg-white px-6 py-14 text-center shadow-sm">
                    <span
                        class="mx-auto flex h-12 w-12 items-center justify-center rounded-full bg-emerald-100 text-xl font-bold text-emerald-800"
                        aria-hidden="true">+</span>
                    <h2 class="mt-4 text-xl font-bold text-slate-950">No enrolled courses yet</h2>
                    <p class="mx-auto mt-2 max-w-md text-sm leading-6 text-slate-600">Find a topic you are curious about
                        and add your first course to your learning plan.</p>
                    <a href="{{ route('courses.index') }}"
                        class="mt-5 inline-flex rounded-md bg-emerald-800 px-4 py-2.5 text-sm font-bold text-white transition hover:bg-emerald-900 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-emerald-800">Browse
                        courses</a>
                </section>
            @endif
        </div>
    </main>
</x-app-layout>
