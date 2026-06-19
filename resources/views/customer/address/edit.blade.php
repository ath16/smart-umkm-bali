<x-customer-layout>
    <x-slot name="header">
        <h1 class="font-display text-headline-md text-primary-dark">Edit Alamat</h1>
        <p class="text-body-sm text-on-surface-variant mt-1">Perbarui informasi alamat pengiriman Anda.</p>
    </x-slot>

    <div class="max-w-3xl bg-surface-white rounded-heritage border border-outline shadow-sm p-6 lg:p-8">
        <form method="POST" action="{{ route('customer.address.update', $address) }}">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <!-- Label -->
                <div class="col-span-full md:col-span-1">
                    <label class="block text-label-md font-semibold text-text-primary mb-1">Label Alamat <span class="text-error">*</span></label>
                    <input type="text" name="label" value="{{ old('label', $address->label) }}" placeholder="Contoh: Rumah, Kantor, Kost" class="w-full border-outline rounded-heritage bg-surface-white focus:border-primary focus:ring focus:ring-primary/20 transition-colors" required>
                    @error('label') <p class="mt-1 text-error text-xs">{{ $message }}</p> @enderror
                </div>

                <!-- Set Default -->
                <div class="col-span-full md:col-span-1 flex items-end">
                    <label class="flex items-center gap-2 cursor-pointer mb-3">
                        <input type="checkbox" name="is_default" value="1" {{ old('is_default', $address->is_default) ? 'checked' : '' }} class="rounded border-outline text-primary focus:ring-primary">
                        <span class="text-body-sm font-medium text-text-primary">Jadikan Alamat Utama</span>
                    </label>
                </div>

                <!-- Recipient Name -->
                <div>
                    <label class="block text-label-md font-semibold text-text-primary mb-1">Nama Penerima <span class="text-error">*</span></label>
                    <input type="text" name="recipient_name" value="{{ old('recipient_name', $address->recipient_name) }}" class="w-full border-outline rounded-heritage bg-surface-white focus:border-primary focus:ring focus:ring-primary/20 transition-colors" required>
                    @error('recipient_name') <p class="mt-1 text-error text-xs">{{ $message }}</p> @enderror
                </div>

                <!-- Phone -->
                <div>
                    <label class="block text-label-md font-semibold text-text-primary mb-1">Nomor Telepon <span class="text-error">*</span></label>
                    <input type="text" name="phone" value="{{ old('phone', $address->phone) }}" class="w-full border-outline rounded-heritage bg-surface-white focus:border-primary focus:ring focus:ring-primary/20 transition-colors" required>
                    @error('phone') <p class="mt-1 text-error text-xs">{{ $message }}</p> @enderror
                </div>

                <!-- Province -->
                <div>
                    <label class="block text-label-md font-semibold text-text-primary mb-1">Provinsi <span class="text-error">*</span></label>
                    <input type="text" name="province" value="{{ old('province', $address->province) }}" class="w-full border-outline rounded-heritage bg-surface-white focus:border-primary focus:ring focus:ring-primary/20 transition-colors" required>
                    @error('province') <p class="mt-1 text-error text-xs">{{ $message }}</p> @enderror
                </div>

                <!-- City -->
                <div>
                    <label class="block text-label-md font-semibold text-text-primary mb-1">Kota/Kabupaten <span class="text-error">*</span></label>
                    <input type="text" name="city" value="{{ old('city', $address->city) }}" class="w-full border-outline rounded-heritage bg-surface-white focus:border-primary focus:ring focus:ring-primary/20 transition-colors" required>
                    @error('city') <p class="mt-1 text-error text-xs">{{ $message }}</p> @enderror
                </div>

                <!-- District -->
                <div>
                    <label class="block text-label-md font-semibold text-text-primary mb-1">Kecamatan <span class="text-error">*</span></label>
                    <input type="text" name="district" value="{{ old('district', $address->district) }}" class="w-full border-outline rounded-heritage bg-surface-white focus:border-primary focus:ring focus:ring-primary/20 transition-colors" required>
                    @error('district') <p class="mt-1 text-error text-xs">{{ $message }}</p> @enderror
                </div>

                <!-- Postal Code -->
                <div>
                    <label class="block text-label-md font-semibold text-text-primary mb-1">Kode Pos <span class="text-error">*</span></label>
                    <input type="text" name="postal_code" value="{{ old('postal_code', $address->postal_code) }}" class="w-full border-outline rounded-heritage bg-surface-white focus:border-primary focus:ring focus:ring-primary/20 transition-colors" required>
                    @error('postal_code') <p class="mt-1 text-error text-xs">{{ $message }}</p> @enderror
                </div>

                <!-- Full Address -->
                <div class="col-span-full">
                    <label class="block text-label-md font-semibold text-text-primary mb-1">Alamat Lengkap <span class="text-error">*</span></label>
                    <textarea name="address" rows="3" class="w-full border-outline rounded-heritage bg-surface-white focus:border-primary focus:ring focus:ring-primary/20 transition-colors" required>{{ old('address', $address->address) }}</textarea>
                    @error('address') <p class="mt-1 text-error text-xs">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="flex items-center gap-4 border-t border-outline pt-6">
                <a href="{{ route('customer.address.index') }}" class="px-6 py-2.5 bg-surface-white border border-outline text-text-primary font-semibold rounded-heritage hover:bg-surface-container-high transition-colors">
                    Batal
                </a>
                <button type="submit" class="px-6 py-2.5 bg-primary text-white font-semibold rounded-heritage hover:bg-primary-dark transition-colors shadow-sm ml-auto">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</x-customer-layout>
