<x-guest-layout>
    <div class="mb-7">
        <p class="text-sm font-semibold text-indigo-600">Welcome back</p>
        <h1 class="mt-2 text-3xl font-bold tracking-tight text-slate-950">{{ __('Sign in to Eduleb') }}</h1>
        <p class="mt-2 text-sm leading-6 text-slate-500">Pick up where you left off and keep learning.</p>
    </div>

    <x-auth-session-status class="mb-5 rounded-xl bg-emerald-50 px-4 py-3 text-sm text-emerald-700"
        :status="session('status')" />
    <x-input-error :messages="$errors->get('google')" class="mb-5 rounded-xl bg-rose-50 px-4 py-3 text-sm text-rose-700" />

    <form method="POST" action="{{ route('login') }}" class="space-y-5">
        @csrf

        <div>
            <x-input-label for="email" :value="__('Email address')" class="text-sm font-semibold text-slate-700" />
            <x-text-input id="email"
                class="mt-2 block w-full rounded-xl border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 shadow-sm transition placeholder:text-slate-400 focus:border-indigo-500 focus:bg-white focus:ring-4 focus:ring-indigo-100"
                type="email" name="email" :value="old('email')" placeholder="you@example.com" required autofocus
                autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div>
            <div class="flex items-center justify-between gap-3">
                <x-input-label for="password" :value="__('Password')" class="text-sm font-semibold text-slate-700" />
                @if (Route::has('password.request'))
                    <a class="rounded text-xs font-semibold text-indigo-600 transition hover:text-indigo-800 focus:outline-none focus-visible:ring-2 focus-visible:ring-indigo-500 focus-visible:ring-offset-2"
                        href="{{ route('password.request') }}">
                        {{ __('Forgot password?') }}
                    </a>
                @endif
            </div>

            <x-text-input id="password"
                class="mt-2 block w-full rounded-xl border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 shadow-sm transition placeholder:text-slate-400 focus:border-indigo-500 focus:bg-white focus:ring-4 focus:ring-indigo-100"
                type="password" name="password" placeholder="Enter your password" required
                autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="flex items-center justify-between gap-4">
            <label for="remember_me" class="inline-flex cursor-pointer items-center gap-2.5">
                <input id="remember_me" type="checkbox" name="remember"
                    class="h-4 w-4 rounded border-slate-300 text-indigo-600 shadow-sm focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                <span class="text-sm text-slate-600">{{ __('Remember me') }}</span>
            </label>

            <p class="text-right text-sm text-slate-500">
                New to Eduleb?
                <a class="font-semibold text-indigo-600 transition hover:text-indigo-800"
                    href="{{ route('register') }}">Create an account</a>
            </p>
        </div>

        <button type="submit"
            class="inline-flex w-full items-center justify-center rounded-xl bg-indigo-600 px-5 py-3.5 text-sm font-semibold text-white shadow-lg shadow-indigo-200 transition hover:-translate-y-0.5 hover:bg-indigo-700 hover:shadow-indigo-300 focus:outline-none focus-visible:ring-4 focus-visible:ring-indigo-200 active:translate-y-0">
            {{ __('Sign in') }}
        </button>
    </form>

    <div class="my-6 flex items-center gap-4" aria-hidden="true">
        <span class="h-px flex-1 bg-slate-200"></span>
        <span class="text-xs font-medium uppercase tracking-wider text-slate-400">or</span>
        <span class="h-px flex-1 bg-slate-200"></span>
    </div>

    <a class="inline-flex w-full items-center justify-center gap-3 rounded-xl border border-slate-200 bg-white px-5 py-3 text-sm font-semibold text-slate-700 shadow-sm transition hover:border-slate-300 hover:bg-slate-50 focus:outline-none focus-visible:ring-4 focus-visible:ring-indigo-100"
        href="{{ route('auth.google') }}">
        <svg class="h-5 w-5" viewBox="0 0 48 48" aria-hidden="true">
            <path fill="#EA4335"
                d="M24 9.5c3.54 0 6.71 1.22 9.21 3.6l6.85-6.85C35.9 2.38 30.47 0 24 0 14.62 0 6.51 5.38 2.56 13.22l7.98 6.19C12.43 13.72 17.73 9.5 24 9.5Z"
                transform="translate(0 4)" />
            <path fill="#4285F4"
                d="M46.98 24.55c0-1.57-.15-3.09-.38-4.55H24v9.02h12.94c-.58 2.96-2.26 5.48-4.74 7.18l7.72 5.99c4.51-4.16 7.06-10.29 7.06-17.64Z" />
            <path fill="#FBBC05"
                d="M10.53 28.59a14.4 14.4 0 0 1 0-9.18l-7.98-6.19a23.9 23.9 0 0 0 0 21.56l7.98-6.19Z"
                transform="translate(0 3)" />
            <path fill="#34A853"
                d="M24 48c6.48 0 11.93-2.13 15.9-5.81l-7.72-5.99c-2.15 1.45-4.9 2.3-8.18 2.3-6.27 0-11.57-4.22-13.47-9.91l-7.98 6.19C6.51 42.62 14.62 48 24 48Z" />
        </svg>
        Continue with Google
    </a>
</x-guest-layout>
