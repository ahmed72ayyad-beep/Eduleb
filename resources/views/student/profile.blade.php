<x-app-layout>
    <x-slot name="header">
        <p class="text-sm font-semibold uppercase tracking-wide text-indigo-600">Student dashboard</p>
        <h1 class="mt-1 text-2xl font-bold text-slate-900">Profile & account settings</h1>
    </x-slot>

    <main class="min-h-screen bg-slate-50 px-4 py-8 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-5xl">
            @include('student.partials.navigation')
            <div class="mb-6">
                <p class="text-sm text-slate-500">Keep your account details up to date.</p>
            </div>

            <div class="space-y-5">
                <section class="rounded-xl border border-slate-200 bg-white p-5 sm:p-8">
                    <div class="mb-6 flex items-center gap-4 border-b border-slate-100 pb-5">
                        <img src="{{ asset(auth()->user()->image) }}" alt="{{ auth()->user()->name }}"
                            class="h-14 w-14 rounded-full bg-slate-100 object-cover">
                        <div>
                            <h2 class="text-lg font-bold text-slate-900">Personal information</h2>
                            <p class="text-sm text-slate-500">Name, email address and profile photo.</p>
                        </div>
                    </div>
                    @include('profile.partials.update-profile-information-form')
                </section>

                <section class="rounded-xl border border-slate-200 bg-white p-5 sm:p-8">
                    <div class="mb-6 border-b border-slate-100 pb-5">
                        <h2 class="text-lg font-bold text-slate-900">Password</h2>
                        <p class="mt-1 text-sm text-slate-500">Choose a strong password you do not use elsewhere.</p>
                    </div>
                    @include('profile.partials.update-password-form')
                </section>

                <section class="rounded-xl border border-rose-200 bg-white p-5 sm:p-8">
                    <div class="mb-6 border-b border-rose-100 pb-5">
                        <h2 class="text-lg font-bold text-slate-900">Close account</h2>
                        <p class="mt-1 text-sm text-slate-500">Account deletion is permanent and removes your account
                            access.</p>
                    </div>
                    @include('profile.partials.delete-user-form')
                </section>
            </div>
        </div>
    </main>
</x-app-layout>
