<x-guest-layout>
    <div class="mb-7">
        <p class="text-sm font-semibold text-indigo-600">Start something great</p>
        <h1 class="mt-2 text-3xl font-bold tracking-tight text-slate-950">{{ __('Create your account') }}</h1>
        <p class="mt-2 text-sm leading-6 text-slate-500">A few details, and your next learning chapter begins.</p>
    </div>

    <x-input-error :messages="$errors->get('google')" class="mb-5 rounded-xl bg-rose-50 px-4 py-3 text-sm text-rose-700" />

    <form method="POST" action="{{ route('register') }}" class="space-y-4">
        @csrf

        <div>
            <x-input-label for="name" :value="__('Your name')" class="text-sm font-semibold text-slate-700" />
            <x-text-input id="name"
                class="mt-2 block w-full rounded-xl border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 shadow-sm transition placeholder:text-slate-400 focus:border-indigo-500 focus:bg-white focus:ring-4 focus:ring-indigo-100"
                type="text" name="name" :value="old('name')" placeholder="Alex Morgan" required autofocus
                autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email address')" class="text-sm font-semibold text-slate-700" />
            <x-text-input id="email"
                class="mt-2 block w-full rounded-xl border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 shadow-sm transition placeholder:text-slate-400 focus:border-indigo-500 focus:bg-white focus:ring-4 focus:ring-indigo-100"
                type="email" name="email" :value="old('email')" placeholder="you@example.com" required
                autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="password" :value="__('Password')" class="text-sm font-semibold text-slate-700" />
            <x-text-input id="password"
                class="mt-2 block w-full rounded-xl border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 shadow-sm transition placeholder:text-slate-400 focus:border-indigo-500 focus:bg-white focus:ring-4 focus:ring-indigo-100"
                type="password" name="password" placeholder="Create a password" required
                autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="password_confirmation" :value="__('Confirm password')"
                class="text-sm font-semibold text-slate-700" />
            <x-text-input id="password_confirmation"
                class="mt-2 block w-full rounded-xl border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 shadow-sm transition placeholder:text-slate-400 focus:border-indigo-500 focus:bg-white focus:ring-4 focus:ring-indigo-100"
                type="password" name="password_confirmation" placeholder="Enter your password again" required
                autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <button type="submit"
            class="inline-flex w-full items-center justify-center rounded-xl bg-indigo-600 px-5 py-3.5 text-sm font-semibold text-white shadow-lg shadow-indigo-200 transition hover:-translate-y-0.5 hover:bg-indigo-700 hover:shadow-indigo-300 focus:outline-none focus-visible:ring-4 focus-visible:ring-indigo-200 active:translate-y-0">
            {{ __('Create account') }}
        </button>
    </form>

    <p class="mt-6 text-center text-sm text-slate-500">
        {{ __('Already have an account?') }}
        <a class="font-semibold text-indigo-600 transition hover:text-indigo-800"
            href="{{ route('login') }}">{{ __('Sign in') }}</a>
    </p>
</x-guest-layout>
