@extends('errors::minimal')

@section('title', 'Halaman Tidak Ditemukan')
@section('code', '404')
@section('message', 'Halaman Tidak Ditemukan')
@section('description', 'Maaf, halaman atau produk yang Anda cari mungkin telah dipindahkan, dihapus, atau tidak pernah ada.')

@section('extra-actions')
    <button onclick="window.history.back()" class="inline-flex items-center justify-center px-6 py-3 bg-surface-white text-basalt border border-basalt/20 text-sm font-semibold rounded-full hover:bg-basalt hover:text-white transition-colors w-full sm:w-auto group">
        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 15 3 9m0 0 6-6M3 9h12a6 6 0 0 1 0 12h-3"/></svg>
        Kembali Sebelumnya
    </button>
@endsection
