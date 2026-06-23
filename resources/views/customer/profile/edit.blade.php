<x-customer-layout>
    <x-slot name="header">
        <h1 class="font-playfair text-2xl md:text-3xl text-basalt">Profil Saya</h1>
    </x-slot>

    <div class="space-y-8">
        {{-- Profile Form --}}
        <div class="bg-surface-white rounded-lg border border-outline/30 overflow-hidden">
            <div class="px-6 py-5 border-b border-outline/20">
                <h2 class="font-semibold text-basalt text-lg">Informasi Pribadi</h2>
                <p class="text-body-sm text-basalt-muted mt-1">Perbarui nama, email, dan informasi profil Anda.</p>
            </div>
            <form method="POST" action="{{ route('customer.profile.update') }}" enctype="multipart/form-data" class="p-6 space-y-6">
                @csrf
                @method('PUT')

                {{-- Avatar --}}
                <div class="flex items-center gap-6">
                    @if($profile->avatar)
                        <img src="{{ imageUrl($profile->avatar_url, 'thumbnail') }}" alt="Avatar" class="w-20 h-20 rounded-full object-cover border-2 border-outline/30">
                    @else
                        <div class="w-20 h-20 rounded-full bg-terracotta/10 flex items-center justify-center">
                            <span class="font-playfair font-bold text-3xl text-terracotta">{{ strtoupper(substr($user->name, 0, 1)) }}</span>
                        </div>
                    @endif
                    <div>
                        <label class="inline-flex items-center gap-2 px-4 py-2 bg-surface border border-outline/50 rounded-lg text-body-sm font-medium text-basalt cursor-pointer hover:bg-surface-container transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6.827 6.175A2.31 2.31 0 0 1 5.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 0 0-1.134-.175 2.31 2.31 0 0 1-1.64-1.055l-.822-1.316a2.192 2.192 0 0 0-1.736-1.039 48.774 48.774 0 0 0-5.232 0 2.192 2.192 0 0 0-1.736 1.039l-.821 1.316Z"/><path stroke-linecap="round" stroke-linejoin="round" d="M16.5 12.75a4.5 4.5 0 1 1-9 0 4.5 4.5 0 0 1 9 0Z"/></svg>
                            Ubah Foto
                            <input type="file" name="avatar" class="hidden" accept="image/*">
                        </label>
                        @error('avatar') <p class="text-error text-body-sm mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>

                {{-- Name --}}
                <div>
                    <label for="name" class="block text-body-sm font-medium text-basalt mb-2">Nama Lengkap</label>
                    <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" class="w-full border-outline/50 rounded-lg text-body-md focus:border-terracotta focus:ring-1 focus:ring-terracotta/20 bg-surface">
                    @error('name') <p class="text-error text-body-sm mt-1">{{ $message }}</p> @enderror
                </div>

                {{-- Email --}}
                <div>
                    <label for="email" class="block text-body-sm font-medium text-basalt mb-2">Email</label>
                    <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" class="w-full border-outline/50 rounded-lg text-body-md focus:border-terracotta focus:ring-1 focus:ring-terracotta/20 bg-surface">
                    @error('email') <p class="text-error text-body-sm mt-1">{{ $message }}</p> @enderror
                </div>

                {{-- Phone & Birth Date --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div>
                        <label for="phone" class="block text-body-sm font-medium text-basalt mb-2">Nomor Telepon</label>
                        <input type="text" name="phone" id="phone" value="{{ old('phone', $profile->phone) }}" placeholder="08xxxxxxxxxx" class="w-full border-outline/50 rounded-lg text-body-md focus:border-terracotta focus:ring-1 focus:ring-terracotta/20 bg-surface">
                        @error('phone') <p class="text-error text-body-sm mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label for="birth_date" class="block text-body-sm font-medium text-basalt mb-2">Tanggal Lahir</label>
                        <input type="date" name="birth_date" id="birth_date" value="{{ old('birth_date', $profile->birth_date) }}" class="w-full border-outline/50 rounded-lg text-body-md focus:border-terracotta focus:ring-1 focus:ring-terracotta/20 bg-surface">
                        @error('birth_date') <p class="text-error text-body-sm mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>

                {{-- Gender --}}
                <div>
                    <label for="gender" class="block text-body-sm font-medium text-basalt mb-2">Jenis Kelamin</label>
                    <select name="gender" id="gender" class="w-full border-outline/50 rounded-lg text-body-md focus:border-terracotta focus:ring-1 focus:ring-terracotta/20 bg-surface">
                        <option value="">— Pilih —</option>
                        <option value="L" {{ old('gender', $profile->gender) === 'L' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="P" {{ old('gender', $profile->gender) === 'P' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                    @error('gender') <p class="text-error text-body-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="flex justify-end pt-2">
                    <button type="submit" class="px-8 py-3 bg-terracotta text-white rounded-full font-semibold text-body-sm hover:bg-terracotta-dark transition-all duration-300 shadow-sm hover:shadow-lg hover:shadow-terracotta/20">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>

        {{-- Password Form --}}
        <div class="bg-surface-white rounded-lg border border-outline/30 overflow-hidden">
            <div class="px-6 py-5 border-b border-outline/20">
                <h2 class="font-semibold text-basalt text-lg">Ubah Kata Sandi</h2>
                <p class="text-body-sm text-basalt-muted mt-1">Pastikan Anda menggunakan kata sandi yang kuat.</p>
            </div>
            <form method="POST" action="{{ route('password.update') }}" class="p-6 space-y-6">
                @csrf
                @method('put')

                <div>
                    <label for="current_password" class="block text-body-sm font-medium text-basalt mb-2">Kata Sandi Saat Ini</label>
                    <input type="password" name="current_password" id="current_password" class="w-full border-outline/50 rounded-lg text-body-md focus:border-terracotta focus:ring-1 focus:ring-terracotta/20 bg-surface">
                    @error('current_password', 'updatePassword') <p class="text-error text-body-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div>
                        <label for="password" class="block text-body-sm font-medium text-basalt mb-2">Kata Sandi Baru</label>
                        <input type="password" name="password" id="password" class="w-full border-outline/50 rounded-lg text-body-md focus:border-terracotta focus:ring-1 focus:ring-terracotta/20 bg-surface">
                        @error('password', 'updatePassword') <p class="text-error text-body-sm mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label for="password_confirmation" class="block text-body-sm font-medium text-basalt mb-2">Konfirmasi Kata Sandi</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" class="w-full border-outline/50 rounded-lg text-body-md focus:border-terracotta focus:ring-1 focus:ring-terracotta/20 bg-surface">
                    </div>
                </div>

                @if(session('status') === 'password-updated')
                    <p class="text-forest text-body-sm font-medium">Kata sandi berhasil diperbarui.</p>
                @endif

                <div class="flex justify-end pt-2">
                    <button type="submit" class="px-8 py-3 bg-basalt text-white rounded-full font-semibold text-body-sm hover:bg-basalt-light transition-all duration-300">
                        Perbarui Kata Sandi
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-customer-layout>
