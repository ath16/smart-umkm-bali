@extends('errors::minimal')

@section('title', 'Kesalahan Internal Peladen')
@section('code', '500')
@section('message', 'Kesalahan Internal Peladen')
@section('description', 'Sistem kami sedang mengalami masalah teknis yang tidak terduga. Tim teknisi kami telah diberitahu dan sedang berusaha keras untuk memulihkannya segera.')

@section('extra-actions')
    <button onclick="window.location.reload()" class="inline-flex items-center justify-center px-6 py-3 bg-surface-white text-basalt border border-basalt/20 text-sm font-semibold rounded-full hover:bg-basalt hover:text-white transition-colors w-full sm:w-auto group">
        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0 3.181 3.183a8.25 8.25 0 0 0 13.803-3.7M4.031 9.865a8.25 8.25 0 0 1 13.803-3.7l3.181 3.182m0-4.991v4.99"/></svg>
        Coba Muat Ulang
    </button>
@endsection
