<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Superadmin | {{ config('app.name', 'Smart UMKM Bali') }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Outfit:wght@500;600;700;800&display=swap" rel="stylesheet">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-surface-container-low text-text-primary">
    <div class="min-h-screen flex bg-surface-container-low">
        
        <!-- Sidebar -->
        <div class="w-64 bg-surface-white border-r border-outline shadow-sm flex flex-col hidden md:flex">
            <div class="h-16 flex items-center px-6 border-b border-outline bg-primary-dark">
                <span class="font-display font-bold text-xl text-white">Superadmin</span>
            </div>
            
            <nav class="flex-1 px-4 py-6 space-y-2">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-3 text-sm font-semibold rounded-heritage {{ request()->routeIs('admin.dashboard') ? 'bg-primary/10 text-primary-dark' : 'text-on-surface hover:bg-surface-container hover:text-text-primary' }} transition-colors">
                    Dashboard
                </a>
                <a href="{{ route('admin.stores.index') }}" class="flex items-center gap-3 px-4 py-3 text-sm font-semibold rounded-heritage {{ request()->routeIs('admin.stores.*') ? 'bg-primary/10 text-primary-dark' : 'text-on-surface hover:bg-surface-container hover:text-text-primary' }} transition-colors">
                    Moderasi Toko
                </a>
                <a href="{{ route('admin.products.index') }}" class="flex items-center gap-3 px-4 py-3 text-sm font-semibold rounded-heritage {{ request()->routeIs('admin.products.*') ? 'bg-primary/10 text-primary-dark' : 'text-on-surface hover:bg-surface-container hover:text-text-primary' }} transition-colors">
                    Moderasi Produk
                </a>
            </nav>
            
            <div class="p-4 border-t border-outline">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold text-error bg-error/10 rounded-heritage hover:bg-error/20 transition-colors">
                        Logout
                    </button>
                </form>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col min-w-0">
            <!-- Topbar -->
            <header class="h-16 bg-surface-white border-b border-outline shadow-sm flex items-center justify-between px-6 lg:px-8">
                <div class="font-semibold text-text-primary flex items-center gap-2">
                    <span class="bg-primary/20 text-primary-dark px-3 py-1 rounded-full text-xs">Admin</span>
                    {{ Auth::user()->name }}
                </div>
            </header>

            <!-- Page Content -->
            <main class="flex-1 p-6 lg:p-8 overflow-y-auto">
                @if(session('success'))
                    <div class="mb-6 p-4 rounded-heritage bg-accent-teal/10 text-accent-teal font-semibold border border-accent-teal/20">
                        {{ session('success') }}
                    </div>
                @endif
                
                @if(session('error'))
                    <div class="mb-6 p-4 rounded-heritage bg-error/10 text-error font-semibold border border-error/20">
                        {{ session('error') }}
                    </div>
                @endif

                {{ $slot }}
            </main>
        </div>
    </div>
</body>
</html>
