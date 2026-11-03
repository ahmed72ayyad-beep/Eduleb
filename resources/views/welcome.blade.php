<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#f7f8ff">

    <title>{{ config('app.name', 'Eduleb') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-[#f7f8ff] font-sans text-slate-950 antialiased">
    <div class="relative isolate min-h-screen overflow-hidden">
        <img class="pointer-events-none absolute inset-0 -z-10 h-full w-full object-cover opacity-80"
            src="{{ asset('assets/img/bg/home-bg.jpg') }}" alt="" aria-hidden="true">
        <div class="pointer-events-none absolute -right-36 top-36 -z-10 h-96 w-96 rounded-full bg-indigo-200/60 blur-3xl"
            aria-hidden="true"></div>

        <header class="mx-auto flex w-full max-w-7xl items-center justify-between px-6 py-6 sm:px-8 lg:px-12">
            <a href="{{ route('home') }}" class="rounded-lg focus:outline-none focus:ring-4 focus:ring-indigo-200"
                aria-label="Eduleb home">
                <img class="w-28 sm:w-40" src="{{ asset('assets/img/logo.png') }}" alt="Eduleb">
            </a>

            @if (Route::has('login'))
                <nav class="flex items-center gap-2 sm:gap-5" aria-label="Account navigation">
                    @auth
                        <a href="{{ url('/dashboard') }}"
                            class="rounded-full bg-indigo-600 px-5 py-2.5 text-sm font-semibold text-white shadow-lg shadow-indigo-200 transition hover:-translate-y-0.5 hover:bg-indigo-700 focus:outline-none focus:ring-4 focus:ring-indigo-200 sm:px-6">
                            Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}"
                            class="whitespace-nowrap rounded-full px-1 py-2.5 text-sm font-semibold text-slate-700 transition hover:text-indigo-700 focus:outline-none focus:ring-4 focus:ring-indigo-200 sm:px-4">
                            Log in
                        </a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}"
                                class="whitespace-nowrap rounded-full bg-indigo-600 px-3 py-2.5 text-sm font-semibold text-white shadow-lg shadow-indigo-200 transition hover:-translate-y-0.5 hover:bg-indigo-700 focus:outline-none focus:ring-4 focus:ring-indigo-200 sm:px-6">
                                Get started
                            </a>
                        @endif
                    @endauth
                </nav>
            @endif
        </header>

        <main
            class="mx-auto grid min-h-[calc(100vh-7rem)] w-full max-w-7xl items-center gap-12 px-6 py-12 sm:px-8 lg:grid-cols-2 lg:gap-16 lg:px-12 lg:py-16">
            <section class="relative z-10 max-w-2xl">
                <div
                    class="mb-7 inline-flex items-center gap-2 rounded-full border border-indigo-100 bg-white/80 px-4 py-2 text-sm font-semibold text-indigo-700 shadow-sm shadow-indigo-100/70 backdrop-blur">
                    <svg class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path
                            d="M10 1.667 12.575 7.4l5.758.59-4.292 3.882 1.195 5.658L10 14.642l-5.236 2.888 1.195-5.658L1.667 7.99l5.758-.59L10 1.667Z" />
                    </svg>
                    A brighter way to learn
                </div>

                <h1
                    class="max-w-2xl text-5xl font-bold leading-[1.08] tracking-tight text-slate-950 sm:text-6xl lg:text-7xl">
                    Find your best way
                    <span class="relative mt-1 inline-block text-indigo-600">
                        to grow.
                        <svg class="absolute -bottom-2 left-0 w-full text-amber-300" viewBox="0 0 220 12" fill="none"
                            aria-hidden="true">
                            <path d="M3 8.5C54 3 143 1.5 217 7" stroke="currentColor" stroke-width="5"
                                stroke-linecap="round" />
                        </svg>
                    </span>
                </h1>

                <p class="mt-7 max-w-xl text-lg leading-8 text-slate-600 sm:text-xl">
                    Explore inspiring courses and teachers. Build the skills you need, one meaningful lesson at a time.
                </p>

                <div class="mt-9 flex flex-col gap-3 sm:flex-row sm:items-center">
                    <a href="{{ route('home') }}"
                        class="group inline-flex whitespace-nowrap items-center justify-center gap-3 rounded-full bg-indigo-600 px-7 py-4 text-base font-semibold text-white shadow-xl shadow-indigo-200 transition hover:-translate-y-1 hover:bg-indigo-700 hover:shadow-indigo-300 focus:outline-none focus:ring-4 focus:ring-indigo-200">
                        Explore Eduleb
                        <svg class="h-5 w-5 transition-transform group-hover:translate-x-1" viewBox="0 0 20 20"
                            fill="none" aria-hidden="true">
                            <path d="M4.167 10h11.666m0 0L10 4.167M15.833 10 10 15.833" stroke="currentColor"
                                stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </a>
                    @guest

                        <a href="{{ route('login') }}"
                            class="inline-flex items-center justify-center rounded-full px-7 py-4 text-base font-semibold text-slate-700 transition hover:bg-white/70 hover:text-indigo-700 focus:outline-none focus:ring-4 focus:ring-indigo-200">
                            Sign in
                        </a>
                    @endguest
                </div>

                <div class="mt-10 flex flex-wrap gap-x-7 gap-y-3 text-sm font-medium text-slate-600">
                    <span class="inline-flex items-center gap-2">
                        <svg class="h-5 w-5 text-emerald-500" viewBox="0 0 20 20" fill="currentColor"
                            aria-hidden="true">
                            <path fill-rule="evenodd"
                                d="M16.704 5.29a1 1 0 0 1 .006 1.414l-7.5 7.562a1 1 0 0 1-1.42.003L3.294 9.79a1 1 0 1 1 1.412-1.417l3.786 3.775 6.798-6.852a1 1 0 0 1 1.414-.006Z"
                                clip-rule="evenodd" />
                        </svg>
                        Learn at your own pace
                    </span>
                    <span class="inline-flex items-center gap-2">
                        <svg class="h-5 w-5 text-emerald-500" viewBox="0 0 20 20" fill="currentColor"
                            aria-hidden="true">
                            <path fill-rule="evenodd"
                                d="M16.704 5.29a1 1 0 0 1 .006 1.414l-7.5 7.562a1 1 0 0 1-1.42.003L3.294 9.79a1 1 0 1 1 1.412-1.417l3.786 3.775 6.798-6.852a1 1 0 0 1 1.414-.006Z"
                                clip-rule="evenodd" />
                        </svg>
                        Find your next opportunity
                    </span>
                </div>
            </section>

            <section class="relative mx-auto w-full max-w-xl" aria-label="Learning with Eduleb">
                <div class="absolute -inset-5 rounded-[2.5rem] bg-gradient-to-br from-indigo-200/70 via-white/30 to-rose-200/70 blur-2xl"
                    aria-hidden="true"></div>

                <div
                    class="relative rounded-[2rem] border border-white/80 bg-white/70 p-3 shadow-[0_32px_80px_-28px_rgba(47,54,132,0.3)] backdrop-blur-md sm:p-4">
                    <img class="aspect-[4/3] w-full rounded-[1.5rem] object-cover object-center"
                        src="{{ asset('assets/img/landing-learning.jpg') }}"
                        alt="Students collaborating around a laptop">
                </div>

                <div
                    class="absolute right-0 top-7 flex items-center gap-3 rounded-2xl border border-white/80 bg-white/95 p-3.5 shadow-xl shadow-indigo-950/10 sm:-right-5 sm:p-4">
                    <span class="flex h-11 w-11 items-center justify-center rounded-xl bg-amber-100 text-amber-600">
                        <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                            <path
                                d="M12 3v2m0 14v2M3 12h2m14 0h2M5.64 5.64l1.42 1.42m9.88 9.88 1.42 1.42m0-12.72-1.42 1.42m-9.88 9.88-1.42 1.42"
                                stroke="currentColor" stroke-width="1.7" stroke-linecap="round" />
                            <circle cx="12" cy="12" r="4" stroke="currentColor" stroke-width="1.7" />
                        </svg>
                    </span>
                    <span class="pr-1">
                        <span class="block text-sm font-bold text-slate-900">Make it yours</span>
                        <span class="mt-0.5 block text-xs text-slate-500">A journey built around you</span>
                    </span>
                </div>

                <div
                    class="absolute bottom-7 left-0 flex max-w-[calc(100%-1rem)] items-center gap-3 rounded-2xl border border-white/80 bg-white/95 p-3.5 shadow-xl shadow-indigo-950/10 sm:-left-5 sm:max-w-none sm:p-4">
                    <span
                        class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-indigo-100 text-indigo-600">
                        <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                            <path
                                d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2Z"
                                stroke="currentColor" stroke-width="1.7" stroke-linecap="round"
                                stroke-linejoin="round" />
                            <path d="M8 7h8M8 11h6" stroke="currentColor" stroke-width="1.7"
                                stroke-linecap="round" />
                        </svg>
                    </span>
                    <span class="pr-1">
                        <span class="block text-sm font-bold text-slate-900">Small steps, big things</span>
                        <span class="mt-0.5 block text-xs text-slate-500">Your next chapter starts here</span>
                    </span>
                </div>
            </section>
        </main>

        <footer class="mx-auto flex w-full max-w-7xl items-center justify-center px-6 pb-6 sm:px-8 lg:px-12">
            <p class="text-xs font-medium tracking-wide text-slate-500">Curiosity looks good on you.</p>
        </footer>
    </div>
</body>

</html>
