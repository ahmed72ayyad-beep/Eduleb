<x-app-layout>
    <x-slot name="header">
        <div>
            <p class="text-sm font-semibold uppercase tracking-wide text-emerald-700">Instructor workspace</p>
            <h1 class="mt-1 text-2xl font-bold text-slate-900">My courses</h1>
        </div>
    </x-slot>

    <main class="min-h-screen bg-slate-50 px-4 py-6 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-7xl">
            <section aria-labelledby="courses-heading">
                <div class="mb-5 flex flex-wrap items-end justify-between gap-3">
                    <div>
                        <p class="text-sm font-semibold uppercase tracking-wide text-emerald-700">Teaching catalog</p>
                        <h2 id="courses-heading" class="mt-1 text-xl font-bold text-slate-900">My courses</h2>
                    </div>
                    <a href="{{ route('courses.index') }}"
                        class="rounded-lg border border-slate-300 bg-white px-4 py-2.5 text-sm font-semibold text-slate-700 hover:bg-slate-50">
                        Browse course catalog
                    </a>
                </div>

                @if (isset($courses) && is_iterable($courses))
                    @if (count($courses))
                        <div class="overflow-hidden rounded-xl border border-slate-200 bg-white">
                            <div class="divide-y divide-slate-100">
                                @foreach ($courses as $course)
                                    <article class="flex flex-col gap-4 p-4 sm:flex-row sm:items-center sm:p-5">
                                        @if ($course->outer_image)
                                            <img src="{{ asset($course->outer_image) }}" alt="{{ $course->title }}"
                                                class="h-20 w-full rounded-lg object-cover sm:w-32">
                                        @else
                                            <div
                                                class="flex h-20 w-full items-center justify-center rounded-lg bg-slate-100 text-xs font-semibold uppercase tracking-wide text-slate-600 sm:w-32">
                                                No image</div>
                                        @endif
                                        <div class="min-w-0 flex-1">
                                            <div class="flex flex-wrap items-center gap-2">
                                                <h3 class="font-bold text-slate-900">{{ $course->title }}</h3>
                                                <span
                                                    class="rounded bg-slate-100 px-2 py-1 text-xs font-medium text-slate-600">{{ ucfirst($course->type) }}</span>
                                            </div>
                                            <p class="mt-1 line-clamp-1 text-sm text-slate-600">
                                                {{ $course->sub_title ?: $course->overview ?: $course->description }}
                                            </p>
                                            <div class="mt-2 flex flex-wrap gap-x-4 gap-y-1 text-xs text-slate-500">
                                                <span>${{ number_format((float) $course->price, 2) }}</span>
                                                @if ($course->duration)
                                                    <span>{{ $course->duration }}</span>
                                                @endif
                                                @if ($course->total_lectures)
                                                    <span>{{ $course->total_lectures }} lectures</span>
                                                @endif
                                                <span>{{ $course->star_num }} / 5 ⭐ </span>
                                            </div>
                                        </div>
                                        <div class="flex flex-col gap-5">

                                            <a href="{{ route('courses.show', $course) }}"
                                                class="shrink-0 text-sm flex items-center justify-between gap-1 font-semibold text-indigo-700 hover:text-indigo-900">
                                                <span>
                                                    View
                                                    course
                                                </span>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                                    viewBox="0 0 24 24" fill="none">
                                                    <path
                                                        d="M 20.0106 8.1106 l 1.1747 -1.9213 c 0.288 -0.472 0.14 -1.0867 -0.3307 -1.3747 -0.472 -0.2867 -1.0867 -0.14 -1.3747 0.3307 l -1.2093 1.976 c -0.904 -0.4413 -1.8507 -0.784 -2.832 -1.0253 l 0.444 -2.2067 c 0.1093 -0.5413 -0.2427 -1.0693 -0.7827 -1.1773 -0.54 -0.104 -1.0693 0.2413 -1.1773 0.7827 l -0.452 2.2467 c -0.4853 -0.0493 -0.976 -0.076 -1.4707 -0.076 s -0.9853 0.0267 -1.4707 0.076 l -0.452 -2.2467 c -0.1093 -0.5413 -0.64 -0.888 -1.1773 -0.7827 -0.5413 0.1093 -0.892 0.636 -0.7827 1.1773 l 0.444 2.2067 c -0.9813 0.2413 -1.928 0.584 -2.832 1.0253 l -1.2093 -1.976 c -0.2867 -0.4707 -0.9027 -0.6173 -1.3747 -0.3307 -0.4707 0.288 -0.6187 0.904 -0.3307 1.3747 l 1.1747 1.9213 c -0.792 0.536 -1.5387 1.156 -2.224 1.856 -0.3867 0.3933 -0.38 1.028 0.0147 1.4147 0.3933 0.3867 1.0267 0.38 1.4147 -0.0147 2.3387 -2.3853 5.4667 -3.6987 8.8066 -3.6987 s 6.468 1.3133 8.8066 3.6987 c 0.196 0.2 0.4547 0.3 0.7147 0.3 0.252 0 0.5053 -0.0947 0.7 -0.2853 0.3947 -0.3867 0.4013 -1.02 0.0147 -1.4147 -0.6867 -0.7 -1.432 -1.32 -2.224 -1.856 Z"
                                                        fill="#94a3b8"></path>
                                                    <circle cx="12" cy="14" r="4.6667" fill="#94a3b8">
                                                    </circle>
                                                </svg>
                                            </a>
                                            <a href="{{ route('instructor.courses.lessons.create', $course) }}"
                                                class="shrink-0 flex items-center justify-between gap-1 text-sm font-semibold text-indigo-700 hover:text-indigo-900"><span>Add
                                                    Lesson</span> <svg xmlns="http://www.w3.org/2000/svg" width="18"
                                                    height="18" viewBox="0 0 24 24" fill="none">
                                                    <path
                                                        d="M11 20C11 20.5523 11.4477 21 12 21C12.5523 21 13 20.5523 13 20V13H20C20.5523 13 21 12.5523 21 12C21 11.4477 20.5523 11 20 11H13V4C13 3.44771 12.5523 3 12 3C11.4477 3 11 3.44771 11 4V11H4C3.44771 11 3 11.4477 3 12C3 12.5523 3.44771 13 4 13H11V20Z"
                                                        fill="#94a3b8" />
                                                </svg></a>
                                        </div>
                                    </article>
                                @endforeach
                            </div>
                        </div>
                    @else
                        <div class="rounded-xl border border-dashed border-slate-300 bg-white px-6 py-10 text-center">
                            <p class="text-lg font-semibold text-slate-900">No course records supplied</p>
                            <p class="mt-2 text-sm text-slate-600">This page does not query for courses; the current
                                instructor
                                response must provide them.</p>
                        </div>
                    @endif
                @else
                    <div class="rounded-xl border border-dashed border-slate-300 bg-white px-6 py-10 text-center">
                        <p class="text-lg font-semibold text-slate-900">Your course list is not available here</p>
                        <p class="mt-2 text-sm text-slate-600">The existing instructor route does not pass course data
                            to this view.
                        </p>
                    </div>
                @endif
            </section>
        </div>
    </main>
</x-app-layout>
