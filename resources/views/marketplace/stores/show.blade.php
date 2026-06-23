@extends('layouts.public')

@section('title', $store->name)

@section('meta')
<meta name="description" content="{{ $store->description ?? $store->name . ' — Toko pengrajin lokal Bali di Smart UMKM Bali.' }}">
<meta property="og:title" content="{{ $store->name }} | Smart UMKM Bali">
<meta property="og:description" content="{{ $store->description ?? 'Temukan produk premium dari pengrajin Bali.' }}">
<meta property="og:type" content="profile">
@if($store->setting && $store->setting->banner_path)
<meta property="og:image" content="{{ imageUrl($store->setting->banner_url ?? null, 'large') }}">
@endif
@endsection

@php
    // ── Dynamic Theming ──
    $themeConfig = $store->setting->theme_config ?? [];
    $brandColor  = $themeConfig['brand_color'] ?? '#D2691E'; // Default: Terracotta
    $themeStyle  = $themeConfig['theme_style'] ?? 'minimalist';
    $motif       = $themeConfig['cultural_motif'] ?? 'patra';

    // Social links
    $socials = $store->setting->social_links ?? [];
@endphp

@section('content')
<div style="--store-primary: {{ $brandColor }};">

{{-- ═══════════════════════════════════════
     SECTION 1: HERO BANNER (Full-Width)
     ═══════════════════════════════════════ --}}
<section class="relative h-[70vh] md:h-[80vh] overflow-hidden">
    {{-- Background Image --}}
    @if($store->setting && $store->setting->banner_path)
        <img src="{{ imageUrl($store->setting->banner_url ?? null, 'banner') }}" alt="{{ $store->name }}" class="absolute inset-0 w-full h-full object-cover" loading="eager">
    @else
        <div class="absolute inset-0 bg-gradient-to-br from-basalt via-basalt/80 to-basalt/60"></div>
    @endif

    {{-- Gradient Overlays --}}
    <div class="absolute inset-0 bg-gradient-to-t from-basalt/80 via-basalt/30 to-basalt/10"></div>
    <div class="absolute inset-0 bg-gradient-to-r from-basalt/30 to-transparent"></div>

    {{-- Center Content --}}
    <div class="absolute inset-0 flex items-end justify-center pb-16 md:pb-20 px-4">
        <div class="text-center max-w-2xl">
            {{-- Logo / Avatar --}}
            <div class="mx-auto w-24 h-24 md:w-32 md:h-32 rounded-full border-4 border-white/30 shadow-premium overflow-hidden bg-surface-white mb-6">
                @if($store->setting && $store->setting->logo_path)
                    <img src="{{ imageUrl($store->setting->logo_url ?? null, 'thumbnail') }}" alt="{{ $store->name }}" class="w-full h-full object-cover">
                @else
                    <div class="w-full h-full flex items-center justify-center bg-store-primary">
                        <span class="font-playfair font-bold text-4xl md:text-5xl text-white">{{ substr($store->name, 0, 1) }}</span>
                    </div>
                @endif
            </div>

            {{-- Store Name --}}
            <h1 class="font-playfair text-4xl md:text-5xl lg:text-6xl text-white leading-tight mb-3">{{ $store->name }}</h1>
            
            {{-- Category & Location --}}
            <div class="flex flex-wrap items-center justify-center gap-4 text-white/70 text-body-sm mb-6">
                @if($store->storeCategory)
                    <span class="flex items-center gap-1.5">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9.568 3H5.25A2.25 2.25 0 0 0 3 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 0 0 5.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 0 0 9.568 3Z"/><path stroke-linecap="round" stroke-linejoin="round" d="M6 6h.008v.008H6V6Z"/></svg>
                        {{ $store->storeCategory->name }}
                    </span>
                @endif
                @if($store->address)
                    <span class="flex items-center gap-1.5">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z"/></svg>
                        {{ $store->address }}
                    </span>
                @endif
                <span class="flex items-center gap-1.5">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="m20.25 7.5-.625 10.632a2.25 2.25 0 0 1-2.247 2.118H6.622a2.25 2.25 0 0 1-2.247-2.118L3.75 7.5m8.25 3v6.75m0 0-3-3m3 3 3-3M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125Z"/></svg>
                    {{ $products->total() }} produk
                </span>
            </div>

            {{-- Social Links --}}
            @if(!empty($socials))
                <div class="flex items-center justify-center gap-3">
                    @if(!empty($socials['instagram']))
                        <a href="{{ $socials['instagram'] }}" target="_blank" rel="noopener" class="w-10 h-10 rounded-full bg-white/10 backdrop-blur-sm flex items-center justify-center text-white hover:bg-white/20 transition-colors" aria-label="Instagram">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069ZM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0Zm0 5.838a6.162 6.162 0 1 0 0 12.324 6.162 6.162 0 0 0 0-12.324ZM12 16a4 4 0 1 1 0-8 4 4 0 0 1 0 8Zm6.406-11.845a1.44 1.44 0 1 0 0 2.881 1.44 1.44 0 0 0 0-2.881Z"/></svg>
                        </a>
                    @endif
                    @if(!empty($socials['whatsapp']))
                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $socials['whatsapp']) }}" target="_blank" rel="noopener" class="w-10 h-10 rounded-full bg-white/10 backdrop-blur-sm flex items-center justify-center text-white hover:bg-white/20 transition-colors" aria-label="WhatsApp">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413Z"/></svg>
                        </a>
                    @endif
                    @if(!empty($socials['website']))
                        <a href="{{ $socials['website'] }}" target="_blank" rel="noopener" class="w-10 h-10 rounded-full bg-white/10 backdrop-blur-sm flex items-center justify-center text-white hover:bg-white/20 transition-colors" aria-label="Website">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 21a9.004 9.004 0 0 0 8.716-6.747M12 21a9.004 9.004 0 0 1-8.716-6.747M12 21c2.485 0 4.5-4.03 4.5-9S14.485 3 12 3m0 18c-2.485 0-4.5-4.03-4.5-9S9.515 3 12 3m0 0a8.997 8.997 0 0 1 7.843 4.582M12 3a8.997 8.997 0 0 0-7.843 4.582m15.686 0A11.953 11.953 0 0 1 12 10.5c-2.998 0-5.74-1.1-7.843-2.918m15.686 0A8.959 8.959 0 0 1 21 12c0 .778-.099 1.533-.284 2.253m0 0A17.919 17.919 0 0 1 12 16.5c-3.162 0-6.133-.815-8.716-2.247m0 0A9.015 9.015 0 0 1 3 12c0-1.605.42-3.113 1.157-4.418"/></svg>
                        </a>
                    @endif
                </div>
            @endif
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════
     SECTION 2: BRAND STORY
     ═══════════════════════════════════════ --}}
