<x-app-layout>
    @section('title', 'Riwayat Transaksi')

    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="font-display text-headline-md text-primary-dark">Riwayat Transaksi</h1>
                <p class="text-body-sm text-on-surface-variant mt-1">Daftar transaksi penjualan</p>
            </div>
            <a href="{{ route('transactions.create') }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-primary border border-transparent rounded-heritage font-body text-body-sm font-semibold text-white hover:bg-primary-dark transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/></svg>
                Transaksi Baru
            </a>
        </div>
    </x-slot>

    {{-- Search & Filters --}}
    <div class="bg-surface-white rounded-heritage border border-outline shadow-card mb-6">
        <div class="p-4 sm:p-6">
            <form method="GET" action="{{ route('transactions.index') }}" class="flex flex-col sm:flex-row gap-3">
                <div class="flex-1 relative">
                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                        <svg class="w-4 h-4 text-on-surface-variant" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z"/></svg>
                    </div>
                    <input type="text" name="search" value="{{ $search }}" placeholder="Cari nomor invoice..." class="w-full pl-10 pr-4 py-2.5 border-outline rounded-heritage bg-surface-white text-text-primary text-body-sm placeholder:text-on-surface-variant/50 focus:border-outline-dark focus:ring focus:ring-outline-dark/10 transition-colors">
                </div>
                <div class="flex gap-2">
                    <button type="submit" class="inline-flex items-center gap-2 px-5 py-2.5 bg-primary border border-transparent rounded-heritage font-body text-body-sm font-semibold text-white hover:bg-primary-dark transition-colors">
                        Cari
                    </button>
                    @if($search)
                        <a href="{{ route('transactions.index') }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-transparent border border-outline-dark rounded-heritage font-body text-body-sm font-semibold text-primary hover:bg-cream transition-colors">
                            Reset
                        </a>
                    @endif
                </div>
            </form>
        </div>
    </div>

    {{-- Transactions Table --}}
    <div class="bg-surface-white rounded-heritage border border-outline shadow-card overflow-hidden">
        @if($transactions->count() > 0)
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="bg-surface border-b border-outline">
                            <th class="text-left px-6 py-3.5 font-display text-label-md text-on-surface-variant uppercase tracking-wider">Invoice / Waktu</th>
                            <th class="text-left px-6 py-3.5 font-display text-label-md text-on-surface-variant uppercase tracking-wider">Kasir</th>
                            <th class="text-right px-6 py-3.5 font-display text-label-md text-on-surface-variant uppercase tracking-wider">Total Belanja</th>
                            <th class="text-center px-6 py-3.5 font-display text-label-md text-on-surface-variant uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-surface">
                        @foreach($transactions as $transaction)
                            <tr class="hover:bg-surface/50 transition-colors">
                                <td class="px-6 py-4">
                                    <p class="text-body-sm font-semibold text-primary-dark">{{ $transaction->invoice_number }}</p>
                                    <p class="text-label-md text-on-surface-variant mt-0.5">{{ $transaction->created_at->format('d M Y H:i') }}</p>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-2">
                                        <div class="w-6 h-6 rounded-full bg-primary/10 flex items-center justify-center text-primary text-xs font-bold">
                                            {{ strtoupper(substr($transaction->user->name, 0, 1)) }}
                                        </div>
                                        <span class="text-body-sm text-text-primary">{{ $transaction->user->name }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <p class="text-body-sm font-semibold text-text-primary tabular-nums">Rp{{ number_format($transaction->total_amount, 0, ',', '.') }}</p>
                                    <p class="text-label-md text-on-surface-variant mt-0.5">{{ $transaction->details->sum('quantity') }} item</p>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <a href="{{ route('transactions.show', $transaction) }}" class="inline-flex items-center px-3 py-1.5 bg-transparent border border-outline-dark rounded-heritage text-body-sm font-medium text-primary hover:bg-cream transition-colors">
                                        Lihat
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            @if($transactions->hasPages())
                <div class="px-6 py-4 border-t border-outline">
                    {{ $transactions->links('products.partials.pagination') }}
                </div>
            @endif
        @else
            <div class="px-6 py-16 text-center">
                <div class="w-16 h-16 rounded-full bg-surface-container mx-auto mb-4 flex items-center justify-center">
                    <svg class="w-8 h-8 text-outline-dark" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" /></svg>
                </div>
                <h3 class="font-display text-body-lg font-semibold text-text-primary mb-1">Belum ada transaksi</h3>
                <p class="text-body-sm text-on-surface-variant mb-4">Catat transaksi pertama untuk usaha Anda.</p>
                <a href="{{ route('transactions.create') }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-primary border border-transparent rounded-heritage font-body text-body-sm font-semibold text-white hover:bg-primary-dark transition-colors">
                    Mulai Transaksi
                </a>
            </div>
        @endif
    </div>
</x-app-layout>
