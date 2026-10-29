<x-app-layout>
    {{-- @dd($courses->count()) --}}

    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <h1 class="font-bold text-2xl text-gray-800 leading-tight">
                    {{ __('Courses Management') }}
                </h1>
                <p class="text-sm text-gray-500 mt-1">Create, update, and monitor all learning courses on <span
                        class="text-emerald-700 font-semibold text-lg">EduLeb</span>.</p>
            </div>

            @can('courses.create')
                <a href="{{ route('dashboard.courses.create') }}"
                    class="inline-flex items-center gap-2 rounded-md bg-emerald-800 px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-emerald-900 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-emerald-800">
                    <span class="text-lg">+</span> Add New Course
                </a>
            @endcan
        </div>
    </x-slot>

    <div class="min-h-screen bg-gradient-to-br from-slate-50 via-emerald-50/40 to-amber-50/30 py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            <!-- Filter & Search Bar Section -->
            <div
                class="flex flex-col items-center justify-between gap-4 rounded-lg border border-slate-200 bg-white p-5 shadow-sm md:flex-row sm:p-6">
                <!-- Search Input -->
                <div id="search_counter" class="relative w-full md:w-96">
                    <input id="search" type="text" placeholder="Search courses by title or instructor..."
                        class="w-full rounded-md border-slate-300 py-2.5 pl-10 pr-4 text-sm placeholder-slate-400 transition focus:border-emerald-600 focus:ring-emerald-600">
                    <span class="absolute left-3.5 top-3 text-gray-400 text-sm"><svg xmlns="http://www.w3.org/2000/svg"
                            width="20" height="20" viewBox="0 0 24 24" fill="none">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M 14.811 14.811 C 15.2016 14.4205 15.8346 14.4205 16.2252 14.811 L 21.707 20.2929 C 22.0975 20.6834 22.0975 21.3165 21.707 21.707 C 21.3165 22.0975 20.6834 22.0975 20.2929 21.707 L 14.811 16.2252 C 14.4205 15.8346 14.4205 15.2016 14.811 14.811 Z"
                                fill="currentColor"></path>
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M 2 10.3333 C 2 5.731 5.731 2 10.3333 2 C 14.9356 2 18.6666 5.731 18.6666 10.3333 C 18.6666 14.9356 14.9356 18.6666 10.3333 18.6666 C 5.731 18.6666 2 14.9356 2 10.3333 Z M 10.3333 4 C 6.8356 4 4 6.8356 4 10.3333 C 4 13.831 6.8356 16.6666 10.3333 16.6666 C 13.831 16.6666 16.6666 13.831 16.6666 10.3333 C 16.6666 6.8356 13.831 4 10.3333 4 Z"
                                fill="currentColor"></path>
                        </svg></span>
                    {{-- <ul
                        class="w-full bg-slate-200  flex flex-col justify-start content-center items-center z-50 absolute ">
                        <li class="w-full bg-slate-200 transition-all hover:bg-slate-100  px-2 py-3 ">
                            ssssssssssssssssssssssss
                        </li>
                        <li class="w-full bg-slate-300  px-2 py-3 ">
                            ssssssssssssssssssssssss
                        </li>
                        <li class="w-full bg-slate-300  px-2 py-3 ">
                            ssssssssssssssssssssssss
                        </li>
                    </ul> --}}
                </div>

                <!-- Filters -->
                <div class="flex flex-wrap items-center gap-3 w-full md:w-auto justify-start md:justify-end">

                    <form action="" onsubmit="return false;">
                        <select id="course-tag-filter" onchange="filterManagedCourses()"
                            class="rounded-md border-slate-300 px-4 py-2.5 text-xs font-semibold text-slate-700 focus:border-emerald-600 focus:ring-emerald-600">
                            <option selected value="all">All Tags</option>
                            @forelse ($tags as $tag)
                                <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                            @empty
                                <div>NO TAGS </div>
                            @endforelse

                        </select>

                        <select id="course-type-filter" onchange="filterManagedCourses()"
                            class="rounded-md border-slate-300 px-4 py-2.5 text-xs font-semibold text-slate-700 focus:border-emerald-600 focus:ring-emerald-600">
                            <option selected value="all">Course Type</option>
                            <option value="online">Online</option>
                            <option value="recorded">Recorded</option>
                        </select>

                        <button type="button" onclick="resetManagedCourseFilters()"
                            class="rounded-md bg-slate-100 px-4 py-2.5 text-xs font-semibold text-slate-700 transition hover:bg-slate-200 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-slate-500">
                            Reset Filters
                        </button>
                    </form>
                </div>
            </div>

            <!-- Courses Table Card -->
            <div class="space-y-6 rounded-lg border border-slate-200 bg-white p-5 shadow-sm sm:p-6">
                <div class="flex items-center justify-between border-b border-slate-100 pb-4">
                    <div>
                        <h2 class="text-2xl font-bold text-slate-900">All Courses</h2>
                        <p class="text-xs text-slate-500">Total Courses Available: <span
                                class="font-semibold text-emerald-800">
                                {{ $courses_num }}</span>
                        </p>
                    </div>
                    {{-- <span class="text-xs font-bold bg-indigo-50 text-indigo-600 px-3 py-1.5 rounded-full">
                        Page {{ $courses->currentPage() }} of {{ ceil($courses_num / 8) }}
                    </span> --}}
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm text-slate-600">
                        <thead class="bg-emerald-50 text-xs uppercase text-emerald-900">
                            <tr>
                                <th scope="col"
                                    class="h-9 w-64 overflow-hidden text-ellipsis rounded-l-md px-4 py-3.5">Course
                                    Details</th>
                                <th scope="col" class="py-3.5 px-4">Instructor</th>
                                <th scope="col" class="py-3.5 px-4">Price</th>
                                <th scope="col" class="py-3.5 px-4">Rating</th>
                                <th scope="col" class="py-3.5 px-4">Seats</th>
                                <th scope="col" class="py-3.5 px-4">Cert.</th>
                                <th scope="col" class="py-3.5 px-4">Status</th>
                                <th scope="col" class="rounded-r-md px-4 py-3.5 text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @forelse ($courses as $course)
                                <!-- Course Item 1 -->
                                <tr id="course{{ $course->id }}" data-course-row data-type="{{ $course->type }}"
                                    data-tags="{{ $course->tags->pluck('id')->implode(',') }}"
                                    class="transition-colors hover:bg-emerald-50/40">
                                    <td class="py-4 px-4 font-semibold text-gray-800 flex items-center gap-3">
                                        {{-- <div
                                        class="w-11 h-11 rounded-2xl bg-indigo-100 text-indigo-600 flex items-center justify-center font-bold text-lg shrink-0">

                                    </div> --}}
                                        <div>
                                            <div class="font-bold text-gray-900">{{ $course->title }}</div>
                                            <div class="text-xs text-gray-400 font-normal">Duration:
                                                {{ $course->duration }} • {{ $course->total_lectures }} Lectures</div>
                                        </div>
                                    </td>
                                    <td class="py-4 px-4">
                                        <div class="flex items-center gap-2">

                                            <img src="{{ asset($course->instructor->personal_image) }}"
                                                class="w-8 h-8 rounded-full bg-purple-100 text-purple-700 font-bold flex items-center justify-center text-xs transition-all hover:scale-150"
                                                alt="">
                                            <span
                                                class="text-xs font-semibold text-gray-700">{{ $course->instructor->name }}</span>
                                        </div>
                                    </td>
                                    <td class="py-4 px-4 font-bold text-emerald-800">{{ $course->price }} $</td>
                                    <td class="py-4 px-4">
                                        <span
                                            class="inline-flex items-center gap-1 text-xs font-bold text-amber-500 bg-amber-50 px-2.5 py-1 rounded-lg">
                                            ⭐ {{ $course->star_num }}
                                        </span>
                                    </td>
                                    <td class="py-4 px-4 text-xs font-semibold text-gray-600">
                                        {{ $course->available_seats }} Seats</td>
                                    <td class="py-4 px-4">
                                        <span
                                            class="bg-emerald-50 text-emerald-600 text-xs font-bold px-2 py-0.5 rounded-md border border-emerald-100">{{ $course->certification }}</span>
                                    </td>
                                    <td class="py-4 px-4">
                                        <span
                                            class=" text-xs font-bold px-2 py-0.5 rounded-md ">{{ $course->status }}</span>
                                    </td>
                                    <td class="py-4 px-4 text-right space-x-4 flex justify-end">
                                        @can('courses.update')
                                            <form method="GET"
                                                action="{{ route('dashboard.courses.edit', $course->id) }}">
                                                <button
                                                    class="flex items-center gap-1 rounded-md bg-emerald-50 p-2 text-sm font-semibold text-emerald-800 transition hover:bg-emerald-100 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-emerald-700">
                                                    Edit <svg xmlns="http://www.w3.org/2000/svg" width="15"
                                                        height="15" viewBox="0 0 24 24" fill="none">
                                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                                            d="M14.7566 2.62145C16.5852 0.792851 19.55 0.792851 21.3786 2.62145C23.2072 4.45005 23.2072 7.41479 21.3786 9.24339L11.8933 18.7287C11.3514 19.2706 11.0323 19.5897 10.6774 19.8665C10.2592 20.1927 9.80655 20.4725 9.32766 20.7007C8.92136 20.8943 8.49334 21.037 7.76623 21.2793L4.43511 22.3897L3.63303 22.6571C2.98247 22.8739 2.26522 22.7046 1.78032 22.2197C1.29542 21.7348 1.1261 21.0175 1.34296 20.367L2.72068 16.2338C2.96303 15.5067 3.10568 15.0787 3.29932 14.6724C3.52755 14.1935 3.80727 13.7409 4.13354 13.3226C4.41035 12.9677 4.72939 12.6487 5.27137 12.1067L14.7566 2.62145ZM4.40051 20.8201L7.24203 19.8729C8.03314 19.6092 8.36927 19.4958 8.68233 19.3466C9.06287 19.1653 9.42252 18.943 9.75492 18.6837C10.0284 18.4704 10.2801 18.2205 10.8698 17.6308L18.4393 10.0614C17.6506 9.78321 16.6346 9.26763 15.6835 8.31651C14.7324 7.36538 14.2168 6.34939 13.9387 5.56075L6.36917 13.1302C5.77951 13.7199 5.52959 13.9716 5.3163 14.2451C5.05704 14.5775 4.83476 14.9371 4.65341 15.3177C4.50421 15.6307 4.3908 15.9669 4.12709 16.758L3.17992 19.5995L4.40051 20.8201ZM15.1554 4.34404C15.1896 4.519 15.2474 4.75684 15.3438 5.03487C15.561 5.66083 15.9712 6.48288 16.7442 7.25585C17.5171 8.02881 18.3392 8.43903 18.9651 8.6562C19.2432 8.75266 19.481 8.81046 19.656 8.84466L20.3179 8.18272C21.5607 6.93991 21.5607 4.92492 20.3179 3.68211C19.0751 2.4393 17.0601 2.4393 15.8173 3.68211L15.1554 4.34404Z"
                                                            fill="currentColor" />
                                                    </svg>
                                                </button>
                                            </form>
                                        @endcan

                                        @can('courses.delete')
                                            <form method="POST"
                                                onsubmit="return confirm('هل أنت متأكد من رغبتك في حذف هذا الكورس نهائياً؟');"
                                                action="{{ route('dashboard.courses.destroy', $course->id) }}">
                                                {{-- @csrf() --}}
                                                @method('delete')

                                                <button type="submit"
                                                    class="flex items-center gap-1 rounded-md bg-rose-50 p-2 text-sm font-semibold text-rose-700 transition hover:bg-rose-100 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-rose-700">
                                                    Delete <svg xmlns="http://www.w3.org/2000/svg" width="20"
                                                        height="20" viewBox="0 0 24 24" fill="none">
                                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                                            d="M10.3094 2.25002H13.6908C13.9072 2.24988 14.0957 2.24976 14.2737 2.27819C14.977 2.39049 15.5856 2.82915 15.9146 3.46084C15.9978 3.62073 16.0573 3.79961 16.1256 4.00494L16.2373 4.33984C16.2562 4.39653 16.2616 4.41258 16.2661 4.42522C16.4413 4.90933 16.8953 5.23659 17.4099 5.24964C17.4235 5.24998 17.44 5.25004 17.5001 5.25004H20.5001C20.9143 5.25004 21.2501 5.58582 21.2501 6.00004C21.2501 6.41425 20.9143 6.75004 20.5001 6.75004H3.5C3.08579 6.75004 2.75 6.41425 2.75 6.00004C2.75 5.58582 3.08579 5.25004 3.5 5.25004H6.50008C6.56013 5.25004 6.5767 5.24998 6.59023 5.24964C7.10488 5.23659 7.55891 4.90936 7.73402 4.42524C7.73863 4.41251 7.74392 4.39681 7.76291 4.33984L7.87452 4.00496C7.94281 3.79964 8.00233 3.62073 8.08559 3.46084C8.41453 2.82915 9.02313 2.39049 9.72643 2.27819C9.90445 2.24976 10.093 2.24988 10.3094 2.25002ZM9.00815 5.25004C9.05966 5.14902 9.10531 5.04404 9.14458 4.93548C9.1565 4.90251 9.1682 4.86742 9.18322 4.82234L9.28302 4.52292C9.37419 4.24941 9.39519 4.19363 9.41601 4.15364C9.52566 3.94307 9.72853 3.79686 9.96296 3.75942C10.0075 3.75231 10.067 3.75004 10.3553 3.75004H13.6448C13.9331 3.75004 13.9927 3.75231 14.0372 3.75942C14.2716 3.79686 14.4745 3.94307 14.5842 4.15364C14.605 4.19363 14.626 4.2494 14.7171 4.52292L14.8169 4.82216L14.8556 4.9355C14.8949 5.04405 14.9405 5.14902 14.992 5.25004H9.00815Z"
                                                            fill="red" />
                                                        <path
                                                            d="M5.91509 8.45015C5.88754 8.03685 5.53016 7.72415 5.11686 7.7517C4.70357 7.77925 4.39086 8.13663 4.41841 8.54993L4.88186 15.5017C4.96736 16.7844 5.03642 17.8205 5.19839 18.6336C5.36679 19.4789 5.65321 20.185 6.2448 20.7385C6.8364 21.2919 7.55995 21.5308 8.4146 21.6425C9.23662 21.7501 10.275 21.7501 11.5606 21.75H12.4395C13.7251 21.7501 14.7635 21.7501 15.5856 21.6425C16.4402 21.5308 17.1638 21.2919 17.7554 20.7385C18.347 20.185 18.6334 19.4789 18.8018 18.6336C18.9638 17.8206 19.0328 16.7844 19.1183 15.5017L19.5818 8.54993C19.6093 8.13663 19.2966 7.77925 18.8833 7.7517C18.47 7.72415 18.1126 8.03685 18.0851 8.45015L17.6251 15.3493C17.5353 16.6971 17.4713 17.6349 17.3307 18.3406C17.1943 19.025 17.004 19.3873 16.7306 19.6431C16.4572 19.8989 16.083 20.0647 15.391 20.1552C14.6776 20.2485 13.7376 20.25 12.3868 20.25H11.6134C10.2626 20.25 9.32255 20.2485 8.60915 20.1552C7.91715 20.0647 7.54299 19.8989 7.26958 19.6431C6.99617 19.3873 6.80583 19.025 6.66948 18.3406C6.52892 17.6349 6.46489 16.6971 6.37503 15.3493L5.91509 8.45015Z"
                                                            fill="red" />
                                                        <path
                                                            d="M9.42546 10.2538C9.83762 10.2125 10.2052 10.5133 10.2464 10.9254L10.7464 15.9254C10.7876 16.3376 10.4869 16.7051 10.0747 16.7463C9.66256 16.7875 9.29503 16.4868 9.25381 16.0747L8.75381 11.0747C8.7126 10.6625 9.01331 10.295 9.42546 10.2538Z"
                                                            fill="red" />
                                                        <path
                                                            d="M14.5747 10.2538C14.9869 10.295 15.2876 10.6625 15.2464 11.0747L14.7464 16.0747C14.7052 16.4868 14.3376 16.7875 13.9255 16.7463C13.5133 16.7051 13.2126 16.3376 13.2538 15.9254L13.7538 10.9254C13.795 10.5133 14.1626 10.2125 14.5747 10.2538Z"
                                                            fill="red" />
                                                    </svg>
                                                </button>
                                            </form>
                                        @endcan
                                    </td>
                                </tr>
                            @empty

                                <tr>
                                    <td colspan="100" class="text-center pt-10 pb-10 text-3xl">
                                        No Courses Yet
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination Placeholder -->
                <div class="flex items-center justify-between border-t border-slate-100 pt-4 text-xs text-slate-500">
                    {{-- <div>Showing 1 to 3 of 32 courses</div>
                <div class="flex gap-2">
                    <button class="px-3 py-1.5 rounded-xl border bg-slate-50 disabled:opacity-50"
                        disabled>Previous</button>
                    <button class="px-3 py-1.5 rounded-xl border bg-indigo-600 text-white font-semibold">1</button>
                    <button class="px-3 py-1.5 rounded-xl border bg-slate-50 hover:bg-slate-100">2</button>
                    <button class="px-3 py-1.5 rounded-xl border bg-slate-50 hover:bg-slate-100">Next</button> --}}
                    {{ $courses->links() }}
                </div>
            </div>
        </div>

    </div>
    </div>
