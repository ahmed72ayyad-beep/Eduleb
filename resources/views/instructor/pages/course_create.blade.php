<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <h1 class="font-bold text-2xl text-gray-800 leading-tight">
                    {{ __('Create New Course') }}
                </h1>
                <p class="text-sm text-gray-500 mt-1">
                    Fill in the details below to Send a new Application to Admins on
                    <span class="text-indigo-600 font-semibold text-lg">EduLeb</span>.
                </p>
            </div>

            <a href="{{ route('dashboard.courses.index') }}"
                class="inline-flex items-center gap-2 px-4 py-2 rounded-2xl bg-slate-100 text-gray-700 text-xs font-semibold hover:bg-slate-200 transition">
                ← Back to My Courses
            </a>
        </div>
    </x-slot>

    <div class="py-8 bg-gradient-to-br from-slate-50 via-indigo-50/20 to-purple-50/30 min-h-screen">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 space-y-8">

            <form action="{{ route('student.applications.store') }}" method="POST" enctype="multipart/form-data"
                class="space-y-8">
                @csrf
                <input type="hidden" name="application_type" value="create_course">
                <!-- 1. Basic Information Card -->
                <div class="bg-white rounded-3xl p-6 md:p-8 shadow-sm border border-gray-100 space-y-6">
                    <div class="border-b border-gray-100 pb-4">
                        <h3 class="text-lg font-bold text-gray-800">1. Basic Information</h3>
                        <p class="text-xs text-gray-400">Core details about the course and assignment</p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- title -->
                        <div class="md:col-span-2 space-y-2">
                            <x-input type="text" name="title" required label="Course Title *"
                                labelclass="block text-xs font-bold uppercase text-gray-600 tracking-wider"
                                placeholder="e.g. Full-Stack Web Development with Laravel 11"
                                class="w-full px-4 py-3 rounded-2xl border border-gray-200 focus:border-indigo-500 focus:ring-indigo-500/20 text-sm" />
                        </div>

                        <!-- sub_title -->
                        <div class="md:col-span-2 space-y-2">
                            <x-input type="text" name="sub_title" label="Sub Title"
                                labelclass="block text-xs font-bold uppercase text-gray-600 tracking-wider"
                                placeholder="e.g. Master modern web applications from setup to deployment"
                                class="w-full px-4 py-3 rounded-2xl border border-gray-200 focus:border-indigo-500 focus:ring-indigo-500/20 text-sm" />
                        </div>


                        <!-- type -->
                        <div class="space-y-2 mt-4">
                            <x-select spicialmsgstyle="color:blue" spicialmsg="Date Is requerid For Online Type"
                                name="type" required label="Course Type *"
                                labelclass="block text-xs font-bold uppercase text-gray-600 tracking-wider"
                                class="w-full  px-4 py-3 rounded-2xl border border-gray-200 focus:border-indigo-500 focus:ring-indigo-500/20 text-sm font-semibold text-gray-700">
                                <option value="online">Online</option>
                                <option value="recorded">Recorded</option>
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
                            <x-input type="number" step="0.01" name="price" required label="Price ($) *"
                                labelclass="block text-xs font-bold uppercase text-gray-600 tracking-wider"
                                placeholder="89.99"
                                class="w-full px-4 py-3 rounded-2xl border border-gray-200 focus:border-indigo-500 focus:ring-indigo-500/20 text-sm" />
                        </div>

                        <!-- duration -->
                        <div class="space-y-2">
                            <x-input type="text" name="duration" label="Duration (Hours/Weeks)"
                                labelclass="block text-xs font-bold uppercase text-gray-600 tracking-wider"
                                placeholder="e.g. 24 Hours"
                                class="w-full px-4 py-3 rounded-2xl border border-gray-200 focus:border-indigo-500 focus:ring-indigo-500/20 text-sm" />
                        </div>

                        <!-- total_lectures -->
                        <div class="space-y-2">
                            <x-input type="number" name="total_lectures" label="Total Lectures"
                                labelclass="block text-xs font-bold uppercase text-gray-600 tracking-wider"
                                placeholder="36"
                                class="w-full px-4 py-3 rounded-2xl border border-gray-200 focus:border-indigo-500 focus:ring-indigo-500/20 text-sm" />
                        </div>

                        <!-- date -->
                        <div class="space-y-2">
                            <x-input type="date" name="date" label="Start Date"
                                labelclass="block text-xs font-bold uppercase text-gray-600 tracking-wider"
                                class="w-full px-4 py-3 rounded-2xl border border-gray-200 focus:border-indigo-500 focus:ring-indigo-500/20 text-sm" />
                        </div>

                        <!-- available_seats -->
                        <div class="space-y-2">
                            <x-input type="number" name="available_seats" label="Available Seats"
                                labelclass="block text-xs font-bold uppercase text-gray-600 tracking-wider"
                                placeholder="20"
                                class="w-full px-4 py-3 rounded-2xl border border-gray-200 focus:border-indigo-500 focus:ring-indigo-500/20 text-sm" />
                        </div>

                        <!-- certification -->
                        <div class="space-y-2">
                            <x-select name="certification" required label="Certification *"
                                labelclass="block text-xs font-bold uppercase text-gray-600 tracking-wider"
                                class="w-full px-4 py-3 rounded-2xl border border-gray-200 focus:border-indigo-500 focus:ring-indigo-500/20 text-sm font-semibold text-gray-700">
                                <option value="yes">Yes (Certificate Provided)</option>
                                <option value="no">No</option>
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
                                class="w-full px-4 py-3 rounded-2xl border border-gray-200 focus:border-indigo-500 focus:ring-indigo-500/20 text-sm" />
                        </div>

                        <!-- description -->
                        <div class="space-y-2">
                            <x-textarea name="description" rows="5" label="Full Description"
                                labelclass="block text-xs font-bold uppercase text-gray-600 tracking-wider"
                                placeholder="Detailed explanation of prerequisites and course topics..."
                                class="w-full px-4 py-3 rounded-2xl border border-gray-200 focus:border-indigo-500 focus:ring-indigo-500/20 text-sm" />
                        </div>

                        <!-- curriculum -->
                        <div class="space-y-2">
                            <x-textarea id="curriculum" name="curriculum" rows="4" label="Curriculum Outline"
                                labelclass="block text-xs font-bold uppercase text-gray-600 tracking-wider"
                                placeholder="Module 1: Introduction, Module 2: Setup..."
                                class="w-full px-4 py-3 rounded-2xl border border-gray-200 focus:border-indigo-500 focus:ring-indigo-500/20 text-sm" />
                        </div>

                        <!-- Images Upload -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pt-2">
                            <div class="space-y-2">
                                <x-input type="file" name="outer_image" label="Outer Thumbnail Image"
                                    labelclass="block text-xs font-bold uppercase text-gray-600 tracking-wider"
                                    class="block w-full text-xs text-gray-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-indigo-50 file:text-indigo-600 hover:file:bg-indigo-100" />
                            </div>

                            <div class="space-y-2">
                                <x-input type="file" name="inner_image" label="Inner Cover Image"
                                    labelclass="block text-xs font-bold uppercase text-gray-600 tracking-wider"
                                    class="block w-full text-xs text-gray-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-indigo-50 file:text-indigo-600 hover:file:bg-indigo-100" />
                            </div>
                        </div>
                    </div>
                </div>
                <!-- 4. Tags-->
                <div class="bg-white rounded-3xl p-6 md:p-8 shadow-sm border border-gray-100 space-y-6">
                    <div class="border-b border-gray-100 pb-4">
                        <h3 class="text-lg font-bold text-gray-800">4. Tags</h3>
                        <p class="text-xs text-gray-400">Trinding ,Searching engines and more</p>
                    </div>
                    <h3 class="block text-xs font-bold uppercase text-gray-600 tracking-wider m-0">Tags</h3>
                    <div class="grid grid-cols-1 md:grid-cols-4 md:col-span-2 gap-6">
                        {{-- <div class="flex flex-wrap justify-evenly items-center w-full"> --}}
                        @forelse ($tags as $tag)
                            <div class="basis-3 flex flex-row justify-between">
                                <x-input labelclass="text-sm" multiple="12" type="checkbox"
                                    value="{{ $tag->id }}" name="tags[]" id="{{ $tag->id }}"
                                    label="{{ $tag->name }}" />
                            </div>

                        @empty
                            <div>No tags</div>
                        @endforelse

                        {{-- </div> --}}
                    </div>
                </div>

                <!-- Submit Button Bar -->
                <div class="flex items-center justify-end gap-4">
                    <button type="reset"
                        class="px-6 py-3 rounded-2xl bg-slate-100 text-gray-600 text-xs font-bold hover:bg-slate-200 transition">
                        Reset Form
                    </button>
                    <button type="submit"
                        class="px-8 py-3 rounded-2xl bg-gradient-to-r from-indigo-600 to-purple-600 text-white text-xs font-bold shadow-md shadow-indigo-200 hover:shadow-lg hover:opacity-95 transition-all">
                        Save & Publish Course
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
        fetch("{{ route('instructors.search', ':id') }}".replace(":id", query))
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










