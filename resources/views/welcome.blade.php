@extends('layouts.public')

@section('title', 'Karya Tangan Bali, Untuk Dunia')

@section('meta')
<meta property="og:title" content="Smart UMKM Bali — Premium Marketplace Produk Bali">
<meta property="og:description" content="Temukan karya tangan autentik dari pengrajin UMKM Bali. Produk berkualitas tinggi langsung dari tangan sang pembuat.">
<meta property="og:type" content="website">
@endsection

@section('content')

{{-- ════════════════════════════════════════════════════════════
     SECTION 1: HERO STORYTELLING
     Full-screen hero with cinematic gradient overlay
     ════════════════════════════════════════════════════════════ --}}
<section class="relative min-h-screen flex items-center justify-center overflow-hidden">
    <!-- Background Image -->
    <div class="absolute inset-0 -z-10">
        <img 
            src="https://images.unsplash.com/photo-1604430456280-43f652c497aa?w=1920&q=80" 
            alt="Pengrajin Bali" 
            class="w-full h-full object-cover"
            loading="eager"
        >
        <div class="absolute inset-0 bg-gradient-to-b from-basalt/50 via-basalt/30 to-basalt/70"></div>
    </div>

    <!-- Hero Content -->
    <div class="relative max-w-5xl mx-auto px-6 text-center pt-20">
        <p class="text-prada tracking-[0.3em] uppercase text-label-md mb-8 animate-fade-in" style="opacity:0">
            Marketplace Premium UMKM Bali
        </p>
        
        <h1 class="font-playfair text-5xl sm:text-6xl md:text-7xl lg:text-display-2xl text-white leading-[1.05] tracking-tight mb-8 animate-fade-up" style="opacity:0">
            Karya Tangan Bali,<br>
            <em class="font-normal italic">Untuk Dunia</em>
        </h1>
        
        <p class="text-white/70 text-body-lg md:text-xl max-w-2xl mx-auto mb-12 leading-relaxed animate-fade-up-delay" style="opacity:0">
            Setiap produk menyimpan cerita warisan budaya ribuan tahun — dari tangan pengrajin langsung ke tangan Anda.
        </p>

        <div class="flex flex-col sm:flex-row items-center justify-center gap-4 animate-fade-up-delay-2" style="opacity:0">
            <a href="{{ route('products.index') }}" class="group px-8 py-4 bg-terracotta text-white rounded-full font-semibold text-body-md tracking-wide hover:bg-terracotta-dark transition-all duration-300 hover:shadow-lg hover:shadow-terracotta/30">
                Jelajahi Koleksi
                <svg class="inline-block w-4 h-4 ml-1 transition-transform duration-300 group-hover:translate-x-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5"/></svg>
            </a>
            <a href="{{ route('store.index') }}" class="px-8 py-4 bg-white/10 backdrop-blur-sm text-white border border-white/20 rounded-full font-semibold text-body-md tracking-wide hover:bg-white/20 transition-all duration-300">
                Temui Pengrajin
            </a>
        </div>
    </div>

    <!-- Scroll Indicator -->
    <div class="absolute bottom-10 left-1/2 -translate-x-1/2 flex flex-col items-center gap-2 text-white/40 animate-bounce">
        <span class="text-label-sm tracking-widest uppercase">Scroll</span>
        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5"/></svg>
    </div>
</section>


{{-- ════════════════════════════════════════════════════════════
     SECTION 2: FEATURED PRODUCTS CAROUSEL
     Horizontal scrolling product showcase
     ════════════════════════════════════════════════════════════ --}}
