<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <h2 class="font-bold text-2xl text-gray-800 leading-tight">
                    {{ __('Main Dashboard') }}
                </h2>
                <p class="text-sm text-gray-500 mt-1">Welcome back, {{ auth()->user()->name }}! Manage your <span
                        class="text-indigo-600 font-semibold text-lg">EduLeb</span> platform seamlessly.</p>
            </div>
            <div class="flex items-center gap-3">
                <span
                    class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-indigo-50 text-indigo-700 border border-indigo-100">
                    <span class="w-2 h-2 rounded-full bg-emerald-500 mr-1.5 animate-pulse"></span>
                    {{ auth()->user()->getRoleNames()->first() ? ucfirst(auth()->user()->getRoleNames()->first()) : 'No Role' }}
                </span>
            </div>
        </div>
    </x-slot>

    <div class="py-8 bg-gradient-to-br from-slate-50 via-indigo-50/20 to-purple-50/30 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            <!-- Banner / Hero Section -->
            <div
                class="relative overflow-hidden rounded-3xl bg-gradient-to-r from-indigo-600 via-indigo-700 to-purple-700 p-8 text-white shadow-xl shadow-indigo-200">
                <div class="relative z-10 max-w-2xl space-y-3">
                    <span
                        class="inline-block px-3 py-1 bg-white/20 backdrop-blur-md rounded-full text-xs font-medium tracking-wide uppercase">
                        EduLab Management Suite
                    </span>
                    <h3 class="text-3xl font-extrabold tracking-tight sm:text-4xl">
                        Smart Learning & Knowledge Hub Dashboard
                    </h3>
                    <p class="text-indigo-100 text-sm leading-relaxed">
                        Track course performance, student engagement, instructor activities, blog posts, and reviews all
                        from one place.
                    </p>
                </div>
                <!-- Decorative Elements -->
                <div
                    class="absolute -bottom-10 -right-10 w-72 h-72 bg-purple-500/30 rounded-full blur-3xl pointer-events-none">
                </div>
                <div
                    class="absolute top-0 right-1/3 w-48 h-48 bg-indigo-400/20 rounded-full blur-2xl pointer-events-none">
                </div>
            </div>

            <!-- Key Metrics / Stats Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Courses Card -->
                <div
                    class="bg-white/80 backdrop-blur-sm p-6 rounded-2xl shadow-sm border border-gray-100 hover:shadow-md transition-all duration-300 group">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Total Courses</p>
                            <h4
                                class="text-3xl font-bold text-gray-800 mt-2 group-hover:text-indigo-600 transition-colors">
                                {{ $courses_num }}</h4>
                            <span class="inline-flex items-center text-xs font-medium text-emerald-600 mt-2">
                                ↑ 12% this month
                            </span>
                        </div>
                        <div
                            class="w-14 h-14 rounded-2xl bg-indigo-50 text-indigo-600 flex items-center justify-center text-2xl group-hover:bg-indigo-600 group-hover:text-white transition-all shadow-sm">
                            🎓
                        </div>
                    </div>
                </div>

                <!-- Active Students Card -->
                <div
                    class="bg-white/80 backdrop-blur-sm p-6 rounded-2xl shadow-sm border border-gray-100 hover:shadow-md transition-all duration-300 group">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Active Students</p>
                            <h4
                                class="text-3xl font-bold text-gray-800 mt-2 group-hover:text-indigo-600 transition-colors">
                                {{ $users_num }}</h4>
                            <span class="inline-flex items-center text-xs font-medium text-emerald-600 mt-2">
                                ↑ 24% new enrollments
                            </span>
                        </div>
                        <div
                            class="w-14 h-14 rounded-2xl bg-purple-50 text-purple-600 flex items-center justify-center text-2xl group-hover:bg-purple-600 group-hover:text-white transition-all shadow-sm">
                            👨‍🎓
                        </div>
                    </div>
                </div>

                <!-- Instructors Card -->
                <div
                    class="bg-white/80 backdrop-blur-sm p-6 rounded-2xl shadow-sm border border-gray-100 hover:shadow-md transition-all duration-300 group">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Instructors</p>
                            <h4
                                class="text-3xl font-bold text-gray-800 mt-2 group-hover:text-indigo-600 transition-colors">
                                {{ $instructors_num }}</h4>
                            <span class="inline-flex items-center text-xs font-medium text-indigo-600 mt-2">
                                Fully verified
                            </span>
                        </div>
                        <div
                            class="w-14 h-14 rounded-2xl bg-amber-50 text-amber-600 flex items-center justify-center text-2xl group-hover:bg-amber-600 group-hover:text-white transition-all shadow-sm">
                            👨‍🏫
                        </div>
                    </div>
                </div>

                <!-- Blog Articles Card -->
                <div
                    class="bg-white/80 backdrop-blur-sm p-6 rounded-2xl shadow-sm border border-gray-100 hover:shadow-md transition-all duration-300 group">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Blog Posts</p>
                            <h4
                                class="text-3xl font-bold text-gray-800 mt-2 group-hover:text-indigo-600 transition-colors">
                                {{ $blogs_num }}</h4>
                            <span class="inline-flex items-center text-xs font-medium text-emerald-600 mt-2">
                                ↑ 5 posts this week
                            </span>
                        </div>
                        <div
                            class="w-14 h-14 rounded-2xl bg-blue-50 text-blue-600 flex items-center justify-center text-2xl group-hover:bg-blue-600 group-hover:text-white transition-all shadow-sm">
                            📝
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Management Tools -->
            <div class="bg-white rounded-3xl p-6 shadow-sm border border-gray-100 space-y-4">
                <div class="flex items-center justify-between">
                    <h3 class="text-lg font-bold text-gray-800">Quick Actions</h3>
                    <span class="text-xs text-indigo-600 font-medium bg-indigo-50 px-3 py-1 rounded-full">Management
                        Tools</span>
                </div>
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4">
                    <a href="{{ route('dashboard.courses.index') }}"
                        class="flex flex-col items-center justify-center p-5 rounded-2xl bg-slate-50 border border-slate-100 hover:border-indigo-200 hover:bg-indigo-50/50 hover:text-indigo-600 transition-all duration-200 group text-center space-y-2">
                        <span
                            class="text-2xl p-3 bg-white rounded-xl shadow-xs group-hover:scale-110 transition-transform">📚</span>
                        <span class="text-xs font-bold text-gray-700 group-hover:text-indigo-600">Courses</span>
                    </a>

                    <a href="#"
                        class="flex flex-col items-center justify-center p-5 rounded-2xl bg-slate-50 border border-slate-100 hover:border-indigo-200 hover:bg-indigo-50/50 hover:text-indigo-600 transition-all duration-200 group text-center space-y-2">
                        <span
                            class="text-2xl p-3 bg-white rounded-xl shadow-xs group-hover:scale-110 transition-transform">🏷️</span>
                        <span class="text-xs font-bold text-gray-700 group-hover:text-indigo-600">Categories</span>
                    </a>

                    <a href="#"
                        class="flex flex-col items-center justify-center p-5 rounded-2xl bg-slate-50 border border-slate-100 hover:border-indigo-200 hover:bg-indigo-50/50 hover:text-indigo-600 transition-all duration-200 group text-center space-y-2">
                        <span
                            class="text-2xl p-3 bg-white rounded-xl shadow-xs group-hover:scale-110 transition-transform">👨‍🏫</span>
                        <span class="text-xs font-bold text-gray-700 group-hover:text-indigo-600">Instructors</span>
                    </a>

                    <a href="{{ route("dashboard.users.index") }}"
                        class="flex flex-col items-center justify-center p-5 rounded-2xl bg-slate-50 border border-slate-100 hover:border-indigo-200 hover:bg-indigo-50/50 hover:text-indigo-600 transition-all duration-200 group text-center space-y-2">
                        <span
                            class="text-2xl p-3 bg-white rounded-xl shadow-xs group-hover:scale-110 transition-transform">👥</span>
                        <span class="text-xs font-bold text-gray-700 group-hover:text-indigo-600">Users</span>
                    </a>

                    <a href="{{ route("dashboard.blogs.index") }}"
                        class="flex flex-col items-center justify-center p-5 rounded-2xl bg-slate-50 border border-slate-100 hover:border-indigo-200 hover:bg-indigo-50/50 hover:text-indigo-600 transition-all duration-200 group text-center space-y-2">
                        <span
                            class="text-2xl p-3 bg-white rounded-xl shadow-xs group-hover:scale-110 transition-transform">✍️</span>
                        <span class="text-xs font-bold text-gray-700 group-hover:text-indigo-600">Blogs</span>
                    </a>


                </div>
            </div>

            <!-- Content Grid: Latest Courses & Top Instructors -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Latest Courses Table (2 Columns) -->
                <div class="lg:col-span-2 bg-white rounded-3xl p-6 shadow-sm border border-gray-100 space-y-4">
                    <div class="flex items-center justify-between border-b border-gray-100 pb-4">
                        <div>
                            <h3 class="text-lg font-bold text-gray-800">Latest Courses</h3>
                            <p class="text-xs text-gray-400">Recently published learning courses</p>
                        </div>
                        <a href="{{ route("dashboard.courses.index") }}"
                            class="text-xs font-bold text-indigo-600 hover:text-indigo-800 transition">View All →</a>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left text-gray-600">
                            <thead class="text-xs text-gray-400 uppercase bg-slate-50 rounded-xl">
                                <tr>
                                    <th scope="col" class="py-3 px-4 rounded-l-xl">Course Title</th>
                                    <th scope="col" class="py-3 px-4">Instructor</th>
                                    <th scope="col" class="py-3 px-4">Price</th>
                                    <th scope="col" class="py-3 px-4 rounded-r-xl">Status</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-50">
                                @forelse ($courses as $course)
                                    <tr class="hover:bg-slate-50/50 transition">
                                        <td class="py-3.5 px-4 font-semibold text-gray-800 flex items-center gap-3">
                                            <div
                                                class="w-10 h-10 rounded-xl bg-indigo-100 text-indigo-600 flex items-center justify-center font-bold text-base shrink-0">
                                                💻
                                            </div>
                                            <span>{{ $course->title }}</span>
                                        </td>
                                        <td class="py-3.5 px-4 text-xs font-medium">{{ $course->instructor->name }}</td>
                                        <td class="py-3.5 px-4 font-bold text-indigo-600">{{ $course->price }} $</td>
                                        <td class="py-3.5 px-4">
                                            @if ($course->date != null)
                                                <span
                                                    class="bg-emerald-50  {{ $course->date > now() ? 'text-emerald-600' : 'text-red-600' }} text-xs font-bold px-2.5 py-1 rounded-full border border-emerald-100">{{ $course->date > now() ? 'active' : 'Done' }}</span>
                                            @else
                                                <span
                                                    class="bg-emerald-50 text-gray-400  text-xs font-bold px-2.5 py-1 rounded-full border border-emerald-100">Not
                                                    Avilable</span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr class="text-3xl font-semibold"> Nothing Yet</tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Instructors Spotlight (1 Column) -->
                <div class="bg-white rounded-3xl p-6 shadow-sm border border-gray-100 space-y-4">
                    <div class="flex items-center justify-between border-b border-gray-100 pb-4">
                        <h3 class="text-lg font-bold text-gray-800">Top Instructors</h3>
                        <a href="#"
                            class="text-xs font-bold text-indigo-600 hover:text-indigo-800 transition">View All</a>
                    </div>

                    <div class="space-y-4">
                        @forelse ($instructors as $instructor)
                            <div
                                class="flex items-center justify-between p-3 rounded-2xl bg-slate-50/80 border border-slate-100">
                                <div class="flex items-center gap-3">
                                    <div
                                        class="w-11 h-11 rounded-full bg-purple-100 text-purple-700 font-bold flex items-center justify-center text-sm ring-2 ring-purple-200">
                                        HM
                                    </div>
                                    <div>
                                        <h4 class="text-sm font-bold text-gray-800">{{ $instructor->name }}</h4>
                                        <p class="text-xs text-gray-400">{{ $instructor->major }}</p>
                                    </div>
                                </div>
                                <span class="text-xs font-bold bg-indigo-50 text-indigo-600 px-2.5 py-1 rounded-lg">{{ $instructor->courses->count() }}</span>
                            </div>

                        @empty
                        @endforelse
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
