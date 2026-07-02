@extends('layouts.public')

@section('title', 'Katalog Produk')

@section('meta')
<meta name="description" content="Jelajahi koleksi produk UMKM Bali — kerajinan tangan, kopi, fashion, dan seni autentik dari pengrajin lokal.">
@endsection

@section('content')
<div class="bg-cream-premium min-h-screen">

    {{-- ── Page Header ── --}}
    <div class="bg-surface-white border-b border-outline/30">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 md:py-16">
            <div class="max-w-2xl">
                <p class="text-terracotta tracking-[0.2em] uppercase text-label-md mb-3">Koleksi</p>
                <h1 class="font-playfair text-4xl md:text-5xl text-basalt leading-tight mb-3">
                    @if(request('search'))
                        Hasil untuk "<em class="italic">{{ request('search') }}</em>"
                    @elseif(request('category'))
                        {{ $categories->firstWhere('slug', request('category'))->name ?? 'Katalog Produk' }}
                    @else
                        Katalog Produk
                    @endif
                </h1>
                <p class="text-body-md text-basalt-muted">
                    @if(isset($products))
                        {{ $products->total() }} produk ditemukan
                    @else
                        Temukan karya tangan terbaik dari seluruh Bali.
                    @endif
                </p>
            </div>
        </div>
    </div>

    {{-- ── Control Bar: Pill Filters + Sort + Filter Drawer Toggle ── --}}
    <div class="sticky top-20 z-30 bg-cream-premium/95 backdrop-blur-md border-b border-outline/20" x-data="{ showFilters: false }">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
            <div class="flex items-center justify-between gap-4">
                
                {{-- Quick Category Pills --}}
                <div class="flex-1 flex items-center gap-2 overflow-x-auto hide-scrollbar">
                    <a href="{{ route('products.index', array_filter(['sort' => request('sort'), 'search' => request('search')])) }}" 
                       class="shrink-0 px-4 py-2 rounded-full text-body-sm font-medium transition-all duration-300 border
                       {{ !request('category') ? 'bg-basalt text-white border-basalt' : 'bg-surface-white text-basalt-muted border-outline/50 hover:border-basalt/30 hover:text-basalt' }}">
                        Semua
                    </a>
                    @foreach($categories as $category)
                        <a href="{{ route('products.index', array_filter(['category' => $category->slug, 'sort' => request('sort'), 'search' => request('search')])) }}" 
                           class="shrink-0 px-4 py-2 rounded-full text-body-sm font-medium transition-all duration-300 border
                           {{ request('category') === $category->slug ? 'bg-basalt text-white border-basalt' : 'bg-surface-white text-basalt-muted border-outline/50 hover:border-basalt/30 hover:text-basalt' }}">
                            {{ $category->name }}
                        </a>
                    @endforeach
                </div>

                {{-- Sort & Filter Buttons --}}
                <div class="flex items-center gap-2 shrink-0">
                    <form method="GET" action="{{ route('products.index') }}" class="hidden sm:block">
                        @if(request('category')) <input type="hidden" name="category" value="{{ request('category') }}"> @endif
                        @if(request('search')) <input type="hidden" name="search" value="{{ request('search') }}"> @endif
                        @if(request('min_price')) <input type="hidden" name="min_price" value="{{ request('min_price') }}"> @endif
                        @if(request('max_price')) <input type="hidden" name="max_price" value="{{ request('max_price') }}"> @endif
                        <select name="sort" onchange="this.form.submit()" class="border-outline/50 rounded-full bg-surface-white text-body-sm text-basalt focus:border-basalt focus:ring-1 focus:ring-basalt/20 pr-8 py-2">
                            <option value="latest" {{ request('sort') === 'latest' ? 'selected' : '' }}>Terbaru</option>
                            <option value="price_asc" {{ request('sort') === 'price_asc' ? 'selected' : '' }}>Harga ↑</option>
                            <option value="price_desc" {{ request('sort') === 'price_desc' ? 'selected' : '' }}>Harga ↓</option>
                        </select>
                    </form>

                    <button @click="showFilters = true" class="inline-flex items-center gap-2 px-4 py-2 border border-outline/50 rounded-full text-body-sm font-medium text-basalt bg-surface-white hover:border-basalt/30 transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 6h9.75M10.5 6a1.5 1.5 0 1 1-3 0m3 0a1.5 1.5 0 1 0-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m-9.75 0h9.75"/></svg>
                        Filter
                        @if(request('min_price') || request('max_price'))
                            <span class="w-2 h-2 bg-terracotta rounded-full"></span>
                        @endif
                    </button>
                </div>
            </div>
        </div>

        {{-- ── Filter Drawer (Slide-in from right) ── --}}
        <div x-show="showFilters" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 z-50 bg-basalt/40 backdrop-blur-sm" @click="showFilters = false" style="display:none"></div>
        
        <div x-show="showFilters" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="translate-x-full" x-transition:enter-end="translate-x-0" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="translate-x-0" x-transition:leave-end="translate-x-full" class="fixed top-0 right-0 z-50 h-full w-full max-w-sm bg-surface-white shadow-premium" @click.stop style="display:none">
            
            <form method="GET" action="{{ route('products.index') }}" class="h-full flex flex-col">
                @if(request('sort')) <input type="hidden" name="sort" value="{{ request('sort') }}"> @endif

                {{-- Drawer Header --}}
                <div class="flex items-center justify-between px-6 py-5 border-b border-outline/30">
                    <h3 class="font-playfair text-xl text-basalt">Filter</h3>
                    <button type="button" @click="showFilters = false" class="p-2 text-basalt-muted hover:text-basalt transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12"/></svg>
                    </button>
                </div>
                
                {{-- Drawer Body --}}
                <div class="flex-1 overflow-y-auto p-6 space-y-8">
                    {{-- Search --}}
                    <div>
                        <label class="block text-label-md font-semibold text-basalt mb-3 tracking-wide uppercase">Kata Kunci</label>
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama produk..." class="w-full border-outline/50 rounded-lg text-body-md focus:border-basalt focus:ring-1 focus:ring-basalt/20 bg-surface">
                    </div>

                    {{-- Category --}}
                    <div>
                        <label class="block text-label-md font-semibold text-basalt mb-3 tracking-wide uppercase">Kategori</label>
                        <div class="space-y-2">
                            <label class="flex items-center gap-3 cursor-pointer p-2 rounded-lg hover:bg-surface transition-colors">
                                <input type="radio" name="category" value="" {{ !request('category') ? 'checked' : '' }} class="text-terracotta focus:ring-terracotta/30 w-4 h-4">
                                <span class="text-body-md text-basalt">Semua Kategori</span>
                            </label>
                            @foreach($categories as $category)
                                <label class="flex items-center gap-3 cursor-pointer p-2 rounded-lg hover:bg-surface transition-colors">
                                    <input type="radio" name="category" value="{{ $category->slug }}" {{ request('category') === $category->slug ? 'checked' : '' }} class="text-terracotta focus:ring-terracotta/30 w-4 h-4">
                                    <span class="text-body-md text-basalt">{{ $category->name }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    {{-- Price Range --}}
                    <div>
                        <label class="block text-label-md font-semibold text-basalt mb-3 tracking-wide uppercase">Rentang Harga</label>
                        <div class="flex items-center gap-3">
                            <input type="number" name="min_price" value="{{ request('min_price') }}" placeholder="Min" class="w-full border-outline/50 rounded-lg text-body-md focus:border-basalt focus:ring-1 focus:ring-basalt/20 bg-surface">
                            <span class="text-basalt-muted">—</span>
                            <input type="number" name="max_price" value="{{ request('max_price') }}" placeholder="Max" class="w-full border-outline/50 rounded-lg text-body-md focus:border-basalt focus:ring-1 focus:ring-basalt/20 bg-surface">
                        </div>
                    </div>
                </div>

                {{-- Drawer Footer --}}
                <div class="p-6 border-t border-outline/30 space-y-3">
                    <button type="submit" @click="showFilters = false" class="w-full py-3.5 bg-basalt text-white font-semibold rounded-full hover:bg-basalt-light transition-colors">
                        Terapkan Filter
                    </button>
                    @if(request()->hasAny(['search', 'category', 'min_price', 'max_price']))
                        <a href="{{ route('products.index') }}" class="block w-full py-3 text-center text-basalt-muted font-medium text-body-sm hover:text-terracotta transition-colors">
                            Reset Semua Filter
                        </a>
                    @endif
                </div>
            </form>
        </div>
    </div>

    {{-- ── Products Grid ── --}}
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 md:py-14">
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-5 md:gap-8">
            @forelse($products as $product)
                <a href="{{ route('products.show', $product->slug) }}" class="group">
                    {{-- Product Image --}}
                    <div class="aspect-[4/5] bg-surface-container rounded-lg overflow-hidden relative mb-4">
                        @if($product->images && $product->images->count() > 0)
                            <img 
                                src="{{ imageUrl($product->images->where('is_primary', true)->first()->image_url ?? $product->images->first()->image_url ?? null, 'product_card') }}" 
                                alt="{{ $product->name }}" 
                                class="w-full h-full object-cover transition-transform duration-700 ease-out group-hover:scale-105"
                                loading="lazy"
                            >
                        @else
                            <div class="w-full h-full flex items-center justify-center text-on-surface-variant/30">
                                <svg class="w-12 h-12" fill="none" stroke="currentColor" stroke-width="0.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z"/></svg>
                            </div>
                        @endif
                        {{-- Subtle hover overlay --}}
                        <div class="absolute inset-0 bg-basalt/0 group-hover:bg-basalt/5 transition-colors duration-500"></div>
                        
                        @if($product->stock <= 0)
                            <div class="absolute top-3 left-3 px-3 py-1 bg-basalt/80 text-white text-label-sm font-medium rounded-full backdrop-blur-sm">Habis</div>
                        @endif
                    </div>

                    {{-- Product Info --}}
                    <div>
                        <p class="text-label-sm text-terracotta/80 tracking-wider uppercase mb-1">{{ $product->category->name ?? 'Produk Bali' }}</p>
                        <h3 class="font-playfair text-base md:text-lg text-basalt leading-snug mb-1 group-hover:text-terracotta transition-colors duration-300 line-clamp-2">{{ $product->name }}</h3>
                        <p class="text-body-sm text-basalt-muted mb-2 hidden sm:block">{{ $product->store->name ?? '' }}</p>
                        <p class="font-semibold text-basalt">{{ $product->formatted_sell_price }}</p>
                    </div>
                </a>
            @empty
                <div class="col-span-full py-20 text-center">
                    <div class="max-w-md mx-auto">
                        <svg class="w-16 h-16 mx-auto text-basalt/10 mb-6" fill="none" stroke="currentColor" stroke-width="0.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z"/></svg>
                        <h3 class="font-playfair text-2xl text-basalt mb-2">Produk tidak ditemukan</h3>
                        <p class="text-body-md text-basalt-muted mb-6">Coba ubah kata kunci pencarian atau sesuaikan filter Anda.</p>
                        <a href="{{ route('products.index') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-basalt text-white rounded-full font-medium text-body-sm hover:bg-basalt-light transition-colors">
                            Reset Filter
                        </a>
                    </div>
                </div>
            @endforelse
        </div>

        {{-- Pagination --}}
        @if(isset($products) && $products->hasPages())
            <div class="mt-16 flex justify-center">
                {{ $products->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