@if($store->description)
<section class="bg-surface-white">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-20 md:py-28 text-center">
        <div class="store-patra-divider mb-8">
            <span class="text-store-primary text-label-md tracking-[0.3em] uppercase px-4">Tentang Kami</span>
        </div>
        <blockquote class="font-playfair text-2xl md:text-3xl lg:text-4xl text-basalt leading-relaxed italic mb-6">
            "{{ $store->description }}"
        </blockquote>
        <p class="text-body-sm text-basalt-muted tracking-wider uppercase">— {{ $store->name }}</p>
    </div>
</section>
@endif

{{-- ═══════════════════════════════════════
     SECTION 3: OWNER / MEET THE MAKER
     ═══════════════════════════════════════ --}}
<section class="bg-cream-premium">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 md:py-24">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-10 md:gap-16 items-center">
            {{-- Owner Image --}}
            <div class="aspect-[4/5] rounded-lg overflow-hidden bg-surface-container">
                @if($store->setting && $store->setting->logo_path)
                    <img src="{{ imageUrl($store->setting->logo_url ?? null, 'thumbnail') }}" alt="Pengrajin {{ $store->name }}" class="w-full h-full object-cover">
                @else
                    <div class="w-full h-full flex items-center justify-center bg-store-primary/10">
                        <span class="font-playfair font-bold text-8xl text-store-primary/30">{{ substr($store->name, 0, 1) }}</span>
                    </div>
                @endif
            </div>

            {{-- Owner Story --}}
            <div>
                <p class="text-store-primary tracking-[0.2em] uppercase text-label-md mb-4">Pengrajin</p>
                <h2 class="font-playfair text-3xl md:text-4xl text-basalt leading-tight mb-6">
                    Mengenal {{ $store->owner->name ?? $store->name }}
                </h2>
                <div class="space-y-4 text-body-md text-basalt-muted leading-relaxed">
                    <p>{{ $store->description ?? 'Setiap karya yang kami buat membawa jiwa budaya Bali — tradisi yang diwariskan turun-temurun, dibentuk oleh tangan-tangan yang penuh dedikasi.' }}</p>
                    <p>Kami percaya bahwa keindahan lahir dari ketekunan. Dari pemilihan bahan baku hingga proses akhir, setiap detail dikerjakan dengan cinta dan penghormatan terhadap warisan leluhur.</p>
                </div>
                <div class="mt-8 flex items-center gap-4">
                    <div class="h-px flex-1 bg-outline/20"></div>
                    @if($store->address)
                        <span class="text-label-sm text-basalt-muted tracking-wider">{{ $store->address }}</span>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════
     SECTION 4: CULTURAL HERITAGE
     ═══════════════════════════════════════ --}}
