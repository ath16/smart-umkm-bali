<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Smart UMKM Bali') }} — @yield('title', 'Dashboard')</title>

        <!-- Fonts: Inter for SaaS UI -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            .font-inter { font-family: 'Inter', system-ui, sans-serif; }
        </style>
    </head>
    <body class="font-inter text-slate-900 antialiased bg-slate-50" x-data="{ sidebarOpen: false }">
        <div class="min-h-screen flex">
            <!-- Sidebar Overlay (Mobile) -->
            <div x-show="sidebarOpen" x-transition:enter="transition-opacity ease-linear duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition-opacity ease-linear duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 z-40 bg-black/20 backdrop-blur-sm lg:hidden" @click="sidebarOpen = false" style="display:none"></div>

            <!-- ═══ Sidebar ═══ -->
            <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'" class="fixed inset-y-0 left-0 z-50 w-64 bg-white border-r border-slate-200 flex flex-col transition-transform duration-200 lg:translate-x-0 lg:static lg:z-auto">
                <!-- Logo -->
                <div class="h-14 flex items-center px-5 border-b border-slate-100">
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-2.5">
                        <div class="w-7 h-7 rounded-lg bg-slate-900 flex items-center justify-center">
                            <span class="font-bold text-xs text-white">S</span>
                        </div>
                        <span class="font-semibold text-sm text-slate-900">Smart UMKM Bali</span>
                    </a>
                </div>

                <!-- Store Switcher -->
                @php $store = Auth::user()->currentStore(); @endphp
                @if($store)
                <div class="px-4 py-3 border-b border-slate-100">
                    <div class="flex items-center gap-2.5 px-2 py-1.5 rounded-md bg-slate-50">
                        <div class="w-6 h-6 rounded bg-slate-200 flex items-center justify-center shrink-0">
                            <span class="text-[10px] font-bold text-slate-600">{{ strtoupper(substr($store->name, 0, 1)) }}</span>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-xs font-semibold text-slate-800 truncate">{{ $store->name }}</p>
                        </div>
                    </div>
                </div>
                @endif

                <!-- Navigation -->
                <nav class="flex-1 px-3 py-4 space-y-0.5 overflow-y-auto">
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-2.5 px-2.5 py-2 rounded-md text-[13px] font-medium transition-colors {{ request()->routeIs('dashboard') && !request()->routeIs('dashboard.*') ? 'bg-slate-100 text-slate-900' : 'text-slate-500 hover:bg-slate-50 hover:text-slate-700' }}">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 0 1 6 3.75h2.25A2.25 2.25 0 0 1 10.5 6v2.25a2.25 2.25 0 0 1-2.25 2.25H6a2.25 2.25 0 0 1-2.25-2.25V6ZM3.75 15.75A2.25 2.25 0 0 1 6 13.5h2.25a2.25 2.25 0 0 1 2.25 2.25V18a2.25 2.25 0 0 1-2.25 2.25H6A2.25 2.25 0 0 1 3.75 18v-2.25ZM13.5 6a2.25 2.25 0 0 1 2.25-2.25H18A2.25 2.25 0 0 1 20.25 6v2.25A2.25 2.25 0 0 1 18 10.5h-2.25a2.25 2.25 0 0 1-2.25-2.25V6ZM13.5 15.75a2.25 2.25 0 0 1 2.25-2.25H18a2.25 2.25 0 0 1 2.25 2.25V18A2.25 2.25 0 0 1 18 20.25h-2.25A2.25 2.25 0 0 1 13.5 18v-2.25Z"/></svg>
                        Dashboard
                    </a>

                    <p class="px-2.5 pt-5 pb-1.5 text-[10px] font-semibold text-slate-400 uppercase tracking-widest">Kelola</p>

                    <a href="{{ route('dashboard.products.index') }}" class="flex items-center gap-2.5 px-2.5 py-2 rounded-md text-[13px] font-medium transition-colors {{ request()->routeIs('dashboard.products.*') ? 'bg-slate-100 text-slate-900' : 'text-slate-500 hover:bg-slate-50 hover:text-slate-700' }}">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="m20.25 7.5-.625 10.632a2.25 2.25 0 0 1-2.247 2.118H6.622a2.25 2.25 0 0 1-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125Z"/></svg>
                        Produk
                    </a>

                    <a href="{{ route('transactions.index') }}" class="flex items-center gap-2.5 px-2.5 py-2 rounded-md text-[13px] font-medium transition-colors {{ request()->routeIs('transactions.*') ? 'bg-slate-100 text-slate-900' : 'text-slate-500 hover:bg-slate-50 hover:text-slate-700' }}">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0 1 15.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 0 1 3 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 0 0-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 0 1-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 0 0 3 15h-.75M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm3 0h.008v.008H18V10.5Zm-12 0h.008v.008H6V10.5Z"/></svg>
                        Transaksi Kasir
                    </a>

                    @if(Auth::user()->isOwner())
                    <a href="{{ route('dashboard.orders.index') }}" class="flex items-center gap-2.5 px-2.5 py-2 rounded-md text-[13px] font-medium transition-colors {{ request()->routeIs('dashboard.orders.*') ? 'bg-slate-100 text-slate-900' : 'text-slate-500 hover:bg-slate-50 hover:text-slate-700' }}">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z"/></svg>
                        Pesanan Online
                    </a>

                    <p class="px-2.5 pt-5 pb-1.5 text-[10px] font-semibold text-slate-400 uppercase tracking-widest">Insight</p>

                    <a href="{{ route('reports.index') }}" class="flex items-center gap-2.5 px-2.5 py-2 rounded-md text-[13px] font-medium transition-colors {{ request()->routeIs('reports.*') ? 'bg-slate-100 text-slate-900' : 'text-slate-500 hover:bg-slate-50 hover:text-slate-700' }}">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 0 1 3 19.875v-6.75ZM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V8.625ZM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V4.125Z"/></svg>
                        Laporan
                    </a>

                    <a href="{{ route('dashboard.reviews.index') }}" class="flex items-center gap-2.5 px-2.5 py-2 rounded-md text-[13px] font-medium transition-colors {{ request()->routeIs('dashboard.reviews.*') ? 'bg-slate-100 text-slate-900' : 'text-slate-500 hover:bg-slate-50 hover:text-slate-700' }}">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 0 1 1.04 0l2.125 5.111a.563.563 0 0 0 .475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 0 0-.182.557l1.285 5.385a.562.562 0 0 1-.84.61l-4.725-2.885a.562.562 0 0 0-.586 0L6.982 20.54a.562.562 0 0 1-.84-.61l1.285-5.386a.562.562 0 0 0-.182-.557l-4.204-3.602a.562.562 0 0 1 .321-.988l5.518-.442a.563.563 0 0 0 .475-.345L11.48 3.5Z"/></svg>
                        Ulasan
                    </a>

                    <p class="px-2.5 pt-5 pb-1.5 text-[10px] font-semibold text-slate-400 uppercase tracking-widest">Pengaturan</p>

                    <a href="{{ route('staff.index') }}" class="flex items-center gap-2.5 px-2.5 py-2 rounded-md text-[13px] font-medium transition-colors {{ request()->routeIs('staff.*') ? 'bg-slate-100 text-slate-900' : 'text-slate-500 hover:bg-slate-50 hover:text-slate-700' }}">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z"/></svg>
                        Staff Kasir
                    </a>

                    <a href="{{ route('stores.edit') }}" class="flex items-center gap-2.5 px-2.5 py-2 rounded-md text-[13px] font-medium transition-colors {{ request()->routeIs('stores.*') ? 'bg-slate-100 text-slate-900' : 'text-slate-500 hover:bg-slate-50 hover:text-slate-700' }}">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.325.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 0 1 1.37.49l1.296 2.247a1.125 1.125 0 0 1-.26 1.431l-1.003.827c-.293.241-.438.613-.431.992a7.723 7.723 0 0 1 0 .255c-.007.378.138.75.43.991l1.004.827c.424.35.534.955.26 1.43l-1.298 2.247a1.125 1.125 0 0 1-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.47 6.47 0 0 1-.22.128c-.331.183-.581.495-.644.869l-.213 1.281c-.09.543-.56.94-1.11.94h-2.594c-.55 0-1.019-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 0 1-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 0 1-1.369-.49l-1.297-2.247a1.125 1.125 0 0 1 .26-1.431l1.004-.827c.292-.24.437-.613.43-.991a6.932 6.932 0 0 1 0-.255c.007-.38-.138-.751-.43-.992l-1.004-.827a1.125 1.125 0 0 1-.26-1.43l1.297-2.247a1.125 1.125 0 0 1 1.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.086.22-.128.332-.183.582-.495.644-.869l.214-1.28Z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/></svg>
                        Pengaturan Toko
                    </a>
                    @endif
                </nav>

                <!-- User Footer -->
                <div class="border-t border-slate-100 p-3">
                    <div class="flex items-center gap-2.5 px-2 py-1.5">
                        <div class="w-7 h-7 rounded-full bg-slate-200 flex items-center justify-center text-slate-600 text-xs font-semibold shrink-0">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-xs font-medium text-slate-700 truncate">{{ Auth::user()->name }}</p>
                            <p class="text-[10px] text-slate-400">{{ Auth::user()->role === 'owner' ? 'Pemilik' : 'Kasir' }}</p>
                        </div>
                        <div class="flex items-center gap-0.5">
                            <a href="{{ route('profile.edit') }}" class="p-1 rounded text-slate-400 hover:text-slate-600 hover:bg-slate-100 transition-colors" title="Profil">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.325.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 0 1 1.37.49l1.296 2.247a1.125 1.125 0 0 1-.26 1.431l-1.003.827c-.293.241-.438.613-.431.992a7.723 7.723 0 0 1 0 .255c-.007.378.138.75.43.991l1.004.827c.424.35.534.955.26 1.43l-1.298 2.247a1.125 1.125 0 0 1-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.47 6.47 0 0 1-.22.128c-.331.183-.581.495-.644.869l-.213 1.281c-.09.543-.56.94-1.11.94h-2.594c-.55 0-1.019-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 0 1-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 0 1-1.369-.49l-1.297-2.247a1.125 1.125 0 0 1 .26-1.431l1.004-.827c.292-.24.437-.613.43-.991a6.932 6.932 0 0 1 0-.255c.007-.38-.138-.751-.43-.992l-1.004-.827a1.125 1.125 0 0 1-.26-1.43l1.297-2.247a1.125 1.125 0 0 1 1.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.086.22-.128.332-.183.582-.495.644-.869l.214-1.28Z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/></svg>
                            </a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="p-1 rounded text-slate-400 hover:text-red-500 hover:bg-red-50 transition-colors" title="Logout">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15m3 0 3-3m0 0-3-3m3 3H9"/></svg>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </aside>

            <!-- ═══ Main Content ═══ -->
            <div class="flex-1 flex flex-col min-h-screen">
                <!-- Top Bar -->
                <header class="h-14 bg-white border-b border-slate-200 flex items-center justify-between px-4 lg:px-6 sticky top-0 z-30">
                    <!-- Left: Mobile hamburger + Breadcrumb -->
                    <div class="flex items-center gap-3">
                        <button @click="sidebarOpen = true" class="p-1.5 rounded-md text-slate-400 hover:text-slate-600 hover:bg-slate-100 lg:hidden transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"/></svg>
                        </button>
                        <span class="text-sm text-slate-500 hidden lg:block">@yield('title', 'Dashboard')</span>
                    </div>

                    <!-- Right: Search + Quick Action -->
                    <div class="flex items-center gap-2">
                        <!-- Search Trigger -->
                        <div class="hidden sm:flex items-center gap-2 px-3 py-1.5 border border-slate-200 rounded-md bg-slate-50 text-slate-400 text-xs cursor-pointer hover:border-slate-300 transition-colors w-56">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z"/></svg>
                            <span>Cari...</span>
                            <kbd class="ml-auto px-1.5 py-0.5 rounded border border-slate-200 bg-white text-[10px] font-mono text-slate-400">⌘K</kbd>
                        </div>

                        <!-- Quick Add -->
                        <a href="{{ route('dashboard.products.create') }}" class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-slate-900 text-white text-xs font-medium rounded-md hover:bg-slate-800 transition-colors">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/></svg>
                            <span class="hidden sm:inline">Tambah</span>
                        </a>
                    </div>
                </header>

                <!-- Page Header -->
                @isset($header)
                    <div class="bg-white border-b border-slate-200">
                        <div class="max-w-7xl mx-auto px-4 lg:px-6 py-4">
                            {{ $header }}
                        </div>
                    </div>
                @endisset

                <!-- Page Content -->
                <main class="flex-1 p-4 lg:p-6">
                    <div class="max-w-7xl mx-auto">
                        {{ $slot }}
                    </div>
                </main>
            </div>
        </div>
        @stack('scripts')
    </body>
</html>
