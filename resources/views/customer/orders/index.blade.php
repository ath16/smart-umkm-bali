<x-customer-layout>
    <x-slot name="title">Riwayat Pesanan</x-slot>
    <x-slot name="header">
        <h2 class="font-playfair font-semibold text-2xl text-basalt">Riwayat Pesanan</h2>
    </x-slot>
<div class="bg-surface-white border border-outline rounded-heritage p-6 shadow-sm">
    
    @if(session('success'))
        <div class="mb-6 p-4 bg-primary/10 border border-primary/20 text-primary-dark rounded-heritage flex items-center gap-3">
            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/></svg>
            <p class="text-body-md font-medium">{{ session('success') }}</p>
        </div>
    @endif

    @if($orders->isEmpty())
        <div class="text-center py-12">
            <div class="w-20 h-20 mx-auto bg-surface-container rounded-full flex items-center justify-center text-on-surface-variant mb-4">
                <svg class="w-10 h-10" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z"/></svg>
            </div>
            <h3 class="font-display font-semibold text-title-lg text-text-primary mb-2">Belum ada pesanan</h3>
            <p class="text-body-md text-on-surface-variant mb-6">Anda belum melakukan transaksi apapun.</p>
            <a href="{{ route('products.index') }}" class="inline-flex items-center px-6 py-3 bg-primary text-white font-semibold rounded-heritage hover:bg-primary-dark transition-colors">
                Mulai Belanja
            </a>
        </div>
    @else
        <div class="space-y-6">
            @foreach($orders as $order)
                <div class="border border-outline rounded-lg overflow-hidden">
                    <div class="bg-surface px-4 py-3 border-b border-outline flex flex-col sm:flex-row justify-between items-start sm:items-center gap-3">
                        <div class="flex items-center gap-4">
                            <span class="font-bold text-text-primary text-label-md">{{ $order->invoice_number }}</span>
                            <span class="text-label-sm text-on-surface-variant">{{ $order->created_at->format('d M Y, H:i') }}</span>
                        </div>
                        <div>
                            @if($order->status === 'pending')
                                <span class="px-2 py-1 bg-warning/20 text-warning-dark text-xs font-bold rounded uppercase tracking-wider">Menunggu Pembayaran</span>
                            @elseif($order->status === 'paid')
                                <span class="px-2 py-1 bg-info/20 text-info-dark text-xs font-bold rounded uppercase tracking-wider">Lunas / Diproses</span>
                            @elseif($order->status === 'shipped')
                                <span class="px-2 py-1 bg-primary/20 text-primary-dark text-xs font-bold rounded uppercase tracking-wider">Sedang Dikirim</span>
                            @elseif($order->status === 'completed')
                                <span class="px-2 py-1 bg-success/20 text-success-dark text-xs font-bold rounded uppercase tracking-wider">Selesai</span>
                            @elseif($order->status === 'cancelled')
                                <span class="px-2 py-1 bg-error/20 text-error text-xs font-bold rounded uppercase tracking-wider">Dibatalkan</span>
                            @endif
                        </div>
                    </div>
                    <div class="p-4 flex flex-col md:flex-row gap-6">
                        <div class="flex-1 space-y-4">
                            <div class="flex items-center gap-2 mb-2">
                                <svg class="w-4 h-4 text-primary" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 21v-7.5a.75.75 0 0 1 .75-.75h3a.75.75 0 0 1 .75.75V21m-4.5 0H2.36m11.14 0H18m0 0h3.64m-1.39 0V9.809c0-.626-.314-1.227-.84-1.583l-8.24-5.56a2.11 2.11 0 0 0-2.34 0l-8.24 5.56c-.526.356-.84.957-.84 1.583V21h1.39m1.39 0h1.39m0 0v-7.5a.75.75 0 0 1 .75-.75h3a.75.75 0 0 1 .75.75V21m-4.5 0H8.64"/></svg>
                                <span class="font-bold text-text-primary">{{ $order->store->name }}</span>
                            </div>
                            
                            @foreach($order->items->take(2) as $item)
                                <div class="flex gap-4">
                                    <div class="w-16 h-16 bg-surface-container rounded border border-outline shrink-0 overflow-hidden">
                                        @if($item->product && $item->product->images->count() > 0)
                                            <img src="{{ imageUrl($item->product->images->first()->image_url ?? null, 'thumbnail') }}" alt="{{ $item->product_name }}" class="w-full h-full object-cover">
                                        @endif
                                    </div>
                                    <div>
                                        <p class="font-semibold text-body-sm text-text-primary line-clamp-1">{{ $item->product_name }}</p>
                                        <p class="text-label-sm text-on-surface-variant">{{ $item->quantity }} x {{ 'Rp ' . number_format($item->price, 0, ',', '.') }}</p>
                                    </div>
                                </div>
                            @endforeach
                            
                            @if($order->items->count() > 2)
                                <p class="text-label-sm text-on-surface-variant italic">+ {{ $order->items->count() - 2 }} produk lainnya</p>
                            @endif
                        </div>
                        
                        <div class="md:w-48 md:border-l md:border-outline md:pl-6 flex flex-col justify-center">
                            <p class="text-label-sm text-on-surface-variant mb-1">Total Belanja</p>
                            <p class="font-bold text-title-md text-text-primary mb-4">{{ $order->formatted_total_amount }}</p>
                            
                            <a href="{{ route('customer.orders.show', $order->id) }}" class="block text-center px-4 py-2 bg-primary text-white text-label-sm font-semibold rounded hover:bg-primary-dark transition-colors">
                                Lihat Detail
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        
        <div class="mt-6">
            {{ $orders->links() }}
        </div>
    @endif
</div>
</x-customer-layout>