<section class="relative overflow-hidden" style="background-color: color-mix(in srgb, var(--store-primary) 8%, white);">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 md:py-20">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 md:gap-12 text-center">
            <div>
                <div class="w-14 h-14 mx-auto rounded-full bg-store-primary/10 flex items-center justify-center mb-4">
                    <svg class="w-7 h-7 text-store-primary" fill="none" stroke="currentColor" stroke-width="1" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9.813 15.904 9 18.75l-.813-2.846a4.5 4.5 0 0 0-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 0 0 3.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 0 0 3.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 0 0-3.09 3.09ZM18.259 8.715 18 9.75l-.259-1.035a3.375 3.375 0 0 0-2.455-2.456L14.25 6l1.036-.259a3.375 3.375 0 0 0 2.455-2.456L18 2.25l.259 1.035a3.375 3.375 0 0 0 2.455 2.456L21.75 6l-1.036.259a3.375 3.375 0 0 0-2.455 2.456ZM16.894 20.567 16.5 21.75l-.394-1.183a2.25 2.25 0 0 0-1.423-1.423L13.5 18.75l1.183-.394a2.25 2.25 0 0 0 1.423-1.423l.394-1.183.394 1.183a2.25 2.25 0 0 0 1.423 1.423l1.183.394-1.183.394a2.25 2.25 0 0 0-1.423 1.423Z"/></svg>
                </div>
                <h3 class="font-playfair text-lg text-basalt mb-2">Buatan Tangan</h3>
                <p class="text-body-sm text-basalt-muted">Setiap produk dikerjakan secara manual oleh pengrajin berpengalaman.</p>
            </div>
            <div>
                <div class="w-14 h-14 mx-auto rounded-full bg-store-primary/10 flex items-center justify-center mb-4">
                    <svg class="w-7 h-7 text-store-primary" fill="none" stroke="currentColor" stroke-width="1" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12.75 3.03v.568c0 .334.148.65.405.864l1.068.89c.442.369.535 1.01.216 1.49l-.51.766a2.25 2.25 0 0 1-1.161.886l-.143.048a1.107 1.107 0 0 0-.57 1.664c.369.555.169 1.307-.427 1.605L9 13.125l.423 1.059a.956.956 0 0 1-1.652.928l-.679-.906a1.125 1.125 0 0 0-1.906.172L4.5 15.75l-.612.153M12.75 3.031a9 9 0 1 0 6.672 14.849"/></svg>
                </div>
                <h3 class="font-playfair text-lg text-basalt mb-2">Warisan Budaya</h3>
                <p class="text-body-sm text-basalt-muted">Teknik dan motif tradisional yang dijaga dan dilestarikan.</p>
            </div>
            <div>
                <div class="w-14 h-14 mx-auto rounded-full bg-store-primary/10 flex items-center justify-center mb-4">
                    <svg class="w-7 h-7 text-store-primary" fill="none" stroke="currentColor" stroke-width="1" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z"/></svg>
                </div>
                <h3 class="font-playfair text-lg text-basalt mb-2">Berkelanjutan</h3>
                <p class="text-body-sm text-basalt-muted">Bahan baku lokal pilihan yang ramah lingkungan.</p>
            </div>
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════
     SECTION 5: PRODUCT COLLECTION (The Gallery)
     ═══════════════════════════════════════ --}}
