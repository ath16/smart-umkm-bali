@extends('layouts.public')

@section('title', $product->name)

@section('meta')
    <meta name="description" content="{{ $product->description ?? 'Beli ' . $product->name . ' dari toko ' . $product->store->name }}">
    
    <!-- Open Graph -->
    <meta property="og:type" content="product" />
    <meta property="og:title" content="{{ $product->name }} | Smart UMKM Bali" />
    <meta property="og:description" content="{{ $product->description ?? 'Dapatkan produk lokal terbaik dari Bali.' }}" />
    @if($product->images->count() > 0)
    <meta property="og:image" content="{{ imageUrl($product->images->first()->image_url ?? null, 'large') }}" />
    @endif
    <meta property="og:url" content="{{ request()->url() }}" />
    
    <!-- Twitter -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $product->name }}">
    <meta name="twitter:description" content="{{ $product->description ?? 'Dapatkan produk lokal terbaik dari Bali.' }}">
    @if($product->images->count() > 0)
    <meta name="twitter:image" content="{{ imageUrl($product->images->first()->image_url ?? null, 'large') }}">
    @endif
@endsection

@section('content')
<div class="bg-surface-white">

    {{-- ── Breadcrumb ── --}}
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-6 pb-2">
        <nav class="flex text-body-sm text-basalt-muted" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-2">
                <li><a href="{{ route('landing') }}" class="hover:text-terracotta transition-colors">Beranda</a></li>
                <li><span class="mx-1 text-basalt/20">/</span></li>
                <li><a href="{{ route('products.index') }}" class="hover:text-terracotta transition-colors">Produk</a></li>
                @if($product->category)
                <li><span class="mx-1 text-basalt/20">/</span></li>
                <li><a href="{{ route('products.index', ['category' => $product->category->slug]) }}" class="hover:text-terracotta transition-colors">{{ $product->category->name }}</a></li>
                @endif
                <li><span class="mx-1 text-basalt/20">/</span></li>
                <li class="text-basalt font-medium truncate max-w-[180px]">{{ $product->name }}</li>
            </ol>
        </nav>
    </div>

    {{-- ═══════════════════════════════════════════
         MAIN PDP: Gallery Left + Sticky Info Right
         ═══════════════════════════════════════════ --}}
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-16 md:pb-24">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-16 pt-6">

            {{-- ── Left: Image Gallery (Scrollable Stack) ── --}}
            <div class="lg:col-span-7" x-data="{ activeImage: 0 }">
                {{-- Main Image (Mobile: Swipe Carousel) --}}
                <div class="lg:hidden">
                    <div class="flex overflow-x-auto snap-x snap-mandatory hide-scrollbar gap-2 rounded-lg">
                        @if($product->images && $product->images->count() > 0)
                            @foreach($product->images as $index => $img)
                                <div class="snap-center shrink-0 w-full aspect-[4/5] bg-surface-container rounded-lg overflow-hidden">
                                    <img src="{{ imageUrl($img->image_url, 'large') }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                                </div>
                            @endforeach
                        @else
                            <div class="w-full aspect-[4/5] bg-surface-container rounded-lg flex items-center justify-center text-basalt/10">
                                <svg class="w-24 h-24" fill="none" stroke="currentColor" stroke-width="0.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z"/></svg>
                            </div>
                        @endif
                    </div>
                    {{-- Image dots --}}
                    @if($product->images && $product->images->count() > 1)
                        <div class="flex justify-center gap-1.5 mt-3">
                            @foreach($product->images as $i => $img)
                                <span class="w-1.5 h-1.5 rounded-full {{ $i === 0 ? 'bg-basalt' : 'bg-basalt/20' }}"></span>
                            @endforeach
                        </div>
                    @endif
                </div>

                {{-- Desktop: Stacked vertical images (Apple Store style) --}}
                <div class="hidden lg:flex flex-col gap-3">
                    @if($product->images && $product->images->count() > 0)
                        @foreach($product->images as $img)
                            <div class="aspect-[4/5] bg-surface-container rounded-lg overflow-hidden">
                                <img src="{{ imageUrl($img->image_url, 'thumbnail') }}" alt="{{ $product->name }}" class="w-full h-full object-cover hover:scale-[1.02] transition-transform duration-700 ease-out" loading="lazy">
                            </div>
                        @endforeach
                    @else
                        <div class="aspect-[4/5] bg-surface-container rounded-lg flex items-center justify-center text-basalt/10">
                            <svg class="w-32 h-32" fill="none" stroke="currentColor" stroke-width="0.3" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z"/></svg>
                        </div>
                    @endif
                </div>
            </div>

            {{-- ── Right: Sticky Product Info ── --}}
            <div class="lg:col-span-5">
                <div class="lg:sticky lg:top-28">
                    {{-- Category --}}
                    <p class="text-label-md text-terracotta tracking-[0.15em] uppercase mb-3">{{ $product->category->name ?? 'Produk Bali' }}</p>
                    
                    {{-- Product Name --}}
                    <h1 class="font-playfair text-3xl md:text-4xl text-basalt leading-tight mb-4">{{ $product->name }}</h1>
                    
                    {{-- Price --}}
                    <div class="flex items-baseline gap-3 mb-8">
                        <span class="text-2xl font-semibold text-basalt">{{ $product->formatted_sell_price }}</span>
                        @if($product->stock > 0)
                            <span class="text-body-sm text-forest">Stok tersedia</span>
                        @else
                            <span class="text-body-sm text-error">Stok habis</span>
                        @endif
                    </div>

                    {{-- Divider --}}
                    <div class="h-px bg-outline/30 mb-8"></div>

                    {{-- Add to Cart --}}
                    <form action="{{ route('cart.store') }}" method="POST" class="mb-8" x-data="{ qty: 1 }">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        
                        {{-- Quantity --}}
                        <div class="flex items-center gap-4 mb-4">
                            <span class="text-body-sm font-medium text-basalt">Jumlah</span>
                            <div class="inline-flex items-center border border-outline/50 rounded-full overflow-hidden">
                                <button type="button" @click="qty = Math.max(1, qty - 1)" class="w-10 h-10 flex items-center justify-center text-basalt hover:bg-surface transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14"/></svg>
                                </button>
                                <input type="number" name="quantity" x-model="qty" min="1" max="{{ $product->stock }}" class="w-12 text-center border-none focus:ring-0 text-body-md font-semibold bg-transparent">
                                <button type="button" @click="qty = Math.min({{ $product->stock }}, qty + 1)" class="w-10 h-10 flex items-center justify-center text-basalt hover:bg-surface transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/></svg>
                                </button>
                            </div>
                        </div>

                        <button type="submit" {{ $product->stock > 0 ? '' : 'disabled' }} class="w-full py-4 rounded-full font-semibold text-body-md tracking-wide transition-all duration-300
                            {{ $product->stock > 0 
                                ? 'bg-terracotta text-white hover:bg-terracotta-dark shadow-sm hover:shadow-lg hover:shadow-terracotta/20' 
                                : 'bg-surface-container text-basalt-muted cursor-not-allowed' }}">
                            {{ $product->stock > 0 ? 'Tambahkan ke Keranjang' : 'Stok Habis' }}
                        </button>
                    </form>

                    {{-- Accordion Details --}}
                    <div class="space-y-0 border-t border-outline/30" x-data="{ open: 'desc' }">
                        {{-- Description --}}
                        <div class="border-b border-outline/30">
                            <button @click="open = open === 'desc' ? '' : 'desc'" class="w-full flex items-center justify-between py-5 text-left">
                                <span class="font-semibold text-body-md text-basalt">Deskripsi</span>
                                <svg :class="open === 'desc' ? 'rotate-180' : ''" class="w-4 h-4 text-basalt-muted transition-transform duration-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5"/></svg>
                            </button>
                            <div x-show="open === 'desc'" x-collapse class="pb-5">
                                <p class="text-body-md text-basalt-muted leading-relaxed">{{ $product->description ?? 'Produk autentik buatan tangan dari pengrajin UMKM Bali.' }}</p>
                            </div>
                        </div>

                        {{-- Shipping --}}
                        <div class="border-b border-outline/30">
                            <button @click="open = open === 'ship' ? '' : 'ship'" class="w-full flex items-center justify-between py-5 text-left">
                                <span class="font-semibold text-body-md text-basalt">Pengiriman</span>
                                <svg :class="open === 'ship' ? 'rotate-180' : ''" class="w-4 h-4 text-basalt-muted transition-transform duration-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5"/></svg>
                            </button>
                            <div x-show="open === 'ship'" x-collapse class="pb-5">
                                <p class="text-body-md text-basalt-muted leading-relaxed">Pengiriman dari {{ $product->store->address ?? 'Bali' }}. Estimasi 2-5 hari kerja untuk wilayah Indonesia.</p>
                            </div>
                        </div>

                        {{-- Care --}}
                        <div class="border-b border-outline/30">
                            <button @click="open = open === 'care' ? '' : 'care'" class="w-full flex items-center justify-between py-5 text-left">
                                <span class="font-semibold text-body-md text-basalt">Perawatan Produk</span>
                                <svg :class="open === 'care' ? 'rotate-180' : ''" class="w-4 h-4 text-basalt-muted transition-transform duration-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5"/></svg>
                            </button>
                            <div x-show="open === 'care'" x-collapse class="pb-5">
                                <p class="text-body-md text-basalt-muted leading-relaxed">Simpan di tempat kering dan tidak lembap. Untuk produk kain, sebaiknya cuci tangan dengan deterjen lembut.</p>
                            </div>
                        </div>
                    </div>

                    {{-- Store Info (Artisan Block) --}}
                    <div class="mt-8 p-6 bg-cream-premium rounded-lg">
                        <div class="flex items-center gap-4 mb-4">
                            <div class="w-14 h-14 rounded-full bg-surface-white border border-outline/30 flex items-center justify-center overflow-hidden shadow-sm">
                                @if($product->store->setting && $product->store->setting->logo_path)
                                    <img src="{{ imageUrl($product->store->setting->logo_url ?? null, 'thumbnail') }}" alt="{{ $product->store->name }}" class="w-full h-full object-cover">
                                @else
                                    <span class="font-playfair font-bold text-xl text-terracotta">{{ substr($product->store->name, 0, 1) }}</span>
                                @endif
                            </div>
                            <div>
                                <p class="text-label-sm text-basalt-muted mb-0.5">Dibuat oleh</p>
                                <p class="font-playfair font-semibold text-lg text-basalt">{{ $product->store->name }}</p>
                            </div>
                        </div>
                        <p class="text-body-sm text-basalt-muted leading-relaxed mb-4">{{ $product->store->description ?? 'Pengrajin lokal Bali yang berdedikasi menghasilkan karya tangan berkualitas tinggi.' }}</p>
                        <a href="{{ route('catalog.show', $product->store->slug) }}" class="inline-flex items-center gap-2 text-terracotta font-semibold text-body-sm hover:gap-3 transition-all duration-300 group">
                            Kunjungi Toko
                            <svg class="w-4 h-4 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5"/></svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ── Reviews Section ── --}}
    <div class="border-t border-outline/20 bg-cream-premium">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 md:py-24">
            <h2 class="font-playfair text-2xl md:text-3xl text-basalt mb-10">Ulasan Pelanggan</h2>
            @if(isset($reviews) && $reviews->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    @foreach($reviews as $review)
                        <div class="bg-surface-white rounded-lg p-6 border border-outline/30">
                            <div class="flex items-center gap-3 mb-4">
                                <div class="w-10 h-10 rounded-full bg-terracotta/10 flex items-center justify-center">
                                    <span class="font-semibold text-terracotta text-sm">{{ substr($review->user->name, 0, 1) }}</span>
                                </div>
                                <div>
                                    <p class="font-semibold text-basalt text-body-sm">{{ $review->user->name }}</p>
                                    <div class="flex items-center gap-0.5">
                                        @for($i = 1; $i <= 5; $i++)
                                            <svg class="w-3.5 h-3.5 {{ $i <= $review->rating ? 'text-prada fill-current' : 'text-outline stroke-current fill-transparent' }}" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 0 1 1.04 0l2.125 5.111a.563.563 0 0 0 .475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 0 0-.182.557l1.285 5.385a.562.562 0 0 1-.84.61l-4.725-2.885a.562.562 0 0 0-.586 0L6.982 20.54a.562.562 0 0 1-.84-.61l1.285-5.386a.562.562 0 0 0-.182-.557l-4.204-3.602a.562.562 0 0 1 .321-.988l5.518-.442a.563.563 0 0 0 .475-.345L11.48 3.5Z"/></svg>
                                        @endfor
                                    </div>
                                </div>
                                <span class="ml-auto text-label-sm text-basalt-muted">{{ $review->created_at->diffForHumans() }}</span>
                            </div>
                            <p class="text-body-md text-basalt-muted leading-relaxed">{{ $review->comment }}</p>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-10">
                    <p class="text-basalt-muted text-body-md">Belum ada ulasan. Jadilah yang pertama memberikan ulasan!</p>
                </div>
            @endif
        </div>
    </div>

    {{-- ── Similar Products ── --}}
    @if(isset($similarProducts) && $similarProducts->count() > 0)
    <div class="border-t border-outline/20 bg-surface-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 md:py-24">
            <div class="flex items-end justify-between mb-10">
                <h2 class="font-playfair text-2xl md:text-3xl text-basalt">Produk Serupa</h2>
                <a href="{{ route('products.index', ['category' => $product->category->slug ?? '']) }}" class="hidden sm:inline-flex items-center gap-2 text-basalt-muted hover:text-terracotta text-body-sm font-medium transition-colors group">
                    Lihat Semua
                    <svg class="w-4 h-4 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5"/></svg>
                </a>
            </div>
            <div class="flex overflow-x-auto snap-x snap-mandatory hide-scrollbar gap-5 pb-4 -mx-4 px-4">
                @foreach($similarProducts as $simProduct)
                    <a href="{{ route('products.show', $simProduct->slug ?? $simProduct->id) }}" class="snap-start shrink-0 w-[65vw] sm:w-[40vw] md:w-[28vw] lg:w-[22vw] group">
                        <div class="aspect-[4/5] bg-surface-container rounded-lg overflow-hidden mb-4">
                            @if($simProduct->images && $simProduct->images->count() > 0)
                                <img src="{{ imageUrl($simProduct->images->where('is_primary', true)->first()->image_url ?? $simProduct->images->first()->image_url ?? null, 'product_card') }}" alt="{{ $simProduct->name }}" class="w-full h-full object-cover transition-transform duration-700 ease-out group-hover:scale-105" loading="lazy">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-basalt/10">
                                    <svg class="w-12 h-12" fill="none" stroke="currentColor" stroke-width="0.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z"/></svg>
                                </div>
                            @endif
                        </div>
                        <p class="text-label-sm text-terracotta/80 tracking-wider uppercase mb-1">{{ $simProduct->category->name ?? '' }}</p>
                        <h3 class="font-playfair text-base text-basalt mb-1 group-hover:text-terracotta transition-colors duration-300 line-clamp-2">{{ $simProduct->name }}</h3>
                        <p class="font-semibold text-basalt">{{ $simProduct->formatted_sell_price }}</p>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
    @endif
</div>

{{-- ── Mobile Sticky Bottom Bar ── --}}
<div class="lg:hidden fixed bottom-0 left-0 right-0 z-40 bg-surface-white/95 backdrop-blur-lg border-t border-outline/30 px-4 py-3 flex items-center gap-3">
    <div class="flex-1">
        <p class="text-label-sm text-basalt-muted">{{ $product->category->name ?? 'Produk Bali' }}</p>
        <p class="font-semibold text-basalt text-lg">{{ $product->formatted_sell_price }}</p>
    </div>
    <form action="{{ route('cart.store') }}" method="POST">
        @csrf
        <input type="hidden" name="product_id" value="{{ $product->id }}">
        <input type="hidden" name="quantity" value="1">
        <button type="submit" {{ $product->stock > 0 ? '' : 'disabled' }} class="px-8 py-3 rounded-full font-semibold text-body-sm
            {{ $product->stock > 0 
                ? 'bg-terracotta text-white hover:bg-terracotta-dark shadow-sm' 
                : 'bg-surface-container text-basalt-muted cursor-not-allowed' }}">
            {{ $product->stock > 0 ? 'Keranjang' : 'Habis' }}
        </button>
    </form>
</div>
@endsection
