<x-guest-layout>
    <x-slot:title>Daftar</x-slot:title>
    <div class="mb-6">
        <h2 class="font-display text-headline-md text-primary-dark">Daftar Akun</h2>
        <p class="text-body-sm text-on-surface-variant mt-1">Buat akun untuk mulai menjelajahi produk UMKM lokal</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-4">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Nama Lengkap')" />
            <x-text-input id="name" class="block mt-1.5 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="Nama lengkap Anda" />
            <x-input-error :messages="$errors->get('name')" class="mt-1.5" />
        </div>

        <!-- Role Selection -->
        <div>
            <x-input-label :value="__('Mendaftar sebagai')" />
            <div class="flex gap-4 mt-2">
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="radio" name="role" value="customer" class="text-primary focus:ring-primary h-4 w-4" {{ old('role', 'customer') === 'customer' ? 'checked' : '' }}>
                    <span class="text-body-sm text-on-surface">Pelanggan</span>
                </label>
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="radio" name="role" value="owner" class="text-primary focus:ring-primary h-4 w-4" {{ old('role') === 'owner' ? 'checked' : '' }}>
                    <span class="text-body-sm text-on-surface">Pemilik Usaha (UMKM)</span>
                </label>
            </div>
            <x-input-error :messages="$errors->get('role')" class="mt-1.5" />
        </div>

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1.5 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="contoh@email.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-1.5" />
        </div>

        <!-- Separator -->
        <div class="relative py-2">
            <div class="absolute inset-0 flex items-center"><div class="w-full border-t border-outline"></div></div>
            <div class="relative flex justify-center text-label-md uppercase tracking-wider">
                <span class="bg-surface-white px-3 text-on-surface-variant">Keamanan</span>
            </div>
        </div>

        <!-- Password -->
        <div>
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1.5 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" 
                            placeholder="Minimal 8 karakter" />
            <x-input-error :messages="$errors->get('password')" class="mt-1.5" />
        </div>

        <!-- Confirm Password -->
        <div>
            <x-input-label for="password_confirmation" :value="__('Konfirmasi Password')" />
            <x-text-input id="password_confirmation" class="block mt-1.5 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" 
                            placeholder="Ulangi password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1.5" />
        </div>

        <x-primary-button class="w-full justify-center mt-6">
            {{ __('Daftar Sekarang') }}
        </x-primary-button>

        <p class="text-center text-body-sm text-on-surface-variant mt-4">
            Sudah punya akun?
            <a href="{{ route('login') }}" class="text-primary hover:text-primary-dark font-semibold transition-colors">Masuk</a>
        </p>
    </form>
</x-guest-layout>
