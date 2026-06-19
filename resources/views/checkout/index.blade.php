@extends('layouts.public')

@section('title', 'Checkout')

@section('content')
<div class="bg-cream-premium min-h-screen" x-data="checkoutForm({{ $totalWeight ?? 0 }}, {{ $subtotalAmount ?? 0 }})">

    {{-- Minimal Checkout Header --}}
    <div class="border-b border-outline/20 bg-surface-white">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-5 flex items-center justify-between">
            <a href="{{ route('landing') }}" class="flex items-center gap-3">
                <div class="w-8 h-8 rounded-lg bg-terracotta flex items-center justify-center">
                    <span class="font-playfair font-bold text-base text-white">S</span>
                </div>
                <span class="font-playfair font-semibold text-basalt hidden sm:block">Smart UMKM Bali</span>
            </a>
            <div class="flex items-center gap-2 text-body-sm text-basalt-muted">
                <svg class="w-4 h-4 text-forest" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z"/></svg>
                Checkout Aman
            </div>
        </div>
    </div>

    <form action="{{ route('checkout.process') }}" method="POST">
        @csrf
        
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-10 md:py-14">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-14">

                {{-- ── Left Column: Shipping & Payment ── --}}
                <div class="lg:col-span-7 space-y-8">
                    
                    {{-- Shipping Address --}}
                    <div>
                        <h2 class="font-playfair text-2xl text-basalt mb-6">Alamat Pengiriman</h2>
                        @if($address)
                            <input type="hidden" name="address_id" value="{{ $address->id }}">
                            <div class="bg-surface-white rounded-lg border border-outline/30 p-6">
                                <div class="flex justify-between items-start mb-3">
                                    <p class="font-semibold text-basalt">{{ $address->recipient_name }}</p>
                                    <a href="{{ route('customer.address') }}" class="text-terracotta text-body-sm font-medium hover:underline">Ubah</a>
                                </div>
                                <p class="text-body-sm text-basalt-muted">{{ $address->phone }}</p>
                                <p class="text-body-sm text-basalt-muted mt-1">{{ $address->address }}, {{ $address->district }}, {{ $address->city }}, {{ $address->province }} {{ $address->postal_code }}</p>
                            </div>
                        @else
                            <div class="bg-error-container/30 rounded-lg border border-error/20 p-6 text-center">
                                <p class="text-error font-medium mb-3">Anda belum memiliki alamat pengiriman.</p>
                                <a href="{{ route('customer.address.create') }}" class="inline-flex items-center gap-2 px-6 py-2.5 bg-terracotta text-white rounded-full font-semibold text-body-sm hover:bg-terracotta-dark transition-colors">
                                    Tambah Alamat
                                </a>
                            </div>
                        @endif
                    </div>

                    {{-- Shipping Method --}}
                    <div>
                        <h2 class="font-playfair text-2xl text-basalt mb-6">Metode Pengiriman</h2>
                        <div x-show="loadingRates" class="space-y-3">
                            <div class="h-16 bg-surface-container animate-pulse rounded-lg"></div>
                            <div class="h-16 bg-surface-container animate-pulse rounded-lg"></div>
                        </div>
                        <div x-show="!loadingRates" class="space-y-3">
                            <template x-for="(rate, index) in rates" :key="index">
                                <label class="flex items-center gap-4 p-4 bg-surface-white rounded-lg border border-outline/30 cursor-pointer hover:border-terracotta/40 transition-colors has-[:checked]:border-terracotta has-[:checked]:bg-terracotta/5">
                                    <input type="radio" name="shipping_rate_index" :value="index" x-model="selectedRate" @change="updateTotal()" class="text-terracotta focus:ring-terracotta/30 w-4 h-4">
                                    <input type="hidden" name="courier_name" :value="rate.courier_name" x-bind:disabled="selectedRate != index">
                                    <input type="hidden" name="courier_service" :value="rate.service" x-bind:disabled="selectedRate != index">
                                    <div class="flex-1">
                                        <p class="font-semibold text-basalt text-body-sm" x-text="rate.courier_name + ' - ' + rate.service"></p>
                                        <p class="text-label-sm text-basalt-muted" x-text="rate.etd ? ('Estimasi ' + rate.etd + ' hari') : 'Estimasi pengiriman standar'"></p>
                                    </div>
                                    <span class="font-semibold text-basalt text-body-sm" x-text="'Rp ' + formatNumber(rate.cost)"></span>
                                </label>
                            </template>
                            <template x-if="rates.length === 0 && !loadingRates">
                                <p class="text-basalt-muted text-body-sm p-4">Tidak ada opsi pengiriman tersedia.</p>
                            </template>
                        </div>
                        @error('courier_name') <p class="text-error text-body-sm mt-2">{{ $message }}</p> @enderror
                    </div>

                    {{-- Payment Method --}}
                    <div>
                        <h2 class="font-playfair text-2xl text-basalt mb-6">Metode Pembayaran</h2>
                        <div class="space-y-3">
                            <label class="flex items-center gap-4 p-4 bg-surface-white rounded-lg border border-outline/30 cursor-pointer hover:border-terracotta/40 transition-colors has-[:checked]:border-terracotta has-[:checked]:bg-terracotta/5">
                                <input type="radio" name="payment_method" value="bank_transfer" checked class="text-terracotta focus:ring-terracotta/30 w-4 h-4">
                                <div>
                                    <p class="font-semibold text-basalt text-body-sm">Transfer Bank (Midtrans)</p>
                                    <p class="text-label-sm text-basalt-muted">Pembayaran online yang aman dan terenkripsi</p>
                                </div>
                            </label>
                            <label class="flex items-center gap-4 p-4 bg-surface-white rounded-lg border border-outline/30 cursor-pointer hover:border-terracotta/40 transition-colors has-[:checked]:border-terracotta has-[:checked]:bg-terracotta/5">
                                <input type="radio" name="payment_method" value="cod" class="text-terracotta focus:ring-terracotta/30 w-4 h-4">
                                <div>
                                    <p class="font-semibold text-basalt text-body-sm">COD (Bayar di Tempat)</p>
                                    <p class="text-label-sm text-basalt-muted">Bayar saat pesanan Anda tiba</p>
                                </div>
                            </label>
                        </div>
                        @error('payment_method') <p class="text-error text-body-sm mt-2">{{ $message }}</p> @enderror
                    </div>

                    {{-- Notes --}}
                    <div>
                        <label class="block text-body-sm font-medium text-basalt mb-2">Catatan (opsional)</label>
                        <textarea name="notes" rows="3" placeholder="Instruksi khusus untuk penjual..." class="w-full border-outline/50 rounded-lg text-body-md focus:border-basalt focus:ring-1 focus:ring-basalt/20 bg-surface-white resize-none"></textarea>
                    </div>
                </div>

                {{-- ── Right Column: Order Summary (Sticky) ── --}}
                <div class="lg:col-span-5">
                    <div class="lg:sticky lg:top-24 bg-surface-white rounded-lg border border-outline/30 p-6">
                        <h3 class="font-playfair text-xl text-basalt mb-6">Ringkasan Pesanan</h3>

                        {{-- Order Items --}}
                        <div class="space-y-4 mb-6 max-h-72 overflow-y-auto hide-scrollbar">
                            @foreach($groupedItems as $storeId => $items)
                                @foreach($items as $item)
                                    <div class="flex gap-3">
                                        <div class="w-16 h-16 rounded-lg overflow-hidden bg-surface-container shrink-0">
                                            @if($item->product->images && $item->product->images->count() > 0)
                                                <img src="{{ Storage::url($item->product->images->first()->image_path) }}" alt="{{ $item->product->name }}" class="w-full h-full object-cover">
                                            @endif
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <p class="text-body-sm text-basalt font-medium line-clamp-1">{{ $item->product->name }}</p>
                                            <p class="text-label-sm text-basalt-muted">{{ $item->quantity }}x {{ $item->product->formatted_sell_price }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            @endforeach
                        </div>

                        <div class="h-px bg-outline/20 mb-4"></div>

                        {{-- Totals --}}
                        <div class="space-y-3 mb-6">
                            <div class="flex justify-between text-body-sm">
                                <span class="text-basalt-muted">Subtotal Produk</span>
                                <span class="text-basalt" x-text="'Rp ' + formatNumber(subtotalAmount)"></span>
                            </div>
                            <div class="flex justify-between text-body-sm">
                                <span class="text-basalt-muted">Ongkos Kirim</span>
                                <span class="text-basalt" x-text="shippingFee > 0 ? 'Rp ' + formatNumber(shippingFee) : '—'"></span>
                            </div>
                        </div>

                        <div class="h-px bg-outline/20 mb-4"></div>

                        <div class="flex justify-between mb-8">
                            <span class="font-semibold text-basalt text-lg">Total</span>
                            <span class="font-semibold text-basalt text-xl" x-text="'Rp ' + formatNumber(totalAmount)"></span>
                        </div>

                        <button type="submit" {{ $address ? '' : 'disabled' }} class="w-full py-4 rounded-full font-semibold text-body-md tracking-wide transition-all duration-300
                            {{ $address ? 'bg-terracotta text-white hover:bg-terracotta-dark shadow-sm hover:shadow-lg hover:shadow-terracotta/20' : 'bg-surface-container text-basalt-muted cursor-not-allowed' }}">
                            Bayar Sekarang
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

@push('scripts')
<script>
document.addEventListener('alpine:init', () => {
    Alpine.data('checkoutForm', (totalWeight, subtotalAmount) => ({
        totalWeight: totalWeight,
        subtotalAmount: subtotalAmount,
        rates: [],
        selectedRate: null,
        loadingRates: true,
        shippingFee: 0,
        totalAmount: subtotalAmount,

        init() {
            if (this.totalWeight > 0) {
                fetch(`/api/shipping-rates?weight=${this.totalWeight}`)
                    .then(res => res.json())
                    .then(data => {
                        this.rates = data.data || [];
                        this.loadingRates = false;
                    })
                    .catch(() => { this.loadingRates = false; });
            } else {
                this.loadingRates = false;
            }
        },

        updateTotal() {
            if (this.selectedRate !== null && this.rates[this.selectedRate]) {
                this.shippingFee = this.rates[this.selectedRate].cost;
            } else {
                this.shippingFee = 0;
            }
            this.totalAmount = this.subtotalAmount + this.shippingFee;
        },

        formatNumber(num) {
            return new Intl.NumberFormat('id-ID').format(num);
        }
    }));
});
</script>
@endpush
@endsection
