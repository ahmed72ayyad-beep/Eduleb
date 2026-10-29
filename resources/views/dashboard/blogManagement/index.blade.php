<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row justify-between items-center gap-4">
            <div>
                <h2 class="font-bold text-2xl text-gray-800 leading-tight">
                    {{ __('Blog & Posts Management') }}
                </h2>
                <p class="text-sm text-gray-500 mt-1">
                    {{ __('Manage platform articles, blog posts, and publication details seamlessly.') }}
                </p>
            </div>
            <div class="flex items-center gap-1 flex-col">
                @if ($errors->hasAny(['title', 'sub_title', 'subject', 'image', 'content']))
                    <p class="text-red-600 m-0">Not Added Cheak The Form Data</p>
                @endif
                <x-primary-button x-data=""
                    x-on:click.prevent="$dispatch('open-modal', 'create-post-modal')"
                    class="flex gap-x-3 rounded-md bg-emerald-800 px-6 py-2.5 shadow-sm transition hover:bg-emerald-900 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-emerald-800
    {{ $errors->hasAny(['title', 'sub_title', 'subject', 'image', 'content'])
        ? 'border-2 border-solid border-red-600'
        : '' }}">
                    <span>{{ __('Add New Post') }}</span>


                    <svg class="w-5 h-5 ml-2 -mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                </x-primary-button>
            </div>
        </div>
    </x-slot>

    <div class="min-h-screen bg-gradient-to-br from-slate-50 via-emerald-50/40 to-amber-50/30 py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <!-- Stats Overview Cards -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                <div
                    class="flex items-center justify-between overflow-hidden rounded-lg border border-slate-200 border-t-2 border-t-emerald-700 bg-white p-5 shadow-sm transition hover:shadow-md">
                    <div>
                        <p class="text-sm font-medium text-gray-500">{{ __('Total Posts') }}</p>
                        <h3 class="text-2xl font-bold text-gray-800 mt-1">{{ $blogs_num }}</h3>
                    </div>
                    <div
                        class="flex h-12 w-12 items-center justify-center rounded-md bg-emerald-50 text-xl font-bold text-emerald-800">
                        📝</div>
                </div>
                <div
                    class="flex items-center justify-between overflow-hidden rounded-lg border border-slate-200 border-t-2 border-t-teal-700 bg-white p-5 shadow-sm transition hover:shadow-md">
                    <div>
                        <p class="text-sm font-medium text-gray-500">{{ __('Writers') }}</p>
                        <h3 class="text-2xl font-bold text-green-600 mt-1">{{ $writers_num }}</h3>
                    </div>
                    <div
                        class="flex h-12 w-12 items-center justify-center rounded-md bg-teal-50 text-xl font-bold text-teal-800">
                        ✍️</div>
                </div>
                <div
                    class="flex items-center justify-between overflow-hidden rounded-lg border border-slate-200 border-t-2 border-t-amber-500 bg-white p-5 shadow-sm transition hover:shadow-md">
                    <div>
                        <p class="text-sm font-medium text-gray-500">{{ __('Tags') }}</p>
                        <h3 class="text-2xl font-bold text-amber-600 mt-1">{{ $tags_num }}</h3>
                    </div>
                    <div
                        class="flex h-12 w-12 items-center justify-center rounded-md bg-amber-50 text-xl font-bold text-amber-800">
                        🏷️</div>
                </div>
                <div
                    class="flex items-center justify-between overflow-hidden rounded-lg border border-slate-200 border-t-2 border-t-sky-700 bg-white p-5 shadow-sm transition hover:shadow-md">
                    <div>
                        <p class="text-sm font-medium text-gray-500">{{ __('Total Comments') }}</p>
                        <h3 class="text-2xl font-bold text-blue-600 mt-1">{{ $comments_num }}</h3>
                    </div>
                    <div
                        class="flex h-12 w-12 items-center justify-center rounded-md bg-sky-50 text-xl font-bold text-sky-800">
                        💬</div>
                </div>
            </div>

            <!-- Search Bar with Suggestions Counter Container -->
            <div
                class="flex flex-col items-center justify-between gap-4 rounded-lg border border-slate-200 bg-white p-5 shadow-sm md:flex-row sm:p-6">
                <div class="w-full md:w-1/2 relative" id="search_counter">
                    <label for="search"
                        class="block text-sm font-medium text-gray-700 mb-1">{{ __('Search Posts') }}</label>
                    <input
                        class="mt-1 block w-full rounded-md border-slate-300 px-5 py-2.5 text-sm shadow-sm focus:border-emerald-600 focus:ring-emerald-600"
                        id="search" type="text" name="search" placeholder="Search by post title or author..." />
                </div>
            </div>

            <!-- Posts Table Card -->
            <div class="overflow-hidden rounded-lg border border-slate-200 bg-white shadow-sm">
                <div class="p-6 text-gray-900 overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead>
                            <tr>
                                <th
                                    class="rounded-l-md bg-emerald-50 px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-emerald-900">
                                    {{ __('Post Details') }}</th>
                                <th
                                    class="bg-emerald-50 px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-emerald-900">
                                    {{ __('Subject') }}</th>
                                <th
                                    class="px-6 py-4 bg-gray-50 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                    {{ __('Author') }}</th>
                                <th
                                    class="px-6 py-4 bg-gray-50 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                    {{ __('Date') }}</th>
                                <th
                                    class="rounded-r-md bg-emerald-50 px-6 py-4 text-right text-xs font-semibold uppercase tracking-wider text-emerald-900">
                                    {{ __('Actions') }}</th>
                            </tr>
                        </thead>
                        <tbody id="blogs-table-body" class="divide-y divide-slate-100 bg-white text-sm">
                            @forelse($blogs as $blog)
                                <tr id="blog_row_{{ $blog->id }}" class="transition-colors hover:bg-emerald-50/40">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center space-x-3">
                                            @if ($blog->image)
                                                <img src="{{ asset($blog->image) }}" alt="Post Image"
                                                    class="h-10 w-10 flex-shrink-0 rounded-md object-cover">
                                            @else
                                                <div
                                                    class="flex h-10 w-10 flex-shrink-0 items-center justify-center rounded-md bg-emerald-50 font-bold text-emerald-800">
                                                    📄</div>
                                            @endif
                                            <div>
                                                <div class="font-bold text-gray-900">{{ $blog->title }}</div>
                                                <div class="text-xs text-gray-500 truncate max-w-xs">
                                                    {{ $blog->sub_title }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span
                                            class="rounded-sm bg-emerald-50 px-2.5 py-1 text-xs font-semibold text-emerald-800">{{ $blog->subject }}</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-gray-600">
                                        {{ $blog->author->name ?? 'Admin' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-gray-500 text-xs">
                                        {{ $blog->created_at->format('Y-m-d') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium space-x-2">
                                        <button x-data=""
                                            x-on:click.prevent="$dispatch('open-modal', 'edit-post-modal{{ $blog->id }}')"
                                            class="rounded-md bg-emerald-50 px-3 py-1.5 text-emerald-800 transition hover:bg-emerald-100">{{ __('Edit') }}</button>
                                        <x-modal name="edit-post-modal{{ $blog->id }}" focusable>
                                            <form method="POST"
                                                action="{{ route('dashboard.blogs.update', $blog->id) }}"
                                                enctype="multipart/form-data"
                                                class="space-y-5 rounded-lg p-6 sm:p-8 [&_input]:rounded-md [&_textarea]:rounded-md [&_input:focus]:border-emerald-600 [&_input:focus]:ring-emerald-600 [&_textarea:focus]:border-emerald-600 [&_textarea:focus]:ring-emerald-600">
                                                @csrf
                                                @method('PUT')
                                                <h2 class="text-xl font-bold text-gray-900 mb-2">
                                                    {{ __('Update Blog Post') }}
                                                </h2>

                                                <div>
                                                    <x-input label="Post Title"
                                                        labelclass="block text-sm font-medium text-gray-700 text-left"
                                                        class="mt-1 block w-full rounded-md border-slate-300 px-4 py-2 text-sm shadow-sm focus:border-emerald-600 focus:ring-emerald-600"
                                                        id="title" type="text" name="title"
                                                        placeholder="Enter post title..." required
                                                        value="{{ $blog->title }}" />
                                                </div>

                                                <div>
                                                    <x-input label="Sub Title"
                                                        labelclass="block text-sm font-medium text-gray-700 text-left"
                                                        class="mt-1 block w-full rounded-md border-slate-300 px-4 py-2 text-sm shadow-sm focus:border-emerald-600 focus:ring-emerald-600"
                                                        id="sub_title" type="text" name="sub_title"
                                                        placeholder="Enter brief subtitle..." required
                                                        value="{{ $blog->sub_title }}" />
                                                </div>

                                                <div>
                                                    <x-input
                                                        labelclass="block text-sm font-medium text-gray-700 text-left"
                                                        label="Subject"
                                                        class="mt-1 block w-full rounded-md border-slate-300 px-4 py-2 text-sm shadow-sm focus:border-emerald-600 focus:ring-emerald-600"
                                                        id="subject" type="text" name="subject"
                                                        placeholder="Enter subject category..." required
                                                        value="{{ $blog->subject }}" />
                                                </div>

                                                <div>
                                                    <x-input label="Post Image"
                                                        labelclass="block text-sm font-medium text-gray-700 text-left"
                                                        class="mt-1 block w-full text-sm text-slate-500 file:mr-4 file:rounded-md file:border-0 file:bg-emerald-50 file:px-6 file:py-2 file:text-sm file:font-semibold file:text-emerald-800 hover:file:bg-emerald-100"
                                                        id="image" type="file" name="image"
                                                        value="{{ $blog->image }}" />
                                                </div>
                                                <div>
                                                    <x-textarea label="Content" rows="7"
                                                        labelclass="block text-sm font-medium text-gray-700 text-left"
                                                        class="mt-1 block w-full rounded-md border-slate-300 p-4 text-sm shadow-sm focus:border-emerald-600 focus:ring-emerald-600"
                                                        id="content" name="content"
                                                        placeholder="Write your post content here..."
                                                        value="{{ $blog->content }}" />
                                                </div>
                                                <h2 class="block text-sm font-medium text-gray-700">Select The Related
                                                    Tags </h2>
                                                <div class="flex flex-wrap justify-evenly items-center ">
                                                    @foreach ($tags as $tag)
                                                        <div class="basis-2/5 flex flex-row justify-between">
                                                            <label
                                                                for="{{ $tag->id }}">{{ $tag->name }}</label>
                                                            <input id="{{ $tag->id }}" type="checkbox"
                                                                name="tags[]" value="{{ $tag->id }}"
                                                                @checked($blog->tags->contains('id', $tag->id)) />
                                                        </div>
                                                    @endforeach

                                                </div>
                                                <div class="mt-8 flex justify-end gap-3">
                                                    <x-secondary-button x-on:click="$dispatch('close')"
                                                        class="rounded-md px-6 py-2.5">
                                                        {{ __('Cancel') }}
                                                    </x-secondary-button>

                                                    <x-primary-button
                                                        class="rounded-md bg-emerald-800 px-6 py-2.5 shadow-sm transition hover:bg-emerald-900">
                                                        {{ __('Save Post') }}
                                                    </x-primary-button>
                                                </div>
                                            </form>

                                        </x-modal>









                                        <form action="{{ route('dashboard.blogs.destroy', $blog->id) }}"
                                            method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="rounded-md bg-rose-50 px-3 py-1.5 text-rose-700 transition hover:bg-rose-100"
                                                onclick="return confirm('Are you sure?')">{{ __('Delete') }}</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-4 text-center text-gray-500">
                                        {{ __('No blog posts found.') }}
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>

    <!-- Create Post Modal -->
    <x-modal name="create-post-modal" focusable>
        <form method="POST" action="{{ route('dashboard.blogs.store') }}" enctype="multipart/form-data"
            class="space-y-5 rounded-lg p-6 sm:p-8 [&_input]:rounded-md [&_textarea]:rounded-md [&_input:focus]:border-emerald-600 [&_input:focus]:ring-emerald-600 [&_textarea:focus]:border-emerald-600 [&_textarea:focus]:ring-emerald-600">
            @csrf
            <h2 class="text-xl font-bold text-gray-900 mb-2">
                {{ __('Create New Blog Post') }}
            </h2>

            <div>
                <x-input label="Post Title" labelclass="block text-sm font-medium text-gray-700"
                    class="mt-1 block w-full rounded-md border-slate-300 px-4 py-2 text-sm shadow-sm focus:border-emerald-600 focus:ring-emerald-600"
                    id="title" type="text" name="title" placeholder="Enter post title..." required />
            </div>

            <div>
                <x-input label="Sub Title" labelclass="block text-sm font-medium text-gray-700"
                    class="mt-1 block w-full rounded-md border-slate-300 px-4 py-2 text-sm shadow-sm focus:border-emerald-600 focus:ring-emerald-600"
                    id="sub_title" type="text" name="sub_title" placeholder="Enter brief subtitle..." required />
            </div>

            <div>
                <x-input labelclass="block text-sm font-medium text-gray-700" label="Subject"
                    class="mt-1 block w-full rounded-md border-slate-300 px-4 py-2 text-sm shadow-sm focus:border-emerald-600 focus:ring-emerald-600"
                    id="subject" type="text" name="subject" placeholder="Enter subject category..." required />
            </div>

            <div>
                <x-input label="Post Image" labelclass="block text-sm font-medium text-gray-700"
                    class="mt-1 block w-full text-sm text-slate-500 file:mr-4 file:rounded-md file:border-0 file:bg-emerald-50 file:px-6 file:py-2 file:text-sm file:font-semibold file:text-emerald-800 hover:file:bg-emerald-100"
                    id="image" type="file" name="image" />
            </div>

            <div>
                <x-textarea label="Content" labelclass="block text-sm font-medium text-gray-700"
                    class="mt-1 block w-full rounded-md border-slate-300 p-4 text-sm shadow-sm focus:border-emerald-600 focus:ring-emerald-600"
                    id="content" name="content" rows="4" placeholder="Write your post content here..." />
            </div>
            <h2 class="block text-sm font-medium text-gray-700">Select The Related Tags </h2>
            <div class="flex flex-wrap justify-evenly items-center ">
                @forelse ($tags as $tag)
                    <div class="basis-2/5 flex flex-row justify-between">

                        <x-input labelclass="text-sm" multiple="5" type="checkbox" value="{{ $tag->id }}"
                            name="tags[]" id="{{ $tag->id }}" label="{{ $tag->name }}" />
                    </div>

                @empty
                    <div>No tags</div>
                @endforelse

            </div>
            <div class="mt-8 flex justify-end gap-3">
                <x-secondary-button x-on:click="$dispatch('close')" class="rounded-md px-6 py-2.5">
                    {{ __('Cancel') }}
                </x-secondary-button>

                <x-primary-button
                    class="rounded-md bg-emerald-800 px-6 py-2.5 shadow-sm transition hover:bg-emerald-900">
                    {{ __('Save Post') }}
                </x-primary-button>
            </div>

        </form>
    </x-modal>






    <!-- Vanilla JavaScript Search with Suggestions Dropdown & Row Highlighting -->

</x-app-layout>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        let myInput = document.querySelector("#search");
        let search_counter = document.querySelector("#search_counter");

        if (!myInput || !search_counter) return;

        let ul = document.createElement("ul");
        ul.classList.add("w-full", "bg-white", "shadow-xl", "flex", "flex-col", "justify-start", "items-start",
            "z-50", "rounded-3xl", "absolute", "mt-2", "border", "border-gray-100", "overflow-hidden");
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
                // تمرير القيمة هنا كـ Route Parameter مباشرة
                fetch("{{ route('dashboard.blogs.search', ':query') }}".replace(":query", query), {
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'Accept': 'application/json'
                        }
                    })
                    .then((result) => result.json())
                    .then((data) => {
                        ul.innerHTML = "";
                        let blogs = data;
                        let hasResults = false;

                        blogs.forEach(blog => {
                            hasResults = true;
                            let li = createBlogSuggestionItem(blog.title, blog
                                .author_name, blog.id);
                            ul.appendChild(li);
                        });

                        if (!hasResults) {
                            let li = document.createElement("li");
                            li.textContent = "No posts found";
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

        function createBlogSuggestionItem(titleText, authorName, blogId) {
            let li = document.createElement("li");
            li.classList.add("w-full", "bg-white", "px-6", "py-3", "transition-all", "hover:bg-slate-50",
                "text-sm", "flex", "justify-between", "items-center", "cursor-pointer", "border-b",
                "border-gray-50");

            let textContainer = document.createElement("div");
            textContainer.classList.add("flex", "flex-col");

            let titleSpan = document.createElement("span");
            titleSpan.textContent = titleText;
            titleSpan.classList.add("font-bold", "text-gray-900");

            let authorSpan = document.createElement("span");
            authorSpan.textContent = "By: " + authorName;
            authorSpan.classList.add("text-xs", "text-gray-500", "mt-0.5");

            textContainer.appendChild(titleSpan);
            textContainer.appendChild(authorSpan);
            li.appendChild(textContainer);

            li.onmousedown = function(e) {
                e.preventDefault();
                myInput.value = titleText;
                ul.innerHTML = "";

                document.querySelectorAll("tr[id^='blog_row_']").forEach(row => {
                    row.classList.remove("bg-emerald-50", "transition-colors", "duration-500");
                });

                let targetRow = document.querySelector("#blog_row_" + blogId);
                if (targetRow) {
                    targetRow.classList.add("bg-emerald-50", "transition-colors", "duration-500");
                    targetRow.scrollIntoView({
                        behavior: 'smooth',
                        block: 'center'
                    });

                    setTimeout(() => {
                        targetRow.classList.remove("bg-emerald-50");
                    }, 3000);
                }
            };

            return li;
        }

        // إخفاء القائمة عند النقر خارجها
        document.addEventListener("click", function(e) {
            if (!search_counter.contains(e.target)) {
                ul.innerHTML = "";
            }
        });
    });
</script>
