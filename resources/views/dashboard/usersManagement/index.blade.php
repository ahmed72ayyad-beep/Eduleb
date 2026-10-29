<x-app-layout>
    {{-- @dd($courses->count()) --}}
    <style>
        .dnone {
            display: none;
        }
    </style>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <h1 class="font-bold text-2xl text-gray-800 leading-tight">
                    {{ __('Users Management') }}
                </h1>
                <p class="text-sm text-gray-500 mt-1">Change Roles, Delete, and monitor all Users on <span
                        class="text-emerald-700 font-semibold text-lg">Eduleb</span>.</p>
            </div>

            {{-- @can('users.create')
                <a href="{{ route('dashboard.users.create') }}"
                    class="inline-flex items-center gap-2 px-5 py-2.5 rounded-2xl bg-gradient-to-r from-indigo-600 to-purple-600 text-white text-sm font-semibold shadow-md shadow-indigo-200 hover:shadow-lg hover:opacity-95 transition-all">
                    <span class="text-lg">+</span> Add New Course
                </a>
            @endcan --}}
        </div>
    </x-slot>

    <div class="min-h-screen bg-gradient-to-br from-slate-50 via-emerald-50/40 to-amber-50/30 py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            <!-- Filter & Search Bar Section -->
            <div
                class="flex flex-col items-center justify-between gap-4 rounded-lg border border-slate-200 bg-white p-5 shadow-sm md:flex-row sm:p-6">
                <!-- Search Input -->
                <div id="search_counter" class="relative w-full md:w-96">
                    <input id="search" type="text" placeholder="Search users by title or instructor..."
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

                </div>

                <!-- Filters -->
                <div class="flex flex-wrap items-center gap-3 w-full md:w-auto justify-start md:justify-end">

                    <form class="flex w-full justify-between gap-2 sm:w-auto" action="">
                        <select onchange="select_Role(event)"
                            class="rounded-md border-slate-300 px-4 py-2.5 text-xs font-semibold text-slate-700 focus:border-emerald-600 focus:ring-emerald-600">
                            <option value="role">Role</option>
                            @foreach ($roles as $role)
                                <option value="{{ $role->name }}">{{ $role->name }}</option>
                            @endforeach
                        </select>
                        <div onclick="reset(event)"
                            class="rounded-md bg-slate-100 px-4 py-2.5 text-xs font-semibold text-slate-700 transition hover:bg-slate-200">
                            Reset Filters
                        </div>
                    </form>
                </div>
            </div>

            <!-- users Table Card -->
            <div class="space-y-6 rounded-lg border border-slate-200 bg-white p-5 shadow-sm sm:p-6">
                <div class="flex items-center justify-between border-b border-slate-100 pb-4">
                    <div>
                        <h2 class="text-2xl font-bold text-slate-900">All users</h2>
                        <p class="text-xs text-slate-500">Total Users : <span class="font-semibold text-emerald-800">
                                {{ $users->count() }}</span>
                        </p>
                    </div>
                    {{-- <span class="text-xs font-bold bg-indigo-50 text-indigo-600 px-3 py-1.5 rounded-full">
                        Page {{ $users->currentPage() }} of {{ ceil($users_num / 8) }}
                    </span> --}}
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm text-slate-600">
                        <thead class="bg-emerald-50 text-xs uppercase text-emerald-900">
                            <tr>
                                <th scope="col" class="py-3.5 px-4 rounded-l-2xl w-56 ">User Name
                                </th>
                                <th scope="col" class="py-3.5 px-4 ">Role</th>
                                <th scope="col" class="py-3.5 px-4 ">Email</th>
                                <th scope="col" class="py-3 px-2 w-4 ">Courses</th>
                                <th scope="col" class="py-3.5 px-4 w-32 ">Register At
                                </th>
                                <th scope="col" class="py-3.5 px-4 w-40 ">Last Login
                                </th>
                                <th scope="col"
                                    class="py-3.5 px-4 rounded-r-2xl text-right flex justify-center items-center">
                                    Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @forelse ($users as $user)
                                <!-- user Item 1 -->
                                <tr datas="tr"
                                    title="{{ $user->roles->first() == null ? 'student' : $user->roles->first()->name }}"
                                    id="user{{ $user->id }}" class="transition-colors hover:bg-emerald-50/40">
                                    <td class="py-4 px-4 font-semibold text-gray-800 flex items-center gap-3  ">
                                        {{-- <div
                                        class="w-11 h-11 rounded-2xl bg-indigo-100 text-indigo-600 flex items-center justify-center font-bold text-lg shrink-0">

                                    </div> --}}
                                        <div>
                                            <div class="font-bold text-gray-900 text-s">{{ $user->name }}</div>

                                        </div>
                                    </td>
                                    <td class="py-4 px-4">
                                        <div class="flex items-center gap-2">

                                            <select onchange="updateRole(event,{{ $user->id }})"
                                                class="rounded-md border-slate-300 py-2 pl-3 pr-8 text-xs text-slate-700 focus:border-emerald-600 focus:ring-emerald-600"
                                                name="role" id="role">
                                                @foreach ($roles as $role)
                                                    <option class="rounded-3xl" @selected($user->hasRole($role->name))
                                                        value="{{ $role->name }}">
                                                        {{ $role->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </td>
                                    <td class="py-4 px-4 font-medium text-emerald-800"> {{ $user->email }}</td>
                                    <td class="py-4 px-4">
                                        <div class="flex flex-wrap gap-2 min-w-32">
                                            @forelse ($user->courses as $course)
                                                <span
                                                    class="inline-flex items-center rounded-sm border border-emerald-100 bg-emerald-50 px-2.5 py-1 text-xs font-semibold text-emerald-800">
                                                    {{ $course->title }}
                                                </span>
                                            @empty
                                                <span class="text-xs text-gray-400">
                                                    No courses
                                                </span>
                                            @endforelse
                                        </div>
                                    </td>

                                    <td class="py-4 px-4 text-s w-9 font-semibold text-gray-600 ">
                                        {{ $user->created_at->format('Y M d') }} </td>
                                    <td class="py-4 px-4 ">
                                        <span
                                            class="rounded-sm border border-emerald-200 bg-emerald-50 px-2 py-0.5 text-xs font-bold text-emerald-800">{{ $user->last_login == null ? 'not Avilable' : $user->last_login->diffForHumans() }}</span>
                                    </td>
                                    <td class="py-4 px-4 text-right space-x-4 flex justify-end">

                                        @can('users.delete')
                                            <form method="POST"
                                                onsubmit="return confirm('Are You Sure Of Delete {{ $user->name }}');"
                                                action="{{ route('dashboard.users.destroy', $user->id) }}">
                                                {{-- @csrf() --}}
                                                @method('delete')

                                                <button c type="submit"
                                                    class="flex items-center gap-1 rounded-md bg-rose-50 p-2 text-sm font-semibold text-rose-700 transition hover:bg-rose-100">
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
                                    <td colspan="7"
                                        class="px-4 py-10 text-center text-sm font-medium text-slate-500">
                                        No users Yet
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination Placeholder -->
                <div class="flex items-center justify-between border-t border-slate-100 pt-4 text-xs text-slate-500">
                    {{-- <div>Showing 1 to 3 of 32 users</div>
                <div class="flex gap-2">
                    <button class="px-3 py-1.5 rounded-xl border bg-slate-50 disabled:opacity-50"
                        disabled>Previous</button>
                    <button class="px-3 py-1.5 rounded-xl border bg-indigo-600 text-white font-semibold">1</button>
                    <button class="px-3 py-1.5 rounded-xl border bg-slate-50 hover:bg-slate-100">2</button>
                    <button class="px-3 py-1.5 rounded-xl border bg-slate-50 hover:bg-slate-100">Next</button> --}}
                    {{-- {{ $users->links() }} --}}
                </div>
            </div>
        </div>

    </div>
    </div>
</x-app-layout>
<script>
    function updateRole(e, user_id) {
        fetch("{{ route('dashboard.users.update_role') }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}",
                "Accept": "application/json"
            },
            body: JSON.stringify({
                "user_id": user_id,
                "role": e.target.value
            })

        }).then((result) => {

        }).catch((err) => {

        });
    }
