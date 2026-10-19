<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row justify-between items-center gap-4">
            <div>
                <h2 class="font-bold text-2xl text-gray-800 leading-tight">
                    {{ __('FAQ Management') }}
                </h2>
                <p class="text-sm text-gray-500 mt-1">
                    {{ __('Manage platform frequently asked questions and answers seamlessly.') }}
                </p>
            </div>
            <div class="flex items-center gap-3">
                <x-primary-button x-data="" x-on:click.prevent="$dispatch('open-modal', 'create-faq-modal')"
                    class="bg-indigo-600 hover:bg-indigo-700 rounded-full px-6 py-2.5 shadow-lg flex gap-x-3">
                    <span>
                        {{ __('Add New FAQ') }}
                    </span>
                    <svg class="w-5 h-5 ml-2 -mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>

                </x-primary-button>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <!-- Stats Overview Cards -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-2 gap-6">
                <div
                    class="bg-white overflow-hidden shadow-sm sm:rounded-3xl p-6 border border-gray-100 flex items-center justify-between transition-all hover:shadow-md">
                    <div>
                        <p class="text-sm font-medium text-gray-500">{{ __('Total FAQs') }}</p>
                        <h3 class="text-2xl font-bold text-gray-800 mt-1">{{ $faqs->count() }}</h3>
                    </div>
                    <div
                        class="w-14 h-14 bg-indigo-50 text-indigo-600 rounded-full flex items-center justify-center font-bold text-xl shadow-inner">
                        ❓</div>
                </div>
                {{-- <div
                    class="bg-white overflow-hidden shadow-sm sm:rounded-3xl p-6 border border-gray-100 flex items-center justify-between transition-all hover:shadow-md">
                    <div>
                        <p class="text-sm font-medium text-gray-500">{{ __('Authors') }}</p>
                        <h3 class="text-2xl font-bold text-green-600 mt-1">{{ $authors_num ?? 0 }}</h3>
                    </div>
                    <div
                        class="w-14 h-14 bg-green-50 text-green-600 rounded-full flex items-center justify-center font-bold text-xl shadow-inner">
                        ✍️</div>
                </div> --}}
                <div
                    class="bg-white overflow-hidden shadow-sm sm:rounded-3xl p-6 border border-gray-100 flex items-center justify-between transition-all hover:shadow-md">
                    <div>
                        <p class="text-sm font-medium text-gray-500">{{ __('Active Status') }}</p>
                        <h3 class="text-2xl font-bold text-blue-600 mt-1">{{ __('100% Online') }}</h3>
                    </div>
                    <div
                        class="w-14 h-14 bg-blue-50 text-blue-600 rounded-full flex items-center justify-center font-bold text-xl shadow-inner">
                        ⚡</div>
                </div>
            </div>

            <!-- Search Bar with Suggestions Counter Container -->
            <div
                class="bg-white p-4 sm:p-6 shadow-sm sm:rounded-3xl border border-gray-100 flex flex-col md:flex-row justify-between items-center gap-4">
                <div class="w-full md:w-1/2 relative" id="search_counter">
                    <label for="search"
                        class="block text-sm font-medium text-gray-700 mb-1">{{ __('Search Questions') }}</label>
                    <input
                        class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-full px-5 py-2.5 shadow-sm text-sm"
                        id="search" type="text" name="search" autocomplete="off"
                        placeholder="Search by question or author..." />
                </div>
            </div>

            <!-- FAQs Table Card -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-3xl border border-gray-100">
                <div class="p-6 text-gray-900 overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead>
                            <tr>
                                <th
                                    class="px-6 py-4 bg-gray-50 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider rounded-r-2xl">
                                    {{ __('Question & Answer') }}</th>
                                <th
                                    class="px-6 py-4 bg-gray-50 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                    {{ __('Author') }}</th>
                                <th
                                    class="px-6 py-4 bg-gray-50 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                    {{ __('Date') }}</th>
                                <th
                                    class="px-6 py-4 bg-gray-50 text-right text-xs font-semibold text-gray-500 uppercase tracking-wider rounded-l-2xl">
                                    {{ __('Actions') }}</th>
                            </tr>
                        </thead>
                        <tbody id="faqs-table-body" class="bg-white divide-y divide-gray-200 text-sm">
                            @forelse($faqs ?? [] as $faq)
                                <tr id="faq_row_{{ $faq->id }}" class="hover:bg-gray-50 transition-colors">
                                    <td class="px-6 py-4">
                                        <div class="font-bold text-gray-900">{{ $faq->question }}</div>
                                        <div class="text-xs text-gray-500 mt-1 truncate max-w-md">{{ $faq->answer }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-gray-600">
                                        {{ $faq->author->name ?? 'Admin' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-gray-500 text-xs">
                                        {{ $faq->created_at == null ? 'Not Available' : $faq->created_at->format('Y-m-d') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium space-x-2">
                                        <button x-data="" x-on:click.prevent="$dispatch('open-modal', 'edit-faq-modal{{ $faq->id }}')"
                                            class="text-indigo-600 hover:text-indigo-900 bg-indigo-50 px-3 py-1 rounded-full">{{ __('Edit') }}</button>
                                        <x-modal name="edit-faq-modal{{ $faq->id }}" focusable>
                                            <form method="POST" action="{{ route('dashboard.FAQs.update',$faq->id) }}"
                                                class="p-8 space-y-5 rounded-3xl">
                                                @csrf
                                                @method("PUT")
                                                <h2 class="text-xl font-bold text-gray-900 mb-2">
                                                    {{ __('Edit FAQ') }}
                                                </h2>

                                                <div>
                                                    <x-input labelclass="block text-sm font-medium text-gray-700"
                                                        label="Question" value="{{ $faq->question }}"
                                                        class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-full px-4 py-2 shadow-sm text-sm"
                                                        id="question" type="text" name="question"
                                                        placeholder="Enter question..." required />
                                                </div>

                                                <div>
                                                    <x-textarea label="Answer" value="{{ $faq->answer }}"
                                                        labelclass="block text-sm font-medium text-gray-700"
                                                        class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-2xl p-4 shadow-sm text-sm"
                                                        id="answer" name="answer" rows="4"
                                                        placeholder="Write the detailed answer here..." required />
                                                </div>

                                                <div class="mt-8 flex justify-end gap-3">
                                                    <x-secondary-button x-on:click="$dispatch('close')"
                                                        class="rounded-full px-6 py-2.5">
                                                        {{ __('Cancel') }}
                                                    </x-secondary-button>

                                                    <x-primary-button
                                                        class="bg-indigo-600 hover:bg-indigo-700 rounded-full px-6 py-2.5 shadow-lg">
                                                        {{ __('Save FAQ') }}
                                                    </x-primary-button>
                                                </div>
                                            </form>
                                        </x-modal>

                                        <form action="{{ route('dashboard.FAQs.destroy', $faq->id) }}" method="POST"
                                            class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="text-red-600 hover:text-red-900 bg-red-50 px-3 py-1 rounded-full"
                                                onclick="return confirm('Are you sure?')">{{ __('Delete') }}</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-4 text-center text-gray-500">
                                        {{ __('No FAQs found.') }}
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>

    <!-- Create FAQ Modal -->
    <x-modal name="create-faq-modal" focusable>
        <form method="POST" action="{{ route('dashboard.FAQs.store') }}" class="p-8 space-y-5 rounded-3xl">
            @csrf
            <h2 class="text-xl font-bold text-gray-900 mb-2">
                {{ __('Create New FAQ') }}
            </h2>

            <div>
                <x-input labelclass="block text-sm font-medium text-gray-700" label="Question"
                    class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-full px-4 py-2 shadow-sm text-sm"
                    id="question" type="text" name="question" placeholder="Enter question..." required />
            </div>

            <div>
                <x-textarea label="Answer" labelclass="block text-sm font-medium text-gray-700"
                    class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-2xl p-4 shadow-sm text-sm"
                    id="answer" name="answer" rows="4" placeholder="Write the detailed answer here..."
                    required />
            </div>

            <div class="mt-8 flex justify-end gap-3">
                <x-secondary-button x-on:click="$dispatch('close')" class="rounded-full px-6 py-2.5">
                    {{ __('Cancel') }}
                </x-secondary-button>

                <x-primary-button class="bg-indigo-600 hover:bg-indigo-700 rounded-full px-6 py-2.5 shadow-lg">
                    {{ __('Save FAQ') }}
                </x-primary-button>
            </div>
        </form>
    </x-modal>

    <!-- JavaScript Search Script with Fetch & Route Parameter -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let myInput = document.querySelector("#search");
            let search_counter = document.querySelector("#search_counter");

            if (!myInput || !search_counter) return;

            let ul = document.createElement("ul");
            ul.classList.add("w-full", "bg-white", "shadow-xl", "flex", "flex-col", "justify-start", "items-start",
                "z-50",
                "rounded-3xl", "absolute", "mt-2", "border", "border-gray-100", "overflow-hidden");
            search_counter.appendChild(ul);

            let timeout = null;

            myInput.onkeyup = function(e) {
                clearTimeout(timeout);
                let query = myInput.value.trim();

                if (query === "") {
                    ul.innerHTML = "";
                    return;
                }

                timeout = setTimeout(() => {
                    fetch("{{ route('dashboard.FAQs.search', ':id') }}".replace(":id",
                            encodeURIComponent(query)), {
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest',
                                'Accept': 'application/json'
                            }
                        })
                        .then((result) => result.json())
                        .then((data) => {
                            ul.innerHTML = "";
                            let faqs = data;
                            let hasResults = false;

                            faqs.forEach(faq => {
                                hasResults = true;
                                let li = createFaqSuggestionItem(faq.question, faq
                                    .author_name, faq.id);
                                ul.appendChild(li);
                            });

                            if (!hasResults) {
                                let li = document.createElement("li");
                                li.textContent = "No FAQs found";
                                li.classList.add("w-full", "px-6", "py-3", "text-sm",
                                    "text-gray-400");
                                ul.appendChild(li);
                            }
                        })
                        .catch((err) => {
                            console.error("Search error:", err);
                        });
                }, 300);
            };

            function createFaqSuggestionItem(questionText, authorName, faqId) {
                let li = document.createElement("li");
                li.classList.add("w-full", "bg-white", "px-6", "py-3", "transition-all", "hover:bg-slate-50",
                    "text-sm", "flex",
                    "justify-between", "items-center", "cursor-pointer", "border-b", "border-gray-50");

                let textContainer = document.createElement("div");
                textContainer.classList.add("flex", "flex-col");

                let questionSpan = document.createElement("span");
                questionSpan.textContent = questionText;
                questionSpan.classList.add("font-bold", "text-gray-900");

                let authorSpan = document.createElement("span");
                authorSpan.textContent = "By: " + authorName;
                authorSpan.classList.add("text-xs", "text-gray-500", "mt-0.5");

                textContainer.appendChild(questionSpan);
                textContainer.appendChild(authorSpan);
                li.appendChild(textContainer);

                li.onmousedown = function(e) {
                    e.preventDefault();
                    myInput.value = questionText;
                    ul.innerHTML = "";

                    document.querySelectorAll("tr[id^='faq_row_']").forEach(row => {
                        row.classList.remove("bg-indigo-50", "transition-colors", "duration-500");
                    });

                    let targetRow = document.querySelector("#faq_row_" + faqId);
                    if (targetRow) {
                        targetRow.classList.add("bg-indigo-50", "transition-colors", "duration-500");
                        targetRow.scrollIntoView({
                            behavior: 'smooth',
                            block: 'center'
                        });

                        setTimeout(() => {
                            targetRow.classList.remove("bg-indigo-50");
                        }, 3000);
                    }
                };

                return li;
            }

            document.addEventListener("click", function(e) {
                if (!search_counter.contains(e.target)) {
                    ul.innerHTML = "";
                }
            });
        });
    </script>
</x-app-layout>
