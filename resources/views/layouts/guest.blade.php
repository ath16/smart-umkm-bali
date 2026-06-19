<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="description" content="Smart UMKM Bali - Sistem manajemen usaha cerdas untuk UMKM di Bali">

        <title>{{ config('app.name', 'Smart UMKM Bali') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&family=Space+Grotesk:wght@500;600;700&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-body text-text-primary antialiased">
        <div class="min-h-screen flex">
            <!-- Left Decorative Panel -->
            <div class="hidden lg:flex lg:w-1/2 bg-primary-dark relative overflow-hidden items-center justify-center">
                <!-- Batik Pattern Overlay -->
                <div class="absolute inset-0 opacity-5">
                    <svg width="100%" height="100%" xmlns="http://www.w3.org/2000/svg">
                        <defs>
                            <pattern id="kawung" x="0" y="0" width="60" height="60" patternUnits="userSpaceOnUse">
                                <circle cx="30" cy="30" r="12" fill="none" stroke="#ffffff" stroke-width="1"/>
                                <circle cx="0" cy="0" r="12" fill="none" stroke="#ffffff" stroke-width="1"/>
                                <circle cx="60" cy="0" r="12" fill="none" stroke="#ffffff" stroke-width="1"/>
                                <circle cx="0" cy="60" r="12" fill="none" stroke="#ffffff" stroke-width="1"/>
                                <circle cx="60" cy="60" r="12" fill="none" stroke="#ffffff" stroke-width="1"/>
                            </pattern>
                        </defs>
                        <rect width="100%" height="100%" fill="url(#kawung)"/>
                    </svg>
                </div>
                
                <div class="relative z-10 px-12 text-center">
                    <h1 class="font-display text-display-lg text-white mb-6">Smart UMKM<br>Bali</h1>
                    <p class="text-body-lg text-white/70 max-w-md mx-auto">Sistem manajemen usaha cerdas untuk pelaku UMKM di Bali. Kelola produk, catat transaksi, dan pantau performa bisnis Anda.</p>
                    <div class="mt-10 flex items-center justify-center gap-8 text-white/50">
                        <div class="text-center">
                            <div class="font-display text-headline-lg text-white">500+</div>
                            <div class="text-body-sm mt-1">UMKM Aktif</div>
                        </div>
                        <div class="w-px h-12 bg-white/20"></div>
                        <div class="text-center">
                            <div class="font-display text-headline-lg text-white">10K+</div>
                            <div class="text-body-sm mt-1">Transaksi/Hari</div>
                        </div>
                        <div class="w-px h-12 bg-white/20"></div>
                        <div class="text-center">
                            <div class="font-display text-headline-lg text-white">99.9%</div>
                            <div class="text-body-sm mt-1">Uptime</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Content Panel -->
            <div class="flex-1 flex flex-col justify-center items-center px-6 py-12 bg-surface">
                <div class="w-full max-w-md">
                    <!-- Logo for mobile -->
                    <div class="lg:hidden text-center mb-8">
                        <h2 class="font-display text-headline-lg text-primary-dark">Smart UMKM Bali</h2>
                        <p class="text-body-sm text-on-surface-variant mt-1">Sistem Manajemen Usaha Cerdas</p>
                    </div>
                    
                    <div class="bg-surface-white rounded-heritage border border-outline shadow-card p-card-padding">
                        {{ $slot }}
                    </div>
                    
                    <p class="text-center text-label-md text-on-surface-variant mt-6 uppercase tracking-wider">
                        &copy; {{ date('Y') }} Smart UMKM Bali
                    </p>
                </div>
            </div>
        </div>
    </body>
</html>
