<x-app-layout>
    <x-slot name="header">
        <div>
            <p class="text-sm font-semibold uppercase tracking-wide text-emerald-700">Instructor workspace</p>
            <h1 class="mt-1 text-2xl font-bold text-slate-900">Students</h1>
        </div>
    </x-slot>

    <main class="min-h-screen bg-slate-50 px-4 py-6 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-7xl">
            <section aria-labelledby="students-heading">
                <div class="mb-5">
                    <p class="text-sm font-semibold uppercase tracking-wide text-emerald-700">Course enrollment</p>
                    <h2 id="students-heading" class="mt-1 text-xl font-bold text-slate-900">Students</h2>
                </div>

                @if (isset($courses) && is_iterable($courses))
                    @if (count($courses))
                        <div class="space-y-4">
                            @foreach ($courses as $course)
                                <section class="overflow-hidden rounded-xl border border-slate-200 bg-white"
                                    aria-label="Students in {{ $course->title }}">
                                    <div
                                        class="flex flex-wrap items-center justify-between gap-2 border-b border-slate-100 px-4 py-3 sm:px-5">
                                        <h3 class="font-semibold text-slate-900">{{ $course->title }}</h3>
                                        @if ($course->relationLoaded('students'))
                                            <span
                                                class="text-xs text-slate-500">{{ $course->getRelation('students')->count() }}
                                                enrolled</span>
                                        @else
                                            <span class="text-xs text-slate-500">Enrollment data not supplied</span>
                                        @endif
                                    </div>
                                    @if ($course->relationLoaded('students') && $course->getRelation('students')->isNotEmpty())
                                        <ul class="divide-y divide-slate-100">
                                            @foreach ($course->getRelation('students') as $student)
                                                <li class="flex items-center gap-3 px-4 py-3 sm:px-5">
                                                    @if ($student->image)
                                                        <img src="{{ asset($student->image) }}" alt=""
                                                            class="h-10 w-10 rounded-full object-cover">
                                                    @else
                                                        <span
                                                            class="flex h-10 w-10 items-center justify-center rounded-full bg-indigo-100 text-sm font-bold text-indigo-800"
                                                            aria-hidden="true">{{ strtoupper(substr($student->name, 0, 1)) }}</span>
                                                    @endif
                                                    <div class="min-w-0 flex-1">
                                                        <p class="truncate text-sm font-semibold text-slate-900">
                                                            {{ $student->name }}</p>
                                                        <p class="truncate text-xs text-slate-500">{{ $student->email }}
                                                        </p>
                                                    </div>
                                                    @if ($student->pivot?->state)
                                                        <span
                                                            class="text-xs font-medium text-slate-600">{{ ucfirst($student->pivot->state) }}</span>
                                                    @endif
                                                    @forelse ($student->reviews as $review)
                                                        @if ($review->course_id == $course->id)
                                                            <span
                                                                class="inline-flex items-center gap-1 text-xs font-bold text-amber-500 bg-amber-50 px-2.5 py-1 rounded-lg">
                                                                ⭐ {{ $review->star_num }}
                                                            </span>
                                                        @endif
                                                    @empty
                                                        <span class="text-xs font-medium text-red-600">Did't Rate
                                                            Yet</span>
                                                    @endforelse
                                                </li>
                                            @endforeach
                                        </ul>
                                    @elseif ($course->relationLoaded('students'))
                                        <p class="px-4 py-5 text-sm text-slate-500 sm:px-5">No students are enrolled in
                                            this course.
                                        </p>
                                    @else
                                        <p class="px-4 py-5 text-sm text-slate-500 sm:px-5">The existing students
                                            relationship was
                                            not supplied to this view.</p>
                                    @endif
                                </section>
                            @endforeach
                        </div>
                    @else
                        <div
                            class="rounded-xl border border-dashed border-slate-300 bg-white px-6 py-10 text-center text-sm text-slate-600">
                            No course records were supplied.</div>
                    @endif
                @else
                    <div
                        class="rounded-xl border border-dashed border-slate-300 bg-white px-6 py-10 text-center text-sm text-slate-600">
                        Enrollment details are unavailable because the current instructor route does not supply courses.
                    </div>
                @endif
            </section>
        </div>
    </main>
</x-app-layout>
