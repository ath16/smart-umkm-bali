@extends('layouts.public')

@section('title', 'Keranjang Belanja')

@section('content')
<div class="bg-cream-premium min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 md:py-16" x-data="cart({{ $groupedItems->count() }}, {{ $totalAmount ?? 0 }})">

        {{-- Page Header --}}
        <div class="mb-10">
            <h1 class="font-playfair text-3xl md:text-4xl text-basalt">Keranjang Belanja</h1>
        </div>

        @if($groupedItems->isEmpty())
            {{-- Empty State --}}
            <div class="text-center py-24 max-w-md mx-auto">
                <svg class="w-20 h-20 mx-auto text-basalt/10 mb-8" fill="none" stroke="currentColor" stroke-width="0.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z"/></svg>
                <h2 class="font-playfair text-2xl text-basalt mb-3">Keranjang Anda kosong</h2>
                <p class="text-body-md text-basalt-muted mb-8">Temukan produk unik dari pengrajin lokal Bali.</p>
                <a href="{{ route('products.index') }}" class="inline-flex items-center gap-2 px-8 py-3.5 bg-terracotta text-white rounded-full font-semibold text-body-sm hover:bg-terracotta-dark transition-all duration-300">
                    Jelajahi Produk
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5"/></svg>
                </a>
            </div>
        @else
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12">
                {{-- Left: Cart Items --}}
                <div class="lg:col-span-8 space-y-6">
                    @php $subtotal = 0; $totalAmount = 0; @endphp
                    @foreach($groupedItems as $storeId => $items)
                        @php $storeName = $items->first()->product->store->name ?? 'Toko'; @endphp
                        <div class="bg-surface-white rounded-lg border border-outline/30 overflow-hidden">
                            {{-- Store Header --}}
                            <div class="px-6 py-4 border-b border-outline/20 flex items-center gap-3">
                                <div class="w-8 h-8 rounded-full bg-terracotta/10 flex items-center justify-center">
                                    <span class="font-playfair font-bold text-sm text-terracotta">{{ substr($storeName, 0, 1) }}</span>
                                </div>
                                <span class="font-semibold text-basalt text-body-md">{{ $storeName }}</span>
                            </div>
                            
                            {{-- Items --}}
                            <div class="divide-y divide-outline/20">
                                @foreach($items as $item)
                                    @php $subtotal = $item->quantity * $item->product->sell_price; $totalAmount += $subtotal; @endphp
                                    <div class="p-6 flex gap-4 sm:gap-6" x-data="{ quantity: {{ $item->quantity }}, itemId: {{ $item->id }}, stock: {{ $item->product->stock }}, subtotal: {{ $subtotal }} }">
                                        {{-- Product Image --}}
                                        <a href="{{ route('products.show', $item->product->slug ?? $item->product->id) }}" class="shrink-0 w-24 h-28 sm:w-28 sm:h-32 rounded-lg overflow-hidden bg-surface-container">
                                            @if($item->product->images && $item->product->images->count() > 0)
                                                <img src="{{ Storage::url($item->product->images->first()->image_path) }}" alt="{{ $item->product->name }}" class="w-full h-full object-cover">
                                            @else
                                                <div class="w-full h-full flex items-center justify-center text-basalt/10">
                                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" stroke-width="0.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Z"/></svg>
                                                </div>
                                            @endif
                                        </a>

                                        {{-- Item Details --}}
                                        <div class="flex-1 min-w-0">
                                            <div class="flex justify-between gap-2">
                                                <div>
                                                    <p class="text-label-sm text-terracotta/70 tracking-wider uppercase mb-0.5">{{ $item->product->category->name ?? 'Produk' }}</p>
                                                    <h3 class="font-playfair text-base sm:text-lg text-basalt line-clamp-1 mb-1">{{ $item->product->name }}</h3>
                                                    <p class="font-semibold text-basalt">{{ $item->product->formatted_sell_price }}</p>
                                                </div>
                                                <button 
                                                    @click="removeItem(itemId)" 
                                                    :disabled="loadingItem === itemId" 
                                                    class="shrink-0 p-2 text-basalt-muted hover:text-error transition-colors self-start">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0"/></svg>
                                                </button>
                                            </div>
                                            
                                            @if($item->quantity > $item->product->stock)
                                                <p class="text-error text-label-sm mt-1">Stok hanya tersisa {{ $item->product->stock }}</p>
                                            @endif

                                            {{-- Quantity Control --}}
                                            <div class="flex items-center gap-3 mt-4">
                                                <div class="inline-flex items-center border border-outline/50 rounded-full">
                                                    <button type="button" @click="quantity = Math.max(1, quantity - 1); updateQuantity(itemId, quantity)" :disabled="loadingItem === itemId" class="w-8 h-8 flex items-center justify-center text-basalt hover:bg-surface rounded-l-full transition-colors">
                                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14"/></svg>
                                                    </button>
                                                    <span class="w-8 text-center text-body-sm font-semibold text-basalt" x-text="quantity"></span>
                                                    <button type="button" @click="quantity = Math.min(stock, quantity + 1); updateQuantity(itemId, quantity)" :disabled="loadingItem === itemId" class="w-8 h-8 flex items-center justify-center text-basalt hover:bg-surface rounded-r-full transition-colors">
                                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/></svg>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- Right: Order Summary (Sticky) --}}
                <div class="lg:col-span-4">
                    <div class="lg:sticky lg:top-28 bg-surface-white rounded-lg border border-outline/30 p-6">
                        <h3 class="font-playfair text-xl text-basalt mb-6">Ringkasan</h3>
                        
                        <div class="space-y-3 mb-6">
                            <div class="flex justify-between text-body-sm">
                                <span class="text-basalt-muted">Subtotal</span>
                                <span class="text-basalt font-medium" x-text="'Rp ' + formattedTotalAmount"></span>
                            </div>
                            <div class="flex justify-between text-body-sm">
                                <span class="text-basalt-muted">Pengiriman</span>
                                <span class="text-basalt-muted italic">Dihitung saat checkout</span>
                            </div>
                        </div>

                        <div class="h-px bg-outline/30 mb-6"></div>

                        <div class="flex justify-between mb-8">
                            <span class="font-semibold text-basalt">Total</span>
                            <span class="font-semibold text-xl text-basalt" x-text="'Rp ' + formattedTotalAmount"></span>
                        </div>

                        <a href="{{ route('checkout.index') }}" class="block w-full py-4 bg-terracotta text-white text-center rounded-full font-semibold text-body-md tracking-wide hover:bg-terracotta-dark transition-all duration-300 shadow-sm hover:shadow-lg hover:shadow-terracotta/20">
                            Lanjut ke Checkout
                        </a>

                        <a href="{{ route('products.index') }}" class="block w-full py-3 text-center text-basalt-muted font-medium text-body-sm mt-3 hover:text-terracotta transition-colors">
                            Lanjut Belanja
                        </a>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('alpine:init', () => {
    Alpine.data('cart', (initialStoresCount, initialTotalAmount) => ({
        storesCount: initialStoresCount,
        loadingItem: null,
        formattedTotalAmount: new Intl.NumberFormat('id-ID').format(initialTotalAmount),

        async updateQuantity(itemId, newQuantity) {
            this.loadingItem = itemId;
            try {
                const response = await fetch(`/cart/${itemId}`, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json',
                    },
                    body: JSON.stringify({ quantity: newQuantity }),
                });
                const data = await response.json();
                if (data.success) {
                    this.formattedTotalAmount = new Intl.NumberFormat('id-ID').format(data.totalAmount);
                }
            } catch (error) {
                console.error('Update failed', error);
            } finally {
                this.loadingItem = null;
            }
        },

        async removeItem(itemId) {
            this.loadingItem = itemId;
            try {
                const response = await fetch(`/cart/${itemId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json',
                    },
                });
                const data = await response.json();
                if (data.success) {
                    location.reload();
                }
            } catch (error) {
                console.error('Remove failed', error);
            } finally {
                this.loadingItem = null;
            }
        }
    }));
});
</script>
@endpush
@endsection
