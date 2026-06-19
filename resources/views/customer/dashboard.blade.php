<x-customer-layout>
    <x-slot name="header">
        <div>
            <p class="text-terracotta tracking-[0.15em] uppercase text-label-md mb-1">Selamat Datang</p>
            <h1 class="font-playfair text-2xl md:text-3xl text-basalt">Halo, {{ Auth::user()->name }}!</h1>
        </div>
    </x-slot>

    {{-- Quick Actions --}}
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-5 mb-10">
        <a href="{{ route('customer.orders.index') }}" class="group bg-surface-white rounded-lg border border-outline/30 p-6 hover:shadow-card hover:-translate-y-0.5 transition-all duration-300">
            <div class="w-12 h-12 rounded-lg bg-terracotta/10 flex items-center justify-center mb-4 group-hover:bg-terracotta/20 transition-colors">
                <svg class="w-6 h-6 text-terracotta" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z"/></svg>
            </div>
            <h3 class="font-semibold text-basalt mb-1">Pesanan Saya</h3>
            <p class="text-body-sm text-basalt-muted">Lihat riwayat & status pesanan</p>
        </a>

        <a href="{{ route('customer.profile.edit') }}" class="group bg-surface-white rounded-lg border border-outline/30 p-6 hover:shadow-card hover:-translate-y-0.5 transition-all duration-300">
            <div class="w-12 h-12 rounded-lg bg-prada/10 flex items-center justify-center mb-4 group-hover:bg-prada/20 transition-colors">
                <svg class="w-6 h-6 text-prada-dark" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z"/></svg>
            </div>
            <h3 class="font-semibold text-basalt mb-1">Profil Saya</h3>
            <p class="text-body-sm text-basalt-muted">Kelola informasi akun Anda</p>
        </a>

        <a href="{{ route('customer.address.index') }}" class="group bg-surface-white rounded-lg border border-outline/30 p-6 hover:shadow-card hover:-translate-y-0.5 transition-all duration-300">
            <div class="w-12 h-12 rounded-lg bg-forest/10 flex items-center justify-center mb-4 group-hover:bg-forest/20 transition-colors">
                <svg class="w-6 h-6 text-forest" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z"/></svg>
            </div>
            <h3 class="font-semibold text-basalt mb-1">Alamat Pengiriman</h3>
            <p class="text-body-sm text-basalt-muted">Atur alamat pengiriman Anda</p>
        </a>
    </div>

    {{-- Continue Shopping CTA --}}
    <div class="bg-surface-white rounded-lg border border-outline/30 p-8 text-center">
        <svg class="w-12 h-12 mx-auto text-basalt/10 mb-4" fill="none" stroke="currentColor" stroke-width="0.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z"/></svg>
        <h3 class="font-playfair text-xl text-basalt mb-2">Temukan Lebih Banyak</h3>
        <p class="text-body-sm text-basalt-muted mb-6">Jelajahi produk unik dari pengrajin lokal Bali.</p>
        <a href="{{ route('products.index') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-terracotta text-white rounded-full font-semibold text-body-sm hover:bg-terracotta-dark transition-colors">
            Jelajahi Produk
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5"/></svg>
        </a>
    </div>
</x-customer-layout>
