<x-app-layout>
    @section('title', 'Produk')

    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-lg font-semibold text-slate-900">Produk</h1>
                <p class="text-xs text-slate-500 mt-0.5">Kelola katalog produk usaha Anda</p>
            </div>
            <a href="{{ route('dashboard.products.create') }}" class="inline-flex items-center gap-1.5 px-3.5 py-2 bg-slate-900 text-white text-xs font-medium rounded-md hover:bg-slate-800 transition-colors">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/></svg>
                Tambah Produk
            </a>
        </div>
    </x-slot>

    {{-- Flash Messages --}}
    @if(session('success'))
        <div x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 4000)" class="mb-4 flex items-center gap-2.5 bg-emerald-50 border border-emerald-200 rounded-lg px-4 py-2.5">
            <svg class="w-4 h-4 text-emerald-500 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5"/></svg>
            <p class="text-xs text-emerald-700 font-medium">{{ session('success') }}</p>
            <button @click="show = false" class="ml-auto text-emerald-400 hover:text-emerald-600"><svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12"/></svg></button>
        </div>
    @endif

    {{-- Search --}}
    <div class="mb-4">
        <form method="GET" action="{{ route('dashboard.products.index') }}" class="flex gap-2">
            <div class="flex-1 relative">
                <svg class="w-4 h-4 absolute left-3 top-1/2 -translate-y-1/2 text-slate-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z"/></svg>
                <input type="text" name="search" value="{{ $search }}" placeholder="Cari produk..." class="w-full pl-9 pr-4 py-2 border border-slate-200 rounded-lg bg-white text-xs text-slate-800 placeholder:text-slate-400 focus:border-slate-400 focus:ring-1 focus:ring-slate-400/20 transition-colors">
            </div>
            <button type="submit" class="px-4 py-2 bg-white border border-slate-200 rounded-lg text-xs font-medium text-slate-700 hover:bg-slate-50 transition-colors">Cari</button>
            @if($search)
                <a href="{{ route('dashboard.products.index') }}" class="px-4 py-2 bg-white border border-slate-200 rounded-lg text-xs font-medium text-slate-500 hover:bg-slate-50 transition-colors">Reset</a>
            @endif
        </form>
    </div>

    {{-- Table --}}
    <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
        @if($products->count() > 0)
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="border-b border-slate-100">
                            <th class="text-left px-5 py-2.5 text-[10px] font-semibold text-slate-400 uppercase tracking-wider">Produk</th>
                            <th class="text-right px-5 py-2.5 text-[10px] font-semibold text-slate-400 uppercase tracking-wider">Modal</th>
                            <th class="text-right px-5 py-2.5 text-[10px] font-semibold text-slate-400 uppercase tracking-wider">Harga Jual</th>
                            <th class="text-right px-5 py-2.5 text-[10px] font-semibold text-slate-400 uppercase tracking-wider">Margin</th>
                            <th class="text-center px-5 py-2.5 text-[10px] font-semibold text-slate-400 uppercase tracking-wider">Stok</th>
                            <th class="text-center px-5 py-2.5 text-[10px] font-semibold text-slate-400 uppercase tracking-wider w-20"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($products as $product)
                            <tr class="border-b border-slate-50 last:border-0 hover:bg-slate-50/50 transition-colors">
                                <td class="px-5 py-3">
                                    <div class="flex items-center gap-3">
                                        <div class="w-8 h-8 rounded-md bg-slate-100 flex items-center justify-center shrink-0">
                                            <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="m20.25 7.5-.625 10.632a2.25 2.25 0 0 1-2.247 2.118H6.622a2.25 2.25 0 0 1-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125Z"/></svg>
                                        </div>
                                        <div>
                                            <span class="text-xs font-medium text-slate-800 block">{{ $product->name }}</span>
                                            <div class="flex items-center gap-1 mt-0.5">
                                                @if(!$product->is_published)
                                                    <span class="px-1.5 py-0.5 rounded text-[9px] font-semibold bg-slate-100 text-slate-500">DRAFT</span>
                                                @endif
                                                @if($product->is_featured)
                                                    <span class="px-1.5 py-0.5 rounded text-[9px] font-semibold bg-amber-50 text-amber-600">FEATURED</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-5 py-3 text-right text-xs text-slate-500 tabular-nums">{{ $product->formatted_cost_price }}</td>
                                <td class="px-5 py-3 text-right text-xs text-slate-800 font-medium tabular-nums">{{ $product->formatted_sell_price }}</td>
                                <td class="px-5 py-3 text-right text-xs text-emerald-600 font-medium tabular-nums">{{ $product->formatted_profit }}</td>
                                <td class="px-5 py-3 text-center">
                                    @if($product->stock == 0)
                                        <span class="inline-flex px-2 py-0.5 rounded-full text-[11px] font-medium bg-red-50 text-red-600">Habis</span>
                                    @elseif($product->isLowStock())
                                        <span class="inline-flex px-2 py-0.5 rounded-full text-[11px] font-medium bg-amber-50 text-amber-600 tabular-nums">{{ $product->stock }}</span>
                                    @else
                                        <span class="text-xs text-slate-600 tabular-nums">{{ $product->stock }}</span>
                                    @endif
                                </td>
                                <td class="px-5 py-3 text-center" x-data="{ open: false }">
                                    <div class="relative inline-block">
                                        <button @click="open = !open" @click.outside="open = false" class="p-1.5 rounded-md text-slate-400 hover:text-slate-600 hover:bg-slate-100 transition-colors">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM12.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM18.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z"/></svg>
                                        </button>
                                        <div x-show="open" x-transition class="absolute right-0 mt-1 w-36 bg-white border border-slate-200 rounded-lg shadow-lg py-1 z-10" style="display:none">
                                            <a href="{{ route('dashboard.products.edit', $product) }}" class="flex items-center gap-2 px-3 py-2 text-xs text-slate-600 hover:bg-slate-50 transition-colors">
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10"/></svg>
                                                Edit
                                            </a>
                                            <form method="POST" action="{{ route('dashboard.products.destroy', $product) }}" x-ref="deleteForm">
                                                @csrf @method('DELETE')
                                                <button type="button" @click="if(confirm('Hapus produk \'{{ $product->name }}\'?')) $refs.deleteForm.submit()" class="flex items-center gap-2 px-3 py-2 text-xs text-red-500 hover:bg-red-50 transition-colors w-full text-left">
                                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0"/></svg>
                                                    Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @if($products->hasPages())
                <div class="px-5 py-3 border-t border-slate-100">
                    {{ $products->links('products.partials.pagination') }}
                </div>
            @endif
        @else
            {{-- Empty State --}}
            <div class="px-5 py-16 text-center">
                <div class="w-12 h-12 rounded-xl border-2 border-dashed border-slate-200 mx-auto mb-4 flex items-center justify-center">
                    <svg class="w-5 h-5 text-slate-300" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="m20.25 7.5-.625 10.632a2.25 2.25 0 0 1-2.247 2.118H6.622a2.25 2.25 0 0 1-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125Z"/></svg>
                </div>
                @if($search)
                    <h3 class="text-sm font-medium text-slate-700 mb-1">Tidak ditemukan</h3>
                    <p class="text-xs text-slate-400 mb-4">Tidak ada produk yang cocok dengan "{{ $search }}"</p>
                    <a href="{{ route('dashboard.products.index') }}" class="text-xs font-medium text-slate-500 hover:text-slate-700 underline">Reset</a>
                @else
                    <h3 class="text-sm font-medium text-slate-700 mb-1">Belum ada produk</h3>
                    <p class="text-xs text-slate-400 mb-4">Tambahkan produk pertama Anda</p>
                    <a href="{{ route('dashboard.products.create') }}" class="inline-flex items-center gap-1.5 px-3.5 py-2 bg-slate-900 text-white text-xs font-medium rounded-md hover:bg-slate-800 transition-colors">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/></svg>
                        Tambah Produk
                    </a>
                @endif
            </div>
        @endif
    </div>

    @if($products->total() > 0)
        <p class="mt-3 text-[11px] text-slate-400">Menampilkan {{ $products->firstItem() }}–{{ $products->lastItem() }} dari {{ $products->total() }} produk</p>
    @endif
</x-app-layout>
