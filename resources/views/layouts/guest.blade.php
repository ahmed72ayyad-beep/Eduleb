<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Eduleb') }} | Your learning journey</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased text-slate-900">
    <main class="relative isolate flex min-h-screen items-center justify-center overflow-hidden bg-[#f7f8ff] p-4 sm:p-8">
        <div class="pointer-events-none absolute -left-32 top-0 -z-10 h-96 w-96 rounded-full bg-indigo-200/50 blur-3xl"
            aria-hidden="true"></div>
        <div class="pointer-events-none absolute -bottom-48 right-0 -z-10 h-96 w-96 rounded-full bg-rose-200/50 blur-3xl"
            aria-hidden="true"></div>

        <div
            class="grid w-full max-w-6xl overflow-hidden rounded-[2rem] border border-white/80 bg-white/80 shadow-[0_32px_100px_-40px_rgba(47,54,132,0.3)] backdrop-blur-xl lg:min-h-[680px] lg:grid-cols-[0.9fr_1.1fr]">
            <aside class="relative hidden min-h-full overflow-hidden bg-indigo-950 lg:flex lg:flex-col lg:justify-between lg:p-12">
                <img class="absolute inset-0 h-full w-full object-cover opacity-70"
                    src="{{ asset('assets/img/landing-learning.jpg') }}" alt="" aria-hidden="true">
                <div class="absolute inset-0 bg-gradient-to-br from-indigo-950/90 via-indigo-950/65 to-slate-900/45"
                    aria-hidden="true"></div>

                <a href="{{ route('home') }}"
                    class="relative inline-flex w-fit items-center gap-3 rounded-full border border-white/20 bg-white/10 px-4 py-2 text-sm font-semibold text-white backdrop-blur">
                    <span class="flex h-7 w-7 items-center justify-center rounded-full bg-white/15">
                        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                            <path d="m12 3 2.8 5.7 6.2.9-4.5 4.4 1.1 6.2-5.6-3-5.6 3 1.1-6.2L3 9.6l6.2-.9L12 3Z"
                                stroke="currentColor" stroke-width="1.6" stroke-linecap="round"
                                stroke-linejoin="round" />
                        </svg>
                    </span>
                    A brighter way to learn
                </a>

                <div class="relative max-w-md text-white">
                    <p class="text-sm font-semibold uppercase tracking-[0.2em] text-indigo-200">Your next chapter</p>
                    <h2 class="mt-5 text-4xl font-bold leading-tight tracking-tight xl:text-5xl">
                        Make room for what you can become.
                    </h2>
                    <p class="mt-5 max-w-sm text-base leading-7 text-indigo-100/90">
                        Find the right courses, learn from inspiring teachers, and take your next step with confidence.
                    </p>

                    <div class="mt-8 flex items-center gap-3">
                        <span class="flex -space-x-2">
                            <span class="h-8 w-8 rounded-full border-2 border-indigo-950 bg-amber-200"></span>
                            <span class="h-8 w-8 rounded-full border-2 border-indigo-950 bg-rose-200"></span>
                            <span class="h-8 w-8 rounded-full border-2 border-indigo-950 bg-sky-200"></span>
                        </span>
                        <span class="text-sm font-medium text-white/90">A community that learns together</span>
                    </div>
                </div>

                <p class="relative text-xs font-medium tracking-wide text-white/70">Curiosity looks good on you.</p>
            </aside>

            <section class="flex items-center justify-center px-6 py-9 sm:px-10 sm:py-12 lg:px-14">
                <div class="w-full max-w-md">
                    <div class="mb-9 flex flex-col items-center gap-3 text-center sm:mb-10">
                        <a href="{{ route('home') }}" aria-label="Eduleb home"
                            class="rounded-lg focus:outline-none focus-visible:ring-4 focus-visible:ring-indigo-200">
                            <img class="w-36" src="{{ asset('assets/img/logo.png') }}" alt="Eduleb">
                        </a>
                        <p class="text-sm text-slate-500">Your learning journey starts here.</p>
                    </div>

                    {{ $slot }}

                    <div class="mt-8 border-t border-slate-100 pt-5 text-center">
                        <a href="{{ route('home') }}"
                            class="inline-flex items-center gap-2 text-sm font-medium text-slate-500 transition hover:text-indigo-700 focus:outline-none focus-visible:ring-2 focus-visible:ring-indigo-500 focus-visible:ring-offset-2">
                            <svg class="h-4 w-4" viewBox="0 0 20 20" fill="none" aria-hidden="true">
                                <path d="M15.833 10H4.167m0 0L10 15.833M4.167 10 10 4.167" stroke="currentColor"
                                    stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            Back to Eduleb
                        </a>
                    </div>
                </div>
            </section>
        </div>
    </main>
</body>

</html>