<section class="py-24 md:py-32 bg-cream-premium">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Section Header -->
        <div class="flex items-end justify-between mb-12 reveal" x-data x-intersect.once="$el.classList.add('revealed')">
            <div>
                <p class="text-terracotta tracking-[0.2em] uppercase text-label-md mb-3">Pilihan Terbaik</p>
                <h2 class="font-playfair text-3xl md:text-4xl lg:text-5xl text-basalt leading-tight">Produk Unggulan</h2>
            </div>
            <a href="{{ route('products.index') }}" class="hidden sm:inline-flex items-center gap-2 text-basalt-muted hover:text-terracotta text-body-sm font-medium transition-colors group">
                Lihat Semua 
                <svg class="w-4 h-4 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5"/></svg>
            </a>
        </div>

        <!-- Products Carousel -->
        <div class="flex overflow-x-auto snap-x snap-mandatory hide-scrollbar gap-5 pb-4 -mx-4 px-4 reveal" x-data x-intersect.once="$el.classList.add('revealed')">
            @forelse($popularProducts ?? [] as $product)
                <a href="{{ route('products.show', $product->slug ?? $product->id) }}" class="snap-start shrink-0 w-[75vw] sm:w-[45vw] md:w-[30vw] lg:w-[23vw] group">
                    <div class="aspect-[4/5] bg-surface-container rounded-lg overflow-hidden relative mb-4">
                        @if($product->images && $product->images->count() > 0)
                            <img 
                                src="{{ Storage::url($product->images->first()->image_path) }}" 
                                alt="{{ $product->name }}" 
                                class="w-full h-full object-cover transition-transform duration-700 ease-out group-hover:scale-105"
                                loading="lazy"
                            >
                        @else
                            <div class="w-full h-full flex items-center justify-center text-on-surface-variant/30">
                                <svg class="w-16 h-16" fill="none" stroke="currentColor" stroke-width="0.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z"/></svg>
                            </div>
                        @endif
                        <!-- Hover Overlay -->
                        <div class="absolute inset-0 bg-basalt/0 group-hover:bg-basalt/10 transition-colors duration-500"></div>
                    </div>
                    <div>
                        <p class="text-label-sm text-terracotta tracking-wider uppercase mb-1">{{ $product->category->name ?? 'Produk Bali' }}</p>
                        <h3 class="font-playfair text-lg text-basalt mb-1 group-hover:text-terracotta transition-colors duration-300 line-clamp-1">{{ $product->name }}</h3>
                        <p class="text-body-sm text-basalt-muted">{{ $product->store->name ?? '' }}</p>
                        <p class="font-semibold text-basalt mt-2">{{ $product->formatted_sell_price }}</p>
                    </div>
                </a>
            @empty
                <div class="w-full py-16 text-center text-on-surface-variant">
                    <p class="font-playfair text-xl">Segera hadir — koleksi terbaik Bali.</p>
                </div>
            @endforelse
        </div>

        <!-- Mobile CTA -->
        <div class="mt-8 text-center sm:hidden">
            <a href="{{ route('products.index') }}" class="inline-flex items-center gap-2 text-terracotta font-semibold text-body-sm">
                Lihat Semua Produk
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5"/></svg>
            </a>
        </div>
    </div>
</section>


{{-- ════════════════════════════════════════════════════════════
     SECTION 3: CULTURAL SPOTLIGHT
     50/50 editorial split — Aesop style
     ════════════════════════════════════════════════════════════ --}}
<section class="py-24 md:py-32 bg-surface-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-20 items-center">
            <!-- Image -->
            <div class="reveal" x-data x-intersect.once="$el.classList.add('revealed')">
                <div class="aspect-[4/5] rounded-lg overflow-hidden">
                    <img 
                        src="https://images.unsplash.com/photo-1518709766631-a6a7f45921c3?w=800&q=80" 
                        alt="Warisan Budaya Bali" 
                        class="w-full h-full object-cover"
                        loading="lazy"
                    >
                </div>
            </div>
            
            <!-- Text -->
            <div class="reveal reveal-delay-2" x-data x-intersect.once="$el.classList.add('revealed')">
                <div class="patra-divider mb-8">
                    <span class="text-prada text-label-md tracking-[0.3em] uppercase px-4">Warisan Budaya</span>
                </div>
                <h2 class="font-playfair text-3xl md:text-4xl lg:text-5xl text-basalt leading-tight mb-8">
                    Setiap Karya<br>Menyimpan <em class="italic">Cerita</em>
                </h2>
                <p class="text-body-lg text-basalt-muted leading-relaxed mb-6">
                    Di balik setiap produk UMKM Bali terdapat warisan budaya ribuan tahun — teknik tenun yang diajarkan turun-temurun, ukiran kayu yang mengisahkan mitologi Hindu, dan aroma rempah yang menjadi identitas pulau dewata.
                </p>
                <p class="text-body-md text-basalt-muted leading-relaxed mb-10">
                    Smart UMKM Bali hadir untuk memastikan cerita-cerita ini tidak hanya lestari, tetapi juga diapresiasi oleh dunia.
                </p>
                <a href="{{ route('blog.index') }}" class="inline-flex items-center gap-3 text-terracotta font-semibold tracking-wide hover:gap-4 transition-all duration-300 group">
                    Baca Cerita Lengkap
                    <svg class="w-5 h-5 transition-transform duration-300 group-hover:translate-x-1" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25 21 12m0 0-3.75 3.75M21 12H3"/></svg>
                </a>
            </div>
        </div>
    </div>