<section class="bg-surface-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 md:py-24">
        {{-- Section Header --}}
        <div class="text-center mb-12 md:mb-16">
            <div class="store-patra-divider mb-6">
                <span class="text-store-primary text-label-md tracking-[0.3em] uppercase px-4">Koleksi</span>
            </div>
            <h2 class="font-playfair text-3xl md:text-4xl text-basalt">Karya Pilihan</h2>
        </div>

        {{-- Category Filter Pills --}}
        <div class="flex items-center justify-center gap-2 mb-10 overflow-x-auto hide-scrollbar pb-2">
            <a href="{{ route('catalog.show', ['slug' => $store->slug, 'search' => request('search')]) }}"
               class="shrink-0 px-5 py-2.5 rounded-full text-body-sm font-medium transition-all duration-300 border
               {{ !request('category') ? 'bg-store-primary text-white border-transparent' : 'bg-transparent text-basalt-muted border-outline/50 hover:border-basalt/30' }}">
                Semua
            </a>
            @foreach($categories as $category)
                <a href="{{ route('catalog.show', ['slug' => $store->slug, 'category' => $category->slug, 'search' => request('search')]) }}"
                   class="shrink-0 px-5 py-2.5 rounded-full text-body-sm font-medium transition-all duration-300 border
                   {{ request('category') === $category->slug ? 'bg-store-primary text-white border-transparent' : 'bg-transparent text-basalt-muted border-outline/50 hover:border-basalt/30' }}">
                    {{ $category->name }}
                </a>
            @endforeach
        </div>

        {{-- Search (subtle) --}}
        <div class="flex justify-center mb-10">
            <form method="GET" action="{{ route('catalog.show', $store->slug) }}" class="relative w-full max-w-md">
                @if(request('category'))
                    <input type="hidden" name="category" value="{{ request('category') }}">
                @endif
                <svg class="w-4 h-4 absolute left-4 top-1/2 -translate-y-1/2 text-basalt-muted" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z"/></svg>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari di koleksi {{ $store->name }}..." class="w-full pl-10 pr-4 py-3 border border-outline/30 rounded-full text-body-sm bg-cream-premium focus:border-store-primary focus:ring-1 focus:ring-store-primary/20 transition-colors" style="--tw-ring-color: color-mix(in srgb, var(--store-primary) 20%, transparent);">
            </form>
        </div>

        {{-- Products Grid --}}
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 md:gap-10">
            @forelse($products as $product)
                <a href="{{ route('products.show', $product->slug ?? $product->id) }}" class="group">
                    <div class="aspect-[4/5] bg-cream-premium rounded-lg overflow-hidden mb-4 relative">
                        @if($product->images && $product->images->count() > 0)
                            <img src="{{ imageUrl($product->images->where('is_primary', true)->first()->image_url ?? $product->images->first()->image_url ?? null, 'product_card') }}" alt="{{ $product->name }}" class="w-full h-full object-cover transition-transform duration-700 ease-out group-hover:scale-105" loading="lazy">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-basalt/10">
                                <svg class="w-12 h-12" fill="none" stroke="currentColor" stroke-width="0.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z"/></svg>
                            </div>
                        @endif
                        <div class="absolute inset-0 bg-basalt/0 group-hover:bg-basalt/5 transition-colors duration-500"></div>
                        @if($product->stock <= 0)
                            <div class="absolute top-3 left-3 px-3 py-1 bg-basalt/80 text-white text-label-sm font-medium rounded-full backdrop-blur-sm">Habis</div>
                        @endif
                    </div>
                    <p class="text-label-sm text-store-primary tracking-wider uppercase mb-1">{{ $product->category->name ?? 'Produk' }}</p>
                    <h3 class="font-playfair text-base md:text-lg text-basalt leading-snug mb-1 group-hover:text-store-primary transition-colors duration-300 line-clamp-2">{{ $product->name }}</h3>
                    <p class="font-semibold text-basalt">{{ $product->formatted_sell_price }}</p>
                </a>
            @empty
                <div class="col-span-full py-20 text-center">
                    <svg class="w-16 h-16 mx-auto text-basalt/10 mb-6" fill="none" stroke="currentColor" stroke-width="0.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z"/></svg>
                    <h3 class="font-playfair text-xl text-basalt mb-2">Produk tidak ditemukan</h3>
                    <p class="text-body-md text-basalt-muted mb-6">Coba ubah kata kunci atau filter Anda.</p>
                    @if(request()->has('search') || request()->has('category'))
                        <a href="{{ route('catalog.show', $store->slug) }}" class="inline-flex items-center gap-2 px-6 py-3 bg-store-primary text-white rounded-full font-medium text-body-sm hover:opacity-90 transition-opacity">Reset</a>
                    @endif
                </div>
            @endforelse
        </div>

        @if($products->hasPages())
            <div class="mt-14 flex justify-center">
                {{ $products->links() }}
            </div>
        @endif
    </div>
