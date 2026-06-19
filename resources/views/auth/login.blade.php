<x-guest-layout>
    <div class="mb-6">
        <h2 class="font-display text-headline-md text-primary-dark">Masuk</h2>
        <p class="text-body-sm text-on-surface-variant mt-1">Masuk ke akun Smart UMKM Bali Anda</p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-5">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1.5 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="contoh@email.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-1.5" />
        </div>

        <!-- Password -->
        <div>
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1.5 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" 
                            placeholder="Masukkan password" />
            <x-input-error :messages="$errors->get('password')" class="mt-1.5" />
        </div>

        <!-- Remember Me & Forgot -->
        <div class="flex items-center justify-between">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded-sm border-outline text-primary focus:ring-primary/20" name="remember">
                <span class="ms-2 text-body-sm text-on-surface-variant">{{ __('Ingat saya') }}</span>
            </label>

            @if (Route::has('password.request'))
                <a class="text-body-sm text-primary hover:text-primary-dark font-medium transition-colors" href="{{ route('password.request') }}">
                    {{ __('Lupa password?') }}
                </a>
            @endif
        </div>

        <x-primary-button class="w-full justify-center">
            {{ __('Masuk') }}
        </x-primary-button>

        <p class="text-center text-body-sm text-on-surface-variant">
            Belum punya akun?
            <a href="{{ route('register') }}" class="text-primary hover:text-primary-dark font-semibold transition-colors">Daftar sekarang</a>
        </p>
    </form>
</x-guest-layout>