</x-app-layout>
{{-- <script>
    let myInput = document.querySelector("#search");
    let search_counter = document.querySelector("#search_counter");
    let ul = document.createElement("ul");

    // تنسيق قائمة الاقتراحات
    ul.classList.add("w-full", "bg-white", "shadow-xl", "flex", "flex-col", "justify-start", "items-start", "z-50",
        "rounded-2xl", "absolute", "mt-2", "border", "border-gray-100", "overflow-hidden");
    search_counter.appendChild(ul);

    myInput.onkeyup = function(e) {
        let query = myInput.value.trim();
        if (query === "") {
            ul.innerHTML = "";
            return;
        }

        // استدعاء مسار البحث الخاص بك
        fetch(`courses/${query}/search`)
            .then((result) => result.json())
            .then((data) => {
                ul.innerHTML = "";

                let instructors = data[0] || [];
                let courses = data[1] || [];

                let hasResults = false;

                // 1. عرض نتائج المدرسين المطابقين
                instructors.forEach(instructor => {
                    if (instructor.courses && instructor.courses.length > 0) {
                        instructor.courses.forEach(course => {
                            hasResults = true;
                            let li = createSuggestionItem(course.title,
                                `Instructor: ${instructor.name}`, course.id);
                            ul.appendChild(li);
                        });
                    }
                });

                // 2. عرض نتائج الكورسات المطابقة للعنوان
                courses.forEach(course => {
                    hasResults = true;
                    let instructorName = course.instructor ? course.instructor.name : 'Unknown';
                    let li = createSuggestionItem(course.title, `By: ${instructorName}`, course.id);
                    ul.appendChild(li);
                });

                if (!hasResults) {
                    let li = document.createElement("li");
                    li.textContent = "No results found";
                    li.classList.add("w-full", "px-4", "py-3", "text-sm", "text-gray-400");
                    ul.appendChild(li);
                }
            })
            .catch((err) => {
                console.error("Search error:", err);
            });
    };

    // دالة مساعدة لإنشاء عناصر القائمة بشكل مرتب
    function createSuggestionItem(titleText, subtitleText, courseId) {
        let li = document.createElement("li");
        li.id = courseId;
        li.classList.add("w-full", "bg-white", "px-4", "py-3", "transition-all", "hover:bg-slate-50", "text-sm", "flex",
            "justify-between", "items-center", "cursor-pointer", "border-b", "border-gray-50");

        let titleSpan = document.createElement("span");
        titleSpan.textContent = titleText;
        titleSpan.classList.add("font-medium", "text-gray-800");

        let subSpan = document.createElement("span");
        subSpan.textContent = subtitleText;
        subSpan.classList.add("text-xs", "text-emerald-800", "font-semibold", "bg-emerald-50", "px-2", "py-1",
            "rounded-md");

        li.appendChild(titleSpan);
        li.appendChild(subSpan);

        // عند النقر على الاقتراح
        li.onmousedown = function(e) {
            e.preventDefault();
            myInput.value = titleText;
            ul.innerHTML = "";

            let targetRow = document.querySelector("#course" + courseId);
            if (targetRow) {
                targetRow.classList.add("bg-red-100", "transition-colors", "duration-500");
                targetRow.scrollIntoView({
                    behavior: 'smooth',
                    block: 'center'
                });
            }
        };

        return li;
    }
</script> --}}







