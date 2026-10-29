<x-app-layout>
    <x-slot name="header">
        <div>
            <p class="text-sm font-semibold uppercase tracking-wide text-emerald-700">Instructor workspace</p>
            <h1 class="mt-1 text-2xl font-bold text-slate-900">Reviews</h1>
        </div>
    </x-slot>

    <main class="min-h-screen bg-slate-50 px-4 py-6 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-7xl">
            <section aria-labelledby="reviews-heading">
                <div class="mb-5">
                    <p class="text-sm font-semibold uppercase tracking-wide text-emerald-700">Learner feedback</p>
                    <h2 id="reviews-heading" class="mt-1 text-xl font-bold text-slate-900">Reviews</h2>
                </div>

                @if (isset($reviews) && is_iterable($reviews))
                    @if (count($reviews))
                        <div class="divide-y divide-slate-100 rounded-xl border border-slate-200 bg-white">
                            @foreach ($reviews as $review)
                                <article class="flex gap-4 p-4 sm:p-5">
                                    @if ($review->relationLoaded('user') && $review->user?->image)
                                        <img src="{{ asset($review->user->image) }}" alt=""
                                            class="h-10 w-10 shrink-0 rounded-full object-cover">
                                    @else
                                        <span
                                            class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-amber-100 text-sm font-bold text-amber-900"
                                            aria-hidden="true">{{ $review->relationLoaded('user') ? strtoupper(substr($review->user?->name ?? '?', 0, 1)) : '?' }}</span>
                                    @endif
                                    <div class="min-w-0 flex-1">
                                        <div class="flex flex-wrap items-center justify-between gap-2">
                                            <p class="font-semibold text-slate-900">
                                                {{ $review->relationLoaded('user') ? $review->user?->name ?? 'Student' : 'Student details not supplied' }}
                                            </p>
                                            <span
                                                class="text-xs text-slate-500">{{ $review->created_at?->format('M j, Y') ?? 'Date unavailable' }}</span>
                                        </div>
                                        <p class="mt-1 text-sm font-medium text-amber-700"
                                            aria-label="Rated {{ $review->star_num }} out of 5">{{ $review->star_num }}
                                            / 5 stars
                                        </p>
                                        <p class="mt-3 whitespace-pre-line text-sm leading-6 text-slate-700">
                                            {{ $review->content }}
                                        </p>
                                    </div>
                                </article>
                            @endforeach
                        </div>
                    @else
                        <div
                            class="rounded-xl border border-dashed border-slate-300 bg-white px-6 py-10 text-center text-sm text-slate-600">
                            No review records were supplied.</div>
                    @endif
                @else
                    <div class="rounded-xl border border-dashed border-slate-300 bg-white px-6 py-10 text-center">
                        <p class="font-semibold text-slate-900">Reviews are not connected to this view</p>
                        <p class="mt-1 text-sm text-slate-600">The current instructor route does not pass review
                            records.</p>
                    </div>
                @endif
            </section>
        </div>
    </main>
</x-app-layout>
