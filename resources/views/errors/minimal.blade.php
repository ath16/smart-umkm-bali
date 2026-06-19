<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title') - Smart UMKM Bali</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&display=swap" rel="stylesheet">

    <!-- Tailwind CDN for safe fallback rendering -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        basalt: '#1a1a1a',
                        'basalt-muted': '#4a4a4a',
                        terracotta: '#c05a3c',
                        'surface-white': '#ffffff',
                        'cream-premium': '#fdfbf7',
                    },
                    fontFamily: {
                        playfair: ['"Playfair Display"', 'serif'],
                        sans: ['"Inter"', 'system-ui', 'sans-serif'],
                    }
                }
            }
        }
    </script>
</head>
<body class="antialiased font-sans bg-cream-premium text-basalt min-h-screen flex flex-col items-center justify-center relative overflow-hidden">
    
    <!-- Background Decoration -->
    <div class="absolute inset-0 z-0 opacity-10 pointer-events-none flex items-center justify-center">
        <svg class="w-full h-full max-w-4xl" viewBox="0 0 100 100" preserveAspectRatio="none">
            <path d="M0,0 L100,100 M100,0 L0,100" stroke="currentColor" stroke-width="0.2" fill="none" class="text-terracotta"/>
        </svg>
    </div>

    <div class="relative z-10 w-full max-w-2xl px-6 text-center">
        <!-- Error Code -->
        <div class="mb-6">
            <span class="font-playfair text-6xl md:text-8xl font-bold text-terracotta opacity-90 drop-shadow-sm tracking-tight">
                @yield('code')
            </span>
        </div>

        <!-- Divider -->
        <div class="w-16 h-1 bg-terracotta/30 mx-auto mb-8 rounded-full"></div>

        <!-- Title / Message -->
        <h1 class="font-playfair text-2xl md:text-3xl lg:text-4xl font-semibold mb-4 leading-tight">
            @yield('message')
        </h1>
        
        <!-- Description -->
        <p class="text-basalt-muted text-sm md:text-base leading-relaxed mb-10 max-w-md mx-auto">
            @yield('description', 'Terjadi kesalahan pada sistem. Kami sedang berusaha memulihkannya.')
        </p>

        <!-- Action Buttons -->
        <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
            <a href="{{ url('/') }}" class="inline-flex items-center justify-center px-6 py-3 bg-basalt text-white text-sm font-semibold rounded-full hover:bg-black transition-colors shadow-md hover:shadow-lg w-full sm:w-auto group">
                <svg class="w-4 h-4 mr-2 transition-transform group-hover:-translate-x-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18"/></svg>
                Kembali ke Beranda
            </a>
            @yield('extra-actions')
        </div>
    </div>

    <!-- Footer -->
    <div class="absolute bottom-6 text-xs text-basalt-muted/50 tracking-wider uppercase font-semibold">
        &copy; {{ date('Y') }} Smart UMKM Bali
    </div>
</body>
</html>
