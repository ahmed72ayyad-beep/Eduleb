<x-app-layout>
    <x-slot name="header">
        <div>
            <p class="text-xs font-bold uppercase tracking-widest text-emerald-700">Student dashboard</p>
            <h1 class="mt-1 text-2xl font-bold text-slate-950">Course lessons</h1>
            <p class="mt-1 text-sm text-slate-600">{{ $course->title }}</p>
        </div>
    </x-slot>

    <main class="min-h-screen bg-gradient-to-b from-emerald-50 via-slate-50 to-[#f4f7f2] px-4 py-8 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-7xl space-y-6">
            <section
                class="overflow-hidden rounded-lg border border-slate-200 border-t-2 border-t-emerald-700 bg-white shadow-sm">
                <div class="grid md:grid-cols-[minmax(0,0.9fr)_minmax(0,1.1fr)]">
                    <div
                        class="flex min-h-56 items-end bg-gradient-to-br from-emerald-900 via-emerald-800 to-teal-700 p-6 text-white md:min-h-72">
                        <span class="text-xs font-bold uppercase tracking-widest">Eduleb / Learning</span>
                    </div>
                    <div class="p-6 sm:p-8">
                        <p class="text-xs font-bold uppercase tracking-widest text-emerald-800">Course</p>
                        <h2 class="mt-2 text-2xl font-bold leading-tight text-slate-950 sm:text-3xl">
                            {{ $course->title }}</h2>
                        <p class="mt-2 text-base leading-7 text-slate-600">{{ $course->sub_title }}</p>
                        <div class="mt-5 flex flex-wrap gap-x-6 gap-y-2 text-sm text-slate-500">
                            <span>{{ $course->duration }}</span>
                            <span>{{ $course->total_lectures }} lessons in Total</span>
                            <span>{{ $course->type }} Course</span>
                        </div>
                    </div>
                </div>
            </section>

            <div class="grid grid-cols-1 items-start gap-6 lg:grid-cols-3">
                <section aria-labelledby="lessons-heading"
                    class="overflow-hidden rounded-lg border border-slate-200 bg-white shadow-sm lg:col-span-2">
                    <div class="flex flex-wrap items-end justify-between gap-3 border-b border-slate-100 p-5 sm:p-6">
                        <div>
                            <p class="text-xs font-bold uppercase tracking-widest text-emerald-800">Course materials</p>
                            <h2 id="lessons-heading" class="mt-1 text-xl font-bold text-slate-950">Lessons</h2>
                        </div>
                        <span
                            class="rounded-sm bg-emerald-50 px-3 py-1.5 text-xs font-semibold text-emerald-900">{{ $course->LiveLectures->count() == 0 ? $course->Recordedlectures->count() : $course->LiveLectures->count() }}</span>
                    </div>

                    <div class="p-5 sm:p-6">
                        <div class="divide-y divide-slate-100 rounded-md border border-slate-200">
                            @if ($course->type == 'online')
                                @forelse ($course->LiveLectures as $lect)
                                    <details class="group">
                                        <summary
                                            class="flex cursor-pointer list-none items-center gap-3 p-4 focus-visible:outline focus-visible:outline-2 focus-visible:outline-emerald-800 sm:p-5">
                                            <span
                                                class="flex h-9 w-9 shrink-0 items-center justify-center text-lg font-bold ">Lesson
                                            </span>
                                            <span
                                                class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-emerald-50 text-sm font-bold text-emerald-900">{{ $loop->iteration }}</span>
                                            <span class="min-w-0 flex-1 font-bold text-slate-950">{{ $lect->title }}
                                                Development</span>
                                            <span
                                                class="shrink-0 rounded-sm bg-slate-100 px-2.5 py-1 text-xs font-semibold text-slate-600"><span
                                                    class="text-red-400">Start At
                                                    :</span>{{ $lect->starts_at->format('d-M H:i') }}
                                            </span>
                                            <svg class="h-5 w-5 shrink-0 text-slate-400 transition-transform group-open:rotate-180"
                                                viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                <path fill-rule="evenodd"
                                                    d="M5.22 7.47a.75.75 0 0 1 1.06 0L10 11.19l3.72-3.72a.75.75 0 1 1 1.06 1.06l-4.25 4.25a.75.75 0 0 1-1.06 0L5.22 8.53a.75.75 0 0 1 0-1.06Z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </summary>
                                        <div class="border-t border-slate-100 px-4 pb-4 pt-4 sm:px-5 sm:pb-5">
                                            <div class="space-y-4 pl-12">
                                                <p class="text-sm leading-6 text-slate-600">
                                                    {{ $lect->description ?? "The Instructor Did't Give Any description " }}
                                                </p>
                                                <div>
                                                    @if ($lect->starts_at && $lect->starts_at->isFuture())
                                                        <h3 class="flex gap-1">
                                                            <span class="text-slate-900">Live:</span>
                                                            <a class="text-blue-800 transition-all hover:text-blue-500 hover:scale-95"
                                                                href="{{ $lect->live_url }}" target="_blank">
                                                                Click Here
                                                            </a>
                                                        </h3>
                                                    @else
                                                        <h3 class="flex gap-1">
                                                            <span class="text-slate-900">Live:</span>
                                                            <span class="text-red-700">Finished</span>
                                                        </h3>
                                                    @endif
                                                    <h3 class="text-lg font-bold text-slate-900">In this lesson</h3>
                                                    <ul
                                                        class="mt-2 list-inside list-disc space-y-1 text-sm leading-6 text-slate-600">
                                                        <li class="flex gap-1">Silde : <a
                                                                class="text-blue-800 flex gap-1 transition-all hover:text-blue-500 hover:scale-95"
                                                                href="{{ asset($lect->slide) }}" target="_blank"> <span>Click Here </span>
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="20"
                                                                    height="20" viewBox="0 0 24 24" fill="none">
                                                                    <path
                                                                        d="M 20.6493 7.236 l -5.2187 -5.2187 c -0.4413 -0.4413 -1.0267 -0.684 -1.6493 -0.684 H 6.3333 c -2.0227 0 -3.6667 1.644 -3.6667 3.6667 V 19 c 0 2.0227 1.644 3.6667 3.6667 3.6667 H 17.6666 c 2.0227 0 3.6667 -1.644 3.6667 -3.6667 V 8.8853 c 0 -0.6227 -0.2427 -1.2093 -0.684 -1.6493 Z m -12.9826 0.764 h 2.6667 c 0.552 0 1 0.448 1 1 s -0.448 1 -1 1 h -2.6667 c -0.552 0 -1 -0.448 -1 -1 s 0.448 -1 1 -1 Z m 8.6666 10 H 7.6666 c -0.552 0 -1 -0.448 -1 -1 s 0.448 -1 1 -1 h 8.6666 c 0.552 0 1 0.448 1 1 s -0.448 1 -1 1 Z m 0 -4 H 7.6666 c -0.552 0 -1 -0.448 -1 -1 s 0.448 -1 1 -1 h 8.6666 c 0.552 0 1 0.448 1 1 s -0.448 1 -1 1 Z m 2.9093 -5.3333 h -3.9093 c -0.7333 0 -1.3333 -0.6 -1.3333 -1.3333 V 3.4387 l 0.0173 -0.0067 5.2293 5.228 -0.0027 0.0067 Z"
                                                                        fill="#94a3b8"></path>
                                                                </svg></a></li>
                                                        <div>Astimated Duration :
                                                            {{ $lect->duration_minutes ?? 'Not Available' }}</div>
                                                        <li class="flex gap-1">Recorded Live : <a
                                                                class="text-blue-800 flex gap-1 transition-all hover:text-blue-500 hover:scale-95"
                                                                href="{{ $lect->recorded_url ?? 'Not Available' }}">{{ $lect->recorded_url == null ? 'Not Available' : 'Click Here' }}
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <p class="rounded-md bg-emerald-50 px-3 py-2 text-sm text-emerald-900">
                                                    Activity: {{ $lect->sample_activity ?? 'Not Available' }}
                                                </p>
                                            </div>
                                        </div>
                                    </details>

                                @empty
                                    <div class="text-xl text-center p-10">No Lessons Yet </div>
                                @endforelse
                                {{-- @dd($course->Recordedlectures) --}}
                            @elseif ($course->type == 'recorded')
                                @forelse ($course->Recordedlectures as $lect)
                                    <details class="group">
                                        <summary
                                            class="flex cursor-pointer list-none items-center gap-3 p-4 focus-visible:outline focus-visible:outline-2 focus-visible:outline-emerald-800 sm:p-5">
                                            <span
                                                class="flex h-9 w-9 shrink-0 items-center justify-center text-lg font-bold ">Lesson
                                            </span>
                                            <span
                                                class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-emerald-50 text-sm font-bold text-emerald-900">{{ $loop->iteration }}</span>
                                            <span class="min-w-0 flex-1 font-bold text-slate-950">{{ $lect->title }}
                                                Development</span>
                                            <span
                                                class="shrink-0 rounded-sm bg-slate-100 px-2.5 py-1 text-xs font-semibold text-slate-600"><span
                                                    class="text-red-400">Uploaded At :
                                                </span>{{ $lect->created_at->format('d M') }}
                                            </span>
                                            <svg class="h-5 w-5 shrink-0 text-slate-400 transition-transform group-open:rotate-180"
                                                viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                <path fill-rule="evenodd"
                                                    d="M5.22 7.47a.75.75 0 0 1 1.06 0L10 11.19l3.72-3.72a.75.75 0 1 1 1.06 1.06l-4.25 4.25a.75.75 0 0 1-1.06 0L5.22 8.53a.75.75 0 0 1 0-1.06Z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </summary>
                                        <div class="border-t border-slate-100 px-4 pb-4 pt-4 sm:px-5 sm:pb-5">
                                            <div class="space-y-4 pl-12">
                                                <p class="text-sm leading-6 text-slate-600">
                                                    {{ $lect->description ?? "The Instructor Did't Give Any description " }}
                                                </p>
                                                <div>
                                                    <h3 class="text-lg font-bold text-slate-900">In this lesson</h3>
                                                    <ul
                                                        class="mt-2 list-inside list-disc space-y-1 text-sm leading-6 text-slate-600">

                                                        <li class="flex gap-1">Lecture : <a
                                                                class="text-blue-800 flex gap-1 transition-all hover:text-blue-500 hover:scale-95"
                                                                href="{{ $lect->record_url == null ? '#' : $lect->record_url }}">
                                                                <span>{{ $lect->record_url == null ? 'Not Uploaded Yet' : 'Click Here' }}
                                                                </span>
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="20"
                                                                    height="20" viewBox="0 0 24 24" fill="none"
                                                                    stroke="currentColor" stroke-width="2"
                                                                    stroke-linecap="round" stroke-linejoin="round">
                                                                    <rect x="3" y="5" width="18" height="14"
                                                                        rx="2" />
                                                                    <path d="m10 9 5 3-5 3z" fill="currentColor" />
                                                                </svg> </a></li>
                                                        <li class="flex gap-1">Silde : <a
                                                                class="text-blue-800 flex gap-1 transition-all hover:text-blue-500 hover:scale-95"
                                                                href="{{ $lect->slide == null ? '#' : asset($lect->slide) }}" target="_blank">
                                                                <span>{{ $lect->slide == null ? 'No Slides' : 'Click Here' }}
                                                                </span>
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="20"
                                                                    height="20" viewBox="0 0 24 24"
                                                                    fill="none">
                                                                    <path
                                                                        d="M 20.6493 7.236 l -5.2187 -5.2187 c -0.4413 -0.4413 -1.0267 -0.684 -1.6493 -0.684 H 6.3333 c -2.0227 0 -3.6667 1.644 -3.6667 3.6667 V 19 c 0 2.0227 1.644 3.6667 3.6667 3.6667 H 17.6666 c 2.0227 0 3.6667 -1.644 3.6667 -3.6667 V 8.8853 c 0 -0.6227 -0.2427 -1.2093 -0.684 -1.6493 Z m -12.9826 0.764 h 2.6667 c 0.552 0 1 0.448 1 1 s -0.448 1 -1 1 h -2.6667 c -0.552 0 -1 -0.448 -1 -1 s 0.448 -1 1 -1 Z m 8.6666 10 H 7.6666 c -0.552 0 -1 -0.448 -1 -1 s 0.448 -1 1 -1 h 8.6666 c 0.552 0 1 0.448 1 1 s -0.448 1 -1 1 Z m 0 -4 H 7.6666 c -0.552 0 -1 -0.448 -1 -1 s 0.448 -1 1 -1 h 8.6666 c 0.552 0 1 0.448 1 1 s -0.448 1 -1 1 Z m 2.9093 -5.3333 h -3.9093 c -0.7333 0 -1.3333 -0.6 -1.3333 -1.3333 V 3.4387 l 0.0173 -0.0067 5.2293 5.228 -0.0027 0.0067 Z"
                                                                        fill="#94a3b8"></path>
                                                                </svg></a></li>
                                                        <div>Duration :
                                                            {{ $lect->duration_minutes ?? 'Not Available' }}</div>
                                                        {{-- <li class="flex gap-1">Recorded Live : <a
                                                                class="text-blue-800 flex gap-1 transition-all hover:text-blue-500 hover:scale-95"
                                                                href="{{ $lect->recorded_url ?? 'Not Available' }}">{{ $lect->recorded_url == null ? 'Not Available' : 'Click Here' }}
                                                            </a>
                                                        </li> --}}
                                                    </ul>
                                                </div>
                                                <p class="rounded-md bg-emerald-50 px-3 py-2 text-sm text-emerald-900">
                                                    Activity: {{ $lect->sample_activity ?? 'Not Available' }}
                                                </p>
                                            </div>
                                        </div>
                                    </details>

                                @empty
                                    <div class="text-xl text-center p-10">No Lessons Yet </div>
                                @endforelse
                            @endif


                        </div>
                    </div>
                </section>

                <aside class="space-y-5">
                    <section class="rounded-lg border border-slate-200 bg-white p-5 shadow-sm">
                        <p class="text-xs font-bold uppercase tracking-widest text-emerald-800">About this course</p>
                        <p class="mt-3 text-sm leading-7 text-slate-600">{{ $course->description }}</p>
                    </section>

                    <section class="rounded-lg border border-slate-200 bg-white p-5 shadow-sm">
                        <p class="text-xs font-bold uppercase tracking-widest text-slate-500">Your Instructor : <span
                                class="text-blue-600">{{ $course->instructor->name }}</span></p>
                        <p class="mt-3 text-sm text-slate-600">{{ $course->instructor->description }}</p>
                    </section>
                </aside>
            </div>
        </div>
    </main>
</x-app-layout>
