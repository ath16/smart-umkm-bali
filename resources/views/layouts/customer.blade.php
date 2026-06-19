<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Smart UMKM Bali') }} — @yield('title', 'Akun Saya')</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;1,400&family=Plus+Jakarta+Sans:wght@400;500;600;700&family=Space+Grotesk:wght@500;600;700&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-body text-text-primary antialiased bg-cream-premium selection:bg-prada/20" x-data="{ sidebarOpen: false }">
        <div class="min-h-screen flex">
            <!-- Sidebar Overlay (Mobile) -->
            <div x-show="sidebarOpen" x-transition:enter="transition-opacity ease-linear duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition-opacity ease-linear duration-300" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 z-40 bg-basalt/30 backdrop-blur-sm lg:hidden" @click="sidebarOpen = false" style="display:none"></div>

            <!-- Sidebar -->
            <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'" class="fixed inset-y-0 left-0 z-50 w-72 bg-surface-white border-r border-outline/30 flex flex-col transition-transform duration-300 lg:translate-x-0 lg:static lg:z-auto">
                <!-- Logo -->
                <div class="h-20 flex items-center px-6 border-b border-outline/20">
                    <a href="{{ route('landing') }}" class="flex items-center gap-3">
                        <div class="w-9 h-9 rounded-xl bg-terracotta flex items-center justify-center">
                            <span class="font-playfair font-bold text-lg text-white">S</span>
                        </div>
                        <span class="font-playfair font-semibold text-basalt">Smart UMKM Bali</span>
                    </a>
                </div>

                <!-- Navigation -->
                <nav class="flex-1 px-4 py-8 space-y-1 overflow-y-auto">
                    <a href="{{ route('customer.dashboard') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg text-body-sm font-medium transition-all duration-200 {{ request()->routeIs('customer.dashboard') ? 'bg-terracotta/10 text-terracotta font-semibold' : 'text-basalt-muted hover:bg-surface hover:text-basalt' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 0 1 6 3.75h2.25A2.25 2.25 0 0 1 10.5 6v2.25a2.25 2.25 0 0 1-2.25 2.25H6a2.25 2.25 0 0 1-2.25-2.25V6ZM3.75 15.75A2.25 2.25 0 0 1 6 13.5h2.25a2.25 2.25 0 0 1 2.25 2.25V18a2.25 2.25 0 0 1-2.25 2.25H6A2.25 2.25 0 0 1 3.75 18v-2.25ZM13.5 6a2.25 2.25 0 0 1 2.25-2.25H18A2.25 2.25 0 0 1 20.25 6v2.25A2.25 2.25 0 0 1 18 10.5h-2.25a2.25 2.25 0 0 1-2.25-2.25V6ZM13.5 15.75a2.25 2.25 0 0 1 2.25-2.25H18a2.25 2.25 0 0 1 2.25 2.25V18A2.25 2.25 0 0 1 18 20.25h-2.25A2.25 2.25 0 0 1 13.5 18v-2.25Z"/></svg>
                        Dashboard
                    </a>

                    <a href="{{ route('customer.orders.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg text-body-sm font-medium transition-all duration-200 {{ request()->routeIs('customer.orders.*') ? 'bg-terracotta/10 text-terracotta font-semibold' : 'text-basalt-muted hover:bg-surface hover:text-basalt' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z"/></svg>
                        Pesanan Saya
                    </a>

                    <p class="px-4 pt-6 pb-2 text-label-sm text-basalt-muted/60 uppercase tracking-[0.15em]">Pengaturan</p>

                    <a href="{{ route('customer.profile.edit') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg text-body-sm font-medium transition-all duration-200 {{ request()->routeIs('customer.profile.*') ? 'bg-terracotta/10 text-terracotta font-semibold' : 'text-basalt-muted hover:bg-surface hover:text-basalt' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z"/></svg>
                        Profil Saya
                    </a>

                    <a href="{{ route('customer.address.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg text-body-sm font-medium transition-all duration-200 {{ request()->routeIs('customer.address.*') ? 'bg-terracotta/10 text-terracotta font-semibold' : 'text-basalt-muted hover:bg-surface hover:text-basalt' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z"/></svg>
                        Alamat Pengiriman
                    </a>
                </nav>

                <!-- User Menu Footer -->
                <div class="border-t border-outline/20 p-4">
                    <div class="flex items-center gap-3 px-2">
                        @php $avatar = Auth::user()->customerProfile?->avatar; @endphp
                        @if($avatar)
                            <img src="{{ Storage::url($avatar) }}" alt="Avatar" class="w-10 h-10 rounded-full object-cover border border-outline/30">
                        @else
                            <div class="w-10 h-10 rounded-full bg-terracotta/10 flex items-center justify-center">
                                <span class="font-playfair font-semibold text-terracotta">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</span>
                            </div>
                        @endif
                        <div class="flex-1 min-w-0">
                            <p class="text-body-sm font-semibold text-basalt truncate">{{ Auth::user()->name }}</p>
                            <p class="text-label-sm text-basalt-muted">Pembeli</p>
                        </div>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="p-2 rounded-lg text-basalt-muted hover:bg-error/10 hover:text-error transition-colors" title="Logout">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15m3 0 3-3m0 0-3-3m3 3H9"/></svg>
                            </button>
                        </form>
                    </div>
                </div>
            </aside>

            <!-- Main Content -->
            <div class="flex-1 flex flex-col min-h-screen lg:ml-0">
                <!-- Top Bar (Mobile) -->
                <header class="h-20 bg-surface-white border-b border-outline/20 flex items-center justify-between px-6 lg:hidden">
                    <button @click="sidebarOpen = true" class="p-2 -ml-2 rounded-lg text-basalt hover:bg-surface transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"/></svg>
                    </button>
                    <span class="font-playfair font-semibold text-basalt">Akun Saya</span>
                    <div class="w-8"></div>
                </header>

                <!-- Page Header -->
                @isset($header)
                    <div class="bg-surface-white border-b border-outline/20">
                        <div class="max-w-5xl mx-auto px-6 lg:px-10 py-6">
                            {{ $header }}
                        </div>
                    </div>
                @endisset

                <!-- Page Content -->
                <main class="flex-1 p-6 lg:p-10">
                    <div class="max-w-5xl mx-auto">
                        @if (session('success'))
                            <div class="mb-6 p-4 bg-forest/10 border border-forest/20 text-forest rounded-lg flex items-center gap-3">
                                <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5"/></svg>
                                {{ session('success') }}
                            </div>
                        @endif
                        @if (session('error'))
                            <div class="mb-6 p-4 bg-error/10 border border-error/20 text-error rounded-lg flex items-center gap-3">
                                <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z"/></svg>
                                {{ session('error') }}
                            </div>
                        @endif
                        
                        {{ $slot }}
                    </div>
                </main>
            </div>
        </div>
        @stack('scripts')
    </body>
</html>
