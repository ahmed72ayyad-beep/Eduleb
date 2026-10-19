<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <h1 class="font-bold text-2xl text-gray-800 leading-tight">
                    {{ __('Edit Course') }}
                </h1>
                <p class="text-sm text-gray-500 mt-1">
                    Update course details and specifications for
                    <span class="text-indigo-600 font-semibold text-lg">EduLeb</span>.
                </p>
            </div>

            <a href="{{ route('dashboard.courses.index') }}"
                class="inline-flex items-center gap-2 px-4 py-2 rounded-2xl bg-slate-100 text-gray-700 text-xs font-semibold hover:bg-slate-200 transition">
                ← Back to Courses
            </a>
        </div>
    </x-slot>

    <div class="py-8 bg-gradient-to-br from-slate-50 via-indigo-50/20 to-purple-50/30 min-h-screen">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 space-y-8">

            <form action="{{ route('dashboard.courses.update', $course->id) }}" method="POST"
                enctype="multipart/form-data" class="space-y-8">
                @csrf
                @method('PUT')

                <!-- 1. Basic Information Card -->
                <div class="bg-white rounded-3xl p-6 md:p-8 shadow-sm border border-gray-100 space-y-6">
                    <div class="border-b border-gray-100 pb-4">
                        <h3 class="text-lg font-bold text-gray-800">1. Basic Information</h3>
                        <p class="text-xs text-gray-400">Core details about the course and assignment</p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- title -->
                        <div class="md:col-span-2 space-y-2">
                            <x-input type="text" name="title" value="{{ old('title') ?? $course->title }}" required
                                label="Course Title *"
                                labelclass="block text-xs font-bold uppercase text-gray-600 tracking-wider"
                                placeholder="e.g. Full-Stack Web Development with Laravel 11"
                                class="w-full px-4 py-3 rounded-2xl border border-gray-200 focus:border-indigo-500 focus:ring-indigo-500/20 text-sm" />
                        </div>

                        <!-- sub_title -->
                        <div class="md:col-span-2 space-y-2">
                            <x-input type="text" name="sub_title"
                                value="{{ old('sub_title') ?? ($course->sub_title ?? '') }}" label="Sub Title"
                                labelclass="block text-xs font-bold uppercase text-gray-600 tracking-wider"
                                placeholder="e.g. Master modern web applications from setup to deployment"
                                class="w-full px-4 py-3 rounded-2xl border border-gray-200 focus:border-indigo-500 focus:ring-indigo-500/20 text-sm" />
                        </div>

                        <!-- instructor_id (Searchable Input) -->
                        <div id="instructorSearchCounter" class="space-y-2">
                            <x-input id="instructorSearch" name="instructor_name"
                                value="{{ old('instructor_name') ?? $course->instructor->name }}" required
                                label="Instructor *" spicialmsgstyle="color:blue"
                                spicialmsg="You must select from the list that will appear as you type the name."
                                labelclass="block text-xs font-bold uppercase text-gray-600 tracking-wider"
                                class="w-full px-4 py-3 rounded-2xl border border-gray-200 focus:border-indigo-500 focus:ring-indigo-500/20 text-sm font-semibold text-gray-700" />
                            <x-input type="hidden" id="my-hidden" name="instructor_id"
                                value=" {{ old('instructor_id') ?? $course->instructor_id }}" />
                        </div>

                        <!-- type -->
                        <div class="space-y-2 mt-4">
                            <x-select spicialmsgstyle="color:blue" spicialmsg="Date Is required For Online Type"
                                name="type" required label="Course Type *"
                                labelclass="block text-xs font-bold uppercase text-gray-600 tracking-wider"
                                class="w-full px-4 py-3 rounded-2xl border border-gray-200 focus:border-indigo-500 focus:ring-indigo-500/20 text-sm font-semibold text-gray-700">
                                <option value="online" {{ old('type', $course->type) == 'online' ? 'selected' : '' }}>
                                    Online</option>
                                <option value="recorded"
                                    {{ old('type', $course->type) == 'recorded' ? 'selected' : '' }}>Recorded</option>
                            </x-select>
                        </div>
                    </div>
                </div>

                <!-- 2. Logistics & Pricing Card -->
                <div class="bg-white rounded-3xl p-6 md:p-8 shadow-sm border border-gray-100 space-y-6">
                    <div class="border-b border-gray-100 pb-4">
                        <h3 class="text-lg font-bold text-gray-800">2. Pricing & Logistics</h3>
                        <p class="text-xs text-gray-400">Duration, schedule, price, and seats configuration</p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <!-- price -->
                        <div class="space-y-2">
                            <x-input type="number" step="0.01" name="price"
                                value="{{ old('price') ?? $course->price }}" required label="Price ($) *"
                                labelclass="block text-xs font-bold uppercase text-gray-600 tracking-wider"
                                placeholder="89.99"
                                class="w-full px-4 py-3 rounded-2xl border border-gray-200 focus:border-indigo-500 focus:ring-indigo-500/20 text-sm" />
                        </div>

                        <!-- duration -->
                        <div class="space-y-2">
                            <x-input type="text" name="duration"
                                value="{{ old('duration') ?? ($course->duration ?? '') }}"
                                label="Duration (Hours/Weeks)"
                                labelclass="block text-xs font-bold uppercase text-gray-600 tracking-wider"
                                placeholder="e.g. 24 Hours"
                                class="w-full px-4 py-3 rounded-2xl border border-gray-200 focus:border-indigo-500 focus:ring-indigo-500/20 text-sm" />
                        </div>

                        <!-- total_lectures -->
                        <div class="space-y-2">
                            <x-input type="number" name="total_lectures"
                                value="{{ old('total_lectures') ?? ($course->total_lectures ?? '') }}"
                                label="Total Lectures"
                                labelclass="block text-xs font-bold uppercase text-gray-600 tracking-wider"
                                placeholder="36"
                                class="w-full px-4 py-3 rounded-2xl border border-gray-200 focus:border-indigo-500 focus:ring-indigo-500/20 text-sm" />
                        </div>

                        <!-- date -->
                        <div class="space-y-2">
                            <x-input type="date" name="date" value="{{ old('date') ?? ($course->date ?? '') }}"
                                label="Start Date"
                                labelclass="block text-xs font-bold uppercase text-gray-600 tracking-wider"
                                class="w-full px-4 py-3 rounded-2xl border border-gray-200 focus:border-indigo-500 focus:ring-indigo-500/20 text-sm" />
                        </div>

                        <!-- available_seats -->
                        <div class="space-y-2">
                            <x-input type="number" name="available_seats"
                                value="{{ old('available_seats') ?? ($course->available_seats ?? '') }}"
                                label="Available Seats"
                                labelclass="block text-xs font-bold uppercase text-gray-600 tracking-wider"
                                placeholder="20"
                                class="w-full px-4 py-3 rounded-2xl border border-gray-200 focus:border-indigo-500 focus:ring-indigo-500/20 text-sm" />
                        </div>

                        <!-- certification -->
                        <div class="space-y-2">
                            <x-select name="certification" required label="Certification *"
                                labelclass="block text-xs font-bold uppercase text-gray-600 tracking-wider"
                                class="w-full px-4 py-3 rounded-2xl border border-gray-200 focus:border-indigo-500 focus:ring-indigo-500/20 text-sm font-semibold text-gray-700">
                                <option value="yes"
                                    {{ old('certification', $course->certification) == 'yes' ? 'selected' : '' }}>Yes
                                    (Certificate Provided)</option>
                                <option value="no"
                                    {{ old('certification', $course->certification) == 'no' ? 'selected' : '' }}>No
                                </option>
                            </x-select>
                        </div>
                    </div>
                </div>

                <!-- 3. Course Content & Media Card -->
                <div class="bg-white rounded-3xl p-6 md:p-8 shadow-sm border border-gray-100 space-y-6">
                    <div class="border-b border-gray-100 pb-4">
                        <h3 class="text-lg font-bold text-gray-800">3. Descriptions & Media</h3>
                        <p class="text-xs text-gray-400">Detailed overview, syllabus, and course images</p>
                    </div>

                    <div class="space-y-6">
                        <!-- overview -->
                        <div class="space-y-2">
                            <x-textarea name="overview" rows="3" label="Overview"
                                labelclass="block text-xs font-bold uppercase text-gray-600 tracking-wider"
                                placeholder="Brief summary of what students will achieve..."
                                class="w-full px-4 py-3 rounded-2xl border border-gray-200 focus:border-indigo-500 focus:ring-indigo-500/20 text-sm"
                                value="{{ old('overview') ?? ($course->overview ?? '') }}" />
                        </div>

                        <!-- description -->
                        <div class="space-y-2">
                            <x-textarea name="description" rows="5" label="Full Description"
                                labelclass="block text-xs font-bold uppercase text-gray-600 tracking-wider"
                                placeholder="Detailed explanation of prerequisites and course topics..."
                                class="w-full px-4 py-3 rounded-2xl border border-gray-200 focus:border-indigo-500 focus:ring-indigo-500/20 text-sm"
                                value="{{ old('description') ?? ($course->description ?? '') }}" />
                        </div>

                        <!-- curriculum -->
                        <div class="space-y-2">
                            <x-textarea name="curriculum" rows="4" label="Curriculum Outline"
                                labelclass="block text-xs font-bold uppercase text-gray-600 tracking-wider"
                                placeholder="Module 1: Introduction, Module 2: Setup..."
                                class="w-full px-4 py-3 rounded-2xl border border-gray-200 focus:border-indigo-500 focus:ring-indigo-500/20 text-sm"
                                value="{{ old('curriculum') ?? ($course->curriculum ?? '') }}" />
                        </div>

                        <!-- Images Upload -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pt-2">
                            <div class="space-y-2">
                                <x-input type="file" name="outer_image" label="Outer Thumbnail Image"
                                    value="{{ $course->outer_image }}"
                                    labelclass="block text-xs font-bold uppercase text-gray-600 tracking-wider"
                                    class="block w-full text-xs text-gray-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-indigo-50 file:text-indigo-600 hover:file:bg-indigo-100" />
                                @if ($course->outer_image)
                                    <div
                                        class="mt-2 flex items-center gap-3 p-2 bg-slate-50 rounded-2xl border border-slate-100 w-fit">
                                        <img src="{{ asset($course->outer_image) }}" alt="Current Outer Image"
                                            class="w-16 h-12 object-cover rounded-xl border border-gray-200 shadow-xs">
                                        <div>
                                            <span class="text-[10px] font-bold text-gray-500 uppercase block">Current
                                                Outer Image</span>
                                            <span
                                                class="text-xs text-gray-400 block truncate max-w-[150px]">{{ $course->outer_image }}</span>
                                        </div>
                                    </div>
                                @endif
                            </div>

                            <div class="space-y-2">
                                <x-input type="file" name="inner_image" label="Inner Cover Image"
                                    value="{{ $course->inner_image }}"
                                    labelclass="block text-xs font-bold uppercase text-gray-600 tracking-wider"
                                    class="block w-full text-xs text-gray-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-indigo-50 file:text-indigo-600 hover:file:bg-indigo-100" />
                                @if ($course->inner_image)
                                    <div
                                        class="mt-2 flex items-center gap-3 p-2 bg-slate-50 rounded-2xl border border-slate-100 w-fit">
                                        <img src="{{ asset($course->inner_image) }}" alt="Current Inner Image"
                                            class="w-16 h-12 object-cover rounded-xl border border-gray-200 shadow-xs">
                                        <div>
                                            <span class="text-[10px] font-bold text-gray-500 uppercase block">Current
                                                Inner Image</span>
                                            <span
                                                class="text-xs text-gray-400 block truncate max-w-[150px]">{{ $course->inner_image }}</span>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Submit Button Bar -->
                <div class="flex items-center justify-end gap-4">
                    <a onclick="confirm()" href="{{ route('dashboard.courses.index') }}"
                        class="px-6 py-3 rounded-2xl bg-slate-100 text-gray-600 text-xs font-bold hover:bg-slate-200 transition">
                        Cancel
                    </a>
                    <button type="submit"
                        class="px-8 py-3 rounded-2xl bg-gradient-to-r from-indigo-600 to-purple-600 text-white text-xs font-bold shadow-md shadow-indigo-200 hover:shadow-lg hover:opacity-95 transition-all">
                        Update Course
                    </button>
                </div>
            </form>

        </div>
    </div>
