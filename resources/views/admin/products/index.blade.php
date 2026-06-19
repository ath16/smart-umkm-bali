<x-admin-layout>
    <div class="mb-8 flex items-center justify-between">
        <div>
            <h1 class="font-display text-headline-md font-bold text-text-primary">Moderasi Produk</h1>
            <p class="text-body-sm text-on-surface-variant mt-1">Kelola produk yang ada di marketplace, blokir produk yang melanggar.</p>
        </div>
        
        <div class="flex items-center gap-2">
            <a href="{{ route('admin.products.index') }}" class="px-4 py-2 rounded-heritage text-sm font-semibold {{ !request('status') ? 'bg-primary text-white' : 'bg-surface-white text-text-primary border border-outline hover:bg-surface-container' }} transition-colors">Semua</a>
            <a href="{{ route('admin.products.index', ['status' => 'active']) }}" class="px-4 py-2 rounded-heritage text-sm font-semibold {{ request('status') === 'active' ? 'bg-primary text-white' : 'bg-surface-white text-text-primary border border-outline hover:bg-surface-container' }} transition-colors">Aktif</a>
            <a href="{{ route('admin.products.index', ['status' => 'suspended']) }}" class="px-4 py-2 rounded-heritage text-sm font-semibold {{ request('status') === 'suspended' ? 'bg-primary text-white' : 'bg-surface-white text-text-primary border border-outline hover:bg-surface-container' }} transition-colors">Diblokir</a>
        </div>
    </div>

    <div class="bg-surface-white rounded-heritage border border-outline shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-surface-container-low border-b border-outline">
                        <th class="p-4 text-label-md font-semibold text-on-surface-variant">ID</th>
                        <th class="p-4 text-label-md font-semibold text-on-surface-variant">Produk</th>
                        <th class="p-4 text-label-md font-semibold text-on-surface-variant">Toko</th>
                        <th class="p-4 text-label-md font-semibold text-on-surface-variant">Status</th>
                        <th class="p-4 text-label-md font-semibold text-on-surface-variant text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-outline">
                    @forelse($products as $product)
                        <tr class="hover:bg-surface-container-low/50 transition-colors">
                            <td class="p-4 text-body-md text-text-primary">#{{ $product->id }}</td>
                            <td class="p-4">
                                <div class="font-semibold text-text-primary">{{ $product->name }}</div>
                                <div class="text-xs text-on-surface-variant">Rp {{ number_format($product->sell_price, 0, ',', '.') }}</div>
                            </td>
                            <td class="p-4 text-body-md text-text-primary">
                                {{ $product->store?->name ?? 'Unknown' }}
                            </td>
                            <td class="p-4">
                                @if($product->isSuspended())
                                    <span class="px-2 py-1 bg-error/10 text-error text-xs font-semibold rounded-full border border-error/20">Diblokir</span>
                                @else
                                    <span class="px-2 py-1 bg-accent-teal/10 text-accent-teal text-xs font-semibold rounded-full border border-accent-teal/20">Aktif</span>
                                @endif
                            </td>
                            <td class="p-4 text-right">
                                @if($product->isSuspended())
                                    <form action="{{ route('admin.products.unsuspend', $product) }}" method="POST" class="inline-block" onsubmit="return confirm('Cabut blokir produk ini?');">
                                        @csrf
                                        <button type="submit" class="px-3 py-1.5 bg-surface-white border border-outline text-text-primary text-sm font-semibold rounded hover:bg-surface-container transition-colors">
                                            Buka Blokir
                                        </button>
                                    </form>
                                @else
                                    <form action="{{ route('admin.products.suspend', $product) }}" method="POST" class="inline-block" onsubmit="
                                        event.preventDefault();
                                        const reason = prompt('Masukkan alasan pemblokiran:');
                                        if (reason) {
                                            this.querySelector('input[name=reason]').value = reason;
                                            this.submit();
                                        }
                                    ">
                                        @csrf
                                        <input type="hidden" name="reason" value="">
                                        <button type="submit" class="px-3 py-1.5 bg-error/10 text-error text-sm font-semibold rounded hover:bg-error/20 transition-colors">
                                            Blokir
                                        </button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="p-8 text-center text-on-surface-variant">
                                Belum ada data produk.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($products->hasPages())
            <div class="p-4 border-t border-outline">
                {{ $products->links() }}
            </div>
        @endif
    </div>
</x-admin-layout>