</section>


{{-- ════════════════════════════════════════════════════════════
     SECTION 4: FAVORITE SHOPS
     Premium store cards grid
     ════════════════════════════════════════════════════════════ --}}
<section class="py-24 md:py-32 bg-cream-premium poleng-pattern">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Section Header -->
        <div class="text-center mb-16 reveal" x-data x-intersect.once="$el.classList.add('revealed')">
            <p class="text-terracotta tracking-[0.2em] uppercase text-label-md mb-3">Toko Terpilih</p>
            <h2 class="font-playfair text-3xl md:text-4xl lg:text-5xl text-basalt mb-4">Toko Favorit</h2>
            <p class="text-body-md text-basalt-muted max-w-xl mx-auto">Temukan dan dukung pengrajin lokal terbaik dari seluruh pelosok Bali.</p>
        </div>

        <!-- Stores Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($popularStores ?? [] as $index => $store)
                <a 
                    href="{{ route('catalog.show', $store->slug) }}" 
                    class="group bg-surface-white rounded-lg overflow-hidden border border-outline/50 hover:shadow-premium hover:-translate-y-1 transition-all duration-500 reveal reveal-delay-{{ ($index % 3) + 1 }}"
                    x-data x-intersect.once="$el.classList.add('revealed')"
                >
                    <!-- Store Banner -->
                    <div class="h-40 bg-surface-container relative overflow-hidden">
                        @if($store->setting && $store->setting->banner_path)
                            <img src="{{ Storage::url($store->setting->banner_path) }}" alt="{{ $store->name }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
                        @else
                            <div class="w-full h-full bg-gradient-to-br from-terracotta/10 to-prada/10"></div>
                        @endif
                        <div class="absolute inset-0 bg-gradient-to-t from-basalt/30 to-transparent"></div>
                    </div>
                    
                    <!-- Store Info -->
                    <div class="p-6 relative">
                        <!-- Avatar -->
                        <div class="absolute -top-8 left-6 w-16 h-16 bg-surface-white rounded-full border-4 border-surface-white shadow-card overflow-hidden flex items-center justify-center">
                            @if($store->setting && $store->setting->logo_path)
                                <img src="{{ Storage::url($store->setting->logo_path) }}" alt="{{ $store->name }}" class="w-full h-full object-cover">
                            @else
                                <span class="font-playfair font-bold text-2xl text-terracotta">{{ substr($store->name, 0, 1) }}</span>
                            @endif
                        </div>
                        
                        <div class="mt-6">
                            <h3 class="font-playfair font-semibold text-lg text-basalt group-hover:text-terracotta transition-colors duration-300 mb-1">{{ $store->name }}</h3>
                            <p class="text-label-sm text-terracotta/70 mb-3">{{ $store->storeCategory->name ?? 'UMKM Bali' }}</p>
                            <p class="text-body-sm text-basalt-muted line-clamp-2">{{ $store->description ?? 'Toko pengrajin lokal Bali dengan produk berkualitas tinggi.' }}</p>
                        </div>
                    </div>
                </a>
            @empty
                <div class="col-span-full py-16 text-center">
                    <p class="font-playfair text-xl text-basalt-muted">Segera hadir — toko-toko terbaik Bali.</p>
                </div>
            @endforelse
        </div>

        <!-- View All -->
        <div class="text-center mt-12 reveal" x-data x-intersect.once="$el.classList.add('revealed')">
            <a href="{{ route('store.index') }}" class="inline-flex items-center gap-2 px-8 py-3.5 border border-basalt/20 text-basalt rounded-full font-medium text-body-sm hover:bg-basalt hover:text-white transition-all duration-300">
                Jelajahi Semua Toko
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5"/></svg>
            </a>
        </div>
    </div>
