@extends('layouts.customer')

@section('title', 'Detail Pesanan')

@section('header')
<div class="flex items-center gap-4">
    <a href="{{ route('customer.orders.index') }}" class="w-8 h-8 flex items-center justify-center rounded-full hover:bg-surface-container transition-colors text-on-surface-variant">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18"/></svg>
    </a>
    Detail Pesanan
</div>
@endsection

@section('customer-content')
<div class="space-y-6">

    @if(session('success'))
        <div class="p-4 bg-primary/10 border border-primary/20 text-primary-dark rounded-heritage flex items-center gap-3">
            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/></svg>
            <p class="text-body-md font-medium">{{ session('success') }}</p>
        </div>
    @endif

    @if(session('error'))
        <div class="p-4 bg-error/10 border border-error/20 text-error rounded-heritage flex items-center gap-3">
            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3Z"/></svg>
            <p class="text-body-md font-medium">{{ session('error') }}</p>
        </div>
    @endif

    <!-- Status Bar -->
    <div class="bg-surface-white border border-outline rounded-heritage p-6 shadow-sm flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <p class="text-label-sm text-on-surface-variant mb-1">Nomor Invoice</p>
            <p class="font-bold text-text-primary text-title-md font-mono">{{ $order->invoice_number }}</p>
        </div>
        <div class="flex items-center gap-3">
            <a href="{{ route('customer.orders.invoice', $order->id) }}" class="inline-flex items-center gap-2 px-4 py-2 border border-outline text-text-primary text-label-sm font-semibold rounded hover:bg-surface-container transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3"/></svg>
                Invoice
            </a>
            @if($order->status === 'pending')
                <span class="px-3 py-1.5 bg-warning/20 text-warning-dark text-sm font-bold rounded uppercase tracking-wider">Menunggu Pembayaran</span>
            @elseif($order->status === 'paid')
                <span class="px-3 py-1.5 bg-info/20 text-info-dark text-sm font-bold rounded uppercase tracking-wider">Lunas / Diproses</span>
            @elseif($order->status === 'shipped')
                <span class="px-3 py-1.5 bg-primary/20 text-primary-dark text-sm font-bold rounded uppercase tracking-wider">Sedang Dikirim</span>
            @elseif($order->status === 'completed')
                <span class="px-3 py-1.5 bg-success/20 text-success-dark text-sm font-bold rounded uppercase tracking-wider">Selesai</span>
            @elseif($order->status === 'cancelled')
                <span class="px-3 py-1.5 bg-error/20 text-error text-sm font-bold rounded uppercase tracking-wider">Dibatalkan</span>
            @endif
        </div>
    </div>

    @if($order->status === 'pending' && $order->paymentTransaction && $order->paymentTransaction->snap_token)
        <div class="bg-primary/10 border border-primary/20 rounded-heritage p-6 flex flex-col sm:flex-row justify-between items-center gap-4">
            <div>
                <h3 class="font-bold text-primary-dark mb-1">Selesaikan Pembayaran Anda</h3>
                <p class="text-body-sm text-on-surface-variant">Pembayaran untuk pesanan ini tergabung dengan transaksi <strong>{{ $order->paymentTransaction->reference_number }}</strong>.</p>
            </div>
            <a href="{{ route('checkout.success', ['reference' => $order->paymentTransaction->reference_number]) }}" class="px-6 py-2.5 bg-primary text-white font-bold rounded hover:bg-primary-dark transition-colors whitespace-nowrap">
                Bayar Sekarang
            </a>
        </div>
    @endif

    <div class="flex flex-col lg:flex-row gap-6">
        <div class="w-full lg:w-2/3 space-y-6">
            <!-- Product List -->
            <div class="bg-surface-white border border-outline rounded-heritage p-6 shadow-sm">
                <h3 class="font-display font-semibold text-title-md text-text-primary mb-4 flex items-center gap-2">
                    <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 21v-7.5a.75.75 0 0 1 .75-.75h3a.75.75 0 0 1 .75.75V21m-4.5 0H2.36m11.14 0H18m0 0h3.64m-1.39 0V9.809c0-.626-.314-1.227-.84-1.583l-8.24-5.56a2.11 2.11 0 0 0-2.34 0l-8.24 5.56c-.526.356-.84.957-.84 1.583V21h1.39m1.39 0h1.39m0 0v-7.5a.75.75 0 0 1 .75-.75h3a.75.75 0 0 1 .75.75V21m-4.5 0H8.64"/></svg>
                    Produk Dipesan
                </h3>
                
                <p class="font-bold text-text-primary mb-4 border-b border-outline pb-2">{{ $order->store->name }}</p>

                <div class="space-y-4">
                    @foreach($order->items as $item)
                        <div class="flex gap-4">
                            <div class="w-16 h-16 bg-surface-container rounded border border-outline shrink-0 overflow-hidden">
                                @if($item->product && $item->product->images->count() > 0)
                                    <img src="{{ Storage::url($item->product->images->first()->image_path) }}" alt="{{ $item->product_name }}" class="w-full h-full object-cover">
                                @endif
                            </div>
                            <div class="flex-1">
                                <h4 class="font-semibold text-body-sm text-text-primary">{{ $item->product_name }}</h4>
                                <p class="text-label-sm text-on-surface-variant mb-1">{{ $item->quantity }} x {{ 'Rp ' . number_format($item->price, 0, ',', '.') }}</p>
                            </div>
                            <div class="text-right">
                                <p class="font-bold text-text-primary">{{ $item->formatted_subtotal }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            
            @if($order->status === 'completed')
            <!-- Store Review -->
            <div class="bg-surface-white border border-outline rounded-heritage p-6 shadow-sm mt-6">
                <h3 class="font-display font-semibold text-title-md text-text-primary mb-4">Ulasan Toko</h3>
                @php
                    $storeReview = \App\Models\StoreReview::where('order_id', $order->id)->where('user_id', auth()->id())->first();
                @endphp
                @if($storeReview)
                    <div class="bg-surface-container/50 rounded-lg p-4 border border-outline">
                        <div class="flex items-center gap-1 mb-2 text-warning">
                            @for($i = 1; $i <= 5; $i++)
                                <svg class="w-5 h-5 {{ $i <= $storeReview->rating ? 'fill-current' : 'text-outline stroke-current fill-transparent' }}" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 0 1 1.04 0l2.125 5.111a.563.563 0 0 0 .475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 0 0-.182.557l1.285 5.385a.562.562 0 0 1-.84.61l-4.725-2.885a.562.562 0 0 0-.586 0L6.982 20.54a.562.562 0 0 1-.84-.61l1.285-5.386a.562.562 0 0 0-.182-.557l-4.204-3.602a.562.562 0 0 1 .321-.988l5.518-.442a.563.563 0 0 0 .475-.345L11.48 3.5Z"/></svg>
                            @endfor
                        </div>
                        <p class="text-body-sm text-text-primary italic">"{{ $storeReview->comment }}"</p>
                    </div>
                @else
                    <form action="{{ route('customer.reviews.store', $order->id) }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label class="block text-label-sm font-semibold text-text-primary mb-2">Rating Toko</label>
                            <div class="flex gap-4">
                                @for($i = 5; $i >= 1; $i--)
                                    <label class="cursor-pointer">
                                        <input type="radio" name="rating" value="{{ $i }}" class="peer hidden" required>
                                        <span class="inline-flex w-10 h-10 items-center justify-center rounded-full border border-outline peer-checked:bg-warning peer-checked:text-white hover:bg-surface-container transition-colors font-bold">{{ $i }}</span>
                                    </label>
                                @endfor
                            </div>
                        </div>
                        <div class="mb-4">
                            <label class="block text-label-sm font-semibold text-text-primary mb-2">Ulasan</label>
                            <textarea name="comment" rows="2" class="w-full border-outline rounded-lg text-body-sm focus:border-primary focus:ring focus:ring-primary/20" placeholder="Tuliskan pengalaman Anda berbelanja di toko ini..."></textarea>
                        </div>
                        <button type="submit" class="px-6 py-2 bg-primary text-white font-semibold rounded-heritage hover:bg-primary-dark transition-colors">Kirim Ulasan</button>
                    </form>
                @endif
            </div>

            <!-- Product Reviews -->
            <div class="bg-surface-white border border-outline rounded-heritage p-6 shadow-sm mt-6 mb-6">
                <h3 class="font-display font-semibold text-title-md text-text-primary mb-4">Ulasan Produk</h3>
                <div class="space-y-6">
                    @foreach($order->items as $item)
                        @php
                            $productReview = \App\Models\ProductReview::where('order_id', $order->id)->where('product_id', $item->product_id)->where('user_id', auth()->id())->first();
                        @endphp
                        <div class="border-b border-outline pb-6 last:border-0 last:pb-0">
                            <p class="font-semibold text-text-primary text-body-sm mb-3">{{ $item->product_name }}</p>
                            @if($productReview)
                                <div class="bg-surface-container/50 rounded-lg p-4 border border-outline">
                                    <div class="flex items-center gap-1 mb-2 text-warning">
                                        @for($i = 1; $i <= 5; $i++)
                                            <svg class="w-4 h-4 {{ $i <= $productReview->rating ? 'fill-current' : 'text-outline stroke-current fill-transparent' }}" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 0 1 1.04 0l2.125 5.111a.563.563 0 0 0 .475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 0 0-.182.557l1.285 5.385a.562.562 0 0 1-.84.61l-4.725-2.885a.562.562 0 0 0-.586 0L6.982 20.54a.562.562 0 0 1-.84-.61l1.285-5.386a.562.562 0 0 0-.182-.557l-4.204-3.602a.562.562 0 0 1 .321-.988l5.518-.442a.563.563 0 0 0 .475-.345L11.48 3.5Z"/></svg>
                                        @endfor
                                    </div>
                                    <p class="text-body-sm text-text-primary italic">"{{ $productReview->comment }}"</p>
                                </div>
                            @else
                                <form action="{{ route('customer.reviews.product', $order->id) }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $item->product_id }}">
                                    <div class="mb-4">
                                        <div class="flex gap-2">
                                            @for($i = 5; $i >= 1; $i--)
                                                <label class="cursor-pointer">
                                                    <input type="radio" name="rating" value="{{ $i }}" class="peer hidden" required>
                                                    <span class="inline-flex w-8 h-8 items-center justify-center rounded-full border border-outline peer-checked:bg-warning peer-checked:text-white hover:bg-surface-container transition-colors font-bold text-xs">{{ $i }}</span>
                                                </label>
                                            @endfor
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <textarea name="comment" rows="2" class="w-full border-outline rounded-lg text-body-sm focus:border-primary focus:ring focus:ring-primary/20" placeholder="Kualitas produknya bagaimana?"></textarea>
                                    </div>
                                    <button type="submit" class="px-4 py-1.5 bg-surface-container-highest text-text-primary font-semibold text-label-sm rounded hover:bg-outline transition-colors">Kirim Ulasan Produk</button>
                                </form>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
            @endif
            
            <!-- Shipping Info -->
            <div class="bg-surface-white border border-outline rounded-heritage p-6 shadow-sm">
                <h3 class="font-display font-semibold text-title-md text-text-primary mb-4 flex items-center gap-2">
                    <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z"/></svg>
                    Informasi Pengiriman
                </h3>
                
                @if($order->address)
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <p class="text-label-sm text-on-surface-variant mb-1">Penerima</p>
                            <p class="font-semibold text-text-primary">{{ $order->address->recipient_name }}</p>
                            <p class="text-body-sm text-on-surface-variant">{{ $order->address->phone }}</p>
                        </div>
                        <div>
                            <p class="text-label-sm text-on-surface-variant mb-1">Alamat Lengkap</p>
                            <p class="text-body-sm text-text-primary">{{ $order->address->address }}</p>
                            <p class="text-body-sm text-on-surface-variant">{{ $order->address->district }}, {{ $order->address->city }}</p>
                            <p class="text-body-sm text-on-surface-variant">{{ $order->address->province }} {{ $order->address->postal_code }}</p>
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <div class="w-full lg:w-1/3 space-y-6">
            <!-- Payment Summary -->
            <div class="bg-surface-white border border-outline rounded-heritage p-6 shadow-sm">
                <h3 class="font-display font-semibold text-title-md text-text-primary mb-4 flex items-center gap-2">
                    <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0 1 15.797 2.101c.727.198 1.453-.342 1.453-1.096V4.22c0-.756-.728-1.293-1.454-1.096a59.969 59.969 0 0 1-15.797 2.101c-.727.198-1.453-.342-1.453-1.096V18.75M3.75 4.5v.75M3.75 7.5v.75M3.75 10.5v.75M3.75 13.5v.75M3.75 16.5v.75M3.75 19.5v.75"/></svg>
                    Rincian Pembayaran
                </h3>
                
                <div class="space-y-3 text-body-sm text-on-surface-variant mb-4">
                    <div class="flex justify-between items-center">
                        <span>Metode Pembayaran</span>
                        <span class="font-semibold text-text-primary uppercase">{{ $order->payment_method }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span>Total Harga Produk</span>
                        <span class="font-medium text-text-primary">{{ 'Rp ' . number_format($order->items->sum('subtotal'), 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span>Ongkos Kirim</span>
                        <span class="font-medium text-text-primary">{{ $order->formatted_shipping_fee }}</span>
                    </div>
                </div>
                
                <div class="border-t border-outline pt-3">
                    <div class="flex justify-between items-center">
                        <span class="font-bold text-text-primary">Total Tagihan</span>
                        <span class="font-bold text-title-md text-primary-dark">{{ $order->formatted_total_amount }}</span>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="space-y-3">
                @if($order->status === 'pending')
                    <form action="{{ route('customer.orders.cancel', $order->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="w-full block text-center px-4 py-3 bg-surface-white border border-error text-error font-bold rounded-heritage hover:bg-error/5 transition-colors" onclick="return confirm('Anda yakin ingin membatalkan pesanan ini?')">
                            Batalkan Pesanan
                        </button>
                    </form>
                @elseif($order->status === 'shipped')
                    <form action="{{ route('customer.orders.complete', $order->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="w-full block text-center px-4 py-3 bg-primary text-white font-bold rounded-heritage hover:bg-primary-dark transition-colors shadow-sm" onclick="return confirm('Apakah Anda sudah menerima pesanan ini dengan baik?')">
                            Pesanan Diterima
                        </button>
                    </form>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
