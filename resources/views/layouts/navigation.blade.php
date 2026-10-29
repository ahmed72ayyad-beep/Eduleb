<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                    </a>
                </div>

                <!-- Navigation Links -->
                @auth
                    @if (auth()->user()->hasRole('admin'))
                        <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                            <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                                {{ __('Dashboard') }}
                            </x-nav-link>
                            <x-nav-link :href="route('dashboard.courses.index')" :active="request()->routeIs('dashboard.courses.index')">
                                {{ __('Courses Management') }}
                            </x-nav-link>
                            <x-nav-link :href="route('dashboard.users.index')" :active="request()->routeIs('dashboard.users.index')">
                                {{ __('Users Management') }}
                            </x-nav-link>

                            <x-nav-link :href="route('dashboard.blogs.index')" :active="request()->routeIs('dashboard.blogs.index')">
                                {{ __('Blogs Management') }}
                            </x-nav-link>
                            <x-nav-link :href="route('dashboard.FAQs.index')" :active="request()->routeIs('dashboard.FAQs.index')">
                                {{ __('FAQs Management') }}
                            </x-nav-link>
                            <x-nav-link :href="route('student.applications.index')" :active="request()->routeIs('student.applications.index')">
                                {{ __(' Applications Managment') }}
                            </x-nav-link>
                        </div>
                    @elseif (auth()->user()->hasRole('student'))
                        <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                            <x-nav-link :href="route('dashboard')" :active="request()->routeIs('student.dashboard')">
                                {{ __('Dashboard') }}
                            </x-nav-link>

                            <x-nav-link :href="route('student.myCourses')" :active="request()->routeIs('student.myCourses*')">
                                {{ __('My courses') }}
                            </x-nav-link>
                            <x-nav-link :href="route('student.reviews')" :active="request()->routeIs('student.reviews*')">
                                {{ __('My reviews') }}
                            </x-nav-link>
                            {{-- <x-nav-link :href="route('student.profile')" :active="request()->routeIs('student.profile')">
                                {{ __('Profile & settings') }}
                            </x-nav-link> --}}
                            <x-nav-link :href="route('notifications')" :active="request()->routeIs('notifications')">
                                {{ __('Notifications') }}
                            </x-nav-link>
                            <x-nav-link :href="route('student.applications.index')" :active="request()->routeIs('student.applications.index')">
                                {{ __('My Applications') }}
                            </x-nav-link>
                        </div>
                        @elseif (auth()->user()->hasRole('instructor'))
                        <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">

                            <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                                {{ __('Dashboard') }}
                            </x-nav-link>

                            <x-nav-link :href="route('instructor.reviews')" :active="request()->routeIs('instructor.reviews')">
                                {{ __('reviews') }}
                            </x-nav-link>
                            <x-nav-link :href="route('instructor.courses')" :active="request()->routeIs('instructor.courses')">
                                {{ __('Courses') }}
                            </x-nav-link>
                            <x-nav-link :href="route('instructor.students')" :active="request()->routeIs('instructor.students')">
                                {{ __('Students') }}
                            </x-nav-link>
                            <x-nav-link :href="route('instructor.lesson_studio')" :active="request()->routeIs('instructor.lesson_studio')">
                                {{ __('Lesson Studio') }}
                            </x-nav-link>
                            <x-nav-link :href="route('student.applications.index')" :active="request()->routeIs('student.applications.index')">
                                {{ __('My Applications') }}
                            </x-nav-link>



                        </div>
                    @endif
                @endauth

            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex gap-x-2 sm:items-center sm:ms-6">
                <!-- Notification Dropdown Wrapper -->
                <div class="relative inline-block text-left" id="notification-wrapper">

                    <!-- زر الجرس -->
                    <button id="notification-btn" type="button"
                        class="relative p-2.5  text-gray-600 hover:scale-125 transition  focus:outline-none">
                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24"
                            fill="none">
                            <path
                                d="M8.35179 20.2418C9.19288 21.311 10.5142 22 12 22C13.4858 22 14.8071 21.311 15.6482 20.2418C13.2264 20.57 10.7736 20.57 8.35179 20.2418Z"
                                fill="#525fe1" />
                            <path
                                d="M18.7491 9V9.7041C18.7491 10.5491 18.9903 11.3752 19.4422 12.0782L20.5496 13.8012C21.5612 15.3749 20.789 17.5139 19.0296 18.0116C14.4273 19.3134 9.57274 19.3134 4.97036 18.0116C3.21105 17.5139 2.43882 15.3749 3.45036 13.8012L4.5578 12.0782C5.00972 11.3752 5.25087 10.5491 5.25087 9.7041V9C5.25087 5.13401 8.27256 2 12 2C15.7274 2 18.7491 5.13401 18.7491 9Z"
                                fill="#525fe1" />
                        </svg>

                        <!-- البادج الأحمر لعدد الرسائل -->
                        @if (auth()->user()->unreadNotifications->count() > 0)
                            <span
                                class="absolute -top-1 -right-1 bg-rose-500 text-white text-[10px] font-bold w-5 h-5 rounded-full flex items-center justify-center border-2 border-white">
                                {{ auth()->user()->unreadNotifications->count() }}

                            </span>
                        @endif
                    </button>

                    <!-- قائمة الإشعارات (مخفية افتراضياً باستخدام hidden) -->
                    <div id="notification-menu" style="width: 380px"
                        class="hidden absolute right-0 mt-3  bg-white rounded-3xl shadow-xl border border-gray-100 overflow-hidden z-50">

                        <!-- رأس القائمة -->
                        <div
                            class="px-5 py-4 border-b border-gray-100 flex items-center justify-between bg-slate-50/50">
                            <h3 class="font-bold text-gray-800 text-sm">Notifications</h3>
                            @if (auth()->user()->unreadNotifications->count() > 0)
                                <span
                                    class="text-[10px] font-semibold bg-indigo-50 text-indigo-600 px-2.5 py-1 rounded-full">{{ auth()->user()->unreadNotifications->count() }}
                                    New</span>
                            @endif
                        </div>

                        <!-- محتوى الإشعارات (كل إشعار رابط) -->
                        <div class="divide-y divide-gray-50 max-h-72 overflow-y-auto">
                            @forelse (auth()->user()->unreadNotifications as $notify)
                                <div class="flex justify-between items-center ">
                                    <div href="#" class="flex flex-col p-4 ">
                                        <p class="text-sm font-bold text-gray-800 flex items-center gap-x-1">
                                            <span>{{ $notify->data['title'] }}</span><svg
                                                xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                viewBox="0 0 24 24" fill="none">
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                    d="M9.94358 3.25H14.0564C15.8942 3.24998 17.3498 3.24997 18.489 3.40314C19.6614 3.56076 20.6104 3.89288 21.3588 4.64124C22.1071 5.38961 22.4392 6.33856 22.5969 7.51098C22.75 8.65019 22.75 10.1058 22.75 11.9436V12.0564C22.75 13.8942 22.75 15.3498 22.5969 16.489C22.4392 17.6614 22.1071 18.6104 21.3588 19.3588C20.6104 20.1071 19.6614 20.4392 18.489 20.5969C17.3498 20.75 15.8942 20.75 14.0564 20.75H9.94359C8.10583 20.75 6.65019 20.75 5.51098 20.5969C4.33856 20.4392 3.38961 20.1071 2.64124 19.3588C1.89288 18.6104 1.56076 17.6614 1.40314 16.489C1.24997 15.3498 1.24998 13.8942 1.25 12.0564V11.9436C1.24998 10.1058 1.24997 8.65019 1.40314 7.51098C1.56076 6.33856 1.89288 5.38961 2.64124 4.64124C3.38961 3.89288 4.33856 3.56076 5.51098 3.40314C6.65019 3.24997 8.10582 3.24998 9.94358 3.25ZM5.71085 4.88976C4.70476 5.02502 4.12511 5.27869 3.7019 5.7019C3.27869 6.12511 3.02502 6.70476 2.88976 7.71085C2.75159 8.73851 2.75 10.0932 2.75 12C2.75 13.9068 2.75159 15.2615 2.88976 16.2892C3.02502 17.2952 3.27869 17.8749 3.7019 18.2981C4.12511 18.7213 4.70476 18.975 5.71085 19.1102C6.73851 19.2484 8.09318 19.25 10 19.25H14C15.9068 19.25 17.2615 19.2484 18.2892 19.1102C19.2952 18.975 19.8749 18.7213 20.2981 18.2981C20.7213 17.8749 20.975 17.2952 21.1102 16.2892C21.2484 15.2615 21.25 13.9068 21.25 12C21.25 10.0932 21.2484 8.73851 21.1102 7.71085C20.975 6.70476 20.7213 6.12511 20.2981 5.7019C19.8749 5.27869 19.2952 5.02502 18.2892 4.88976C17.2615 4.75159 15.9068 4.75 14 4.75H10C8.09318 4.75 6.73851 4.75159 5.71085 4.88976ZM5.42383 7.51986C5.68901 7.20165 6.16193 7.15866 6.48014 7.42383L8.63903 9.22291C9.57199 10.0004 10.2197 10.5384 10.7666 10.8901C11.2959 11.2306 11.6549 11.3449 12 11.3449C12.3451 11.3449 12.7041 11.2306 13.2334 10.8901C13.7803 10.5384 14.428 10.0004 15.361 9.22291L17.5199 7.42383C17.8381 7.15866 18.311 7.20165 18.5762 7.51986C18.8413 7.83807 18.7983 8.31099 18.4801 8.57617L16.2836 10.4066C15.3973 11.1452 14.6789 11.7439 14.0448 12.1517C13.3843 12.5765 12.7411 12.8449 12 12.8449C11.2589 12.8449 10.6157 12.5765 9.95518 12.1517C9.32112 11.7439 8.60272 11.1452 7.71636 10.4066L5.51986 8.57617C5.20165 8.31099 5.15866 7.83807 5.42383 7.51986Z"
                                                    fill="currentColor" />
                                            </svg>
                                        </p>
                                        <p class="text-xs text-gray-500 mt-0.5">{!! $notify->data['content'] !!}
                                        </p>
                                        <span
                                            class="text-[9px] text-indigo-500 font-medium mt-1 inline-block">{{ $notify->created_at }}</span>
                                        @if ($notify->data['link'] != null)
                                            <a class="flex text-sm items-center gap-3"
                                                href="{{ $notify->data['link'] }}"><span
                                                    class="text-blue-400 hover:text-blue-700">{{ $notify->data['link_text'] }}</span><svg
                                                    xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    viewBox="0 0 24 24" fill="none">
                                                    <path
                                                        d="M6.56739 1.25H12.4326C13.385 1.24999 14.1456 1.24999 14.7599 1.30018C15.3899 1.35165 15.9318 1.45963 16.4295 1.71322C17.2291 2.12068 17.8793 2.77085 18.2868 3.57054C18.5404 4.06824 18.6483 4.61012 18.6998 5.24013C18.75 5.85438 18.75 6.6149 18.75 7.5673V9C18.75 9.41421 18.4142 9.75 18 9.75C17.5858 9.75 17.25 9.41421 17.25 9V7.6C17.25 6.60753 17.2494 5.90829 17.2048 5.36228C17.1609 4.82503 17.0782 4.50252 16.9503 4.25153C16.6866 3.73408 16.2659 3.31338 15.7485 3.04973C15.4975 2.92184 15.175 2.83909 14.6377 2.79519C14.0917 2.75058 13.3925 2.75 12.4 2.75H6.6C5.60753 2.75 4.90829 2.75058 4.36228 2.79519C3.82503 2.83909 3.50252 2.92184 3.25153 3.04973C2.73408 3.31338 2.31338 3.73408 2.04973 4.25153C1.92184 4.50252 1.83909 4.82503 1.79519 5.36228C1.75058 5.90829 1.75 6.60753 1.75 7.6V16.4C1.75 17.3925 1.75058 18.0917 1.79519 18.6377C1.83909 19.175 1.92184 19.4975 2.04973 19.7485C2.31338 20.2659 2.73408 20.6866 3.25153 20.9503C3.50252 21.0782 3.82503 21.1609 4.36228 21.2048C4.90829 21.2494 5.60753 21.25 6.6 21.25H11.7546C12.1688 21.25 12.5046 21.5858 12.5046 22C12.5046 22.4142 12.1688 22.75 11.7546 22.75H6.56737C5.61497 22.75 4.85438 22.75 4.24013 22.6998C3.61012 22.6483 3.06824 22.5404 2.57054 22.2868C1.77085 21.8793 1.12068 21.2291 0.713223 20.4295C0.459634 19.9318 0.35165 19.3899 0.300176 18.7599C0.249989 18.1456 0.249994 17.3851 0.25 16.4326V7.56739C0.249994 6.61495 0.249989 5.85439 0.300176 5.24013C0.35165 4.61012 0.459634 4.06824 0.713223 3.57054C1.12068 2.77085 1.77085 2.12068 2.57054 1.71322C3.06824 1.45963 3.61012 1.35165 4.24013 1.30018C4.85439 1.24999 5.61495 1.24999 6.56739 1.25Z"
                                                        fill="currentColor" />
                                                    <path
                                                        d="M4.75 8C4.75 7.58579 5.08579 7.25 5.5 7.25H9.5C9.91421 7.25 10.25 7.58579 10.25 8C10.25 8.41421 9.91421 8.75 9.5 8.75H5.5C5.08579 8.75 4.75 8.41421 4.75 8Z"
                                                        fill="currentColor" />
                                                    <path
                                                        d="M4.75 12C4.75 11.5858 5.08579 11.25 5.5 11.25H11.7546C12.1688 11.25 12.5046 11.5858 12.5046 12C12.5046 12.4142 12.1688 12.75 11.7546 12.75H5.5C5.08579 12.75 4.75 12.4142 4.75 12Z"
                                                        fill="currentColor" />
                                                    <path
                                                        d="M4.75 16C4.75 15.5858 5.08579 15.25 5.5 15.25H10.0619C10.4761 15.25 10.8119 15.5858 10.8119 16C10.8119 16.4142 10.4761 16.75 10.0619 16.75H5.5C5.08579 16.75 4.75 16.4142 4.75 16Z"
                                                        fill="currentColor" />
                                                    <path
                                                        d="M20.4419 15.3081C20.686 15.5521 20.686 15.9479 20.4419 16.1919L17.9419 18.6919C17.8244 18.8095 17.6649 18.8753 17.4987 18.875C17.3325 18.8747 17.1733 18.8081 17.0563 18.6901L15.5563 17.1778C15.3132 16.9327 15.3148 16.537 15.5599 16.2939C15.8049 16.0508 16.2007 16.0525 16.4437 16.2975L17.5018 17.3643L19.5581 15.3081C19.8021 15.064 20.1979 15.064 20.4419 15.3081Z"
                                                        fill="currentColor" />
                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M12.25 17C12.25 13.8244 14.8244 11.25 18 11.25C21.1756 11.25 23.75 13.8244 23.75 17C23.75 20.1756 21.1756 22.75 18 22.75C14.8244 22.75 12.25 20.1756 12.25 17ZM18 12.75C15.6528 12.75 13.75 14.6528 13.75 17C13.75 19.3472 15.6528 21.25 18 21.25C20.3472 21.25 22.25 19.3472 22.25 17C22.25 14.6528 20.3472 12.75 18 12.75Z"
                                                        fill="currentColor" />
                                                </svg></a>
                                        @endif
                                    </div>
                                    <button title="mark as readed"
                                        onclick="mark_as_readed(event,'{{ $notify->id }}')"><svg
                                            xmlns="http://www.w3.org/2000/svg" width="30" height="30"
                                            viewBox="0 0 24 24" fill="none">
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M15.4933 6.93502C15.8053 7.20743 15.8374 7.68122 15.565 7.99325L7.70786 16.9933C7.56543 17.1564 7.35943 17.25 7.14287 17.25C6.9263 17.25 6.72031 17.1564 6.57788 16.9933L3.43502 13.3933C3.16261 13.0812 3.19473 12.6074 3.50677 12.335C3.8188 12.0626 4.29259 12.0947 4.565 12.4068L7.14287 15.3596L14.435 7.00677C14.7074 6.69473 15.1812 6.66261 15.4933 6.93502Z"
                                                fill="#6b7280" />
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M20.5175 7.01946C20.8174 7.30513 20.829 7.77986 20.5433 8.07981L11.9716 17.0798C11.8201 17.2389 11.6065 17.3235 11.3872 17.3114C11.1679 17.2993 10.9649 17.1917 10.8318 17.0169L10.4035 16.4544C10.1526 16.1249 10.2163 15.6543 10.5458 15.4034C10.8289 15.1878 11.2161 15.2044 11.4787 15.4223L19.4571 7.04531C19.7428 6.74537 20.2175 6.73379 20.5175 7.01946Z"
                                                fill="#6b7280" />
                                        </svg></button>
                                </div>
                            @empty
                                <div class="m-4 text-20px font-semibold text-center">No Unreaded Notifications
                                </div>
                            @endforelse


                        </div>

                        <!-- زر الانتقال لصفحة كل الإشعارات بالنهاية -->
                        <div class="p-3 bg-slate-50/50 border-t border-gray-100 text-center">
                            <a href="{{ route('notifications') }}"
                                class="text-xs font-bold text-indigo-600 hover:text-indigo-700 transition">
                                View All Notifications →
                            </a>
                        </div>

                    </div>
                </div>






                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button
                            class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                            <div>{{ Auth::user()->name }}</div>

                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>
                        <x-dropdown-link :href="route('home')">
                            {{ __('Go to The Website') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>






            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('student.applications.index')" :active="request()->routeIs('student.applications.index')">
                {{ __('Applications') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                        onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>







<script>
    function mark_as_readed(e, notify_id) {
        // let notify = notify_id
        e.preventDefault();
        fetch("{{ route('notify.mark_as_readed', ':id') }}".replace(':id', notify_id)).then((result) => {
            e.target.parentElement.parentElement.style.display = "none"
            // console.log(e.target.parentElement.parentElement);
            //  e.target.parentElement.parentElement.parentElement
            console.log(e.target.parentElement.parentElement.parentElement.childNodes());

            // if (!e.target.parentElement.parentElement.parentElement.hasChildNodes()) {
            //     let empty = document.createElement("div");
            //     empty.classList.append("m-4")
            //     empty.classList.append("text-lg")
            //     empty.classList.append("font-semibold")
            //     empty.classList.append("text-center")
            //     empty.textContent = "No unreaded Notifigation"
            //     e.target.parentElement.parentElement.parentElement.appendChild("empty")
            // }

        }).catch((err) => {

        });







    }
</script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const btn = document.getElementById("notification-btn");
        const menu = document.getElementById("notification-menu");
        const wrapper = document.getElementById("notification-wrapper");

        // إظهار أو إخفاء القائمة عند الضغط على الجرس
        btn.addEventListener("click", function(e) {
            e.stopPropagation();
            menu.classList.toggle("hidden");
        });

        // إغلاق القائمة عند الضغط في أي مكان خارج المكون
        document.addEventListener("click", function(e) {
            if (!wrapper.contains(e.target)) {
                menu.classList.add("hidden");
            }
        });
    });
</script>