</section>


{{-- ════════════════════════════════════════════════════════════
     SECTION 5: PRODUCT CATEGORIES
     Visual category grid with hover overlays
     ════════════════════════════════════════════════════════════ --}}
<section class="py-24 md:py-32 bg-surface-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16 reveal" x-data x-intersect.once="$el.classList.add('revealed')">
            <p class="text-terracotta tracking-[0.2em] uppercase text-label-md mb-3">Temukan Berdasarkan</p>
            <h2 class="font-playfair text-3xl md:text-4xl lg:text-5xl text-basalt">Kategori Produk</h2>
        </div>

        @php
            $categoryImages = [
                'https://images.unsplash.com/photo-1617038220319-276d3cfab638?w=600&q=80',
                'https://images.unsplash.com/photo-1559056199-641a0ac8b55e?w=600&q=80',
                'https://images.unsplash.com/photo-1506905925346-21bda4d32df4?w=600&q=80',
                'https://images.unsplash.com/photo-1611244419377-b0a760c19719?w=600&q=80',
                'https://images.unsplash.com/photo-1578662996442-48f60103fc96?w=600&q=80',
                'https://images.unsplash.com/photo-1590736969955-71cc94901144?w=600&q=80',
                'https://images.unsplash.com/photo-1565108939327-7e8be023855e?w=600&q=80',
                'https://images.unsplash.com/photo-1555939594-58d7cb561ad1?w=600&q=80',
            ];
        @endphp

        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 reveal" x-data x-intersect.once="$el.classList.add('revealed')">
            @forelse($categories ?? [] as $index => $category)
                <a 
                    href="{{ route('products.index', ['category' => $category->slug]) }}" 
                    class="relative h-48 md:h-64 rounded-lg overflow-hidden group {{ $index === 0 || $index === 3 ? 'md:col-span-2' : '' }}"
                >
                    <img 
                        src="{{ $categoryImages[$index % count($categoryImages)] }}" 
                        alt="{{ $category->name }}" 
                        class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"
                        loading="lazy"
                    >
                    <div class="absolute inset-0 bg-basalt/40 group-hover:bg-basalt/30 transition-colors duration-500"></div>
                    <div class="absolute inset-0 flex flex-col items-center justify-center text-white text-center p-4">
                        <h3 class="font-playfair text-xl md:text-2xl font-medium mb-1 transition-transform duration-500 group-hover:scale-110">{{ $category->name }}</h3>
                        <p class="text-label-sm text-white/60 tracking-wider uppercase">{{ $category->products_count ?? 0 }} Produk</p>
                    </div>
                </a>
            @empty
                {{-- Fallback static categories --}}
                @php
                    $staticCategories = [
                        ['name' => 'Kerajinan Tangan', 'count' => '50+'],
                        ['name' => 'Kopi & Kuliner', 'count' => '30+'],
                        ['name' => 'Fashion', 'count' => '40+'],
                        ['name' => 'Seni & Dekorasi', 'count' => '25+'],
                    ];
                @endphp
                @foreach($staticCategories as $index => $cat)
                    <a href="{{ route('products.index') }}" class="relative h-48 md:h-64 rounded-lg overflow-hidden group {{ $index === 0 || $index === 3 ? 'md:col-span-2' : '' }}">
                        <img src="{{ $categoryImages[$index] }}" alt="{{ $cat['name'] }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" loading="lazy">
                        <div class="absolute inset-0 bg-basalt/40 group-hover:bg-basalt/30 transition-colors duration-500"></div>
                        <div class="absolute inset-0 flex flex-col items-center justify-center text-white text-center p-4">
                            <h3 class="font-playfair text-xl md:text-2xl font-medium mb-1 transition-transform duration-500 group-hover:scale-110">{{ $cat['name'] }}</h3>
                            <p class="text-label-sm text-white/60 tracking-wider uppercase">{{ $cat['count'] }} Produk</p>
                        </div>
                    </a>
                @endforeach
            @endforelse
        </div>
    </div>
