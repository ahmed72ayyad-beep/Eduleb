<nav class="mb-8 overflow-x-auto border-b border-slate-200" aria-label="Student dashboard">
    <div class="flex min-w-max gap-2 sm:gap-6">
        <a href="{{ url('/student/dashboard') }}"
            class="border-b-2 px-3 py-3 text-sm font-semibold transition {{ request()->is('student/dashboard') ? 'border-indigo-600 text-indigo-700' : 'border-transparent text-slate-500 hover:border-slate-300 hover:text-slate-800' }}">Overview</a>
        <a href="{{ url('/student/courses') }}"
            class="border-b-2 px-3 py-3 text-sm font-semibold transition {{ request()->is('student/courses*') ? 'border-indigo-600 text-indigo-700' : 'border-transparent text-slate-500 hover:border-slate-300 hover:text-slate-800' }}">My
            courses</a>
        <a href="{{ url('/student/reviews') }}"
            class="border-b-2 px-3 py-3 text-sm font-semibold transition {{ request()->is('student/reviews*') ? 'border-indigo-600 text-indigo-700' : 'border-transparent text-slate-500 hover:border-slate-300 hover:text-slate-800' }}">My
            reviews</a>
        <a href="{{ url('/student/profile') }}"
            class="border-b-2 px-3 py-3 text-sm font-semibold transition {{ request()->is('student/profile') ? 'border-indigo-600 text-indigo-700' : 'border-transparent text-slate-500 hover:border-slate-300 hover:text-slate-800' }}">Profile
            & settings</a>
        <a href="{{ url('/student/notifications') }}"
            class="border-b-2 px-3 py-3 text-sm font-semibold transition {{ request()->is('student/notifications') ? 'border-indigo-600 text-indigo-700' : 'border-transparent text-slate-500 hover:border-slate-300 hover:text-slate-800' }}">Notifications</a>
    </div>
</nav>
