<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <h1 class="font-bold text-2xl text-gray-800 leading-tight">
                    {{ __('Create New Course') }}
                </h1>
                <p class="text-sm text-gray-500 mt-1">
                    Fill in the details below to publish a new course on
                    <span class="text-emerald-700 font-semibold text-lg">EduLeb</span>.
                </p>
            </div>

            <a href="{{ route('dashboard') }}"
                class="inline-flex items-center gap-2 rounded-md bg-white px-4 py-2 text-xs font-semibold text-slate-700 ring-1 ring-slate-200 transition hover:bg-slate-100 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-emerald-700">
                ← Back to Dashboard
            </a>
        </div>
    </x-slot>

    <div class="min-h-screen bg-gradient-to-br from-slate-50 via-emerald-50/40 to-amber-50/30 py-8">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 space-y-8">

            <form action="{{ route('dashboard.instructors.store') }}" method="POST" enctype="multipart/form-data"
                class="space-y-8 [&_input]:rounded-md [&_select]:rounded-md [&_textarea]:rounded-md [&_input:focus]:border-emerald-600 [&_input:focus]:ring-emerald-600 [&_select:focus]:border-emerald-600 [&_select:focus]:ring-emerald-600 [&_textarea:focus]:border-emerald-600 [&_textarea:focus]:ring-emerald-600">
                @csrf

                <!-- 1. Basic Information Card -->
                <div class="space-y-6 rounded-lg border border-slate-200 bg-white p-5 shadow-sm md:p-8">
                    <div class="border-b border-gray-100 pb-4">
                        <h3 class="text-lg font-bold text-gray-800">instructor Basic Information</h3>
                        <p class="text-xs text-gray-400">Core details about You </p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- title -->
                        <div class="space-y-2">
                            <x-input type="text" name="major" required label="Aacademic Major *"
                                labelclass="block text-xs font-bold uppercase text-gray-600 tracking-wider"
                                placeholder="e.g. Full-Stack Web Developer with Laravel 11"
                                class="w-full px-4 py-3 rounded-2xl border border-gray-200 focus:border-indigo-500 focus:ring-indigo-500/20 text-sm" />
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pt-2">
                            <div class="space-y-2">
                                <x-input type="file" name="personal_image" label="Your Personal Image *"
                                    labelclass="block text-xs font-bold uppercase text-gray-600 tracking-wider"
                                    class="block w-full text-xs text-slate-500 file:mr-4 file:rounded-md file:border-0 file:bg-emerald-50 file:px-4 file:py-2.5 file:text-xs file:font-semibold file:text-emerald-800 hover:file:bg-emerald-100" />
                            </div>
                        </div>
                        <div class="md:col-span-2 space-y-2">
                            <x-textarea name="description" rows="5" label="Full Description"
                                labelclass="block text-xs font-bold uppercase text-gray-600 tracking-wider"
                                placeholder="About You And Your Cualifications and Achievements ..."
                                class="w-full px-4 py-3 rounded-2xl border border-gray-200 focus:border-indigo-500 focus:ring-indigo-500/20 text-sm" />
                        </div>
                        <!-- Phone -->
                        <div class="md:col-span-2 space-y-2">
                            <x-input type="text" name="phone" label="Phone Number" type="number"
                                labelclass="block text-xs font-bold uppercase text-gray-600 tracking-wider"
                                placeholder="e.g. {{ fake()->phoneNumber() }}"
                                class="w-full px-4 py-3 rounded-2xl border border-gray-200 focus:border-indigo-500 focus:ring-indigo-500/20 text-sm" />
                        </div>
                        <!-- portfolio_link -->
                        <div id="instructorSearchCounter" class="space-y-2">
                            <x-input id="instructorSearch" name="portfolio_link" required label="Portfolio Link *"
                                spicialmsgstyle="color:blue" spicialmsg="You must Enter A .com link."
                                labelclass="block text-xs font-bold uppercase text-gray-600 tracking-wider"
                                class="w-full px-4 py-3 rounded-2xl border border-gray-200 focus:border-indigo-500 focus:ring-indigo-500/20 text-sm font-semibold text-gray-700" />
                        </div>

                        <!-- Job Title -->
                        <div class="space-y-2 mt-4">
                            <label for=""
                                class="block text-xs font-bold uppercase text-gray-600 tracking-wider">Job Title</label>
                            <select name="job_title" required
                                class="w-full  px-4 py-3 rounded-2xl border border-gray-200 focus:border-indigo-500 focus:ring-indigo-500/20 text-sm font-semibold text-gray-700">
                                <option value="PHD.">phD.</option>
                                <option value="Dr.">Dr.</option>
                                <option value="Prof.">Prof.</option>
                                <option value="Mr.">Mr.</option>
                                <option value="Ms.">Ms.</option>
                            </select>
                        </div>
                    </div>


                </div>



                <!-- Submit Button Bar -->
                <div class="flex items-center justify-end gap-4">
                    <button type="reset"
                        class="rounded-md bg-slate-100 px-6 py-3 text-xs font-bold text-slate-700 transition hover:bg-slate-200 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-slate-500">
                        Reset Form
                    </button>
                    <button type="submit"
                        class="rounded-md bg-emerald-800 px-8 py-3 text-xs font-bold text-white transition hover:bg-emerald-900 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-emerald-800">
                        Save
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
                        "text-xs", "text-emerald-800", "font-semibold",
                        "bg-emerald-50", "px-2", "py-1", "rounded-md"
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
</script>
