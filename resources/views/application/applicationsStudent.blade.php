<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <p class="text-sm font-semibold uppercase tracking-wide text-indigo-600">Student portal</p>
                <h1 class="mt-1 text-2xl font-bold leading-tight text-slate-900">My applications</h1>
                <p class="mt-1 text-sm text-slate-500">Track your requests, review statuses, and manage pending
                    applications.</p>
            </div>

        </div>
    </x-slot>
    {{-- @dd(auth()->user()->applications) --}}


    <main class="min-h-screen relative bg-slate-50 px-4 py-8 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-6xl space-y-6">
            {{-- <section class="grid gap-4 md:grid-cols-3" aria-label="Application overview">
                <article class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                    <p class="text-sm font-medium text-slate-500">Total requests</p>
                    <p class="mt-3 text-3xl font-bold text-slate-900">{{ count($applications) }}</p>
                    <p class="mt-1 text-xs text-slate-500">All applications created</p>
                </article>

                <article class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                    <p class="text-sm font-medium text-slate-500">Pending</p>
                    <p class="mt-3 text-3xl font-bold text-amber-600"></p>
                    <p class="mt-1 text-xs text-slate-500">Awaiting review</p>
                </article>

                <article class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                    <p class="text-sm font-medium text-slate-500">Approved</p>
                    <p class="mt-3 text-3xl font-bold text-emerald-600"></p>
                    <p class="mt-1 text-xs text-slate-500">Accepted by the team</p>
                </article>
            </section> --}}

            <section class="rounded-2xl border border-slate-200 bg-white shadow-sm">
                <div
                    class="flex flex-col gap-4 border-b border-slate-200 p-5 lg:flex-row lg:items-center lg:justify-between">
                    <div>
                        <h2 class="text-lg font-bold text-slate-900">Application history</h2>
                        <p class="mt-1 text-sm text-slate-500">Keep track of every request you have submitted.</p>
                    </div>


                </div>

                <div id="student-applications" class="grid gap-4 p-5 md:grid-cols-2 xl:grid-cols-3">
                    @foreach ($applications as $application)
                        <article
                            class="rounded-2xl border border-slate-200 bg-slate-50 p-5 shadow-sm transition hover:-translate-y-0.5 hover:shadow-md">
                            <div class="flex flex-col items-start justify-between gap-2">

                                <p class="text-s font-bold uppercase tracking-[0.15em] text-indigo-600">
                                    @if ($application['type'] == 'instructor_application')
                                        Instructor Application
                                    @elseif ($application['type'] == 'course_support')
                                        Course Support
                                    @elseif ($application['type'] == 'create_course')
                                        Create Course <a href="{{ route('courses.show', $application->target_id) }}"
                                            style="font-size: 11px !important"
                                            class="  text-red-600 hover:text-red-400 font-semibold  tracking-[1px]">Show
                                            Course</a>
                                    @endif
                                </p>

                                <span
                                    class="flex rounded-full items-center gap-1 px-2.5 py-1 text-[11px] font-semibold
                                    @if ($application->state === 'pending') bg-amber-50 text-amber-800
                                    @elseif ($application->state === 'approved') bg-emerald-50 text-emerald-800
                                    @elseif ($application->state === 'rejected') bg-rose-50 text-rose-800
                                    @else bg-slate-100 text-slate-600 @endif">
                                    <span class="text-sm">
                                        {{ $application->state }}
                                    </span>
                                    <span class="text-slate-900">
                                        {{ $application->state != 'pending' ? $application->reviewed_at->diffForHumans() : ' ' }}
                                    </span>
                                </span>
                            </div>


                            <div class="mt-5 flex flex-wrap gap-2">
                                @if ($application->type == 'instructor_application')
                                    <button type="button" x-data=""
                                        x-on:click.stop="$dispatch('open-modal', 'details-modal{{ $application->id }}')"
                                        class="rounded-md border border-slate-300 px-3 py-2 text-xs font-semibold text-slate-700 hover:bg-white">
                                        View
                                    </button>
                                @elseif ($application->type == 'course_support')
                                    <button type="button" x-data=""
                                        x-on:click.stop="$dispatch('open-modal', 'details-modal{{ $application->id }}')"
                                        class="rounded-md border border-slate-300 px-3 py-2 text-xs font-semibold text-slate-700 hover:bg-white">
                                        View
                                    </button>
                                @elseif ($application->type == 'create_course')
                                    <a href="{{ route('courses.show', $application->target_id) }}"
                                        class="rounded-md border border-slate-300 px-3 py-2 text-xs font-semibold text-slate-700 hover:bg-white">View</a>
                                @endif
                                @if ($application->state === 'pending')
                                    <form method="POST"
                                        action="{{ route('student.applications.destroy', $application->id) }}">
                                        @method('DELETE')
                                        <button type="submit"
                                            class="rounded-md border border-rose-200 px-3 py-2 text-xs font-semibold text-rose-700 hover:bg-rose-50">
                                            Withdraw
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </article>

                        @if ($application->type == 'instructor_application')
                            <x-modal name="details-modal{{ $application->id }}" focusable>
                                <section>
                                    <article>
                                        <header class="flex items-start justify-between border-b border-slate-200 p-5">
                                            <div>
                                                <p class="text-xs font-bold uppercase text-indigo-600">Instructor
                                                    application</p>
                                                <div class="flex items-center gap-x-4">
                                                    <h2 class="text-xl font-bold text-slate-900">
                                                        {{ $application->user->name }}</h2>
                                                    <a class="text-blue-900 text-lg flex items-center gap-x-1.5"
                                                        href="{{ asset($application->content['CV']) }}">CV<svg
                                                            xmlns="http://www.w3.org/2000/svg" width="16"
                                                            height="16" viewBox="0 0 24 24" fill="none">
                                                            <path
                                                                d="M21.25 12C21.25 17.1086 17.1086 21.25 12 21.25C6.89137 21.25 2.75 17.1086 2.75 12C2.75 6.89137 6.89137 2.75 12 2.75C12.4142 2.75 12.75 2.41421 12.75 2C12.75 1.58579 12.4142 1.25 12 1.25C6.06294 1.25 1.25 6.06294 1.25 12C1.25 17.9371 6.06294 22.75 12 22.75C17.9371 22.75 22.75 17.9371 22.75 12C22.75 11.5858 22.4142 11.25 22 11.25C21.5858 11.25 21.25 11.5858 21.25 12Z"
                                                                fill="currentColor" />
                                                            <path
                                                                d="M12.4697 10.4697C12.1768 10.7626 12.1768 11.2374 12.4697 11.5303C12.7626 11.8232 13.2374 11.8232 13.5303 11.5303L21.25 3.81066V7.34375C21.25 7.75796 21.5858 8.09375 22 8.09375C22.4142 8.09375 22.75 7.75796 22.75 7.34375V2C22.75 1.58579 22.4142 1.25 22 1.25H16.6562C16.242 1.25 15.9062 1.58579 15.9062 2C15.9062 2.41421 16.242 2.75 16.6562 2.75H20.1893L12.4697 10.4697Z"
                                                                fill="currentColor" />
                                                        </svg></a>
                                                </div>
                                            </div>
                                            <button type="button" x-data=""
                                                x-on:click.prevent="$dispatch('close')"
                                                class="rounded-md px-2 py-1 text-xl leading-none text-slate-500 hover:bg-slate-100"
                                                aria-label="Close details">&times;</button>
                                        </header>

                                        <dl class="grid gap-4 p-5 pb-2 text-sm sm:grid-cols-2">
                                            <div>
                                                <dt class="text-xs font-semibold uppercase text-slate-500">Major</dt>
                                                <dd class="mt-1 break-all text-slate-900">
                                                    {{ $application->content['major'] }}</dd>
                                            </div>
                                            <div>
                                                <dt class="text-xs font-semibold uppercase text-slate-500">Phone No.
                                                </dt>
                                                <dd class="mt-1 text-slate-900">{{ $application->content['phone'] }}
                                                </dd>
                                            </div>
                                        </dl>
                                        <dl class="grid gap-4 p-5 text-sm sm:grid-cols-2">
                                            <div>
                                                <dt class="text-xs font-semibold uppercase text-slate-500">Email</dt>
                                                <dd class="mt-1 break-all text-slate-900">
                                                    {{ $application->user->email }}</dd>
                                            </div>
                                            <div>
                                                <dt class="text-xs font-semibold uppercase text-slate-500">Submitted
                                                </dt>
                                                <dd class="mt-1 text-slate-900">
                                                    {{ $application->created_at->format('M D Y') }}</dd>
                                            </div>
                                            <div class="sm:col-span-2">
                                                <dt class="text-xs font-semibold uppercase text-slate-500">Application
                                                    summary</dt>
                                                <dd class="mt-1 leading-6 text-slate-700">
                                                    {{ $application->content['description'] }}</dd>
                                            </div>
                                        </dl>
                                    </article>

                                </section>
                            </x-modal>
                        @elseif ($application->type == 'course_support')
                            <x-modal name="details-modal{{ $application->id }}" focusable>
                                <section>
                                    <article>
                                        <header class="flex items-start justify-between border-b border-slate-200 p-5">
                                            <div>
                                                <p class="text-xs font-bold uppercase text-indigo-600">Course Support
                                                </p>
                                                <div class="flex items-center gap-x-4">
                                                    <h2 class="text-xl font-bold text-slate-900">
                                                        {{ $application->user->name }}</h2>
                                                    <a class="text-blue-900 text-sm mt-1 flex items-center gap-x-1"
                                                        href="{{ asset($application->target_id) }}">Show Course Page<svg
                                                            xmlns="http://www.w3.org/2000/svg" width="16"
                                                            height="16" viewBox="0 0 24 24" fill="none">
                                                            <path
                                                                d="M21.25 12C21.25 17.1086 17.1086 21.25 12 21.25C6.89137 21.25 2.75 17.1086 2.75 12C2.75 6.89137 6.89137 2.75 12 2.75C12.4142 2.75 12.75 2.41421 12.75 2C12.75 1.58579 12.4142 1.25 12 1.25C6.06294 1.25 1.25 6.06294 1.25 12C1.25 17.9371 6.06294 22.75 12 22.75C17.9371 22.75 22.75 17.9371 22.75 12C22.75 11.5858 22.4142 11.25 22 11.25C21.5858 11.25 21.25 11.5858 21.25 12Z"
                                                                fill="currentColor" />
                                                            <path
                                                                d="M12.4697 10.4697C12.1768 10.7626 12.1768 11.2374 12.4697 11.5303C12.7626 11.8232 13.2374 11.8232 13.5303 11.5303L21.25 3.81066V7.34375C21.25 7.75796 21.5858 8.09375 22 8.09375C22.4142 8.09375 22.75 7.75796 22.75 7.34375V2C22.75 1.58579 22.4142 1.25 22 1.25H16.6562C16.242 1.25 15.9062 1.58579 15.9062 2C15.9062 2.41421 16.242 2.75 16.6562 2.75H20.1893L12.4697 10.4697Z"
                                                                fill="currentColor" />
                                                        </svg></a>
                                                </div>
                                            </div>
                                            <button type="button" x-data=""
                                                x-on:click.prevent="$dispatch('close')"
                                                class="rounded-md px-2 py-1 text-xl leading-none text-slate-500 hover:bg-slate-100"
                                                aria-label="Close details">&times;</button>
                                        </header>
                                        <dl class="grid gap-4 p-5 text-sm sm:grid-cols-2">
                                            <div>
                                                <dt class="text-xs font-semibold uppercase text-slate-500">Email</dt>
                                                <dd class="mt-1 break-all text-slate-900">
                                                    {{ $application->user->email }}</dd>
                                            </div>
                                            <div>
                                                <dt class="text-xs font-semibold uppercase text-slate-500">Submitted
                                                </dt>
                                                <dd class="mt-1 text-slate-900">
                                                    {{ $application->created_at->format('M D Y') }}</dd>
                                            </div>
                                            <div class="sm:col-span-2">
                                                <dt class="text-xs font-semibold uppercase text-slate-500">Application
                                                    summary</dt>
                                                <dd class="mt-1 leading-6 text-slate-700">
                                                    {{ $application->content['msg'] }}</dd>
                                            </div>
                                        </dl>
                                    </article>

                                </section>
                            </x-modal>
                        @endif
                    @endforeach
                </div>
            </section>
        </div>
    </main>
</x-app-layout>
