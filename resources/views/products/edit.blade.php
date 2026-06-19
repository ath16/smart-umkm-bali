<x-app-layout>
    @section('title', 'Edit Produk')

    <x-slot name="header">
        <div class="flex items-center gap-3">
            <a href="{{ route('dashboard.products.index') }}" class="p-2 -ml-2 rounded-heritage text-on-surface-variant hover:bg-surface-container-high hover:text-text-primary transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18"/></svg>
            </a>
            <div>
                <h1 class="font-display text-headline-md text-primary-dark">Edit Produk</h1>
                <p class="text-body-sm text-on-surface-variant mt-1">{{ $product->name }}</p>
            </div>
        </div>
    </x-slot>

    <div class="max-w-2xl">
        <form method="POST" action="{{ route('dashboard.products.update', $product) }}" class="bg-surface-white rounded-heritage border border-outline shadow-card p-6 sm:p-8">
            @csrf
            @method('PUT')

            @include('products.partials.form', ['product' => $product])

            {{-- Actions --}}
            <div class="flex items-center justify-between mt-8 pt-6 border-t border-outline">
                <form method="POST" action="{{ route('dashboard.products.destroy', $product) }}" x-data x-ref="deleteForm" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="button" @click="if(confirm('Apakah Anda yakin ingin menghapus produk \'{{ $product->name }}\'?')) $refs.deleteForm.submit()" class="inline-flex items-center gap-2 px-4 py-2.5 text-body-sm font-medium text-error hover:bg-error/10 rounded-heritage transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0"/></svg>
                        Hapus Produk
                    </button>
                </form>
                <div class="flex items-center gap-3">
                    <a href="{{ route('dashboard.products.index') }}" class="inline-flex items-center px-5 py-2.5 bg-transparent border border-outline-dark rounded-heritage font-body text-body-sm font-semibold text-primary hover:bg-cream transition-colors">
                        Batal
                    </a>
                    <x-primary-button>
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5"/></svg>
                        Simpan Perubahan
                    </x-primary-button>
                </div>
            </div>
        </form>
    </div>
</x-app-layout>
