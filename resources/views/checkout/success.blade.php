@extends('layouts.public')

@section('title', 'Pesanan Berhasil')

@section('content')
<div class="bg-cream-premium min-h-screen flex items-center justify-center px-4 py-16">
    <div class="max-w-lg w-full text-center">
        
        {{-- Animated Checkmark --}}
        <div class="mx-auto w-24 h-24 rounded-full bg-forest/10 flex items-center justify-center mb-8 animate-fade-up" style="opacity:0">
            <svg class="w-12 h-12 text-forest" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5"/>
            </svg>
        </div>

        {{-- Thank You Message --}}
        <h1 class="font-playfair text-3xl md:text-4xl text-basalt mb-4 animate-fade-up-delay" style="opacity:0">Terima Kasih!</h1>
        <p class="text-body-lg text-basalt-muted mb-2 animate-fade-up-delay" style="opacity:0">
            Pesanan Anda telah diterima.
        </p>
        <p class="text-body-sm text-basalt-muted mb-10 animate-fade-up-delay-2" style="opacity:0">
            Anda telah mendukung pengrajin lokal Bali. Setiap pembelian Anda membantu melestarikan warisan budaya.
        </p>

        {{-- Order Card --}}
        <div class="bg-surface-white rounded-lg border border-outline/30 p-6 mb-8 text-left animate-fade-up-delay-2" style="opacity:0">
            <div class="flex items-center justify-between mb-4">
                <span class="text-label-md text-basalt-muted tracking-wide uppercase">No. Referensi</span>
                <span class="font-mono font-semibold text-basalt">{{ $paymentTx->reference_number }}</span>
            </div>
            
            <div class="flex items-center justify-between mb-4">
                <span class="text-label-md text-basalt-muted tracking-wide uppercase">Status</span>
                @if($paymentTx->status === 'pending')
                    <span class="px-3 py-1 bg-prada/10 text-prada-dark text-label-sm font-semibold rounded-full">Menunggu Pembayaran</span>
                @elseif($paymentTx->status === 'paid')
                    <span class="px-3 py-1 bg-forest/10 text-forest text-label-sm font-semibold rounded-full">Pembayaran Berhasil</span>
                @else
                    <span class="px-3 py-1 bg-surface-container text-basalt-muted text-label-sm font-semibold rounded-full">{{ ucfirst($paymentTx->status) }}</span>
                @endif
            </div>

            <div class="flex items-center justify-between mb-4">
                <span class="text-label-md text-basalt-muted tracking-wide uppercase">Total</span>
                <span class="font-semibold text-lg text-basalt">Rp {{ number_format($paymentTx->amount, 0, ',', '.') }}</span>
            </div>

            <div class="h-px bg-outline/20 my-4"></div>

            {{-- Orders List --}}
            <div class="space-y-3">
                @foreach($paymentTx->orders as $order)
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-body-sm font-medium text-basalt">{{ $order->store->name ?? 'Toko' }}</p>
                            <p class="text-label-sm text-basalt-muted">{{ $order->items->count() }} produk</p>
                        </div>
                        <p class="font-medium text-basalt text-body-sm">{{ $order->formatted_total_amount }}</p>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- Payment Button (Midtrans) --}}
        @if($paymentTx->status === 'pending' && $paymentTx->snap_token)
            <button id="pay-button" class="w-full py-4 bg-terracotta text-white rounded-full font-semibold text-body-md tracking-wide hover:bg-terracotta-dark transition-all duration-300 shadow-sm hover:shadow-lg hover:shadow-terracotta/20 mb-4">
                Bayar Sekarang
            </button>
        @endif

        {{-- Action Links --}}
        <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
            <a href="{{ route('customer.orders.index') }}" class="px-8 py-3 border border-basalt/20 text-basalt rounded-full font-medium text-body-sm hover:bg-basalt hover:text-white transition-all duration-300">
                Lihat Riwayat Pesanan
            </a>
            <a href="{{ route('landing') }}" class="px-8 py-3 text-basalt-muted font-medium text-body-sm hover:text-terracotta transition-colors">
                Kembali ke Beranda
            </a>
        </div>
    </div>
</div>

@if($paymentTx->status === 'pending' && $paymentTx->snap_token)
@push('scripts')
<script src="https://app.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>
<script>
    document.getElementById('pay-button')?.addEventListener('click', function () {
        snap.pay('{{ $paymentTx->snap_token }}', {
            onSuccess: function(result) {
                window.location.href = '{{ route("checkout.success", ["reference" => $paymentTx->reference_number]) }}';
            },
            onPending: function(result) {
                window.location.href = '{{ route("checkout.success", ["reference" => $paymentTx->reference_number]) }}';
            },
            onError: function(result) {
                alert('Pembayaran gagal. Silakan coba lagi.');
            },
            onClose: function() {
                // User closed without completing payment
            }
        });
    });
</script>
@endpush
@endif
@endsection