</section>


{{-- ════════════════════════════════════════════════════════════
     SECTION 6: ARTISAN STORY
     Full-width dark cinematic block
     ════════════════════════════════════════════════════════════ --}}
<section class="relative py-32 md:py-40 overflow-hidden">
    <!-- Background -->
    <div class="absolute inset-0 -z-10">
        <img 
            src="https://images.unsplash.com/photo-1555939594-58d7cb561ad1?w=1920&q=80" 
            alt="Pengrajin Bali bekerja" 
            class="w-full h-full object-cover"
            loading="lazy"
        >
        <div class="absolute inset-0 bg-basalt/80"></div>
    </div>

    <div class="max-w-4xl mx-auto px-6 text-center reveal" x-data x-intersect.once="$el.classList.add('revealed')">
        <!-- Quote Mark -->
        <svg class="w-16 h-16 mx-auto text-prada/40 mb-10" fill="currentColor" viewBox="0 0 24 24"><path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z"/></svg>
        
        <blockquote class="font-playfair text-2xl sm:text-3xl md:text-4xl lg:text-5xl text-white italic leading-snug mb-10">
            Saya belajar menenun sejak usia delapan tahun dari nenek saya. Setiap helai benang adalah doa dan harapan.
        </blockquote>
        
        <div class="flex flex-col items-center gap-3">
            <div class="w-16 h-16 rounded-full bg-surface-container overflow-hidden border-2 border-prada/30">
                <img src="https://images.unsplash.com/photo-1544005313-94ddf0286df2?w=200&q=80" alt="Ni Wayan Suartini" class="w-full h-full object-cover" loading="lazy">
            </div>
            <div>
                <p class="text-white font-semibold text-body-md">Ni Wayan Suartini</p>
                <p class="text-white/50 text-body-sm">Penenun Kain Endek — Klungkung, Bali</p>
            </div>
        </div>
    </div>
</section>


{{-- ════════════════════════════════════════════════════════════
     SECTION 7: WHY CHOOSE US
     Minimalist 3-column value propositions
     ════════════════════════════════════════════════════════════ --}}
