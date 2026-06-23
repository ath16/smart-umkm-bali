@extends('layouts.public')

@section('title', 'Jelajahi Toko')

@section('content')
<div class="bg-surface py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Header & Search -->
        <div class="mb-10 text-center max-w-2xl mx-auto">
            <h1 class="font-display font-bold text-headline-lg text-primary-dark mb-4">Jelajahi Toko UMKM</h1>
            <p class="text-body-lg text-on-surface-variant mb-8">Temukan dan dukung produk lokal dari berbagai toko di seluruh Bali.</p>
            
            <form method="GET" action="{{ route('store.index') }}" class="relative max-w-xl mx-auto">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama toko atau deskripsi..." class="w-full pl-12 pr-4 py-3 border-outline rounded-full shadow-sm focus:border-primary focus:ring focus:ring-primary/20 text-body-lg">
                <svg class="w-6 h-6 absolute left-4 top-1/2 -translate-y-1/2 text-on-surface-variant" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z"/></svg>
                <button type="submit" class="absolute right-2 top-1/2 -translate-y-1/2 px-4 py-1.5 bg-primary text-white text-body-sm font-semibold rounded-full hover:bg-primary-dark transition-colors">
                    Cari
                </button>
            </form>
        </div>

        <!-- Filter Categories (Horizontal Scroll) -->
        @if(isset($storeCategories) && $storeCategories->count() > 0)
        <div class="mb-10 overflow-x-auto pb-4 hide-scrollbar">
            <div class="flex flex-wrap gap-2 mb-8">
                <a href="{{ route('store.index') }}" class="px-6 py-2.5 rounded-full text-label-md font-semibold transition-colors shadow-sm border border-outline {{ !request('category') ? 'bg-primary text-white border-primary' : 'bg-surface-white text-text-primary hover:bg-surface-container' }}">Semua</a>
                @foreach($storeCategories as $category)
                    <a href="{{ route('store.index', ['category' => $category->slug]) }}" class="px-6 py-2.5 rounded-full text-label-md font-semibold transition-colors shadow-sm border border-outline {{ request('category') == $category->slug ? 'bg-primary text-white border-primary' : 'bg-surface-white text-text-primary hover:bg-surface-container' }}">{{ $category->name }}</a>
                @endforeach
            </div>
        </div>
        @endif

        <!-- Stores Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @forelse($stores as $store)
                <a href="{{ route('catalog.show', $store->slug) }}" class="group bg-surface-white rounded-heritage border border-outline overflow-hidden hover:shadow-card hover:-translate-y-1 transition-all duration-300 flex flex-col h-full">
                    <div class="h-32 bg-surface-container-high w-full relative">
                        @if($store->setting && $store->setting->banner_path)
                            <img src="{{ imageUrl($store->setting->banner_url ?? null, 'banner') }}" alt="{{ $store->name }}" class="w-full h-full object-cover">
                        @endif
                        <div class="absolute -bottom-6 left-4 w-16 h-16 bg-surface-white rounded-full border-4 border-surface-white shadow-sm overflow-hidden flex items-center justify-center text-primary font-bold text-title-md">
                            @if($store->setting && $store->setting->logo_path)
                                <img src="{{ imageUrl($store->setting->logo_url ?? null, 'thumbnail') }}" alt="{{ $store->name }}" class="w-full h-full object-cover">
                            @else
                                {{ substr($store->name, 0, 1) }}
                            @endif
                        </div>
                    </div>
                    <div class="p-5 pt-8 flex-1 flex flex-col">
                        <h3 class="font-display font-semibold text-title-md text-text-primary mb-1 line-clamp-1 group-hover:text-primary transition-colors">{{ $store->name }}</h3>
                        <p class="text-label-sm text-on-surface-variant mb-3">{{ $store->storeCategory ? $store->storeCategory->name : 'Uncategorized' }}</p>
                        <p class="text-body-sm text-on-surface-variant line-clamp-3 mb-4 flex-1">{{ $store->description ?? 'Toko UMKM lokal Bali.' }}</p>
                        <div class="mt-auto flex items-center text-label-sm font-semibold text-primary group-hover:text-primary-dark transition-colors">
                            Kunjungi Toko <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5"/></svg>
                        </div>
                    </div>
                </a>
            @empty
                <div class="col-span-full py-8">
                    <x-empty-state 
                        title="Toko tidak ditemukan" 
                        description="Tidak ada toko yang cocok dengan kriteria pencarian Anda."
                    >
                        @if(request()->has('search') || request()->has('category'))
                            <x-slot name="actionUrl">{{ route('store.index') }}</x-slot>
                            <x-slot name="actionText">Reset Pencarian</x-slot>
                        @endif
                    </x-empty-state>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if($stores->hasPages())
            <div class="mt-10">
                {{ $stores->links() }}
            </div>
        @endif

    </div>
</div>

<style>
.hide-scrollbar::-webkit-scrollbar {
    display: none;
}
.hide-scrollbar {
    -ms-overflow-style: none;
    scrollbar-width: none;
}
</style>
@endsection
