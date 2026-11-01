<x-app-layout>
    <x-slot name="header">
        <div>
            <p class="text-sm font-semibold uppercase tracking-wide text-emerald-700">Instructor workspace</p>
            <h1 class="mt-1 text-2xl font-bold text-slate-900">Lesson studio</h1>
        </div>
    </x-slot>

    <main class="min-h-screen bg-slate-50 px-4 py-6 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-7xl">
            <section aria-labelledby="lessons-heading" class="space-y-5">
                <div class="flex flex-wrap items-end justify-between gap-3">
                    <div>
                        <p class="text-sm font-semibold uppercase tracking-wide text-emerald-700">Course materials</p>
                        <h2 id="lessons-heading" class="mt-1 text-xl font-bold text-slate-900">Lesson studio</h2>
                    </div>

                </div>

                <div class="rounded-xl border border-amber-200 bg-amber-50 px-4 py-3 text-sm leading-6 text-amber-950">
                    <span class="text-red-700">Note :</span> The Form content Relies On The Coure Type
                </div>

                <div class="grid grid-cols-1 gap-5 lg:grid-cols-[minmax(0,1.1fr)_minmax(18rem,0.9fr)]">
                    <div class="space-y-4">
                        <div
                            class="flex flex-col gap-3 rounded-xl border border-slate-200 bg-white px-3 sm:flex-row sm:items-end sm:justify-between">
                            <div class="min-w-0 flex-1">
                                @if ($course->type == 'online')
                                    @forelse ($course->LiveLectures as $lect)
                                        {{-- @dump($lect->slide) --}}
                                        <div class="flex justify-between  items-center relative">
                                            <details class="group flex-grow">
                                                <summary
                                                    class="flex cursor-pointer list-none items-center gap-3 p-4 focus-visible:outline focus-visible:outline-2 focus-visible:outline-emerald-800 sm:p-5">
                                                    <span
                                                        class="flex h-9 w-9 shrink-0 items-center justify-center text-lg font-bold ">Lesson
                                                    </span>
                                                    <span
                                                        class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-emerald-50 text-sm font-bold text-emerald-900">{{ $loop->iteration }}</span>
                                                    <span
                                                        class="min-w-0 flex-1 font-bold text-slate-950">{{ $lect->title }}
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
                                                            <h3 class="flex gap-1"><span class="text-slate-900">Live
                                                                    :</span><a
                                                                    class="text-blue-800 flex gap-1 transition-all hover:text-blue-500 hover:scale-95"
                                                                    href="{{ $lect->live_url }}">Click
                                                                    Here</a></h3>
                                                            <h3 class="text-lg font-bold text-slate-900">In this lesson
                                                            </h3>
                                                            <ul
                                                                class="mt-2 list-inside list-disc space-y-1 text-sm leading-6 text-slate-600">
                                                                <li class="flex gap-1">Silde : <a
                                                                        class="text-blue-800 flex gap-1 transition-all hover:text-blue-500 hover:scale-95"
                                                                        href="{{ asset($lect->slide) }}" target="_blank"> <span>Click
                                                                            Here
                                                                        </span>
                                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                                            width="20" height="20"
                                                                            viewBox="0 0 24 24" fill="none">
                                                                            <path
                                                                                d="M 20.6493 7.236 l -5.2187 -5.2187 c -0.4413 -0.4413 -1.0267 -0.684 -1.6493 -0.684 H 6.3333 c -2.0227 0 -3.6667 1.644 -3.6667 3.6667 V 19 c 0 2.0227 1.644 3.6667 3.6667 3.6667 H 17.6666 c 2.0227 0 3.6667 -1.644 3.6667 -3.6667 V 8.8853 c 0 -0.6227 -0.2427 -1.2093 -0.684 -1.6493 Z m -12.9826 0.764 h 2.6667 c 0.552 0 1 0.448 1 1 s -0.448 1 -1 1 h -2.6667 c -0.552 0 -1 -0.448 -1 -1 s 0.448 -1 1 -1 Z m 8.6666 10 H 7.6666 c -0.552 0 -1 -0.448 -1 -1 s 0.448 -1 1 -1 h 8.6666 c 0.552 0 1 0.448 1 1 s -0.448 1 -1 1 Z m 0 -4 H 7.6666 c -0.552 0 -1 -0.448 -1 -1 s 0.448 -1 1 -1 h 8.6666 c 0.552 0 1 0.448 1 1 s -0.448 1 -1 1 Z m 2.9093 -5.3333 h -3.9093 c -0.7333 0 -1.3333 -0.6 -1.3333 -1.3333 V 3.4387 l 0.0173 -0.0067 5.2293 5.228 -0.0027 0.0067 Z"
                                                                                fill="#94a3b8"></path>
                                                                        </svg></a></li>
                                                                <div>Astimated Duration :
                                                                    {{ $lect->duration_minutes ?? 'Not Available' }}
                                                                </div>
                                                                <li class="flex gap-1">Recorded Live : <a
                                                                        class="text-blue-800 flex gap-1 transition-all hover:text-blue-500 hover:scale-95"
                                                                        href="{{ $lect->recorded_url ?? 'Not Available' }}">{{ $lect->recorded_url == null ? 'Not Available' : 'Click Here' }}
                                                                    </a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                        <p
                                                            class="rounded-md bg-emerald-50 px-3 py-2 text-sm text-emerald-900">
                                                            Activity: {{ $lect->sample_activity ?? 'Not Available' }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </details>
                                            <button x-data=""
                                                x-on:click.prevent="$dispatch('open-modal', 'option-lesson-modal{{ $lect->id }}')">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                    viewBox="0 0 24 24" fill="none">
                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M16.75 4C16.75 5.51878 15.5188 6.75 14 6.75C12.4812 6.75 11.25 5.51878 11.25 4C11.25 2.48122 12.4812 1.25 14 1.25C15.5188 1.25 16.75 2.48122 16.75 4ZM14 5.25C14.6904 5.25 15.25 4.69036 15.25 4C15.25 3.30964 14.6904 2.75 14 2.75C13.3096 2.75 12.75 3.30964 12.75 4C12.75 4.69036 13.3096 5.25 14 5.25Z"
                                                        fill="#94a3b8" />
                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M12 14.75C10.4812 14.75 9.25 13.5188 9.25 12C9.25 10.4812 10.4812 9.25 12 9.25C13.5188 9.25 14.75 10.4812 14.75 12C14.75 13.5188 13.5188 14.75 12 14.75ZM10.75 12C10.75 12.6904 11.3096 13.25 12 13.25C12.6904 13.25 13.25 12.6904 13.25 12C13.25 11.3096 12.6904 10.75 12 10.75C11.3096 10.75 10.75 11.3096 10.75 12Z"
                                                        fill="#94a3b8" />
                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M10 22.75C8.48122 22.75 7.25 21.5188 7.25 20C7.25 18.4812 8.48122 17.25 10 17.25C11.5188 17.25 12.75 18.4812 12.75 20C12.75 21.5188 11.5188 22.75 10 22.75ZM8.75 20C8.75 20.6904 9.30964 21.25 10 21.25C10.6904 21.25 11.25 20.6904 11.25 20C11.25 19.3096 10.6904 18.75 10 18.75C9.30964 18.75 8.75 19.3096 8.75 20Z"
                                                        fill="#94a3b8" />
                                                    <path
                                                        d="M15.25 12C15.25 11.5858 15.5858 11.25 16 11.25H19C19.4142 11.25 19.75 11.5858 19.75 12C19.75 12.4142 19.4142 12.75 19 12.75H16C15.5858 12.75 15.25 12.4142 15.25 12Z"
                                                        fill="#94a3b8" />
                                                    <path
                                                        d="M14 19.25C13.5858 19.25 13.25 19.5858 13.25 20C13.25 20.4142 13.5858 20.75 14 20.75H19C19.4142 20.75 19.75 20.4142 19.75 20C19.75 19.5858 19.4142 19.25 19 19.25H14Z"
                                                        fill="#94a3b8" />
                                                    <path
                                                        d="M10.75 4C10.75 3.58579 10.4142 3.25 10 3.25L5 3.25C4.58579 3.25 4.25 3.58579 4.25 4C4.25 4.41421 4.58579 4.75 5 4.75L10 4.75C10.4142 4.75 10.75 4.41421 10.75 4Z"
                                                        fill="#94a3b8" />
                                                    <path
                                                        d="M5 11.25C4.58579 11.25 4.25 11.5858 4.25 12C4.25 12.4142 4.58579 12.75 5 12.75H8C8.41421 12.75 8.75 12.4142 8.75 12C8.75 11.5858 8.41421 11.25 8 11.25H5Z"
                                                        fill="#94a3b8" />
                                                    <path
                                                        d="M4.25 20C4.25 19.5858 4.58579 19.25 5 19.25H6C6.41421 19.25 6.75 19.5858 6.75 20C6.75 20.4142 6.41421 20.75 6 20.75H5C4.58579 20.75 4.25 20.4142 4.25 20Z"
                                                        fill="#94a3b8" />
                                                    <path
                                                        d="M19 3.25C19.4142 3.25 19.75 3.58579 19.75 4C19.75 4.41421 19.4142 4.75 19 4.75H18C17.5858 4.75 17.25 4.41421 17.25 4C17.25 3.58579 17.5858 3.25 18 3.25H19Z"
                                                        fill="#94a3b8" />
                                                </svg>
                                            </button>
                                            <x-modall name="option-lesson-modal{{ $lect->id }}" focusable>
                                                <div class="w-44 flex shadow border flex-col">
                                                    <a href="{{ route('instructor.courses.lessons.edit', [$course->id, $lect->id]) }}"
                                                        class="px-4 py-2  w-full hover:bg-slate-300 text-center text-sm text-blue-600">Edit</a>
                                                    <form
                                                        action="{{ route('instructor.courses.lessons.destroy', [$course->id, $lect->id]) }}"
                                                        method="POST"
                                                        onsubmit="return confirm('Are You Sure Of Delete {{ $lect->title }}');">
                                                        @method('Delete')
                                                        <button
                                                            class="px-4 py-2 w-full hover:bg-slate-300 text-center text-sm text-red-600">Delete</button>
                                                    </form>
                                                </div>

                                            </x-modall>
                                        </div>
                                    @empty
                                        <div class="text-xl text-center p-10">No Lessons Yet </div>
                                    @endforelse
                                    {{-- @dd($course->Recordedlectures) --}}
                                @elseif ($course->type == 'recorded')
                                    @forelse ($course->Recordedlectures as $lect)
                                        <div class="flex  items-center relative">

                                            <details class="group flex-grow">

                                                <summary
                                                    class="flex cursor-pointer list-none items-center gap-3 p-4 focus-visible:outline focus-visible:outline-2 focus-visible:outline-emerald-800 sm:p-5">
                                                    <span
                                                        class="flex h-9 w-9 shrink-0 items-center justify-center text-lg font-bold ">Lesson
                                                    </span>
                                                    <span
                                                        class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-emerald-50 text-sm font-bold text-emerald-900">{{ $loop->iteration }}</span>
                                                    <span
                                                        class="min-w-0 flex-1 font-bold text-slate-950">{{ $lect->title }}
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
                                                            <h3 class="text-lg font-bold text-slate-900">In this lesson
                                                            </h3>
                                                            <ul
                                                                class="mt-2 list-inside list-disc space-y-1 text-sm leading-6 text-slate-600">

                                                                <li class="flex gap-1">Lecture : <a
                                                                        class="text-blue-800 flex gap-1 transition-all hover:text-blue-500 hover:scale-95"
                                                                        href="{{ $lect->video_url == null ? '#' : $lect->video_url }}">
                                                                        <span>{{ $lect->video_url == null ? 'Not Uploaded Yet' : 'Click Here' }}
                                                                        </span>
                                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                                            width="20" height="20"
                                                                            viewBox="0 0 24 24" fill="none"
                                                                            stroke="currentColor" stroke-width="2"
                                                                            stroke-linecap="round"
                                                                            stroke-linejoin="round">
                                                                            <rect x="3" y="5" width="18"
                                                                                height="14" rx="2" />
                                                                            <path d="m10 9 5 3-5 3z"
                                                                                fill="currentColor" />
                                                                        </svg> </a></li>
                                                                <li class="flex gap-1">Silde : <a
                                                                        class="text-blue-800 flex gap-1 transition-all hover:text-blue-500 hover:scale-95"
                                                                        href="{{ $lect->slide == null ? '#' : asset($lect->slide) }}" target="_blank">
                                                                        <span>{{ $lect->slide == null ? 'No Slides' : 'Click Here' }}
                                                                        </span>
                                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                                            width="20" height="20"
                                                                            viewBox="0 0 24 24" fill="none">
                                                                            <path
                                                                                d="M 20.6493 7.236 l -5.2187 -5.2187 c -0.4413 -0.4413 -1.0267 -0.684 -1.6493 -0.684 H 6.3333 c -2.0227 0 -3.6667 1.644 -3.6667 3.6667 V 19 c 0 2.0227 1.644 3.6667 3.6667 3.6667 H 17.6666 c 2.0227 0 3.6667 -1.644 3.6667 -3.6667 V 8.8853 c 0 -0.6227 -0.2427 -1.2093 -0.684 -1.6493 Z m -12.9826 0.764 h 2.6667 c 0.552 0 1 0.448 1 1 s -0.448 1 -1 1 h -2.6667 c -0.552 0 -1 -0.448 -1 -1 s 0.448 -1 1 -1 Z m 8.6666 10 H 7.6666 c -0.552 0 -1 -0.448 -1 -1 s 0.448 -1 1 -1 h 8.6666 c 0.552 0 1 0.448 1 1 s -0.448 1 -1 1 Z m 0 -4 H 7.6666 c -0.552 0 -1 -0.448 -1 -1 s 0.448 -1 1 -1 h 8.6666 c 0.552 0 1 0.448 1 1 s -0.448 1 -1 1 Z m 2.9093 -5.3333 h -3.9093 c -0.7333 0 -1.3333 -0.6 -1.3333 -1.3333 V 3.4387 l 0.0173 -0.0067 5.2293 5.228 -0.0027 0.0067 Z"
                                                                                fill="#94a3b8"></path>
                                                                        </svg></a></li>
                                                                <div>Duration :
                                                                    {{ $lect->duration_minutes ?? 'Not Available' }}
                                                                </div>
                                                                {{-- <li class="flex gap-1">Recorded Live : <a
                                                                class="text-blue-800 flex gap-1 transition-all hover:text-blue-500 hover:scale-95"
                                                                href="{{ $lect->recorded_url ?? 'Not Available' }}">{{ $lect->recorded_url == null ? 'Not Available' : 'Click Here' }}
                                                            </a>
                                                        </li> --}}
                                                            </ul>
                                                        </div>
                                                        <p
                                                            class="rounded-md bg-emerald-50 px-3 py-2 text-sm text-emerald-900">
                                                            Activity: {{ $lect->sample_activity ?? 'Not Available' }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </details>
                                            <button x-data=""
                                                x-on:click.prevent="$dispatch('open-modal', 'option-lesson-modal{{ $lect->id }}')">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                    viewBox="0 0 24 24" fill="none">
                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M16.75 4C16.75 5.51878 15.5188 6.75 14 6.75C12.4812 6.75 11.25 5.51878 11.25 4C11.25 2.48122 12.4812 1.25 14 1.25C15.5188 1.25 16.75 2.48122 16.75 4ZM14 5.25C14.6904 5.25 15.25 4.69036 15.25 4C15.25 3.30964 14.6904 2.75 14 2.75C13.3096 2.75 12.75 3.30964 12.75 4C12.75 4.69036 13.3096 5.25 14 5.25Z"
                                                        fill="#94a3b8" />
                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M12 14.75C10.4812 14.75 9.25 13.5188 9.25 12C9.25 10.4812 10.4812 9.25 12 9.25C13.5188 9.25 14.75 10.4812 14.75 12C14.75 13.5188 13.5188 14.75 12 14.75ZM10.75 12C10.75 12.6904 11.3096 13.25 12 13.25C12.6904 13.25 13.25 12.6904 13.25 12C13.25 11.3096 12.6904 10.75 12 10.75C11.3096 10.75 10.75 11.3096 10.75 12Z"
                                                        fill="#94a3b8" />
                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M10 22.75C8.48122 22.75 7.25 21.5188 7.25 20C7.25 18.4812 8.48122 17.25 10 17.25C11.5188 17.25 12.75 18.4812 12.75 20C12.75 21.5188 11.5188 22.75 10 22.75ZM8.75 20C8.75 20.6904 9.30964 21.25 10 21.25C10.6904 21.25 11.25 20.6904 11.25 20C11.25 19.3096 10.6904 18.75 10 18.75C9.30964 18.75 8.75 19.3096 8.75 20Z"
                                                        fill="#94a3b8" />
                                                    <path
                                                        d="M15.25 12C15.25 11.5858 15.5858 11.25 16 11.25H19C19.4142 11.25 19.75 11.5858 19.75 12C19.75 12.4142 19.4142 12.75 19 12.75H16C15.5858 12.75 15.25 12.4142 15.25 12Z"
                                                        fill="#94a3b8" />
                                                    <path
                                                        d="M14 19.25C13.5858 19.25 13.25 19.5858 13.25 20C13.25 20.4142 13.5858 20.75 14 20.75H19C19.4142 20.75 19.75 20.4142 19.75 20C19.75 19.5858 19.4142 19.25 19 19.25H14Z"
                                                        fill="#94a3b8" />
                                                    <path
                                                        d="M10.75 4C10.75 3.58579 10.4142 3.25 10 3.25L5 3.25C4.58579 3.25 4.25 3.58579 4.25 4C4.25 4.41421 4.58579 4.75 5 4.75L10 4.75C10.4142 4.75 10.75 4.41421 10.75 4Z"
                                                        fill="#94a3b8" />
                                                    <path
                                                        d="M5 11.25C4.58579 11.25 4.25 11.5858 4.25 12C4.25 12.4142 4.58579 12.75 5 12.75H8C8.41421 12.75 8.75 12.4142 8.75 12C8.75 11.5858 8.41421 11.25 8 11.25H5Z"
                                                        fill="#94a3b8" />
                                                    <path
                                                        d="M4.25 20C4.25 19.5858 4.58579 19.25 5 19.25H6C6.41421 19.25 6.75 19.5858 6.75 20C6.75 20.4142 6.41421 20.75 6 20.75H5C4.58579 20.75 4.25 20.4142 4.25 20Z"
                                                        fill="#94a3b8" />
                                                    <path
                                                        d="M19 3.25C19.4142 3.25 19.75 3.58579 19.75 4C19.75 4.41421 19.4142 4.75 19 4.75H18C17.5858 4.75 17.25 4.41421 17.25 4C17.25 3.58579 17.5858 3.25 18 3.25H19Z"
                                                        fill="#94a3b8" />
                                                </svg>
                                            </button>
                                            <x-modall name="option-lesson-modal{{ $lect->id }}" focusable>
                                                <div class="w-44 flex shadow border flex-col">
                                                    <a href="{{ route('instructor.courses.lessons.edit', [$course->id, $lect->id]) }}"
                                                        class="px-4 py-2  w-full hover:bg-slate-300 text-center text-sm text-blue-600">Edit</a>
                                                    <form
                                                        action="{{ route('instructor.courses.lessons.destroy', [$course->id, $lect->id]) }}"
                                                        method="POST"
                                                        onsubmit="return confirm('Are You Sure Of Delete {{ $lect->title }}');">
                                                        @method('Delete')
                                                        <button
                                                            class="px-4 py-2 w-full hover:bg-slate-300 text-center text-sm text-red-600">Delete</button>
                                                    </form>
                                                </div>

                                            </x-modall>
                                        </div>

                                    @empty
                                        <div class="text-xl text-center p-10">No Lessons Yet </div>
                                    @endforelse
                                @endif


                            </div>

                        </div>
                        <div id="lesson-modules" class="space-y-4" aria-live="polite"></div>
                    </div>






























                    @if ($course->type == 'online')
                        <form method="POST" enctype="multipart/form-data"
                            action="{{ route('instructor.courses.lessons.store', $course->id) }}">


                            <div class="h-fit space-y-4 rounded-xl border border-slate-200 bg-white p-5">
                                <div>
                                    <p class="text-xs font-semibold uppercase tracking-wide text-indigo-700">
                                        {{ $course->title }} </p>
                                    <h3 class="mt-1 text-lg font-bold text-slate-900">Add a lesson</h3>
                                </div>
                                <div>
                                    <x-input name="title" label="Lesson
                                    title"
                                        labelclass="mb-1 block text-sm font-medium text-slate-700"
                                        class="w-full rounded-md border-slate-300 text-sm focus:border-indigo-500 focus:ring-indigo-500"
                                        id="" type="text" />
                                </div>
                                <div>
                                    <x-input type="file" name="slide" label="Slides"
                                        labelclass="block text-xs font-bold uppercase text-gray-600 tracking-wider"
                                        class="block w-full text-xs text-slate-500 file:mr-4 file:rounded-md file:border-0 file:bg-emerald-50 file:px-4 file:py-2.5 file:text-xs file:font-semibold file:text-emerald-800 hover:file:bg-emerald-100" />
                                </div>
                                <div>

                                    <x-textarea id="lesson-description" name="description" rows="3"
                                        label="Pref Description "
                                        labelclass="mb-1 block text-sm font-medium text-slate-700"
                                        placeholder="Module 1: Introduction, Module 2: Setup..."
                                        class="w-full rounded-md border-slate-300 text-sm focus:border-indigo-500 focus:ring-indigo-500" />
                                </div>
                                <div>

                                    <x-input name="live_url" label="Live URL"
                                        labelclass="mb-1 block text-sm font-medium text-slate-700"
                                        id="lesson-video-url" type="url" placeholder="https://example.com/video"
                                        class="w-full rounded-md border-slate-300 text-sm focus:border-indigo-500 focus:ring-indigo-500" />
                                </div>
                                <div>
                                    <x-input type="number" name="duration_minutes" label="Expected Duration In min"
                                        labelclass="mb-1 block text-sm font-medium text-slate-700"
                                        id="duration_minutes"
                                        class="w-full rounded-md border-slate-300 text-sm focus:border-indigo-500 focus:ring-indigo-500" />
                                </div>
                                <div>
                                    <x-input name="sample_activity" label="Main Activity" type="text"
                                        labelclass="mb-1 block text-sm font-medium text-slate-700"
                                        id="sample_activity"
                                        class="w-full rounded-md border-slate-300 text-sm focus:border-indigo-500 focus:ring-indigo-500" />
                                </div>
                                <div>
                                    <x-input name="starts_at_date" label="Start At (Date)" type="date"
                                        labelclass="mb-1 block text-sm font-medium text-slate-700" id="starts_at_date"
                                        class="w-full rounded-md border-slate-300 text-sm focus:border-indigo-500 focus:ring-indigo-500" />
                                </div>
                                <div>
                                    <x-input name="starts_at_time" label="Start At (H:M)" type="time"
                                        labelclass="mb-1 block text-sm font-medium text-slate-700" id="starts_at_time"
                                        class="w-full rounded-md border-slate-300 text-sm focus:border-indigo-500 focus:ring-indigo-500" />
                                </div>
                                <button id="save-lesson" type="submit"
                                    class="rounded-md bg-indigo-700 px-4 py-2.5 text-sm font-semibold text-white hover:bg-indigo-800">Add
                                    lesson</button>
                                {{-- <p id="lesson-status" class="text-xs text-slate-500" role="status">No lesson data is
                                    stored by
                                    this
                                    interface.</p> --}}
                            </div>
                        </form>
                    @elseif ($course->type == 'recorded')
                        <form action="{{ route('instructor.courses.lessons.store', $course->id) }}"
                            enctype="multipart/form-data" method="POST">


                            <div class="h-fit space-y-4 rounded-xl border border-slate-200 bg-white p-5">
                                <div>
                                    <p class="text-xs font-semibold uppercase tracking-wide text-indigo-700">
                                        {{ $course->title }} </p>
                                    <h3 class="mt-1 text-lg font-bold text-slate-900">Add a lesson</h3>
                                </div>
                                <div>
                                    <x-input name="title" label="Lesson Title"
                                        labelclass="mb-1 block text-sm font-medium text-slate-700"
                                        class="w-full rounded-md border-slate-300 text-sm focus:border-indigo-500 focus:ring-indigo-500"
                                        id="title" type="text" />
                                </div>
                                <div>
                                    <x-input type="file" name="slide" label="Slides"
                                        labelclass="block text-xs font-bold uppercase text-gray-600 tracking-wider"
                                        class="block w-full text-xs text-slate-500 file:mr-4 file:rounded-md file:border-0 file:bg-emerald-50 file:px-4 file:py-2.5 file:text-xs file:font-semibold file:text-emerald-800 hover:file:bg-emerald-100" />
                                </div>
                                <div>

                                    <x-textarea id="lesson-description" name="description" rows="3"
                                        label="Pref Description "
                                        labelclass="mb-1 block text-sm font-medium text-slate-700"
                                        placeholder="Module 1: Introduction, Module 2: Setup..."
                                        class="w-full rounded-md border-slate-300 text-sm focus:border-indigo-500 focus:ring-indigo-500" />
                                </div>
                                <div>

                                    <x-input name="video_url" label="Video URL"
                                        labelclass="mb-1 block text-sm font-medium text-slate-700"
                                        id="lesson-video-url" type="url" placeholder="https://youtube.com/*"
                                        class="w-full rounded-md border-slate-300 text-sm focus:border-indigo-500 focus:ring-indigo-500" />
                                </div>
                                <div>
                                    <x-input type="number" name="duration_minutes" label="Duration In Minutes"
                                        labelclass="mb-1 block text-sm font-medium text-slate-700"
                                        id="duration_minutes"
                                        class="w-full rounded-md border-slate-300 text-sm focus:border-indigo-500 focus:ring-indigo-500" />
                                </div>
                                <div>
                                    <x-input name="sample_activity" label="Main Activity" type="text"
                                        labelclass="mb-1 block text-sm font-medium text-slate-700"
                                        id="sample_activity"
                                        class="w-full rounded-md border-slate-300 text-sm focus:border-indigo-500 focus:ring-indigo-500" />
                                </div>
                                <button id="save-lesson" type="submit"
                                    class="rounded-md bg-indigo-700 px-4 py-2.5 text-sm font-semibold text-white hover:bg-indigo-800">Add
                                    lesson draft</button>
                            </div>
                        </form>
                    @endif
                </div>
            </section>

            <script>
                (() => {
                    const modulesElement = document.getElementById('lesson-modules');
                    const moduleSelect = document.getElementById('lesson-module');
                    const titleInput = document.getElementById('lesson-title');
                    const descriptionInput = document.getElementById('lesson-description');
                    const videoInput = document.getElementById('lesson-video-url');
                    const status = document.getElementById('lesson-status');

                    if (!modulesElement || !moduleSelect || !titleInput || !descriptionInput || !videoInput || !status) {
                        return;
                    }

                    const modules = [{
                        id: 1,
                        title: 'Section 1',
                        lessons: []
                    }];
                    let nextModuleId = 2;

                    const render = () => {
                        modulesElement.replaceChildren();
                        moduleSelect.replaceChildren();

                        modules.forEach((module) => {
                            const option = document.createElement('option');
                            option.value = String(module.id);
                            option.textContent = module.title;
                            moduleSelect.append(option);

                            const section = document.createElement('section');
                            section.className = 'overflow-hidden rounded-xl border border-slate-200 bg-white';
                            section.setAttribute('aria-label', module.title);

                            const heading = document.createElement('div');
                            heading.className =
                                'flex items-center justify-between border-b border-slate-100 px-4 py-3';
                            const name = document.createElement('h3');
                            name.className = 'font-semibold text-slate-900';
                            name.textContent = module.title;
                            const count = document.createElement('span');
                            count.className = 'text-xs text-slate-500';
                            count.textContent = `${module.lessons.length} drafts`;
                            heading.append(name, count);

                            const list = document.createElement('ol');
                            list.className = 'divide-y divide-slate-100';
                            if (!module.lessons.length) {
                                const empty = document.createElement('li');
                                empty.className = 'px-4 py-5 text-sm text-slate-500';
                                empty.textContent = 'No lesson drafts in this section.';
                                list.append(empty);
                            }

                            module.lessons.forEach((lesson, index) => {
                                const item = document.createElement('li');
                                item.className =
                                    'flex flex-col gap-3 px-4 py-3 sm:flex-row sm:items-start sm:justify-between';
                                const details = document.createElement('div');
                                details.className = 'min-w-0';
                                const lessonName = document.createElement('p');
                                lessonName.className = 'font-semibold text-slate-900';
                                lessonName.textContent = `${index + 1}. ${lesson.title}`;
                                const description = document.createElement('p');
                                description.className =
                                    'mt-1 whitespace-pre-line text-sm leading-5 text-slate-600';
                                description.textContent = lesson.description || 'No description';
                                details.append(lessonName, description);

                                if (lesson.videoUrl) {
                                    const videoLink = document.createElement('a');
                                    videoLink.className =
                                        'mt-2 inline-block break-all text-sm font-medium text-indigo-700 hover:text-indigo-900';
                                    videoLink.href = lesson.videoUrl;
                                    videoLink.target = '_blank';
                                    videoLink.rel = 'noopener noreferrer';
                                    videoLink.textContent = 'Open video link';
                                    details.append(videoLink);
                                }

                                const remove = document.createElement('button');
                                remove.type = 'button';
                                remove.className =
                                    'shrink-0 rounded-md border border-slate-300 px-3 py-1.5 text-xs font-semibold text-slate-700 hover:bg-slate-50';
                                remove.textContent = 'Remove draft';
                                remove.addEventListener('click', () => {
                                    module.lessons.splice(index, 1);
                                    render();
                                    status.textContent = 'Draft removed. Changes are not saved.';
                                });

                                item.append(details, remove);
                                list.append(item);
                            });

                            section.append(heading, list);
                            modulesElement.append(section);
                        });
                    };

                    document.getElementById('add-module').addEventListener('click', () => {
                        modules.push({
                            id: nextModuleId,
                            title: `Section ${nextModuleId}`,
                            lessons: []
                        });
                        nextModuleId += 1;
                        render();
                        moduleSelect.value = String(nextModuleId - 1);
                        status.textContent = 'Section added to this page session only.';
                    });

                    document.getElementById('save-lesson').addEventListener('click', () => {
                        const title = titleInput.value.trim();
                        const module = modules.find((item) => String(item.id) === moduleSelect.value);
                        let videoUrl = '';

                        if (!title || !module) {
                            status.textContent = 'Add a lesson title and select a section.';
                            return;
                        }

                        if (videoInput.value.trim()) {
                            try {
                                const parsedUrl = new URL(videoInput.value.trim());
                                if (parsedUrl.protocol !== 'https:' && parsedUrl.protocol !== 'http:') {
                                    throw new Error('Unsupported URL protocol');
                                }
                                videoUrl = parsedUrl.href;
                            } catch {
                                status.textContent = 'Enter a valid http or https video link.';
                                return;
                            }
                        }

                        module.lessons.push({
                            title,
                            description: descriptionInput.value.trim(),
                            videoUrl,
                        });
                        titleInput.value = '';
                        descriptionInput.value = '';
                        videoInput.value = '';
                        render();
                        status.textContent = 'Lesson draft added for this page session only.';
                    });

                    render();
                })();
            </script>
        </div>
    </main>
</x-app-layout>
