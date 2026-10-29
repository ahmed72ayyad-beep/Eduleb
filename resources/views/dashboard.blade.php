<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <h2 class="font-bold text-2xl text-gray-800 leading-tight">
                    {{ __('Main Dashboard') }}
                </h2>
                <p class="text-sm text-gray-500 mt-1">Welcome back, {{ auth()->user()->name }}! Manage your <span
                        class="text-emerald-700 font-semibold text-lg">EduLeb</span> platform seamlessly.</p>
            </div>
            <div class="flex items-center gap-3">
                <span
                    class="inline-flex items-center px-3 py-1 rounded-md text-xs font-semibold bg-emerald-50 text-emerald-800 border border-emerald-100">
                    <span class="w-2 h-2 rounded-full bg-emerald-500 mr-1.5 animate-pulse"></span>
                    {{ auth()->user()->getRoleNames()->first() ? ucfirst(auth()->user()->getRoleNames()->first()) : 'No Role' }}
                </span>
            </div>
        </div>
    </x-slot>

    <div class="min-h-screen bg-gradient-to-br from-slate-50 via-emerald-50/40 to-amber-50/30 py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            <!-- Banner / Hero Section -->
            <div
                class="relative overflow-hidden rounded-lg bg-gradient-to-r from-emerald-950 via-teal-800 to-slate-900 p-6 text-white shadow-md shadow-slate-900/10 sm:p-8">
                <div class="relative z-10 max-w-2xl space-y-3">
                    <span
                        class="inline-block px-3 py-1 bg-white/20 backdrop-blur-md rounded-full text-xs font-medium tracking-wide uppercase">
                        EduLab Management Suite
                    </span>
                    <h3 class="text-3xl font-extrabold tracking-tight sm:text-4xl">
                        Smart Learning & Knowledge Hub Dashboard
                    </h3>
                    <p class="text-emerald-50 text-sm leading-relaxed">
                        Track course performance, student engagement, instructor activities, blog posts, and reviews all
                        from one place.
                    </p>
                </div>
            </div>

            <!-- Key Metrics / Stats Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Courses Card -->
                <div
                    class="group rounded-lg border border-slate-200 border-t-2 border-t-emerald-700 bg-white p-5 shadow-sm transition duration-200 hover:-translate-y-0.5 hover:shadow-md sm:p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Total Courses</p>
                            <h4
                                class="mt-2 text-3xl font-bold text-slate-900 transition-colors group-hover:text-emerald-800">
                                {{ $courses_num }}</h4>
                            <span class="inline-flex items-center text-xs font-medium text-emerald-600 mt-2">
                                ↑ 12% this month
                            </span>
                        </div>
                        <div
                            class="flex h-12 w-12 items-center justify-center rounded-md bg-emerald-50 text-2xl text-emerald-800 transition-colors group-hover:bg-emerald-800 group-hover:text-white">
                            🎓
                        </div>
                    </div>
                </div>

                <!-- Active Students Card -->
                <div
                    class="group rounded-lg border border-slate-200 border-t-2 border-t-teal-700 bg-white p-5 shadow-sm transition duration-200 hover:-translate-y-0.5 hover:shadow-md sm:p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Active Students</p>
                            <h4
                                class="mt-2 text-3xl font-bold text-slate-900 transition-colors group-hover:text-teal-800">
                                {{ $users_num }}</h4>
                            <span class="inline-flex items-center text-xs font-medium text-emerald-600 mt-2">
                                ↑ 24% new enrollments
                            </span>
                        </div>
                        <div
                            class="flex h-12 w-12 items-center justify-center rounded-md bg-teal-50 text-2xl text-teal-800 transition-colors group-hover:bg-teal-800 group-hover:text-white">
                            👨‍🎓
                        </div>
                    </div>
                </div>

                <!-- Instructors Card -->
                <div
                    class="group rounded-lg border border-slate-200 border-t-2 border-t-amber-500 bg-white p-5 shadow-sm transition duration-200 hover:-translate-y-0.5 hover:shadow-md sm:p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Instructors</p>
                            <h4
                                class="mt-2 text-3xl font-bold text-slate-900 transition-colors group-hover:text-amber-700">
                                {{ $instructors_num }}</h4>
                            <span class="inline-flex items-center text-xs font-medium text-amber-700 mt-2">
                                Fully verified
                            </span>
                        </div>
                        <div
                            class="flex h-12 w-12 items-center justify-center rounded-md bg-amber-50 text-2xl text-amber-700 transition-colors group-hover:bg-amber-600 group-hover:text-white">
                            👨‍🏫
                        </div>
                    </div>
                </div>

                <!-- Blog Articles Card -->
                <div
                    class="group rounded-lg border border-slate-200 border-t-2 border-t-sky-700 bg-white p-5 shadow-sm transition duration-200 hover:-translate-y-0.5 hover:shadow-md sm:p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Blog Posts</p>
                            <h4
                                class="mt-2 text-3xl font-bold text-slate-900 transition-colors group-hover:text-sky-800">
                                {{ $blogs_num }}</h4>
                            <span class="inline-flex items-center text-xs font-medium text-emerald-600 mt-2">
                                ↑ 5 posts this week
                            </span>
                        </div>
                        <div
                            class="flex h-12 w-12 items-center justify-center rounded-md bg-sky-50 text-2xl text-sky-800 transition-colors group-hover:bg-sky-800 group-hover:text-white">
                            📝
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Management Tools -->
            <div class="space-y-4">
                <div class="flex items-center justify-between">
                    <h3 class="text-lg font-bold text-slate-900">Quick Actions</h3>
                    <span class="rounded-sm bg-emerald-50 px-3 py-1 text-xs font-medium text-emerald-800">Management
                        Tools</span>
                </div>
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4">
                    <a href="{{ route('dashboard.courses.index') }}"
                        class="group flex flex-col items-center justify-center space-y-2 rounded-md border border-slate-200 bg-white p-4 text-center transition hover:border-emerald-300 hover:bg-emerald-50/60 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-emerald-700 sm:p-5">
                        <span
                            class="rounded-md bg-emerald-50 p-3 text-2xl transition-transform group-hover:scale-105">📚</span>
                        <span class="text-xs font-bold text-slate-700 group-hover:text-emerald-800">Courses</span>
                    </a>

                    <a href="#"
                        class="group flex flex-col items-center justify-center space-y-2 rounded-md border border-slate-200 bg-white p-4 text-center transition hover:border-amber-300 hover:bg-amber-50/60 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-amber-700 sm:p-5">
                        <span
                            class="rounded-md bg-amber-50 p-3 text-2xl transition-transform group-hover:scale-105">🏷️</span>
                        <span class="text-xs font-bold text-slate-700 group-hover:text-amber-800">Categories</span>
                    </a>

                    <a href="#"
                        class="group flex flex-col items-center justify-center space-y-2 rounded-md border border-slate-200 bg-white p-4 text-center transition hover:border-teal-300 hover:bg-teal-50/60 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-teal-700 sm:p-5">
                        <span
                            class="rounded-md bg-teal-50 p-3 text-2xl transition-transform group-hover:scale-105">👨‍🏫</span>
                        <span class="text-xs font-bold text-slate-700 group-hover:text-teal-800">Instructors</span>
                    </a>

                    <a href="{{ route('dashboard.users.index') }}"
                        class="group flex flex-col items-center justify-center space-y-2 rounded-md border border-slate-200 bg-white p-4 text-center transition hover:border-sky-300 hover:bg-sky-50/60 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-sky-700 sm:p-5">
                        <span
                            class="rounded-md bg-sky-50 p-3 text-2xl transition-transform group-hover:scale-105">👥</span>
                        <span class="text-xs font-bold text-slate-700 group-hover:text-sky-800">Users</span>
                    </a>

                    <a href="{{ route('dashboard.blogs.index') }}"
                        class="group flex flex-col items-center justify-center space-y-2 rounded-md border border-slate-200 bg-white p-4 text-center transition hover:border-rose-300 hover:bg-rose-50/60 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-rose-700 sm:p-5">
                        <span
                            class="rounded-md bg-rose-50 p-3 text-2xl transition-transform group-hover:scale-105">✍️</span>
                        <span class="text-xs font-bold text-slate-700 group-hover:text-rose-800">Blogs</span>
                    </a>


                </div>
            </div>

            <!-- Content Grid: Latest Courses & Top Instructors -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Latest Courses Table (2 Columns) -->
                <div class="space-y-4 rounded-lg border border-slate-200 bg-white p-5 shadow-sm sm:p-6 lg:col-span-2">
                    <div class="flex items-center justify-between border-b border-slate-100 pb-4">
                        <div>
                            <h3 class="text-lg font-bold text-slate-900">Latest Courses</h3>
                            <p class="text-xs text-slate-500">Recently published learning courses</p>
                        </div>
                        <a href="{{ route('dashboard.courses.index') }}"
                            class="rounded-sm px-2 py-1 text-xs font-bold text-emerald-800 transition hover:bg-emerald-50 focus-visible:outline focus-visible:outline-2 focus-visible:outline-emerald-700">View
                            All →</a>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-left text-sm text-slate-600">
                            <thead class="bg-emerald-50 text-xs uppercase text-emerald-900">
                                <tr>
                                    <th scope="col" class="rounded-l-md px-4 py-3">Course Title</th>
                                    <th scope="col" class="px-4 py-3">Instructor</th>
                                    <th scope="col" class="px-4 py-3">Price</th>
                                    <th scope="col" class="rounded-r-md px-4 py-3">Status</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100">
                                @forelse ($courses as $course)
                                    <tr class="transition hover:bg-emerald-50/40">
                                        <td class="flex items-center gap-3 px-4 py-3.5 font-semibold text-slate-800">
                                            <div
                                                class="flex h-10 w-10 shrink-0 items-center justify-center rounded-md bg-amber-50 text-base font-bold text-amber-800">
                                                💻
                                            </div>
                                            <span>{{ $course->title }}</span>
                                        </td>
                                        <td class="px-4 py-3.5 text-xs font-medium">{{ $course->instructor->name }}
                                        </td>
                                        <td class="px-4 py-3.5 font-bold text-emerald-800">{{ $course->price }} $</td>
                                        <td class="px-4 py-3.5">
                                            @if ($course->date != null)
                                                <span
                                                    class="rounded-sm border px-2.5 py-1 text-xs font-bold {{ $course->date > now() ? 'border-emerald-200 bg-emerald-50 text-emerald-800' : 'border-rose-200 bg-rose-50 text-rose-700' }}">{{ $course->date > now() ? 'active' : 'Done' }}</span>
                                            @else
                                                <span
                                                    class="rounded-sm border border-slate-200 bg-slate-100 px-2.5 py-1 text-xs font-bold text-slate-600">Not
                                                    Avilable</span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4"
                                            class="px-4 py-10 text-center text-sm font-medium text-slate-500">Nothing
                                            Yet</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Instructors Spotlight (1 Column) -->
                <div class="space-y-4 rounded-lg border border-slate-200 bg-white p-5 shadow-sm sm:p-6">
                    <div class="flex items-center justify-between border-b border-slate-100 pb-4">
                        <h3 class="text-lg font-bold text-slate-900">Top Instructors</h3>
                        <a href="#"
                            class="rounded-sm px-2 py-1 text-xs font-bold text-emerald-800 transition hover:bg-emerald-50 focus-visible:outline focus-visible:outline-2 focus-visible:outline-emerald-700">View
                            All</a>
                    </div>

                    <div class="space-y-4">
                        @forelse ($instructors as $instructor)
                            <div
                                class="flex items-center justify-between gap-3 rounded-md border border-slate-100 bg-slate-50/70 p-3">
                                <div class="flex items-center gap-3">
                                    <div
                                        class="flex h-11 w-11 items-center justify-center rounded-md bg-amber-100 text-sm font-bold text-amber-900">
                                        HM
                                    </div>
                                    <div>
                                        <h4 class="text-sm font-bold text-slate-800">{{ $instructor->name }}</h4>
                                        <p class="text-xs text-slate-500">{{ $instructor->major }}</p>
                                    </div>
                                </div>
                                <span
                                    class="rounded-sm bg-emerald-50 px-2.5 py-1 text-xs font-bold text-emerald-800">{{ $instructor->courses->count() }}</span>
                            </div>

                        @empty
                        @endforelse
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