</script>

<script>
    function select_Role(e) {
        console.log(e.target.value);
        if (e.target.value != "role") {
            document.querySelectorAll("[datas='tr']").forEach(function(element) {
                // console.log(element.title);
                console.log(element);


                if (element.title == e.target.value) {
                    if (element.classList.contains("dnone")) {
                        element.classList.remove("dnone");
                    }
                }

                if (element.title != e.target.value) {
                    if (!element.classList.contains("dnone")) {
                        element.classList.add("dnone");
                    }
                }


            })
        } else {
            document.querySelectorAll("tr").forEach(function(element) {
                if (element.classList.contains("dnone")) {
                    element.classList.remove("dnone");
                }
            });
        }

    }
</script>
<script>
    function reset(e) {
        e.preventDefault()
        document.querySelectorAll("[datas='tr']").forEach(function(element) {
            // console.log(element.classList);

            if (element.classList.contains("dnone")) {
                element.classList.remove("dnone");
            }
        });
    }
</script>
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
        fetch(`users/${encodeURIComponent(query)}/search`)
            .then((result) => result.json())
            .then((data) => {
                ul.innerHTML = "";
                let users = data;
                let hasResults = false;

                // 1. عرض نتائج المدرسين المطابقين
                users.forEach(user => {
                    hasResults = true;
                    let li = createSuggestionItem(user.name, user.id);
                    ul.appendChild(li);
                    console.log(li);

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
    function createSuggestionItem(titleText, user_id) {
        console.log(titleText);
        console.log(user_id);

        let li = document.createElement("li");
        li.classList.add("w-full", "bg-white", "px-4", "py-3", "transition-all", "hover:bg-slate-50", "text-sm", "flex",
            "justify-between", "items-center", "cursor-pointer", "border-b", "border-gray-50");

        let titleSpan = document.createElement("span");
        titleSpan.textContent = titleText;
        titleSpan.classList.add("font-medium", "text-gray-800");



        li.appendChild(titleSpan);
        console.log(li);

        // عند النقر على الاقتراح
        li.onmousedown = function(e) {
            e.preventDefault();
            myInput.value = titleText;
            ul.innerHTML = "";

            // إزالة اللون الأحمر من أي صف سابق تم تمييزه
            document.querySelectorAll("tr[id^='user']").forEach(row => {
                row.classList.remove("bg-red-200", "transition-colors", "duration-500");
            });

            // العثور على الصف المطلوب في الجدول
            let targetRow = document.querySelector("#user" + user_id);
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
