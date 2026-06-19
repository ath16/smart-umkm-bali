<x-app-layout>
    @section('title', 'Tambah Produk')

    <x-slot name="header">
        <div class="flex items-center gap-3">
            <a href="{{ route('dashboard.products.index') }}" class="p-2 -ml-2 rounded-heritage text-on-surface-variant hover:bg-surface-container-high hover:text-text-primary transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18"/></svg>
            </a>
            <div>
                <h1 class="font-display text-headline-md text-primary-dark">Tambah Produk</h1>
                <p class="text-body-sm text-on-surface-variant mt-1">Tambahkan produk baru ke usaha Anda</p>
            </div>
        </div>
    </x-slot>

    <div class="max-w-2xl">
        <form method="POST" action="{{ route('dashboard.products.store') }}" class="bg-surface-white rounded-heritage border border-outline shadow-card p-6 sm:p-8">
            @csrf

            @include('products.partials.form')

            {{-- Actions --}}
            <div class="flex items-center justify-end gap-3 mt-8 pt-6 border-t border-outline">
                <a href="{{ route('dashboard.products.index') }}" class="inline-flex items-center px-5 py-2.5 bg-transparent border border-outline-dark rounded-heritage font-body text-body-sm font-semibold text-primary hover:bg-cream transition-colors">
                    Batal
                </a>
                <x-primary-button>
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/></svg>
                    Simpan Produk
                </x-primary-button>
            </div>
        </form>
    </div>
</x-app-layout>
