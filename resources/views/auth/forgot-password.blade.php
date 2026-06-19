<x-guest-layout>
    <div class="mb-6">
        <h2 class="font-display text-headline-md text-primary-dark">Lupa Password</h2>
        <p class="text-body-sm text-on-surface-variant mt-2">
            Masukkan email Anda dan kami akan mengirimkan link untuk mengatur ulang password.
        </p>
    </div>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}" class="space-y-5">
        @csrf

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1.5 w-full" type="email" name="email" :value="old('email')" required autofocus placeholder="contoh@email.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-1.5" />
        </div>

        <x-primary-button class="w-full justify-center">
            {{ __('Kirim Link Reset') }}
        </x-primary-button>

        <p class="text-center text-body-sm text-on-surface-variant">
            <a href="{{ route('login') }}" class="text-primary hover:text-primary-dark font-semibold transition-colors">Kembali ke halaman masuk</a>
        </p>
    </form>
</x-guest-layout>
