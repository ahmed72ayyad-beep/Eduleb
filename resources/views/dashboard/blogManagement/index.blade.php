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
                    class="bg-indigo-600 hover:bg-indigo-700 rounded-full px-6 py-2.5 shadow-lg flex gap-x-3
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

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <!-- Stats Overview Cards -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                <div
                    class="bg-white overflow-hidden shadow-sm sm:rounded-3xl p-6 border border-gray-100 flex items-center justify-between transition-all hover:shadow-md">
                    <div>
                        <p class="text-sm font-medium text-gray-500">{{ __('Total Posts') }}</p>
                        <h3 class="text-2xl font-bold text-gray-800 mt-1">{{ $blogs_num }}</h3>
                    </div>
                    <div
                        class="w-14 h-14 bg-indigo-50 text-indigo-600 rounded-full flex items-center justify-center font-bold text-xl shadow-inner">
                        📝</div>
                </div>
                <div
                    class="bg-white overflow-hidden shadow-sm sm:rounded-3xl p-6 border border-gray-100 flex items-center justify-between transition-all hover:shadow-md">
                    <div>
                        <p class="text-sm font-medium text-gray-500">{{ __('Writers') }}</p>
                        <h3 class="text-2xl font-bold text-green-600 mt-1">{{ $writers_num }}</h3>
                    </div>
                    <div
                        class="w-14 h-14 bg-green-50 text-green-600 rounded-full flex items-center justify-center font-bold text-xl shadow-inner">
                        ✍️</div>
                </div>
                <div
                    class="bg-white overflow-hidden shadow-sm sm:rounded-3xl p-6 border border-gray-100 flex items-center justify-between transition-all hover:shadow-md">
                    <div>
                        <p class="text-sm font-medium text-gray-500">{{ __('Tags') }}</p>
                        <h3 class="text-2xl font-bold text-amber-600 mt-1">{{ $tags_num }}</h3>
                    </div>
                    <div
                        class="w-14 h-14 bg-amber-50 text-amber-600 rounded-full flex items-center justify-center font-bold text-xl shadow-inner">
                        🏷️</div>
                </div>
                <div
                    class="bg-white overflow-hidden shadow-sm sm:rounded-3xl p-6 border border-gray-100 flex items-center justify-between transition-all hover:shadow-md">
                    <div>
                        <p class="text-sm font-medium text-gray-500">{{ __('Total Comments') }}</p>
                        <h3 class="text-2xl font-bold text-blue-600 mt-1">{{ $comments_num }}</h3>
                    </div>
                    <div
                        class="w-14 h-14 bg-blue-50 text-blue-600 rounded-full flex items-center justify-center font-bold text-xl shadow-inner">
                        💬</div>
                </div>
            </div>

            <!-- Search Bar with Suggestions Counter Container -->
            <div
                class="bg-white p-4 sm:p-6 shadow-sm sm:rounded-3xl border border-gray-100 flex flex-col md:flex-row justify-between items-center gap-4">
                <div class="w-full md:w-1/2 relative" id="search_counter">
                    <label for="search"
                        class="block text-sm font-medium text-gray-700 mb-1">{{ __('Search Posts') }}</label>
                    <input
                        class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-full px-5 py-2.5 shadow-sm text-sm"
                        id="search" type="text" name="search" placeholder="Search by post title or author..." />
                </div>
            </div>

            <!-- Posts Table Card -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-3xl border border-gray-100">
                <div class="p-6 text-gray-900 overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead>
                            <tr>
                                <th
                                    class="px-6 py-4 bg-gray-50 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider rounded-r-2xl">
                                    {{ __('Post Details') }}</th>
                                <th
                                    class="px-6 py-4 bg-gray-50 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                    {{ __('Subject') }}</th>
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
                        <tbody id="blogs-table-body" class="bg-white divide-y divide-gray-200 text-sm">
                            @forelse($blogs as $blog)
                                <tr id="blog_row_{{ $blog->id }}" class="hover:bg-gray-50 transition-colors">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center space-x-3">
                                            @if ($blog->image)
                                                <img src="{{ asset($blog->image) }}" alt="Post Image"
                                                    class="w-10 h-10 rounded-xl object-cover flex-shrink-0">
                                            @else
                                                <div
                                                    class="w-10 h-10 rounded-xl bg-indigo-100 flex items-center justify-center font-bold text-indigo-600 flex-shrink-0">
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
                                            class="px-2.5 py-1 text-xs font-semibold bg-indigo-50 text-indigo-700 rounded-full">{{ $blog->subject }}</span>
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
                                            class="text-indigo-600 hover:text-indigo-900 bg-indigo-50 px-3 py-1 rounded-full">{{ __('Edit') }}</button>
                                        <x-modal name="edit-post-modal{{ $blog->id }}" focusable>
                                            <form method="POST"
                                                action="{{ route('dashboard.blogs.update', $blog->id) }}"
                                                enctype="multipart/form-data" class="p-8 space-y-5 rounded-3xl">
                                                @csrf
                                                @method('PUT')
                                                <h2 class="text-xl font-bold text-gray-900 mb-2">
                                                    {{ __('Update Blog Post') }}
                                                </h2>

                                                <div>
                                                    <x-input label="Post Title"
                                                        labelclass="block text-sm font-medium text-gray-700 text-left"
                                                        class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-full px-4 py-2 shadow-sm text-sm"
                                                        id="title" type="text" name="title"
                                                        placeholder="Enter post title..." required
                                                        value="{{ $blog->title }}" />
                                                </div>

                                                <div>
                                                    <x-input label="Sub Title"
                                                        labelclass="block text-sm font-medium text-gray-700 text-left"
                                                        class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-full px-4 py-2 shadow-sm text-sm"
                                                        id="sub_title" type="text" name="sub_title"
                                                        placeholder="Enter brief subtitle..." required
                                                        value="{{ $blog->sub_title }}" />
                                                </div>

                                                <div>
                                                    <x-input labelclass="block text-sm font-medium text-gray-700 text-left"
                                                        label="Subject"
                                                        class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-full px-4 py-2 shadow-sm text-sm"
                                                        id="subject" type="text" name="subject"
                                                        placeholder="Enter subject category..." required
                                                        value="{{ $blog->subject }}" />
                                                </div>

                                                <div>
                                                    <x-input label="Post Image"
                                                        labelclass="block text-sm font-medium text-gray-700 text-left"
                                                        class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-6 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100"
                                                        id="image" type="file" name="image"
                                                        value="{{ $blog->image }}" />
                                                </div>
                                                <div>
                                                    <x-textarea label="Content"
                                                    rows="7"
                                                        labelclass="block text-sm font-medium text-gray-700 text-left"
                                                        class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-2xl p-4 shadow-sm text-sm"
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
                                                                @checked($blog->tags->contains('id', $tag->id))/>
                                                        </div>
                                                    @endforeach

                                                </div>
                                                <div class="mt-8 flex justify-end gap-3">
                                                    <x-secondary-button x-on:click="$dispatch('close')"
                                                        class="rounded-full px-6 py-2.5">
                                                        {{ __('Cancel') }}
                                                    </x-secondary-button>

                                                    <x-primary-button
                                                        class="bg-indigo-600 hover:bg-indigo-700 rounded-full px-6 py-2.5 shadow-lg">
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
                                                class="text-red-600 hover:text-red-900 bg-red-50 px-3 py-1 rounded-full"
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
            class="p-8 space-y-5 rounded-3xl">
            @csrf
            <h2 class="text-xl font-bold text-gray-900 mb-2">
                {{ __('Create New Blog Post') }}
            </h2>

            <div>
                <x-input label="Post Title" labelclass="block text-sm font-medium text-gray-700"
                    class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-full px-4 py-2 shadow-sm text-sm"
                    id="title" type="text" name="title" placeholder="Enter post title..." required />
            </div>

            <div>
                <x-input label="Sub Title" labelclass="block text-sm font-medium text-gray-700"
                    class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-full px-4 py-2 shadow-sm text-sm"
                    id="sub_title" type="text" name="sub_title" placeholder="Enter brief subtitle..." required />
            </div>

            <div>
                <x-input labelclass="block text-sm font-medium text-gray-700" label="Subject"
                    class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-full px-4 py-2 shadow-sm text-sm"
                    id="subject" type="text" name="subject" placeholder="Enter subject category..." required />
            </div>

            <div>
                <x-input label="Post Image" labelclass="block text-sm font-medium text-gray-700"
                    class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-6 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100"
                    id="image" type="file" name="image" />
            </div>

            <div>
                <x-textarea label="Content" labelclass="block text-sm font-medium text-gray-700"
                    class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-2xl p-4 shadow-sm text-sm"
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
                <x-secondary-button x-on:click="$dispatch('close')" class="rounded-full px-6 py-2.5">
                    {{ __('Cancel') }}
                </x-secondary-button>

                <x-primary-button class="bg-indigo-600 hover:bg-indigo-700 rounded-full px-6 py-2.5 shadow-lg">
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
                    row.classList.remove("bg-indigo-50", "transition-colors", "duration-500");
                });

                let targetRow = document.querySelector("#blog_row_" + blogId);
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

        // إخفاء القائمة عند النقر خارجها
        document.addEventListener("click", function(e) {
            if (!search_counter.contains(e.target)) {
                ul.innerHTML = "";
            }
        });
    });
</script>
