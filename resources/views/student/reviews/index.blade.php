<x-app-layout>
    <style>
        .ratings a {
            display: inline-flex;
            color: #d1d5db;
            transition: color 0.2s ease;
        }

        .ratings a:hover,
        .ratings a.active {
            color: #facc15;
        }
    </style>
    <x-slot name="header">
        <p class="text-sm font-semibold uppercase tracking-wide text-indigo-600">Student dashboard</p>
        <h1 class="mt-1 text-2xl font-bold text-slate-900">My reviews</h1>
    </x-slot>

    @php
        $studentReviews = $reviews ?? auth()->user()->reviews;
    @endphp
    {{-- @dd($studentReviews) --}}
    <main class="min-h-screen bg-slate-50 px-4 py-8 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-5xl">
            <div class="mb-6">
                <p class="text-sm text-slate-500">Your feedback and course reflections.</p>
                <h2 class="mt-1 text-xl font-bold text-slate-900">{{ $studentReviews->count() }} reviews</h2>
            </div>

            @if ($studentReviews->isNotEmpty())
                <div class="space-y-4">
                    @foreach ($studentReviews as $review)
                        <article class="rounded-xl border border-slate-200 bg-white p-5 sm:p-6">
                            <div class="flex flex-col gap-3 sm:flex-row sm:items-start sm:justify-between">
                                <div>
                                    <p class="text-xs font-semibold uppercase tracking-wide text-emerald-700">
                                        {{ $review->course->instructor->name ?? 'Eduleb instructor' }}</p>
                                    <h2 class="mt-1 text-lg font-bold text-slate-900">{{ $review->course->title }}</h2>
                                </div>
                                <div class="flex items-center gap-2 text-sm font-bold text-amber-700"
                                    aria-label="Rated {{ $review->star_num }} out of 5 stars">
                                    <span aria-hidden="true">★</span> {{ $review->star_num }} / 5
                                </div>
                            </div>
                            <p class="mt-4 whitespace-pre-line text-sm leading-7 text-slate-600">{{ $review->content }}
                            </p>
                            <div
                                class="mt-5 flex flex-wrap items-center justify-between gap-3 border-t border-slate-100 pt-4">
                                <p class="text-xs text-slate-500">{{ $review->created_at?->format('M j, Y') }}</p>
                                <div class="flex items-center justify-between w-64 ">


                                    <button x-data=""
                                        x-on:click.prevent="$dispatch('open-modal', 'edit-review-modal{{ $review->id }}')"
                                        class="border-none text-sm font-semibold text-indigo-700 hover:text-indigo-900 flex items-center gap-1"
                                        @if ($errors->hasAny(['star_num', 'content'])) style="border-bottom:3px dashed red !important" @endif><span>
                                            Edit
                                        </span>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                            viewBox="0 0 24 24" fill="none">
                                            <path d="M1.99609 8.5H11.4961" stroke="currentColor" stroke-width="1.5"
                                                stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round">
                                            </path>
                                            <path d="M5.99609 16.5H7.99609" stroke="currentColor" stroke-width="1.5"
                                                stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round">
                                            </path>
                                            <path d="M10.4961 16.5H14.4961" stroke="currentColor" stroke-width="1.5"
                                                stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round">
                                            </path>
                                            <path
                                                d="M21.9961 12.03V16.11C21.9961 19.62 21.1061 20.5 17.5561 20.5H6.43609C2.88609 20.5 1.99609 19.62 1.99609 16.11V7.89C1.99609 4.38 2.88609 3.5 6.43609 3.5H14.4961"
                                                stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                                stroke-linejoin="round"></path>
                                            <path
                                                d="M19.0761 4.13006L15.3661 7.84006C15.2261 7.98006 15.0861 8.26006 15.0561 8.46006L14.8561 9.88006C14.7861 10.3901 15.1461 10.7501 15.6561 10.6801L17.0761 10.4801C17.2761 10.4501 17.5561 10.3101 17.6961 10.1701L21.4061 6.46006C22.0461 5.82006 22.3461 5.08006 21.4061 4.14006C20.4561 3.19006 19.7161 3.49006 19.0761 4.13006Z"
                                                stroke="currentColor" stroke-width="1.5" stroke-miterlimit="10"
                                                stroke-linecap="round" stroke-linejoin="round"></path>
                                            <path d="M18.5461 4.65991C18.8661 5.78991 19.7461 6.66991 20.8661 6.97991"
                                                stroke="currentColor" stroke-width="1.5" stroke-miterlimit="10"
                                                stroke-linecap="round" stroke-linejoin="round"></path>
                                        </svg>
                                    </button>
                                    <x-modal name="edit-review-modal{{ $review->id }}" focusable>
                                        <form method="POST" action="{{ route('review.update', $review->id) }}"
                                            class="p-8 space-y-5 rounded-3xl">
                                            @csrf
                                            @method('PUT')
                                            <h2 class="text-xl font-bold text-gray-900 mb-2">
                                                {{ __('Edit FAQ') }}
                                            </h2>
                                            <div>
                                                <div class="rating flex items-center gap-3">
                                                    <span class="rating-title text-sm font-medium text-gray-700">
                                                        Your Rating :
                                                    </span>

                                                    <ul class="ratings flex items-center gap-1">
                                                        @for ($i = 0; $i <= 5; $i++)
                                                            <li>
                                                                <a data-rating="{{ $i }}" href="#0"
                                                                    title="Give Me One Star"
                                                                    class="text-gray-300 transition-colors duration-200 hover:text-yellow-400">
                                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                                        viewBox="0 0 24 24" fill="currentColor"
                                                                        class="h-5 w-5">
                                                                        <path
                                                                            d="M12 2l3.09 6.26L22 9.27l-5 4.87L18.18 21 12 17.77 5.82 21 7 14.14 2 9.27l6.91-1.01L12 2z" />
                                                                    </svg> </a>
                                                            </li>
                                                        @endfor
                                                    </ul>
                                                </div>
                                            </div>

                                            <div>
                                                <x-textarea label="Review" value="{{ $review->content }}"
                                                    labelclass="block text-sm font-medium text-gray-700"
                                                    class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-2xl p-4 shadow-sm text-sm"
                                                    id="answer" name="content" rows="4"
                                                    placeholder="Write the new review here..." required />
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
                                    </form>



                                    <form onsubmit="return confirm('Are You Sure Of Delete Review');" method="POST"
                                        action="{{ route('review.destroy', $review->id) }}">
                                        @method('DELETE')
                                        <button
                                            class="border-none text-red-800 text-sm font-bold flex items-center gap-1"><span>
                                                Delete
                                            </span>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                viewBox="0 0 24 24" fill="none" stroke="red" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M3 6h18" />
                                                <path d="M8 6V4h8v2" />
                                                <path d="m19 6-1 14H6L5 6" />
                                                <path d="M10 11v5" />
                                                <path d="M14 11v5" />
                                            </svg>
                                        </button>
                                    </form>
                                    <a href="{{ route('courses.show', $review->course) }}"
                                        class="text-sm font-semibold text-indigo-700 hover:text-indigo-900">View course
                                        &rarr;</a>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>
            @else
                <div class="rounded-xl border border-dashed border-slate-300 bg-white px-6 py-14 text-center">
                    <h2 class="text-xl font-bold text-slate-900">No reviews yet</h2>
                    <p class="mx-auto mt-2 max-w-md text-sm leading-6 text-slate-600">After taking a course, share what
                        helped you and what future learners should know.</p>
                    <a href="{{ url('/student/courses') }}"
                        class="mt-5 inline-flex rounded-lg bg-indigo-700 px-4 py-2.5 text-sm font-bold text-white hover:bg-indigo-800">Go
                        to my courses</a>
                </div>
            @endif
        </div>
    </main>
