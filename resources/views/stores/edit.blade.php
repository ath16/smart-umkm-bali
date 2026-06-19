<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Pengaturan Toko') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <header>
                        <h2 class="text-lg font-medium text-gray-900">
                            {{ __('Informasi Profil Toko') }}
                        </h2>

                        <p class="mt-1 text-sm text-gray-600">
                            {{ __("Perbarui nama toko, kategori, dan informasi kontak usaha Anda.") }}
                        </p>
                    </header>

                    <form method="post" action="{{ route('stores.update') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
                        @csrf
                        @method('put')

                        <div>
                            <x-input-label for="name" :value="__('Nama Toko')" />
                            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $store->name)" required autofocus autocomplete="organization" />
                            <x-input-error class="mt-2" :messages="$errors->get('name')" />
                        </div>

                        <div>
                            <x-input-label for="store_category_id" :value="__('Kategori Utama')" />
                            <select id="store_category_id" name="store_category_id" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full">
                                <option value="">-- Pilih Kategori --</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('store_category_id', $store->store_category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                            <x-input-error class="mt-2" :messages="$errors->get('store_category_id')" />
                        </div>

                        <div>
                            <x-input-label for="contact" :value="__('Kontak (WA/HP)')" />
                            <x-text-input id="contact" name="contact" type="text" class="mt-1 block w-full" :value="old('contact', $store->contact)" />
                            <x-input-error class="mt-2" :messages="$errors->get('contact')" />
                        </div>

                        <div>
                            <x-input-label for="address" :value="__('Alamat')" />
                            <textarea id="address" name="address" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full" rows="3">{{ old('address', $store->address) }}</textarea>
                            <x-input-error class="mt-2" :messages="$errors->get('address')" />
                        </div>

                        <div>
                            <x-input-label for="description" :value="__('Deskripsi')" />
                            <textarea id="description" name="description" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full" rows="3">{{ old('description', $store->description) }}</textarea>
                            <x-input-error class="mt-2" :messages="$errors->get('description')" />
                        </div>

                        <hr class="my-6">

                        <div>
                            <x-input-label for="logo" :value="__('Logo Toko')" />
                            @if($store->setting && $store->setting->logo_path)
                                <div class="mt-2 mb-2 w-16 h-16 rounded overflow-hidden border border-gray-200">
                                    <img src="{{ Storage::url($store->setting->logo_path) }}" alt="Logo" class="w-full h-full object-cover">
                                </div>
                            @endif
                            <input id="logo" name="logo" type="file" accept="image/jpeg, image/png, image/webp" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100" />
                            <x-input-error class="mt-2" :messages="$errors->get('logo')" />
                        </div>

                        <div>
                            <x-input-label for="banner" :value="__('Banner Toko')" />
                            @if($store->setting && $store->setting->banner_path)
                                <div class="mt-2 mb-2 h-32 rounded overflow-hidden border border-gray-200">
                                    <img src="{{ Storage::url($store->setting->banner_path) }}" alt="Banner" class="w-full h-full object-cover">
                                </div>
                            @endif
                            <input id="banner" name="banner" type="file" accept="image/jpeg, image/png, image/webp" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100" />
                            <x-input-error class="mt-2" :messages="$errors->get('banner')" />
                        </div>

                        <div>
                            <x-input-label for="operational_hours" :value="__('Jam Operasional (JSON)')" />
                            <textarea id="operational_hours" name="operational_hours" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full font-mono text-xs" rows="3" placeholder='{"Senin": "09:00 - 17:00", "Selasa": "09:00 - 17:00"}'>{{ old('operational_hours', $store->setting ? json_encode($store->setting->operational_hours) : '') }}</textarea>
                            <x-input-error class="mt-2" :messages="$errors->get('operational_hours')" />
                        </div>

                        <div>
                            <x-input-label for="social_links" :value="__('Sosial Media (JSON)')" />
                            <textarea id="social_links" name="social_links" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full font-mono text-xs" rows="3" placeholder='{"instagram": "https://instagram.com/...", "whatsapp": "..."}'>{{ old('social_links', $store->setting ? json_encode($store->setting->social_links) : '') }}</textarea>
                            <x-input-error class="mt-2" :messages="$errors->get('social_links')" />
                        </div>

                        <div class="flex items-center gap-4">
                            <x-primary-button>{{ __('Simpan Perubahan') }}</x-primary-button>

                            @if (session('success'))
                                <p
                                    x-data="{ show: true }"
                                    x-show="show"
                                    x-transition
                                    x-init="setTimeout(() => show = false, 2000)"
                                    class="text-sm text-green-600 font-medium"
                                >{{ session('success') }}</p>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
