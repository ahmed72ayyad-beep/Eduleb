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
                                        <a href="{{ route('courses.show', $course) }}"
                                            class="shrink-0 text-sm font-semibold text-indigo-700 hover:text-indigo-900">View
                                            course</a>
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