</x-app-layout>

<script>
    let instructor_search = document.querySelector("#instructorSearch");
    let instructor_search_counter = document.querySelector("#instructorSearchCounter");
    let hidden_input = document.querySelector("#my-hidden");

    // إنشاء قائمة الاقتراحات بنفس تنسيق قائمة الكورسات بالضبط
    let ul = document.createElement("ul");
    ul.classList.add(
        "w-full", "bg-white", "shadow-xl", "flex", "flex-col",
        "justify-start", "items-start", "z-50", "rounded-2xl",
        "absolute", "mt-2", "border", "border-gray-100", "overflow-hidden"
    );
    instructor_search_counter.style.position = "relative";
    instructor_search_counter.appendChild(ul);

    // إخفاء القائمة عند الخروج من الحقل (مع تأخير بسيط لتلك تفاعل النقر)
    instructor_search.onblur = function() {
        setTimeout(() => {
            ul.innerHTML = "";
        }, 200);
    };

    instructor_search.onkeyup = function(e) {
        let query = instructor_search.value.trim();
        if (query === "") {
            ul.innerHTML = "";
            return;
        }

        // استدعاء مسار بحث المدرسين
        fetch(`instructors/${encodeURIComponent(query)}/search`)
            .then((result) => result.json())
            .then((result) => {
                ul.innerHTML = "";

                if (!result || result.length === 0) {
                    let li = document.createElement("li");
                    li.textContent = "No instructors found";
                    li.classList.add("w-full", "px-4", "py-3", "text-sm", "text-gray-400");
                    ul.appendChild(li);
                    return;
                }

                result.forEach(element => {
                    let li = document.createElement("li");
                    li.classList.add(
                        "w-full", "bg-white", "px-4", "py-3", "transition-all",
                        "hover:bg-slate-50", "text-sm", "flex", "justify-between",
                        "items-center", "cursor-pointer", "border-b", "border-gray-50"
                    );

                    let nameSpan = document.createElement("span");
                    nameSpan.textContent = element.name;
                    nameSpan.classList.add("font-medium", "text-gray-800");

                    let subSpan = document.createElement("span");
                    subSpan.textContent = "Instructor";
                    subSpan.classList.add(
                        "text-xs", "text-indigo-600", "font-semibold",
                        "bg-indigo-50", "px-2", "py-1", "rounded-md"
                    );

                    li.appendChild(nameSpan);
                    li.appendChild(subSpan);

                    // عند النقر على المدرب
                    li.onmousedown = function(e) {
                        e.preventDefault();
                        instructor_search.value = element.name;
                        hidden_input.value = element.id;
                        console.log(hidden_input.value);

                        ul.innerHTML = "";
                    };

                    ul.appendChild(li);
                });
            })
            .catch((err) => {
                console.error("Search error:", err);
            });
    };
</script>
