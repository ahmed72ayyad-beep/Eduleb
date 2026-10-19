<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" enctype="multipart/form-data"
        class="mt-6 grid grid-cols-1 md:grid-cols-3 gap-8 items-start">
        @csrf
        @method('patch')

        <!-- قسم بيانات النص (الاسم، الإيميل، أزرار الحفظ) - يأخذ عمودين -->
        <div class="md:col-span-2 space-y-6">
            <div>
                <x-input-label for="name" :value="__('Name')" />
                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)"
                    required autofocus autocomplete="name" />
                <x-input-error class="mt-2" :messages="$errors->get('name')" />
            </div>

            <div>
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)"
                    required autocomplete="username" />
                <x-input-error class="mt-2" :messages="$errors->get('email')" />

                @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
                    <div>
                        <p class="text-sm mt-2 text-gray-800">
                            {{ __('Your email address is unverified.') }}

                            <button form="send-verification"
                                class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                {{ __('Click here to re-send the verification email.') }}
                            </button>
                        </p>

                        @if (session('status') === 'verification-link-sent')
                            <p class="mt-2 font-medium text-sm text-green-600">
                                {{ __('A new verification link has been sent to your email address.') }}
                            </p>
                        @endif
                    </div>
                @endif
            </div>

            <div class="flex items-center gap-4">
                <x-primary-button>{{ __('Save') }}</x-primary-button>

                @if (session('status') === 'profile-updated')
                    <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                        class="text-sm text-gray-600">{{ __('Saved.') }}</p>
                @endif
            </div>
        </div>

        <!-- قسم صورة البروفايل بالحجم الأكبر (w-52 h-52) -->
        <div class="flex flex-col items-center justify-center">
            <div class="relative">
                <div @error('image') style="border: 2px dashed red !important" @enderror
                    class="relative w-52 h-52 rounded-full overflow-hidden cursor-pointer group shadow-md border-2 border-white hover:opacity-95 transition-all"
                    onclick="document.getElementById('avatarInput').click()">

                    <!-- الصورة الحالية -->
                    <img id="avatarImage" src="{{ asset(auth()->user()->image) }}" alt="Profile Picture"
                        class="w-full h-full object-cover">

                    <!-- الغلاف الشفاف والأيقونة (Overlay) -->
                    <div class="absolute inset-0 bg-black/40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z">
                            </path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- حقل رفع الملفات المخفي -->
            <input type="file" id="avatarInput" name="image" class="hidden" accept="image/*"
                onchange="previewImage(event)">

            @error('image')
                <p class="mt-2 text-xs text-red-600 font-medium text-center">Update Failed: {{ $message }}</p>
            @enderror
        </div>

    </form>
</section>

<script>
    // دالة معاينة الصورة فوراً قبل الرفع
    function previewImage(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('avatarImage').src = e.target.result;
            }
            reader.readAsDataURL(file);
        }
    }
</script>
