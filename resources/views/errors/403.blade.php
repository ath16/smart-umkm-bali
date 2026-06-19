@extends('errors::minimal')

@section('title', 'Akses Ditolak')
@section('code', '403')
@section('message', 'Akses Ditolak')
@section('description', 'Maaf, Anda tidak memiliki izin (otorisasi) untuk mengakses halaman atau sumber daya ini. Silakan masuk menggunakan akun yang sesuai.')

@section('extra-actions')
    @guest
        <a href="{{ route('login') }}" class="inline-flex items-center justify-center px-6 py-3 bg-surface-white text-basalt border border-basalt/20 text-sm font-semibold rounded-full hover:bg-basalt hover:text-white transition-colors w-full sm:w-auto">
            Masuk ke Akun
        </a>
    @endguest
@endsection