<section class="py-24 md:py-32 bg-surface-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16 reveal" x-data x-intersect.once="$el.classList.add('revealed')">
            <p class="text-terracotta tracking-[0.2em] uppercase text-label-md mb-3">Mengapa Kami</p>
            <h2 class="font-playfair text-3xl md:text-4xl lg:text-5xl text-basalt">Kenapa Smart UMKM Bali?</h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-12 lg:gap-16">
            @php
                $values = [
                    [
                        'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75m-3-7.036A11.959 11.959 0 0 1 3.598 6 11.99 11.99 0 0 0 3 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285Z"/>',
                        'title' => '100% Autentik',
                        'desc' => 'Setiap produk dijamin autentik langsung dari tangan pengrajin UMKM Bali — tanpa perantara, tanpa imitasi.',
                    ],
                    [
                        'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z"/>',
                        'title' => 'Langsung dari Pengrajin',
                        'desc' => 'Harga yang Anda bayar langsung menjadi penghasilan pengrajin — mendukung ekonomi lokal dan keberlangsungan budaya.',
                    ],
                    [
                        'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z"/>',
                        'title' => 'Transaksi Aman',
                        'desc' => 'Pembayaran terenkripsi dan dilindungi oleh sistem keamanan berlapis. Belanja dengan tenang, tanpa rasa khawatir.',
                    ],
                ];
            @endphp

            @foreach($values as $index => $value)
                <div class="text-center reveal reveal-delay-{{ $index + 1 }}" x-data x-intersect.once="$el.classList.add('revealed')">
                    <div class="w-14 h-14 mx-auto mb-6 flex items-center justify-center">
                        <svg class="w-10 h-10 text-prada" fill="none" stroke="currentColor" stroke-width="1" viewBox="0 0 24 24">{!! $value['icon'] !!}</svg>
                    </div>
                    <h3 class="font-playfair text-xl text-basalt mb-3">{{ $value['title'] }}</h3>
                    <p class="text-body-sm text-basalt-muted leading-relaxed max-w-xs mx-auto">{{ $value['desc'] }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>


{{-- ════════════════════════════════════════════════════════════
     SECTION 8: CULTURAL SPOTLIGHT / BLOG PREVIEW
     Latest articles preview
     ════════════════════════════════════════════════════════════ --}}
@if(isset($latestArticles) && $latestArticles->count() > 0)
<section class="py-24 md:py-32 bg-cream-premium poleng-pattern">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-end justify-between mb-12 reveal" x-data x-intersect.once="$el.classList.add('revealed')">
            <div>
                <p class="text-terracotta tracking-[0.2em] uppercase text-label-md mb-3">Cerita Budaya</p>
                <h2 class="font-playfair text-3xl md:text-4xl lg:text-5xl text-basalt">Dari Hati Pulau Dewata</h2>
            </div>
            <a href="{{ route('blog.index') }}" class="hidden sm:inline-flex items-center gap-2 text-basalt-muted hover:text-terracotta text-body-sm font-medium transition-colors group">
                Semua Cerita
                <svg class="w-4 h-4 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5"/></svg>
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach($latestArticles as $index => $article)
                <a 
                    href="{{ route('blog.show', $article->slug) }}" 
                    class="group reveal reveal-delay-{{ $index + 1 }}"
                    x-data x-intersect.once="$el.classList.add('revealed')"
                >
                    <div class="aspect-[3/2] rounded-lg overflow-hidden mb-5">
                        @if($article->image_path)
                            <img src="{{ Storage::url($article->image_path) }}" alt="{{ $article->title }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" loading="lazy">
                        @else
                            <div class="w-full h-full bg-gradient-to-br from-terracotta/20 to-prada/10"></div>
                        @endif
                    </div>
                    <p class="text-label-sm text-terracotta tracking-wider uppercase mb-2">{{ $article->category->name ?? 'Budaya' }}</p>
                    <h3 class="font-playfair text-xl text-basalt mb-2 group-hover:text-terracotta transition-colors duration-300 line-clamp-2">{{ $article->title }}</h3>
                    <p class="text-body-sm text-basalt-muted line-clamp-2">{{ Str::limit(strip_tags($article->content), 120) }}</p>
                </a>
            @endforeach
        </div>
    </div>
</section>
@endif


{{-- ════════════════════════════════════════════════════════════
     SECTION 9: TESTIMONIALS
     Clean typographic testimonials
     ════════════════════════════════════════════════════════════ --}}
<section class="py-24 md:py-32 bg-surface-white" x-data="{ active: 0 }">
    <div class="max-w-4xl mx-auto px-6 text-center reveal" x-data x-intersect.once="$el.classList.add('revealed')">
        <p class="text-terracotta tracking-[0.2em] uppercase text-label-md mb-10">Kata Mereka</p>

        @php
            $testimonials = [
                [
                    'quote' => 'Kualitas ukiran kayunya luar biasa detail. Bisa merasakan langsung jiwa seni Bali di setiap goresannya. Sangat worth it!',
                    'name' => 'Sarah Anderson',
                    'origin' => 'Melbourne, Australia',
                ],
                [
                    'quote' => 'Kain tenun endek yang saya beli sangat cantik dan berkualitas tinggi. Proses pembeliannya mudah dan pengiriman cepat.',
                    'name' => 'Made Agus Darma',
                    'origin' => 'Jakarta, Indonesia',
                ],
                [
                    'quote' => 'I love supporting local artisans directly. This platform makes it so easy to discover authentic Balinese craftsmanship.',
                    'name' => 'Yuki Tanaka',
                    'origin' => 'Tokyo, Japan',
                ],
            ];
        @endphp

        <div class="relative min-h-[200px]">
            @foreach($testimonials as $index => $testimonial)
                <div x-show="active === {{ $index }}" x-transition:enter="transition ease-out duration-500" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave="transition ease-in duration-300" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="absolute inset-0">
                    <blockquote class="font-playfair text-2xl md:text-3xl lg:text-4xl text-basalt italic leading-relaxed mb-10">
                        "{{ $testimonial['quote'] }}"
                    </blockquote>
                    <p class="text-basalt font-semibold">{{ $testimonial['name'] }}</p>
                    <p class="text-basalt-muted text-body-sm">{{ $testimonial['origin'] }}</p>
                </div>
            @endforeach
        </div>

        <!-- Dots -->
        <div class="flex items-center justify-center gap-3 mt-8">
            @foreach($testimonials as $index => $t)
                <button @click="active = {{ $index }}" :class="active === {{ $index }} ? 'bg-terracotta w-8' : 'bg-basalt/20 w-2'" class="h-2 rounded-full transition-all duration-300" aria-label="Testimonial {{ $index + 1 }}"></button>
            @endforeach
        </div>
    </div>
</section>


{{-- ════════════════════════════════════════════════════════════
     SECTION 10: MERCHANT CTA
     Full-width terracotta recruitment banner
     ════════════════════════════════════════════════════════════ --}}
<section class="relative py-24 md:py-32 bg-terracotta overflow-hidden">
    <!-- Subtle pattern overlay -->
    <div class="absolute inset-0 opacity-5">
        <div class="w-full h-full" style="background-image: url('data:image/svg+xml,<svg width=\"60\" height=\"60\" viewBox=\"0 0 60 60\" xmlns=\"http://www.w3.org/2000/svg\"><g fill=\"none\" fill-rule=\"evenodd\"><g fill=\"%23ffffff\" fill-opacity=\"1\"><path d=\"M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\"/></g></g></svg>');"></div>
    </div>

    <div class="relative max-w-3xl mx-auto px-6 text-center reveal" x-data x-intersect.once="$el.classList.add('revealed')">
        <p class="text-white/60 tracking-[0.3em] uppercase text-label-md mb-6">Untuk Pelaku UMKM</p>
        <h2 class="font-playfair text-3xl md:text-4xl lg:text-5xl text-white leading-tight mb-6">
            Bawa Karya Anda<br>ke <em class="italic">Panggung Dunia</em>
        </h2>
        <p class="text-white/70 text-body-lg max-w-xl mx-auto mb-10 leading-relaxed">
            Bergabunglah dengan ratusan pengrajin Bali lainnya. Kelola toko, jangkau pelanggan baru, dan ceritakan kisah di balik produk Anda.
        </p>
        <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
            <a href="{{ route('register') }}" class="px-10 py-4 bg-white text-terracotta rounded-full font-bold text-body-md tracking-wide hover:bg-cream-premium transition-all duration-300 hover:shadow-lg">
                Daftar Sebagai Merchant
            </a>
            <a href="{{ route('login') }}" class="px-10 py-4 bg-transparent border border-white/30 text-white rounded-full font-semibold text-body-md tracking-wide hover:bg-white/10 transition-all duration-300">
                Sudah Punya Akun
            </a>
        </div>
    </div>
</section>

@endsection

@push('scripts')
<script>
    // Auto-rotate testimonials
    document.addEventListener('alpine:init', () => {
        setInterval(() => {
            const el = document.querySelector('[x-data="{ active: 0 }"]');
            if (el && el.__x) {
                el.__x.$data.active = (el.__x.$data.active + 1) % 3;
            }
        }, 6000);
    });
</script>
@endpush