</section>

{{-- ═══════════════════════════════════════
     SECTION 6: REVIEWS (Social Proof)
     ═══════════════════════════════════════ --}}
@if(isset($reviews) && $reviews->count() > 0)
<section class="bg-cream-premium border-t border-outline/20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 md:py-24">
        <div class="text-center mb-12">
            <div class="store-patra-divider mb-6">
                <span class="text-store-primary text-label-md tracking-[0.3em] uppercase px-4">Testimoni</span>
            </div>
            <h2 class="font-playfair text-3xl md:text-4xl text-basalt">Kata Pelanggan Kami</h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8">
            @foreach($reviews as $review)
                <div class="bg-surface-white rounded-lg p-6 md:p-8 border border-outline/20">
                    {{-- Stars --}}
                    <div class="flex items-center gap-0.5 mb-4">
                        @for($i = 1; $i <= 5; $i++)
                            <svg class="w-4 h-4 {{ $i <= $review->rating ? 'text-prada fill-current' : 'text-outline stroke-current fill-transparent' }}" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 0 1 1.04 0l2.125 5.111a.563.563 0 0 0 .475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 0 0-.182.557l1.285 5.385a.562.562 0 0 1-.84.61l-4.725-2.885a.562.562 0 0 0-.586 0L6.982 20.54a.562.562 0 0 1-.84-.61l1.285-5.386a.562.562 0 0 0-.182-.557l-4.204-3.602a.562.562 0 0 1 .321-.988l5.518-.442a.563.563 0 0 0 .475-.345L11.48 3.5Z"/></svg>
                        @endfor
                    </div>
                    {{-- Comment --}}
                    <p class="text-body-md text-basalt-muted leading-relaxed mb-6 italic">"{{ $review->comment }}"</p>
                    {{-- Reviewer --}}
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full bg-store-primary/10 flex items-center justify-center">
                            <span class="font-semibold text-store-primary text-sm">{{ substr($review->user->name, 0, 1) }}</span>
                        </div>
                        <div>
                            <p class="font-semibold text-basalt text-body-sm">{{ $review->user->name }}</p>
                            <p class="text-label-sm text-basalt-muted">{{ $review->created_at->diffForHumans() }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- ═══════════════════════════════════════
     SECTION 7: CONTACT & SOCIAL MEDIA (Store Footer)
     ═══════════════════════════════════════ --}}
