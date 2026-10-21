<x-app-layout>
    <x-slot name="header">
        <a href="{{ url('/student/courses') }}" class="text-sm font-semibold text-indigo-700 hover:text-indigo-900">&larr;
            My courses</a>
        <h1 class="mt-2 text-2xl font-bold text-slate-900">{{ $course->title }}</h1>
    </x-slot>

    <main class="min-h-screen bg-slate-50 px-4 py-8 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-7xl">
            <div class="grid grid-cols-1 gap-8 lg:grid-cols-3">
                <div class="space-y-6 lg:col-span-2">
                    <div class="overflow-hidden rounded-xl border border-slate-200 bg-white">
                        <div class="aspect-[16/8] bg-slate-200">
                            @if ($course->inner_image)
                                <img src="{{ asset($course->inner_image) }}" alt="{{ $course->title }}"
                                    class="h-full w-full object-cover">
                            @else
                                <div
                                    class="flex h-full items-end bg-gradient-to-br from-indigo-800 via-indigo-700 to-slate-900 p-6 text-white">
                                    <span class="text-sm font-semibold uppercase tracking-widest">Eduleb learning</span>
                                </div>
                            @endif
                        </div>
                        <div class="p-6 sm:p-8">
                            <p class="text-sm font-semibold uppercase tracking-wide text-emerald-700">
                                {{ $course->type ?? 'Course' }}</p>
                            <h2 class="mt-2 text-2xl font-bold text-slate-900 sm:text-3xl">{{ $course->title }}</h2>
                            @if ($course->sub_title)
                                <p class="mt-2 text-lg text-slate-600">{{ $course->sub_title }}</p>
                            @endif
                            <div class="mt-5 flex flex-wrap gap-x-6 gap-y-2 text-sm text-slate-500">
                                <span>{{ $course->duration ?? 'Flexible duration' }}</span>
                                <span>{{ $course->total_lectures ?? 'Multiple' }} lessons</span>
                                <span>{{ $course->date ?? 'On demand' }}</span>
                            </div>
                        </div>
                    </div>

                    <section class="rounded-xl border border-slate-200 bg-white p-6 sm:p-8">
                        <h2 class="text-lg font-bold text-slate-900">About this course</h2>
                        <p class="mt-3 whitespace-pre-line text-sm leading-7 text-slate-600">
                            {{ $course->overview ?: ($course->description ?: 'Course information will appear here.') }}
                        </p>
                    </section>

                    <section class="rounded-xl border border-slate-200 bg-white p-6 sm:p-8">
                        <h2 class="text-lg font-bold text-slate-900">Course outline</h2>
                        <p class="mt-3 whitespace-pre-line text-sm leading-7 text-slate-600">
                            {{ $course->curriculum ?: 'The course outline will be available soon.' }}</p>
                    </section>

                    <section class="rounded-xl border border-slate-200 bg-white p-6 sm:p-8">
                        <div class="flex items-center justify-between gap-4">
                            <h2 class="text-lg font-bold text-slate-900">Learner reviews</h2>
                            <span class="text-sm text-slate-500">{{ $course->reviews->count() }} total</span>
                        </div>
                        <div class="mt-5 space-y-5">
                            @forelse ($course->reviews as $review)
                                <article class="border-t border-slate-100 pt-5 first:border-0 first:pt-0">
                                    <div class="flex items-center justify-between gap-4">
                                        <p class="font-semibold text-slate-900">{{ $review->user->name }}</p>
                                        <p class="text-sm font-semibold text-amber-600">{{ $review->star_num }}/5 stars
                                        </p>
                                    </div>
                                    <p class="mt-2 text-sm leading-6 text-slate-600">{{ $review->content }}</p>
                                </article>
                            @empty
                                <p class="border-t border-slate-100 pt-5 text-sm text-slate-500">No reviews yet.</p>
                            @endforelse
                        </div>
                    </section>
                </div>

                <aside class="space-y-5">
                    <section class="rounded-xl border border-slate-200 bg-white p-6">
                        <p class="text-sm font-semibold uppercase tracking-wide text-slate-500">Your instructor</p>
                        @if ($course->instructor)
                            <h2 class="mt-3 text-lg font-bold text-slate-900">{{ $course->instructor->name }}</h2>
                            <p class="mt-1 text-sm text-emerald-700">{{ $course->instructor->major }}</p>
                            <p class="mt-3 text-sm leading-6 text-slate-600">{{ $course->instructor->description }}</p>
                        @else
                            <p class="mt-3 text-sm text-slate-600">Instructor details will be added soon.</p>
                        @endif
                    </section>
                    <section class="rounded-xl border border-slate-200 bg-white p-6">
                        <p class="text-sm font-semibold uppercase tracking-wide text-slate-500">Course information</p>
                        <dl class="mt-4 space-y-3 text-sm">
                            <div class="flex justify-between gap-4">
                                <dt class="text-slate-500">Price</dt>
                                <dd class="font-semibold text-slate-900">{{ $course->price }} $</dd>
                            </div>
                            <div class="flex justify-between gap-4">
                                <dt class="text-slate-500">Seats</dt>
                                <dd class="font-semibold text-slate-900">{{ $course->available_seats ?? 'Open' }}</dd>
                            </div>
                            <div class="flex justify-between gap-4">
                                <dt class="text-slate-500">Format</dt>
                                <dd class="font-semibold text-slate-900">{{ $course->type ?? 'Online' }}</dd>
                            </div>
                        </dl>
                        <a href="{{ route('courses.show', $course) }}"
                            class="mt-6 inline-flex w-full justify-center rounded-lg border border-slate-300 px-4 py-2.5 text-sm font-bold text-slate-800 hover:border-indigo-400 hover:text-indigo-700">Open
                            course page</a>
                    </section>
                </aside>
            </div>
        </div>
    </main>
</x-app-layout>