<script>
    let myInput = document.querySelector("#search");
    let search_counter = document.querySelector("#search_counter");
    let ul = document.createElement("ul");

    // تنسيق قائمة الاقتراحات
    ul.classList.add("w-full", "bg-white", "shadow-xl", "flex", "flex-col", "justify-start", "items-start", "z-50",
        "rounded-2xl", "absolute", "mt-2", "border", "border-gray-100", "overflow-hidden");
    search_counter.appendChild(ul);

    myInput.onkeyup = function(e) {
        let query = myInput.value.trim();
        if (query === "") {
            ul.innerHTML = "";
            return;
        }

        // استدعاء مسار البحث الخاص بك
        fetch("{{ route('dashboard.courses.index.search', ':value') }}".replace(":value", query))
            .then((result) => result.json())
            .then((data) => {
                ul.innerHTML = "";

                let instructors = data[0] || [];
                let courses = data[1] || [];

                let hasResults = false;

                // 1. عرض نتائج المدرسين المطابقين
                instructors.forEach(instructor => {
                    if (instructor.courses && instructor.courses.length > 0) {
                        instructor.courses.forEach(course => {
                            hasResults = true;
                            let li = createSuggestionItem(course.title,
                                `Instructor: ${instructor.name}`, course.id);
                            ul.appendChild(li);
                        });
                    }
                });

                // 2. عرض نتائج الكورسات المطابقة للعنوان
                courses.forEach(course => {
                    hasResults = true;
                    let instructorName = course.instructor ? course.instructor.name : 'Unknown';
                    let li = createSuggestionItem(course.title, `By: ${instructorName}`, course.id);
                    ul.appendChild(li);
                });

                if (!hasResults) {
                    let li = document.createElement("li");
                    li.textContent = "No results found";
                    li.classList.add("w-full", "px-4", "py-3", "text-sm", "text-gray-400");
                    ul.appendChild(li);
                }
            })
            .catch((err) => {
                console.error("Search error:", err);
            });
    };

    // دالة مساعدة لإنشاء عناصر القائمة بشكل مرتب
    function createSuggestionItem(titleText, subtitleText, courseId) {
        let li = document.createElement("li");
        li.classList.add("w-full", "bg-white", "px-4", "py-3", "transition-all", "hover:bg-slate-50", "text-sm", "flex",
            "justify-between", "items-center", "cursor-pointer", "border-b", "border-gray-50");

        let titleSpan = document.createElement("span");
        titleSpan.textContent = titleText;
        titleSpan.classList.add("font-medium", "text-gray-800");

        let subSpan = document.createElement("span");
        subSpan.textContent = subtitleText;
        subSpan.classList.add("text-xs", "text-emerald-800", "font-semibold", "bg-emerald-50", "px-2", "py-1",
            "rounded-md");

        li.appendChild(titleSpan);
        li.appendChild(subSpan);

        // عند النقر على الاقتراح
        li.onmousedown = function(e) {
            e.preventDefault();
            myInput.value = titleText;
            ul.innerHTML = "";

            // إزالة اللون الأحمر من أي صف سابق تم تمييزه
            document.querySelectorAll("tr[id^='course']").forEach(row => {
                row.classList.remove("bg-red-200", "transition-colors", "duration-500");
            });

            // العثور على الصف المطلوب في الجدول
            let targetRow = document.querySelector("#course" + courseId);
            if (targetRow) {
                // إضافة اللون الأحمر والتمرير إليه بسلاسة
                targetRow.classList.add("bg-red-200", "transition-colors", "duration-500");
                targetRow.scrollIntoView({
                    behavior: 'smooth',
                    block: 'center'
                });

                // إزالة اللون الأحمر تدريجياً بعد 3 ثواني (اختياري)
                setTimeout(() => {
                    targetRow.classList.remove("bg-red-200");
                }, 3000);
            }
        };

        return li;
    }
</script>

<script>
    function filterManagedCourses() {
        const selectedTag = document.getElementById("course-tag-filter").value;
        const selectedType = document.getElementById("course-type-filter").value;

        document.querySelectorAll("[data-course-row]").forEach((courseRow) => {
            const tagIds = (courseRow.dataset.tags || "").split(",");
            const matchesTag = selectedTag === "all" || tagIds.includes(selectedTag);
            const matchesType = selectedType === "all" || courseRow.dataset.type === selectedType;

            courseRow.hidden = !(matchesTag && matchesType);
        });
    }

    function resetManagedCourseFilters() {
        document.getElementById("course-tag-filter").value = "all";
        document.getElementById("course-type-filter").value = "all";
        filterManagedCourses();
    }
</script>