</x-app-layout>

<script>
    document.querySelectorAll('.ratings a').forEach(star => {
        star.addEventListener('click', function(e) {
            e.preventDefault();

            let rating = Number(this.dataset.rating);
            let stars = this.closest('.ratings').querySelectorAll('a');
            let form = this.closest('form');

            stars.forEach(item => {
                item.classList.toggle(
                    'active',
                    Number(item.dataset.rating) <= rating
                );
            });

            let hiddenIn = form.querySelector('input[name="star_num"]');

            if (!hiddenIn) {
                hiddenIn = document.createElement('input');
                hiddenIn.type = 'hidden';
                hiddenIn.name = 'star_num';
                form.appendChild(hiddenIn);
            }

            hiddenIn.value = rating;

            console.log(hiddenIn);
        });
    });

    let textareaCounter = document.querySelector("#text-area-countiner");

    let error = document.createElement("p");
    error.style.color = "red";
    error.style.fontSize = "small";
    error.style.padding = "0%";
    error.style.margin = "0%";
    error.style.marginBottom = "10px";
    error.textContent = "This Field Must Filled";

    function submit_review(event) {
        let review_content = document.querySelector("textarea");

        if (review_content.value.length < 1) {
            event.preventDefault();

            if (textareaCounter) {
                textareaCounter.appendChild(error);
            }

            review_content.style.marginBottom = "0%";
            review_content.style.border = "1px solid red";
        }
    }

    // function submit_review(event, course_id) {
    //     console.log(review_content + "Sdddd");
    //     fetch(`/courses/${course_id}/review`, {
    //         method: "POST",
    //         headers: {
    //             "Content-Type": "application/json",
    //             "X-CSRF-TOKEN": "{{ csrf_token() }}",
    //             "Accept": "application/json",
    //         },
    //         body: JSON.stringify({
    //             "content": review_content,
    //             "star_num": rating
    //         })
    //     }).then((result) => {
    //
    //     }).catch((err) => {
    //         console.log(error.response?.status);
    //         console.log(error.response?.data);
    //     });
    // }
</script>
