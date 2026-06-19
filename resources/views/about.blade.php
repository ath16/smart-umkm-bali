@extends('layouts.public')
@section('title', 'Tentang Kami')

@section('content')
<div class="bg-surface-white py-16 lg:py-24">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h1 class="font-display text-4xl font-bold text-primary-dark mb-4">Tentang Smart UMKM Bali</h1>
            <p class="text-body-lg text-on-surface-variant">Dedikasi kami untuk memajukan perekonomian lokal Bali melalui teknologi yang mudah digunakan.</p>
        </div>

        <div class="prose prose-lg prose-brown max-w-none text-on-surface-variant">
            <p>Smart UMKM Bali lahir dari kepedulian terhadap para pelaku usaha mikro, kecil, dan menengah di Pulau Dewata yang seringkali kesulitan dalam mencatat transaksi dan mengelola stok barang secara manual.</p>
            
            <h3 class="font-display text-title-lg font-bold text-text-primary mt-8 mb-4">Visi Kami</h3>
            <p>Menjadi platform digitalisasi nomor satu yang memberdayakan setiap UMKM di Bali untuk tumbuh menjadi bisnis yang modern, transparan, dan berkelanjutan.</p>

            <h3 class="font-display text-title-lg font-bold text-text-primary mt-8 mb-4">Misi Kami</h3>
            <ul class="list-disc pl-6 space-y-2">
                <li>Menyediakan sistem kasir (Point of Sales) yang intuitif dan mudah dipahami oleh siapa saja.</li>
                <li>Membantu pemilik usaha melacak inventaris dan mencegah kerugian akibat selisih stok.</li>
                <li>Menyajikan laporan keuangan yang otomatis dan transparan.</li>
                <li>Menghubungkan pembeli lokal dengan toko-toko UMKM di sekitar mereka.</li>
            </ul>

            <div class="bg-primary/10 rounded-[2rem] p-8 mt-12 border border-primary/20 text-center">
                <h4 class="font-display text-title-md font-bold text-primary-dark mb-2">Mari Bergabung Bersama Kami</h4>
                <p class="text-body-md mb-6">Jadilah bagian dari revolusi digital UMKM Bali hari ini juga.</p>
                <a href="{{ route('register') }}" class="inline-flex justify-center items-center px-6 py-3 bg-primary text-white font-semibold rounded-heritage hover:bg-primary-dark transition-colors">
                    Daftar Sekarang
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
