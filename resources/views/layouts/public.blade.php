<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Smart UMKM Bali') }} — @yield('title')</title>
        <meta name="description" content="Marketplace premium produk UMKM Bali — temukan karya tangan autentik dari pengrajin lokal.">
        
        @yield('meta')

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600&family=Plus+Jakarta+Sans:wght@400;500;600;700&family=Space+Grotesk:wght@500;600;700&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-body text-text-primary antialiased bg-surface selection:bg-prada/20 selection:text-prada-dark">

        {{-- Determine if navbar should be transparent (landing page only) --}}
        @php $transparentNav = $transparentNav ?? false; @endphp

        <!-- Navbar -->
        <nav 
            x-data="{ 
                open: false, 
                scrolled: false,
                transparent: {{ $transparentNav ? 'true' : 'false' }},
                get navClass() {
                    if (!this.transparent) return 'bg-surface-white/95 backdrop-blur-lg border-b border-outline shadow-sm';
                    return this.scrolled 
                        ? 'bg-surface-white/95 backdrop-blur-lg shadow-sm border-b border-outline/50' 
                        : 'bg-transparent border-b border-transparent';
                },
                get textClass() {
                    if (!this.transparent) return 'text-text-primary';
                    return this.scrolled ? 'text-text-primary' : 'text-white';
                },
                get linkHoverClass() {
                    if (!this.transparent) return 'hover:text-primary';
                    return this.scrolled ? 'hover:text-primary' : 'hover:text-white/80';
                }
            }"
            @scroll.window="scrolled = window.scrollY > 80"
            :class="navClass"
            class="fixed top-0 w-full z-50 transition-all duration-500 ease-in-out"
        >
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-20">
                    <div class="flex">
                        <!-- Logo -->
                        <div class="shrink-0 flex items-center">
                            <a href="{{ route('landing') }}" class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-xl bg-terracotta flex items-center justify-center shadow-lg shadow-terracotta/30">
                                    <span class="font-playfair font-bold text-xl text-white">S</span>
                                </div>
                                <span :class="textClass" class="font-playfair font-semibold text-lg hidden sm:block transition-colors duration-500">Smart UMKM Bali</span>
                            </a>
                        </div>

                        <!-- Navigation Links -->
                        <div class="hidden sm:-my-px sm:ms-10 sm:flex sm:space-x-1">
                            @php
                                $navLinks = [
                                    ['route' => 'landing', 'label' => 'Beranda', 'match' => 'landing'],
                                    ['route' => 'store.index', 'label' => 'Toko', 'match' => 'store.*,catalog.*'],
                                    ['route' => 'products.index', 'label' => 'Produk', 'match' => 'products.*'],
                                    ['route' => 'blog.index', 'label' => 'Cerita', 'match' => 'blog.*'],
                                    ['route' => 'about', 'label' => 'Tentang', 'match' => 'about'],
                                ];
                            @endphp
                            @foreach($navLinks as $link)
                                @php $isActive = request()->routeIs(...explode(',', $link['match'])); @endphp
                                <a 
                                    href="{{ route($link['route']) }}" 
                                    :class="textClass"
                                    class="inline-flex items-center px-3 py-2 text-body-sm font-medium transition-all duration-300 rounded-md
                                        {{ $isActive ? 'font-semibold' : 'opacity-80 hover:opacity-100' }}"
                                >
                                    {{ $link['label'] }}
                                    @if($isActive)
                                        <span class="block w-1 h-1 rounded-full bg-current ml-1.5"></span>
                                    @endif
                                </a>
                            @endforeach
                        </div>
                    </div>

                    <!-- Global Search Bar -->
                    <div class="hidden md:flex flex-1 items-center justify-center px-6" x-data="globalSearch()">
                        <div class="w-full max-w-sm relative" @click.away="isOpen = false">
                            <form action="{{ route('products.index') }}" method="GET" class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-4 w-4 opacity-60" fill="none" viewBox="0 0 24 24" stroke="currentColor" :class="textClass">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                    </svg>
                                </div>
                                <input 
                                    type="text" 
                                    name="search"
                                    x-model="query"
                                    @input.debounce.300ms="fetchResults"
                                    @focus="isOpen = true"
                                    :class="transparent && !scrolled 
                                        ? 'bg-white/10 border-white/20 text-white placeholder-white/50 focus:bg-white/20 focus:border-white/40' 
                                        : 'bg-surface border-outline text-text-primary placeholder-on-surface-variant focus:border-primary focus:ring-1 focus:ring-primary'"
                                    class="block w-full pl-10 pr-3 py-2 border rounded-full text-sm transition-all duration-500"
                                    placeholder="Cari produk..."
                                    autocomplete="off"
                                >
                            </form>

                            <!-- Autocomplete Dropdown -->
                            <div 
                                x-show="isOpen && (results.length > 0 || isLoading)" 
                                x-transition:enter="transition ease-out duration-100"
                                x-transition:enter-start="transform opacity-0 scale-95"
                                x-transition:enter-end="transform opacity-100 scale-100"
                                x-transition:leave="transition ease-in duration-75"
                                x-transition:leave-start="transform opacity-100 scale-100"
                                x-transition:leave-end="transform opacity-0 scale-95"
                                class="absolute mt-2 w-full bg-white shadow-dropdown rounded-xl py-1 text-base ring-1 ring-black/5 overflow-auto max-h-60 z-50"
                                style="display: none;"
                            >
                                <div x-show="isLoading" class="px-4 py-3 text-sm text-on-surface-variant text-center">
                                    Mencari...
                                </div>
                                <template x-for="item in results" :key="item.id">
                                    <a :href="item.url" class="group flex items-center px-4 py-2.5 hover:bg-surface-container transition-colors">
                                        <div class="flex-shrink-0 h-10 w-10 bg-surface-container rounded-md overflow-hidden">
                                            <img x-show="item.image" :src="item.image" class="h-10 w-10 object-cover" alt="">
                                            <div x-show="!item.image" class="h-10 w-10 flex items-center justify-center text-on-surface-variant">
                                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                                            </div>
                                        </div>
                                        <div class="ml-3 flex-1 overflow-hidden">
                                            <p class="text-sm font-medium text-text-primary truncate" x-text="item.name"></p>
                                            <p class="text-xs text-on-surface-variant truncate" x-text="item.store"></p>
                                        </div>
                                        <div class="ml-2 flex-shrink-0 text-sm font-semibold text-terracotta">
                                            <span x-text="item.price"></span>
                                        </div>
                                    </a>
                                </template>
                            </div>
                        </div>
                    </div>

                    <div class="hidden sm:flex sm:items-center sm:ms-6 gap-3">
                        @auth
                            <a href="{{ route('cart.index') }}" class="relative p-2 transition-colors duration-300" :class="textClass">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z"/></svg>
                                @php
                                    $cartCount = \App\Models\Cart::where('user_id', auth()->id())->first()?->items()->sum('quantity') ?? 0;
                                @endphp
                                @if($cartCount > 0)
                                    <span class="absolute -top-0.5 -right-0.5 inline-flex items-center justify-center w-5 h-5 text-[10px] font-bold text-white bg-terracotta rounded-full">{{ $cartCount }}</span>
                                @endif
                            </a>
                            <a href="{{ route('dashboard') }}" :class="textClass" class="text-body-sm font-semibold transition-colors duration-300 hover:opacity-80">Dasbor</a>
                        @else
                            <a href="{{ route('login') }}" :class="textClass" class="text-body-sm font-medium transition-colors duration-300 hover:opacity-80">Masuk</a>
                            <a href="{{ route('register') }}" class="inline-flex items-center px-5 py-2 bg-terracotta border border-transparent rounded-full font-semibold text-label-md text-white hover:bg-terracotta-dark transition-all duration-300 shadow-sm hover:shadow-md">
                                Daftar
                            </a>
                        @endauth
                    </div>

                    <!-- Hamburger -->
                    <div class="-me-2 flex items-center sm:hidden">
                        <button @click="open = ! open" :class="textClass" class="inline-flex items-center justify-center p-2 rounded-md transition duration-300">
                            <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                                <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Responsive Navigation Menu -->
            <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-white/95 backdrop-blur-lg border-t border-outline/30">
                <div class="pt-4 pb-3 space-y-1 px-4">
                    <a href="{{ route('landing') }}" class="block px-4 py-2.5 text-base font-medium rounded-lg {{ request()->routeIs('landing') ? 'bg-terracotta/10 text-terracotta font-semibold' : 'text-basalt hover:bg-surface' }}">Beranda</a>
                    <a href="{{ route('store.index') }}" class="block px-4 py-2.5 text-base font-medium rounded-lg {{ request()->routeIs('store.*', 'catalog.*') ? 'bg-terracotta/10 text-terracotta font-semibold' : 'text-basalt hover:bg-surface' }}">Toko</a>
                    <a href="{{ route('products.index') }}" class="block px-4 py-2.5 text-base font-medium rounded-lg {{ request()->routeIs('products.*') ? 'bg-terracotta/10 text-terracotta font-semibold' : 'text-basalt hover:bg-surface' }}">Produk</a>
                    <a href="{{ route('about') }}" class="block px-4 py-2.5 text-base font-medium rounded-lg {{ request()->routeIs('about') ? 'bg-terracotta/10 text-terracotta font-semibold' : 'text-basalt hover:bg-surface' }}">Tentang</a>
                </div>

                <div class="pt-3 pb-4 border-t border-outline/30 px-4 space-y-2">
                    @auth
                        <a href="{{ route('cart.index') }}" class="block text-center w-full px-4 py-2.5 border border-outline text-basalt rounded-full font-semibold">
                            Keranjang ({{ \App\Models\Cart::where('user_id', auth()->id())->first()?->items()->sum('quantity') ?? 0 }})
                        </a>
                        <a href="{{ route('dashboard') }}" class="block text-center w-full px-4 py-2.5 bg-terracotta text-white rounded-full font-semibold">Dasbor</a>
                    @else
                        <a href="{{ route('login') }}" class="block text-center w-full px-4 py-2.5 border border-outline text-basalt rounded-full font-semibold">Masuk</a>
                        <a href="{{ route('register') }}" class="block text-center w-full px-4 py-2.5 bg-terracotta text-white rounded-full font-semibold">Daftar</a>
                    @endauth
                </div>
            </div>
        </nav>

        {{-- Spacer for fixed navbar (only on non-transparent pages) --}}
        @unless($transparentNav)
            <div class="h-20"></div>
        @endunless

        <main>
            @yield('content')
        </main>

        <!-- Premium Footer -->
        <footer class="bg-basalt text-white/70">
            <!-- Patra Gold Divider -->
            <div class="h-px bg-gradient-to-r from-transparent via-prada to-transparent"></div>
            
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-20 pb-12">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 mb-16">
                    <!-- Brand Column -->
                    <div class="lg:col-span-1">
                        <div class="flex items-center gap-3 mb-6">
                            <div class="w-10 h-10 rounded-xl bg-terracotta flex items-center justify-center">
                                <span class="font-playfair font-bold text-xl text-white">S</span>
                            </div>
                            <span class="font-playfair font-semibold text-lg text-white">Smart UMKM Bali</span>
                        </div>
                        <p class="text-body-sm text-white/50 mb-8 leading-relaxed max-w-xs">Marketplace premium karya tangan Bali. Menghubungkan pengrajin lokal dengan dunia.</p>
                        <div class="flex space-x-4">
                            <a href="#" class="text-white/40 hover:text-prada transition-colors duration-300" aria-label="Instagram">
                                <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z" clip-rule="evenodd" /></svg>
                            </a>
                            <a href="#" class="text-white/40 hover:text-prada transition-colors duration-300" aria-label="Facebook">
                                <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" clip-rule="evenodd" /></svg>
                            </a>
                        </div>
                    </div>
                    
                    <!-- Quick Links -->
                    <div>
                        <h3 class="text-label-md font-semibold text-white uppercase tracking-widest mb-6">Jelajahi</h3>
                        <ul class="space-y-3">
                            <li><a href="{{ route('products.index') }}" class="text-body-sm text-white/50 hover:text-prada transition-colors duration-300">Semua Produk</a></li>
                            <li><a href="{{ route('store.index') }}" class="text-body-sm text-white/50 hover:text-prada transition-colors duration-300">Toko UMKM</a></li>
                            <li><a href="{{ route('blog.index') }}" class="text-body-sm text-white/50 hover:text-prada transition-colors duration-300">Cerita Budaya</a></li>
                            <li><a href="{{ route('about') }}" class="text-body-sm text-white/50 hover:text-prada transition-colors duration-300">Tentang Kami</a></li>
                        </ul>
                    </div>
                    
                    <!-- Support -->
                    <div>
                        <h3 class="text-label-md font-semibold text-white uppercase tracking-widest mb-6">Bantuan</h3>
                        <ul class="space-y-3">
                            <li><a href="{{ route('login') }}" class="text-body-sm text-white/50 hover:text-prada transition-colors duration-300">Masuk Merchant</a></li>
                            <li><a href="{{ route('register') }}" class="text-body-sm text-white/50 hover:text-prada transition-colors duration-300">Daftar Pembeli</a></li>
                            <li><a href="{{ route('contact') }}" class="text-body-sm text-white/50 hover:text-prada transition-colors duration-300">Hubungi Kami</a></li>
                        </ul>
                    </div>

                    <!-- Newsletter -->
                    <div>
                        <h3 class="text-label-md font-semibold text-white uppercase tracking-widest mb-6">Newsletter</h3>
                        <p class="text-body-sm text-white/50 mb-4">Dapatkan info terbaru produk & cerita UMKM Bali.</p>
                        <form class="flex gap-2">
                            <input type="email" placeholder="Email Anda" class="flex-1 bg-white/5 border border-white/10 rounded-full px-4 py-2 text-sm text-white placeholder-white/30 focus:outline-none focus:border-prada/50 focus:ring-1 focus:ring-prada/30 transition-colors">
                            <button type="button" class="px-4 py-2 bg-prada text-basalt text-sm font-semibold rounded-full hover:bg-prada-light transition-colors">Kirim</button>
                        </form>
                    </div>
                </div>
                
                <!-- Bottom Bar -->
                <div class="border-t border-white/10 pt-8 flex flex-col md:flex-row justify-between items-center gap-4">
                    <p class="text-body-sm text-white/30">&copy; {{ date('Y') }} Smart UMKM Bali. Hak cipta dilindungi.</p>
                    <p class="text-body-sm text-white/30 flex items-center gap-1.5">
                        Dibuat dengan
                        <svg class="w-4 h-4 text-terracotta" fill="currentColor" viewBox="0 0 24 24"><path d="M11.645 20.91l-.007-.003-.022-.012a15.247 15.247 0 01-.383-.218 25.18 25.18 0 01-4.244-3.17C4.688 15.36 2.25 12.174 2.25 8.25 2.25 5.322 4.714 3 7.688 3A5.5 5.5 0 0112 5.052 5.5 5.5 0 0116.313 3c2.973 0 5.437 2.322 5.437 5.25 0 3.925-2.438 7.111-4.739 9.256a25.175 25.175 0 01-4.244 3.17 15.247 15.247 0 01-.383.219l-.022.012-.007.004-.003.001a.752.752 0 01-.704 0l-.003-.001z"/></svg>
                        untuk UMKM Bali
                    </p>
                </div>
            </div>
        </footer>

        <!-- Global Search Logic -->
        <script>
            document.addEventListener('alpine:init', () => {
                Alpine.data('globalSearch', () => ({
                    isOpen: false,
                    query: '',
                    results: [],
                    isLoading: false,

                    async fetchResults() {
                        if (this.query.trim() === '') {
                            this.results = [];
                            this.isOpen = false;
                            return;
                        }

                        this.isLoading = true;
                        this.isOpen = true;

                        try {
                            const response = await fetch(`/api/search/autocomplete?q=${encodeURIComponent(this.query)}`);
                            const data = await response.json();
                            this.results = data.data;
                        } catch (error) {
                            console.error('Search failed', error);
                            this.results = [];
                        } finally {
                            this.isLoading = false;
                        }
                    }
                }));
            });
        </script>

        {{-- Flash Messages (Toast Notifications) --}}
        @if(session()->has('success') || session()->has('error'))
            <div 
                x-data="{ show: true }" 
                x-init="setTimeout(() => show = false, 5000)"
                x-show="show"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                class="fixed bottom-4 right-4 sm:top-24 sm:bottom-auto sm:right-8 z-[100] max-w-sm w-full"
                style="display: none;"
            >
                @if(session()->has('success'))
                    <div class="bg-surface-white border border-outline/30 rounded-xl shadow-premium p-4 flex items-start gap-4">
                        <div class="w-10 h-10 rounded-full bg-green-500/10 flex items-center justify-center shrink-0">
                            <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5"/></svg>
                        </div>
                        <div class="flex-1 pt-1">
                            <h4 class="text-body-md font-semibold text-basalt mb-0.5">Berhasil</h4>
                            <p class="text-body-sm text-basalt-muted">{{ session('success') }}</p>
                        </div>
                        <button @click="show = false" class="text-basalt-muted hover:text-basalt p-1 transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12"/></svg>
                        </button>
                    </div>
                @endif
                @if(session()->has('error'))
                    <div class="bg-surface-white border border-outline/30 rounded-xl shadow-premium p-4 flex items-start gap-4 mt-2">
                        <div class="w-10 h-10 rounded-full bg-error/10 flex items-center justify-center shrink-0">
                            <svg class="w-5 h-5 text-error" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                        </div>
                        <div class="flex-1 pt-1">
                            <h4 class="text-body-md font-semibold text-basalt mb-0.5">Terjadi Kesalahan</h4>
                            <p class="text-body-sm text-basalt-muted">{{ session('error') }}</p>
                        </div>
                        <button @click="show = false" class="text-basalt-muted hover:text-basalt p-1 transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12"/></svg>
                        </button>
                    </div>
                @endif
            </div>
        @endif

        @stack('scripts')
    </body>
</html>
