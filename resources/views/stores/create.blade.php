<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Daftarkan Toko Anda') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <p class="mb-6 text-gray-600">
                        Isi informasi di bawah ini untuk mendaftarkan toko Anda dan mulai menggunakan fitur kasir, inventaris, dan laporan.
                    </p>

                    <form method="POST" action="{{ route('stores.store') }}" class="max-w-2xl">
                        @csrf

                        <!-- Nama Toko -->
                        <div class="mb-4">
                            <x-input-label for="name" :value="__('Nama Toko*')" />
                            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <!-- Kategori -->
                        <div class="mb-4">
                            <x-input-label for="category" :value="__('Kategori Usaha')" />
                            <x-text-input id="category" class="block mt-1 w-full" type="text" name="category" :value="old('category')" placeholder="Contoh: Makanan, Pakaian, Jasa" />
                            <x-input-error :messages="$errors->get('category')" class="mt-2" />
                        </div>

                        <!-- Kontak -->
                        <div class="mb-4">
                            <x-input-label for="contact" :value="__('Kontak (No. HP/WA)')" />
                            <x-text-input id="contact" class="block mt-1 w-full" type="text" name="contact" :value="old('contact')" />
                            <x-input-error :messages="$errors->get('contact')" class="mt-2" />
                        </div>

                        <!-- Alamat -->
                        <div class="mb-4">
                            <x-input-label for="address" :value="__('Alamat Toko')" />
                            <textarea id="address" name="address" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full" rows="3">{{ old('address') }}</textarea>
                            <x-input-error :messages="$errors->get('address')" class="mt-2" />
                        </div>

                        <!-- Deskripsi -->
                        <div class="mb-4">
                            <x-input-label for="description" :value="__('Deskripsi Singkat')" />
                            <textarea id="description" name="description" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full" rows="3">{{ old('description') }}</textarea>
                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        </div>

                        <div class="flex items-center gap-4 mt-6">
                            <x-primary-button>{{ __('Daftarkan Toko') }}</x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