//
<script>
    // let instructor_search = document.querySelector("#instructorSearch");
    // let instructor_search_counter = document.querySelector("#instructorSearchCounter");
    // let ul = document.createElement("ul");

    // // تنسيق قائمة النتائج بواسطة JS
    // ul.style.zIndex = "100";
    // ul.style.position = "absolute";
    // ul.style.width = "100%";
    // ul.style.top = "100%";
    // ul.style.left = "0";
    // ul.style.backgroundColor = "#fff";
    // ul.style.border = "1px solid #e5e7eb";
    // ul.style.borderRadius = "1rem";
    // ul.style.boxShadow = "0 10px 15px -3px rgba(0, 0, 0, 0.1)";
    // ul.style.overflow = "hidden";
    // ul.style.marginTop = "4px";

    // instructor_search_counter.style.position = "relative";
    // instructor_search_counter.appendChild(ul);

    // // حدث الكتابة في البحث
    // instructor_search.onkeyup = function(e) {
    //     let val = instructor_search.value.trim();
    //     ul.innerHTML = "";

    //     if (val === "") {
    //         return;
    //     }

    //     fetch("instructors/" + encodeURIComponent(val) + "/search")
    //         .then((result) => result.json())
    //         .then((result) => {
    //             ul.innerHTML = "";
    //             result.forEach(element => {
    //                 let li = document.createElement("li");
    //                 li.textContent = element.name;
    //                 li.style.padding = "10px 15px";
    //                 li.style.cursor = "pointer";
    //                 li.style.fontSize = "14px";
    //                 li.classList.add("hover:bg-slate-100");

    //                 // عند الضغط على اسم المدرب ينزل في الحقل وتختفي القائمة
    //                 li.onmousedown = function(e) {
    //                     e.preventDefault(); // منع حدوث blur قبل الاختيار
    //                     instructor_search.value = element.name;
    //                     ul.innerHTML = "";
    //                 };

    //                 ul.appendChild(li);
    //             });
    //         })
    //         .catch((err) => {
    //             console.error(err);
    //         });
    // };

    // // إخفاء القائمة عند الخروج من الحقل
    // instructor_search.onblur = function() {
    //     ul.innerHTML = "";
    // };
</script>
{{-- // images_upload_url: "{{ route('Plog.post.upload_images') }}", --}}
<script src="{{ asset('tinymce/tinymce.min.js') }}"></script>

<script>
    tinymce.init({
        selector: '#curriculum',

        license_key: 'gpl',

        height: 400,
        menubar: 'file edit view insert format tools table help',

        plugins: [
            'advlist',
            'autolink',
            'lists',
            'link',
            // 'image',
            'charmap',
            'preview',
            'anchor',
            'searchreplace',
            'visualblocks',
            'code',
            'fullscreen',
            'insertdatetime',
            // 'media',
            'table',
            'wordcount'
        ],

        toolbar: 'undo redo | blocks | ' +
            'bold italic underline strikethrough | ' +
            'forecolor backcolor | ' +
            'alignleft aligncenter alignright alignjustify | ' +
            'bullist numlist outdent indent | ' +
            'link image media table | ' +
            'blockquote charmap | ' +
            'removeformat code fullscreen',

        // image_title: true,

        automatic_uploads: true,

        // file_picker_types: 'image media',

        content_style: `
            body {
                font-family: Arial, sans-serif;
                font-size: 16px;
            }
        `
    });
</script>
