<x-admin-layout>
    <div class="mb-8">
        <h1 class="font-display text-headline-md font-bold text-text-primary">Dashboard Superadmin</h1>
        <p class="text-body-sm text-on-surface-variant mt-1">Overview statistik sistem dan riwayat moderasi.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <!-- Total Users -->
        <div class="bg-surface-white p-6 rounded-heritage border border-outline shadow-sm flex items-center gap-4">
            <div class="w-12 h-12 rounded-full bg-primary/10 text-primary-dark flex items-center justify-center text-xl">
                👥
            </div>
            <div>
                <p class="text-label-md text-on-surface-variant">Total Users</p>
                <p class="font-display text-title-lg font-bold text-text-primary">{{ number_format($stats['total_users']) }}</p>
            </div>
        </div>

        <!-- Total Stores -->
        <div class="bg-surface-white p-6 rounded-heritage border border-outline shadow-sm flex items-center gap-4">
            <div class="w-12 h-12 rounded-full bg-accent-teal/10 text-accent-teal flex items-center justify-center text-xl">
                🏪
            </div>
            <div>
                <p class="text-label-md text-on-surface-variant">Total Toko</p>
                <p class="font-display text-title-lg font-bold text-text-primary">{{ number_format($stats['total_stores']) }}</p>
            </div>
        </div>

        <!-- Total Products -->
        <div class="bg-surface-white p-6 rounded-heritage border border-outline shadow-sm flex items-center gap-4">
            <div class="w-12 h-12 rounded-full bg-primary-dark/10 text-primary-dark flex items-center justify-center text-xl">
                📦
            </div>
            <div>
                <p class="text-label-md text-on-surface-variant">Total Produk</p>
                <p class="font-display text-title-lg font-bold text-text-primary">{{ number_format($stats['total_products']) }}</p>
            </div>
        </div>

        <!-- Active Suspensions -->
        <div class="bg-surface-white p-6 rounded-heritage border border-error/50 shadow-sm flex items-center gap-4">
            <div class="w-12 h-12 rounded-full bg-error/10 text-error flex items-center justify-center text-xl">
                🚫
            </div>
            <div>
                <p class="text-label-md text-on-surface-variant">Suspensi Aktif</p>
                <p class="font-display text-title-lg font-bold text-error">{{ number_format($stats['active_suspensions']) }}</p>
            </div>
        </div>
    </div>
</x-admin-layout>
