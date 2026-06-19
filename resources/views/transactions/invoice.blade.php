<x-app-layout>
    @section('title', 'Invoice ' . $transaction->invoice_number)

    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-3">
                <a href="{{ route('transactions.index') }}" class="p-2 -ml-2 rounded-heritage text-on-surface-variant hover:bg-surface-container-high hover:text-text-primary transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18"/></svg>
                </a>
                <div>
                    <h1 class="font-display text-headline-md text-primary-dark">Detail Transaksi</h1>
                    <p class="text-body-sm text-on-surface-variant mt-1">{{ $transaction->invoice_number }}</p>
                </div>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('transactions.create') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-transparent border border-outline-dark rounded-heritage font-body text-body-sm font-semibold text-primary hover:bg-cream transition-colors">
                    Transaksi Baru
                </a>
                <button onclick="window.print()" class="inline-flex items-center gap-2 px-4 py-2 bg-primary border border-transparent rounded-heritage font-body text-body-sm font-semibold text-white hover:bg-primary-dark transition-colors print:hidden">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6.72 13.829c-.24.03-.48.062-.72.096m.72-.096a42.415 42.415 0 0 1 10.56 0m-10.56 0L6.34 18m10.94-4.171c.24.03.48.062.72.096m-.72-.096L17.66 18m0 0 .229 2.523a1.125 1.125 0 0 1-1.12 1.227H7.231c-.662 0-1.18-.568-1.12-1.227L6.34 18m11.318 0h1.091A2.25 2.25 0 0 0 21 15.75V9.456c0-1.081-.768-2.015-1.837-2.175a48.055 48.055 0 0 0-1.913-.247M6.34 18H5.25A2.25 2.25 0 0 1 3 15.75V9.456c0-1.081.768-2.015 1.837-2.175a48.041 48.041 0 0 1 1.913-.247m10.5 0a48.536 48.536 0 0 0-10.5 0v2.796c0 .12.09.22.21.22h10.08c.12 0 .21-.1.21-.22V6.75Z"/></svg>
                    Cetak Struk
                </button>
            </div>
        </div>
    </x-slot>

    {{-- Flash Message --}}
    @if(session('success'))
        <div class="mb-6 flex items-center gap-3 bg-accent-teal/10 border border-accent-teal/20 rounded-heritage px-4 py-3 print:hidden">
            <svg class="w-5 h-5 text-accent-teal shrink-0" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/></svg>
            <p class="text-body-sm text-accent-teal font-medium">{{ session('success') }}</p>
        </div>
    @endif

    <div class="max-w-3xl mx-auto">
        <div class="bg-surface-white rounded-heritage border border-outline shadow-card p-8 sm:p-12 print:border-none print:shadow-none print:p-0">
            {{-- Header --}}
            <div class="text-center border-b border-dashed border-outline pb-8 mb-8">
                <h2 class="font-display text-headline-lg font-bold text-primary-dark tracking-tight">{{ $transaction->business->name }}</h2>
                @if($transaction->business->address || $transaction->business->contact)
                    <p class="text-body-sm text-on-surface-variant mt-2 whitespace-pre-line">{{ $transaction->business->address }}
                        @if($transaction->business->contact)Telp: {{ $transaction->business->contact }}@endif
                    </p>
                @endif
            </div>

            {{-- Info --}}
            <div class="grid grid-cols-2 gap-4 mb-8 text-body-sm">
                <div>
                    <p class="text-on-surface-variant mb-1">Nomor Invoice:</p>
                    <p class="font-semibold text-text-primary">{{ $transaction->invoice_number }}</p>
                </div>
                <div class="text-right">
                    <p class="text-on-surface-variant mb-1">Tanggal:</p>
                    <p class="font-semibold text-text-primary">{{ $transaction->created_at->format('d/m/Y H:i') }}</p>
                </div>
                <div>
                    <p class="text-on-surface-variant mb-1">Kasir:</p>
                    <p class="font-semibold text-text-primary">{{ $transaction->user->name }}</p>
                </div>
            </div>

            {{-- Items --}}
            <table class="w-full mb-8">
                <thead>
                    <tr class="border-b border-outline text-label-md text-on-surface-variant uppercase tracking-wider">
                        <th class="py-3 text-left">Item</th>
                        <th class="py-3 text-center">Qty</th>
                        <th class="py-3 text-right">Harga</th>
                        <th class="py-3 text-right">Subtotal</th>
                    </tr>
                </thead>
                <tbody class="text-body-sm border-b border-outline">
                    @foreach($transaction->details as $item)
                        <tr>
                            <td class="py-3 text-text-primary font-medium">{{ $item->product_name }}</td>
                            <td class="py-3 text-center text-on-surface-variant tabular-nums">{{ $item->quantity }}</td>
                            <td class="py-3 text-right text-on-surface-variant tabular-nums">Rp{{ number_format($item->sell_price, 0, ',', '.') }}</td>
                            <td class="py-3 text-right text-text-primary font-semibold tabular-nums">Rp{{ number_format($item->subtotal, 0, ',', '.') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{-- Totals --}}
            <div class="w-full max-w-xs ml-auto space-y-3 text-body-sm">
                <div class="flex justify-between items-center text-on-surface-variant">
                    <span>Total Item</span>
                    <span class="tabular-nums font-medium">{{ $transaction->details->sum('quantity') }}</span>
                </div>
                <div class="flex justify-between items-center font-display text-body-lg font-bold text-primary-dark pt-3 border-t border-dashed border-outline">
                    <span>Total Belanja</span>
                    <span class="tabular-nums">Rp{{ number_format($transaction->total_amount, 0, ',', '.') }}</span>
                </div>
                <div class="flex justify-between items-center text-text-primary font-medium pt-3 border-t border-outline">
                    <span>Tunai</span>
                    <span class="tabular-nums">Rp{{ number_format($transaction->payment_amount, 0, ',', '.') }}</span>
                </div>
                <div class="flex justify-between items-center text-on-surface-variant pt-1">
                    <span>Kembalian</span>
                    <span class="tabular-nums font-semibold {{ $transaction->change_amount > 0 ? 'text-text-primary' : '' }}">Rp{{ number_format($transaction->change_amount, 0, ',', '.') }}</span>
                </div>
            </div>

            {{-- Notes & Footer --}}
            @if($transaction->notes)
                <div class="mt-8 pt-6 border-t border-dashed border-outline">
                    <p class="text-label-md text-on-surface-variant uppercase tracking-wider mb-1">Catatan</p>
                    <p class="text-body-sm text-text-primary">{{ $transaction->notes }}</p>
                </div>
            @endif

            <div class="mt-12 text-center text-body-sm text-on-surface-variant">
                <p>Terima kasih atas kunjungan Anda!</p>
                <p class="mt-1 font-display text-label-md uppercase tracking-widest text-outline-dark">Smart UMKM Bali</p>
            </div>
        </div>
    </div>

    @push('scripts')
    <style>
        @media print {
            body { background: white; }
            nav, aside, header { display: none !important; }
            main { padding: 0 !important; }
            .max-w-3xl { max-width: 100% !important; margin: 0 !important; }
            @page { margin: 0.5cm; }
        }
    </style>
    @endpush
</x-app-layout>
