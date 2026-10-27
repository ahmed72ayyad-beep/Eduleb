<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <p class="text-xs font-bold uppercase text-indigo-600">Eduleb workspace</p>
                <h1 class="mt-1 text-2xl font-bold leading-tight text-slate-900">
                    {{ auth()->user()->hasRole('admin') ? 'Application review' : 'My applications' }}
                </h1>
                <p class="mt-1 text-sm text-slate-500">
                    {{ auth()->user()->hasRole('admin') ? 'Review requests and keep decisions moving.' : 'Track the requests you have started.' }}
                </p>
            </div>
            @unless (auth()->user()->hasRole('admin'))
                <a href="{{ route('instructor.apply') }}"
                    class="inline-flex items-center justify-center gap-2 rounded-md bg-indigo-600 px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-indigo-700">
                    <span aria-hidden="true">+</span> Apply to teach
                </a>
            @endunless
        </div>
    </x-slot>

    @php($isAdmin = auth()->user()->hasRole('admin'))
    {{-- @dd($applications) --}}
    <main class="min-h-screen relative bg-slate-50 px-4 py-8 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-7xl space-y-6">
            @if ($isAdmin)
                <section class="grid grid-cols-1 gap-4 sm:grid-cols-3" aria-label="Application summary">
                    <article class="rounded-lg border border-slate-200 bg-white p-5">
                        <p class="text-sm font-medium text-slate-500">Awaiting review</p>
                        <p id="pending-count" class="mt-2 text-3xl font-bold text-slate-900">{{ $awaitingReview }}</p>
                        <p class="mt-1 text-xs text-slate-500">Across all application types</p>
                    </article>
                    <article class="rounded-lg border border-slate-200 bg-white p-5">
                        <p class="text-sm font-medium text-slate-500">Approved this month</p>
                        <p class="mt-2 text-3xl font-bold text-slate-900">{{ $approvedThisMonthCount }}</p>
                        <p class="mt-1 text-xs text-emerald-700">Decisions completed</p>
                    </article>
                    <article class="rounded-lg border border-slate-200 bg-white p-5">
                        <p class="text-sm font-medium text-slate-500">Average review time</p>
                        <p class="mt-2 text-3xl font-bold text-slate-900">{{ $averageReviewTime }} <span
                                class="text-base font-semibold">days</span></p>
                        <p class="mt-1 text-xs text-slate-500">Based on recent decisions</p>
                    </article>
                </section>

                <section class="overflow-hidden rounded-lg border border-slate-200 bg-white">
                    <div
                        class="flex flex-col gap-4 border-b border-slate-200 p-5 lg:flex-row lg:items-center lg:justify-between">
                        <div>
                            <h2 class="text-lg font-bold text-slate-900">All applications</h2>
                            <p class="mt-1 text-sm text-slate-500">Applicant requests are shown newest first.</p>
                        </div>
                        <div class="flex flex-col gap-3 sm:flex-row">
                            <label class="sr-only" for="application-search">Search applications</label>
                            <input id="application-search" type="search" placeholder="Search name or email"
                                class="w-full rounded-md border-slate-300 text-sm focus:border-indigo-500 focus:ring-indigo-500 sm:w-64">
                            <label class="sr-only" for="application-filter">Filter by status</label>
                            <select id="application-filter"
                                class="rounded-md border-slate-300 text-sm focus:border-indigo-500 focus:ring-indigo-500">
                                <option value="all">All statuses</option>
                                <option value="pending">Pending</option>
                                <option value="Accpted">Accpted</option>
                                <option value="rejected">Rejected</option>
                            </select>
                        </div>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full min-w-[760px] text-left text-sm">
                            <thead class="bg-slate-50 text-xs uppercase text-slate-500">

                                <tr>
                                    <th class="px-5 py-3 font-semibold">Applicant</th>
                                    <th class="px-5 py-3 font-semibold">Request</th>
                                    <th class="px-5 py-3 font-semibold">Submitted</th>
                                    <th class="px-5 py-3 font-semibold">Status</th>
                                    <th class="px-5 py-3 text-center font-semibold">Review</th>
                                </tr>
                            </thead>
                            <tbody id="application-rows" class="divide-y divide-slate-100">
                                @forelse ($applications as $application)
                                    @if ($application->type == 'instructor_application')
                                        <tr data-application
                                            data-search="{{ $application->user->name }} {{ $application->user->email }}"
                                            data-status="{{ $application->state }}"
                                            data-name="{{ $application->user->name }}"
                                            data-email="{{ $application->user->email }}"
                                            data-type="{{ $application->type == 'instructor_application' ? 'Instructor application' : 'Course Support' }}"
                                            data-submitted="{{ $application->created_at->format('M D Y') }}"
                                            data-summary="{{ $application->content['description'] }}">
                                            <td class="px-5 py-4">
                                                <p class="font-semibold text-slate-900">{{ $application->user->name }}
                                                </p>
                                                <p class="mt-1 text-xs text-slate-500">{{ $application->user->email }}
                                                </p>
                                            </td>
                                            <td class="px-5 py-4 text-slate-700">
                                                @if ($application['type'] == 'instructor_application')
                                                    Instructor Application
                                                @elseif ($application['type'] == 'course_support')
                                                    Course_Support <a
                                                        href="{{ route('courses.show', $application->target_id) }}">Show
                                                        Course</a>
                                                @endif
                                            </td>
                                            <td class="px-5 py-4 text-slate-500">
                                                {{ $application->created_at->format('M D Y') }}</td>
                                            <td class="px-5 py-4"><span data-status-label
                                                    class="inline-flex rounded-full bg-amber-50 px-2.5 py-1 text-xs font-semibold text-amber-800">{{ $application->state }}</span>
                                            </td>
                                            <td class="px-5 py-4">
                                                @if ($application->state == 'pending')
                                                    <div class="flex justify-end gap-2"><button type="submit"
                                                            x-data=""
                                                            x-on:click.prevent="$dispatch('open-modal', 'details-modal{{ $application->id }}')"
                                                            class="rounded-md border border-slate-300 px-3 py-1.5 text-xs font-semibold text-splate-700 hover:bg-slate-50">Details</button>
                                                        <x-modal name="details-modal{{ $application->id }}" focusable>
                                                            <section>

                                                                <article>
                                                                    <header
                                                                        class="flex items-start justify-between border-b border-slate-200 p-5">
                                                                        <div>
                                                                            <p
                                                                                class="text-xs font-bold uppercase text-indigo-600">
                                                                                {{ $application->type == 'instructor_application' ? 'Instructor application' : 'Course Support' }}
                                                                            </p>
                                                                            <div class="flex items-center gap-x-4">

                                                                                <h2
                                                                                    class=" text-xl font-bold text-slate-900">
                                                                                    {{ $application->user->name }}</h2>
                                                                                <a class="text-blue-900 text-lg flex items-center gap-x-1.5"
                                                                                    href=" {{ asset($application->content['CV']) }}">CV<svg
                                                                                        xmlns="http://www.w3.org/2000/svg"
                                                                                        width="16" height="16"
                                                                                        viewBox="0 0 24 24"
                                                                                        fill="none">
                                                                                        <path
                                                                                            d="M21.25 12C21.25 17.1086 17.1086 21.25 12 21.25C6.89137 21.25 2.75 17.1086 2.75 12C2.75 6.89137 6.89137 2.75 12 2.75C12.4142 2.75 12.75 2.41421 12.75 2C12.75 1.58579 12.4142 1.25 12 1.25C6.06294 1.25 1.25 6.06294 1.25 12C1.25 17.9371 6.06294 22.75 12 22.75C17.9371 22.75 22.75 17.9371 22.75 12C22.75 11.5858 22.4142 11.25 22 11.25C21.5858 11.25 21.25 11.5858 21.25 12Z"
                                                                                            fill="currentColor" />
                                                                                        <path
                                                                                            d="M12.4697 10.4697C12.1768 10.7626 12.1768 11.2374 12.4697 11.5303C12.7626 11.8232 13.2374 11.8232 13.5303 11.5303L21.25 3.81066V7.34375C21.25 7.75796 21.5858 8.09375 22 8.09375C22.4142 8.09375 22.75 7.75796 22.75 7.34375V2C22.75 1.58579 22.4142 1.25 22 1.25H16.6562C16.242 1.25 15.9062 1.58579 15.9062 2C15.9062 2.41421 16.242 2.75 16.6562 2.75H20.1893L12.4697 10.4697Z"
                                                                                            fill="currentColor" />
                                                                                    </svg></a>
                                                                            </div>
                                                                        </div>
                                                                        <a href="#"
                                                                            class="rounded-md px-2 py-1 text-xl leading-none text-slate-500 hover:bg-slate-100"
                                                                            aria-label="Close details">&times;</a>

                                                                    </header>

                                                                    <dl
                                                                        class="grid gap-4 p-5 pb-2 text-sm sm:grid-cols-2">
                                                                        <div>
                                                                            <dt
                                                                                class="text-xs font-semibold uppercase text-slate-500">
                                                                                Major
                                                                            </dt>
                                                                            <dd class="mt-1 break-all text-slate-900">
                                                                                {{ $application->content['major'] }}
                                                                            </dd>
                                                                        </div>
                                                                        <div>
                                                                            <dt
                                                                                class="text-xs font-semibold uppercase text-slate-500">
                                                                                Phone No.</dt>
                                                                            <dd class="mt-1 text-slate-900">
                                                                                {{ $application->content['phone'] }}
                                                                            </dd>
                                                                        </div>

                                                                    </dl>
                                                                    <dl class="grid gap-4 p-5 text-sm sm:grid-cols-2">
                                                                        <div>
                                                                            <dt
                                                                                class="text-xs font-semibold uppercase text-slate-500">
                                                                                Email
                                                                            </dt>
                                                                            <dd class="mt-1 break-all text-slate-900">
                                                                                {{ $application->user->email }}</dd>
                                                                        </div>
                                                                        <div>
                                                                            <dt
                                                                                class="text-xs font-semibold uppercase text-slate-500">
                                                                                Submitted</dt>
                                                                            <dd class="mt-1 text-slate-900">
                                                                                {{ $application->created_at->format('M D Y') }}
                                                                            </dd>
                                                                        </div>
                                                                        <div class="sm:col-span-2">
                                                                            <dt
                                                                                class="text-xs font-semibold uppercase text-slate-500">
                                                                                Application summary</dt>
                                                                            <dd class="mt-1 leading-6 text-slate-700">
                                                                                {{ $application->content['description'] }}
                                                                            </dd>
                                                                        </div>
                                                                    </dl>

                                                                </article>
                                                                <div class="flex justify-between p-4 flex-row-reverse">

                                                                    <form method="POST"
                                                                        action="{{ route('dashboard.application.approve', $application->id) }}">
                                                                        @method('PUT')

                                                                        <button type="submit"
                                                                            class="rounded-md bg-emerald-700 px-3 py-1.5 text-xs font-semibold text-white hover:bg-emerald-800">Approve</button>
                                                                    </form>
                                                                    <form method="POST"
                                                                        action="{{ route('dashboard.application.reject', $application->id) }}">
                                                                        @method('PUT')

                                                                        <button type="submit"
                                                                            class="rounded-md border border-rose-200 px-3 py-1.5 text-xs font-semibold text-rose-700 hover:bg-rose-50">Decline</button>
                                                                    </form>
                                                                </div>
                                                            </section>


                                                        </x-modal>
                                                        <form method="POST"
                                                            action="{{ route('dashboard.application.approve', $application->id) }}">
                                                            @method('PUT')

                                                            <button type="submit"
                                                                class="rounded-md bg-emerald-700 px-3 py-1.5 text-xs font-semibold text-white hover:bg-emerald-800">Approve</button>
                                                        </form>
                                                        <form method="POST"
                                                            action="{{ route('dashboard.application.reject', $application->id) }}">
                                                            @method('PUT')

                                                            <button type="submit"
                                                                class="rounded-md border border-rose-200 px-3 py-1.5 text-xs font-semibold text-rose-700 hover:bg-rose-50">Decline</button>
                                                        </form>
                                                    </div>
                                                @else
                                                    <div class="text-center font-semibold capitalize"
                                                        style="{{ $application->state == 'Accpted' ? 'color:green' : 'color:red' }}">
                                                        {{ $application->state }}
                                                        <span
                                                            class="text-emerald-900 text-xs">({{ $application->reviewed_at != null ? 'On' . $application->reviewed_at->diffForHumans() : ' ' }})</span>
                                                    </div>
                                                @endif
                                            </td>
                                        </tr>
                                    @elseif ($application->type == 'course_support')
                                        <tr data-application
                                            data-search="{{ $application->user->name }} {{ $application->user->email }}"
                                            data-status="{{ $application->state }}"
                                            data-name="{{ $application->user->name }}"
                                            data-email="{{ $application->user->email }}"
                                            data-type="{{ $application->type == 'instructor_application' ? 'Instructor application' : 'Course Support' }}"
                                            data-submitted="{{ $application->created_at->format('M D Y') }}"
                                            data-summary="{{ $application->content['msg'] }}">
                                            <td class="px-5 py-4">
                                                <p class="font-semibold text-slate-900">{{ $application->user->name }}
                                                </p>
                                                <p class="mt-1 text-xs text-slate-500">{{ $application->user->email }}
                                                </p>
                                            </td>
                                            <td class="px-5 py-4 text-slate-700">
                                                @if ($application['type'] == 'instructor_application')
                                                    Instructor Application
                                                @elseif ($application['type'] == 'course_support')
                                                    Course_Support <a class="text-xs text-blue-600"
                                                        href="{{ route('courses.show', $application->target_id) }}">Show
                                                        Course</a>
                                                @endif
                                            </td>
                                            <td class="px-5 py-4 text-slate-500">
                                                {{ $application->created_at->format('M D Y') }}</td>
                                            <td class="px-5 py-4"><span data-status-label
                                                    class="inline-flex rounded-full bg-amber-50 px-2.5 py-1 text-xs font-semibold text-amber-800">{{ $application->state }}</span>
                                            </td>
                                            <td class="px-5 py-4">
                                                @if ($application->state == 'pending')
                                                    <div class="flex justify-end gap-2"><button type="submit"
                                                            x-data=""
                                                            x-on:click.prevent="$dispatch('open-modal', 'details-modal{{ $application->id }}')"
                                                            class="rounded-md border border-slate-300 px-3 py-1.5 text-xs font-semibold text-splate-700 hover:bg-slate-50">Details</button>
                                                        <x-modal name="details-modal{{ $application->id }}" focusable>
                                                            <section>

                                                                <article>
                                                                    <header
                                                                        class="flex items-start justify-between border-b border-slate-200 p-5">
                                                                        <div>
                                                                            <p
                                                                                class="text-xs font-bold uppercase text-indigo-600">
                                                                                {{ $application->type == 'instructor_application' ? 'Instructor application' : 'Course Support' }}
                                                                            </p>
                                                                            <div class="flex items-center gap-x-4">

                                                                                <h2
                                                                                    class=" text-xl font-bold text-slate-900">
                                                                                    {{ $application->user->name }}</h2>

                                                                            </div>
                                                                        </div>
                                                                        <a href="#"
                                                                            class="rounded-md px-2 py-1 text-xl leading-none text-slate-500 hover:bg-slate-100"
                                                                            aria-label="Close details">&times;</a>

                                                                    </header>


                                                                    <dl class="grid gap-4 p-5 text-sm sm:grid-cols-2">
                                                                        <div>
                                                                            <dt
                                                                                class="text-xs font-semibold uppercase text-slate-500">
                                                                                Email
                                                                            </dt>
                                                                            <dd class="mt-1 break-all text-slate-900">
                                                                                {{ $application->user->email }}</dd>
                                                                        </div>
                                                                        <div>
                                                                            <dt
                                                                                class="text-xs font-semibold uppercase text-slate-500">
                                                                                Submitted</dt>
                                                                            <dd class="mt-1 text-slate-900">
                                                                                {{ $application->created_at->format('M D Y') }}
                                                                            </dd>
                                                                        </div>
                                                                        <div class="sm:col-span-2">
                                                                            <dt
                                                                                class="text-xs font-semibold uppercase text-slate-500">
                                                                                Application summary</dt>
                                                                            <dd class="mt-1 leading-6 text-slate-700">
                                                                                {{ $application->content['msg'] }}
                                                                            </dd>
                                                                        </div>
                                                                    </dl>

                                                                </article>
                                                                <div class="flex justify-between p-4 flex-row-reverse">

                                                                    <form method="POST"
                                                                        action="{{ route('dashboard.application.approve', $application->id) }}">
                                                                        @method('PUT')

                                                                        <button type="submit"
                                                                            class="rounded-md bg-emerald-700 px-3 py-1.5 text-xs font-semibold text-white hover:bg-emerald-800">Approve</button>
                                                                    </form>
                                                                    <form method="POST"
                                                                        action="{{ route('dashboard.application.reject', $application->id) }}">
                                                                        @method('PUT')

                                                                        <button type="submit"
                                                                            class="rounded-md border border-rose-200 px-3 py-1.5 text-xs font-semibold text-rose-700 hover:bg-rose-50">Decline</button>
                                                                    </form>
                                                                </div>
                                                            </section>


                                                        </x-modal>
                                                        <form method="POST"
                                                            action="{{ route('dashboard.application.approve', $application->id) }}">
                                                            @method('PUT')

                                                            <button type="submit"
                                                                class="rounded-md bg-emerald-700 px-3 py-1.5 text-xs font-semibold text-white hover:bg-emerald-800">Approve</button>
                                                        </form>
                                                        <form method="POST"
                                                            action="{{ route('dashboard.application.reject', $application->id) }}">
                                                            @method('PUT')

                                                            <button type="submit"
                                                                class="rounded-md border border-rose-200 px-3 py-1.5 text-xs font-semibold text-rose-700 hover:bg-rose-50">Decline</button>
                                                        </form>
                                                    </div>
                                                @else
                                                    <div class="text-center font-semibold capitalize"
                                                        style="{{ $application->state == 'Accpted' ? 'color:green' : 'color:red' }}">
                                                        {{ $application->state }}
                                                        <span
                                                            class="text-emerald-900 text-xs">({{ $application->reviewed_at != null ? $application->reviewed_at->diffForHumans() : ' ' }})</span>
                                                    </div>
                                                @endif
                                            </td>
                                        </tr>
                                    @endif
                                @empty

                                    <section class="overflow-hidden rounded-lg border border-slate-200 bg-white">
                                        <div class="border-b border-slate-200 px-5 py-4 sm:px-6">
                                            <h2 class="font-bold text-slate-900">Your requests</h2>
                                            <p class="mt-1 text-sm text-slate-500">Updates appear here when you submit
                                                an application.</p>
                                        </div>
                                        <div id="my-applications" class="divide-y divide-slate-100">
                                            <div id="applications-empty" class="px-6 py-14 text-center">
                                                <span
                                                    class="mx-auto flex h-12 w-12 items-center justify-center rounded-full bg-indigo-50 text-xl text-indigo-700"
                                                    aria-hidden="true">+</span>
                                                <h3 class="mt-4 text-base font-bold text-slate-900">No applications yet
                                                </h3>
                                                <p class="mx-auto mt-2 max-w-md text-sm leading-6 text-slate-500">Your
                                                    instructor
                                                    application and any course support requests will appear here with
                                                    their latest status.
                                                </p>
                                                <a href="{{ route('instructor.apply') }}"
                                                    class="mt-5 inline-flex rounded-md bg-indigo-600 px-4 py-2.5 text-sm font-semibold text-white hover:bg-indigo-700">Start
                                                    an instructor application</a>
                                            </div>
                                        </div>

                                    </section>


                                    <style>
                                        .application-modal {
                                            display: none;
                                        }

                                        .application-modal:target {
                                            display: flex;
                                        }
                                    </style>
                                @endforelse


                            </tbody>
                        </table>
                    </div>
                    <p id="empty-filter" class="hidden px-5 py-10 text-center text-sm text-slate-500">No applications
                        match those filters.</p>
                    <div
                        class="flex flex-col gap-2 border-t border-slate-200 px-5 py-4 text-xs text-slate-500 sm:flex-row sm:items-center sm:justify-between">
                        <span id="visible-count">Showing 3 applications</span><span>Front-end preview. Sample decisions
                            reset when this page reloads.</span>
                    </div>
                </section>

            @endif
        </div>
    </main>

</x-app-layout>

<script>
    (() => {
        const adminRows = [...document.querySelectorAll('[data-application]')];
        const search = document.querySelector('#application-search');
        const filter = document.querySelector('#application-filter');

        const updateAdminRows = () => {
            if (!search || !filter) return;
            const query = search.value.trim().toLowerCase();
            let visibleCount = 0;
            adminRows.forEach((row) => {
                const matches = row.dataset.search.includes(query) && (filter.value === 'all' || row
                    .dataset.status === filter.value);
                row.classList.toggle('hidden', !matches);
                if (matches) visibleCount += 1;
            });
            document.querySelector('#visible-count').textContent =
                `Showing ${visibleCount} application${visibleCount === 1 ? '' : 's'}`;
            document.querySelector('#empty-filter').classList.toggle('hidden', visibleCount > 0);
            document.querySelector('#pending-count').textContent = adminRows.filter((row) => row.dataset
                .status === 'pending').length;
        };

        search?.addEventListener('input', updateAdminRows);
        filter?.addEventListener('change', updateAdminRows);
        updateAdminRows();
    })();
</script>