<section class="bg-basalt text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 md:py-20">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-10 md:gap-16">
            {{-- Brand --}}
            <div>
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-12 h-12 rounded-full overflow-hidden border-2 border-white/20 bg-surface-white flex items-center justify-center">
                        @if($store->setting && $store->setting->logo_path)
                            <img src="{{ imageUrl($store->setting->logo_url ?? null, 'thumbnail') }}" alt="{{ $store->name }}" class="w-full h-full object-cover">
                        @else
                            <span class="font-playfair font-bold text-xl text-store-primary">{{ substr($store->name, 0, 1) }}</span>
                        @endif
                    </div>
                    <span class="font-playfair text-xl">{{ $store->name }}</span>
                </div>
                <p class="text-white/60 text-body-sm leading-relaxed">{{ Str::limit($store->description ?? 'Pengrajin lokal Bali yang berdedikasi menghasilkan karya berkualitas.', 120) }}</p>
            </div>

            {{-- Contact --}}
            <div>
                <h4 class="font-semibold text-white mb-4 tracking-wider uppercase text-label-md">Kontak</h4>
                <div class="space-y-3 text-white/60 text-body-sm">
                    @if($store->address)
                        <p class="flex items-start gap-2">
                            <svg class="w-4 h-4 mt-0.5 shrink-0" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z"/></svg>
                            {{ $store->address }}
                        </p>
                    @endif
                    @if($store->contact)
                        <p class="flex items-center gap-2">
                            <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 0 1-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25Z"/></svg>
                            {{ $store->contact }}
                        </p>
                    @endif
                </div>
            </div>

            {{-- Social Media --}}
            <div>
                <h4 class="font-semibold text-white mb-4 tracking-wider uppercase text-label-md">Ikuti Kami</h4>
                <div class="flex items-center gap-3">
                    @if(!empty($socials['instagram']))
                        <a href="{{ $socials['instagram'] }}" target="_blank" rel="noopener" class="w-10 h-10 rounded-full bg-white/10 flex items-center justify-center hover:bg-white/20 transition-colors" aria-label="Instagram">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069ZM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0Zm0 5.838a6.162 6.162 0 1 0 0 12.324 6.162 6.162 0 0 0 0-12.324ZM12 16a4 4 0 1 1 0-8 4 4 0 0 1 0 8Zm6.406-11.845a1.44 1.44 0 1 0 0 2.881 1.44 1.44 0 0 0 0-2.881Z"/></svg>
                        </a>
                    @endif
                    @if(!empty($socials['whatsapp']))
                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $socials['whatsapp']) }}" target="_blank" rel="noopener" class="w-10 h-10 rounded-full bg-white/10 flex items-center justify-center hover:bg-white/20 transition-colors" aria-label="WhatsApp">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413Z"/></svg>
                        </a>
                    @endif
                    @if(!empty($socials['website']))
                        <a href="{{ $socials['website'] }}" target="_blank" rel="noopener" class="w-10 h-10 rounded-full bg-white/10 flex items-center justify-center hover:bg-white/20 transition-colors" aria-label="Website">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 21a9.004 9.004 0 0 0 8.716-6.747M12 21a9.004 9.004 0 0 1-8.716-6.747M12 21c2.485 0 4.5-4.03 4.5-9S14.485 3 12 3m0 18c-2.485 0-4.5-4.03-4.5-9S9.515 3 12 3m0 0a8.997 8.997 0 0 1 7.843 4.582M12 3a8.997 8.997 0 0 0-7.843 4.582m15.686 0A11.953 11.953 0 0 1 12 10.5c-2.998 0-5.74-1.1-7.843-2.918m15.686 0A8.959 8.959 0 0 1 21 12c0 .778-.099 1.533-.284 2.253m0 0A17.919 17.919 0 0 1 12 16.5c-3.162 0-6.133-.815-8.716-2.247m0 0A9.015 9.015 0 0 1 3 12c0-1.605.42-3.113 1.157-4.418"/></svg>
                        </a>
                    @endif
                </div>

                {{-- Operational Hours --}}
                @if($store->setting && $store->setting->operational_hours)
                    <div class="mt-6">
                        <h5 class="text-label-sm text-white/40 uppercase tracking-wider mb-2">Jam Operasional</h5>
                        @foreach($store->setting->operational_hours as $day => $hours)
                            <p class="text-white/60 text-body-sm">{{ $day }}: {{ $hours }}</p>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>

        <div class="mt-12 pt-8 border-t border-white/10 text-center">
            <p class="text-white/30 text-body-sm">{{ $store->name }} — Bagian dari <a href="{{ route('landing') }}" class="text-white/50 hover:text-white transition-colors">Smart UMKM Bali</a></p>
        </div>
    </div>
</section>

</div>
@endsection
