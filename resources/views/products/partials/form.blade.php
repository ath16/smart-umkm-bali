{{-- Product Form Partial - shared by create and edit --}}
@props(['product' => null])

<div class="space-y-6">
    {{-- Nama Produk --}}
    <div>
        <x-input-label for="name" :value="__('Nama Produk')" />
        <x-text-input id="name" name="name" type="text" class="block mt-1.5 w-full" :value="old('name', $product?->name)" required autofocus placeholder="Masukkan nama produk" />
        <x-input-error :messages="$errors->get('name')" class="mt-1.5" />
    </div>

    {{-- Harga Section --}}
    <div class="relative py-1">
        <div class="absolute inset-0 flex items-center"><div class="w-full border-t border-outline"></div></div>
        <div class="relative flex justify-center text-label-md uppercase tracking-wider">
            <span class="bg-surface-white px-3 text-on-surface-variant">Informasi Harga</span>
        </div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
        {{-- Harga Modal --}}
        <div>
            <x-input-label for="cost_price" :value="__('Harga Modal (Rp)')" />
            <div class="relative mt-1.5">
                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                    <span class="text-on-surface-variant text-body-sm">Rp</span>
                </div>
                <input type="number" id="cost_price" name="cost_price" step="1" min="0" value="{{ old('cost_price', $product ? intval($product->cost_price) : '') }}" class="block w-full pl-10 pr-4 py-2.5 border-outline rounded-heritage bg-surface-white text-text-primary text-body-sm placeholder:text-on-surface-variant/50 focus:border-outline-dark focus:ring focus:ring-outline-dark/10 transition-colors tabular-nums" required placeholder="0">
            </div>
            <x-input-error :messages="$errors->get('cost_price')" class="mt-1.5" />
        </div>

        {{-- Harga Jual --}}
        <div>
            <x-input-label for="sell_price" :value="__('Harga Jual (Rp)')" />
            <div class="relative mt-1.5">
                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                    <span class="text-on-surface-variant text-body-sm">Rp</span>
                </div>
                <input type="number" id="sell_price" name="sell_price" step="1" min="0" value="{{ old('sell_price', $product ? intval($product->sell_price) : '') }}" class="block w-full pl-10 pr-4 py-2.5 border-outline rounded-heritage bg-surface-white text-text-primary text-body-sm placeholder:text-on-surface-variant/50 focus:border-outline-dark focus:ring focus:ring-outline-dark/10 transition-colors tabular-nums" required placeholder="0">
            </div>
            <x-input-error :messages="$errors->get('sell_price')" class="mt-1.5" />
        </div>
    </div>

    {{-- Margin Preview --}}
    <div x-data="{
        cost: {{ old('cost_price', $product ? intval($product->cost_price) : 0) }},
        sell: {{ old('sell_price', $product ? intval($product->sell_price) : 0) }},
        get margin() { return this.sell - this.cost },
        get marginPercent() { return this.cost > 0 ? ((this.margin / this.cost) * 100).toFixed(1) : 0 },
        formatRp(n) { return 'Rp' + new Intl.NumberFormat('id-ID').format(n) }
    }"
    x-init="
        $watch('cost', val => cost = Number(val) || 0);
        $watch('sell', val => sell = Number(val) || 0);
        document.getElementById('cost_price').addEventListener('input', e => cost = Number(e.target.value) || 0);
        document.getElementById('sell_price').addEventListener('input', e => sell = Number(e.target.value) || 0);
    "
    class="bg-surface rounded-heritage border border-outline p-4">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-2">
                <svg class="w-4 h-4 text-on-surface-variant" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18 9 11.25l4.306 4.306a11.95 11.95 0 0 1 5.814-5.518l2.74-1.22m0 0-5.94-2.281m5.94 2.28-2.28 5.941"/></svg>
                <span class="text-body-sm text-on-surface-variant">Margin Keuntungan</span>
            </div>
            <div class="text-right">
                <span class="font-display text-body-sm font-semibold" :class="margin >= 0 ? 'text-accent-teal' : 'text-error'" x-text="formatRp(margin)"></span>
                <span class="text-label-md text-on-surface-variant ml-1" x-show="cost > 0">(<span x-text="marginPercent"></span>%)</span>
            </div>
        </div>
    </div>

    {{-- Stok Section --}}
    <div class="relative py-1">
        <div class="absolute inset-0 flex items-center"><div class="w-full border-t border-outline"></div></div>
        <div class="relative flex justify-center text-label-md uppercase tracking-wider">
            <span class="bg-surface-white px-3 text-on-surface-variant">Informasi Stok</span>
        </div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
        {{-- Stok --}}
        <div>
            <x-input-label for="stock" :value="__('Jumlah Stok')" />
            <x-text-input id="stock" name="stock" type="number" class="block mt-1.5 w-full tabular-nums" :value="old('stock', $product?->stock ?? 0)" required min="0" placeholder="0" />
            <x-input-error :messages="$errors->get('stock')" class="mt-1.5" />
        </div>

        {{-- Stok Minimum --}}
        <div>
            <x-input-label for="min_stock" :value="__('Stok Minimum')" />
            <x-text-input id="min_stock" name="min_stock" type="number" class="block mt-1.5 w-full tabular-nums" :value="old('min_stock', $product?->min_stock ?? 5)" required min="0" placeholder="5" />
            <p class="text-label-md text-on-surface-variant mt-1">Peringatan ditampilkan jika stok ≤ nilai ini</p>
            <x-input-error :messages="$errors->get('min_stock')" class="mt-1.5" />
        </div>
    </div>

    {{-- Berat Produk --}}
    <div>
        <x-input-label for="weight" :value="__('Berat Produk (Gram)')" />
        <x-text-input id="weight" name="weight" type="number" class="block mt-1.5 w-full tabular-nums" :value="old('weight', $product?->weight ?? 1000)" required min="1" placeholder="1000" />
        <p class="text-label-md text-on-surface-variant mt-1">Digunakan untuk kalkulasi ongkos kirim (1 kg = 1000 gram)</p>
        <x-input-error :messages="$errors->get('weight')" class="mt-1.5" />
    </div>

    {{-- Visibilitas Section --}}
    <div class="relative py-1">
        <div class="absolute inset-0 flex items-center"><div class="w-full border-t border-outline"></div></div>
        <div class="relative flex justify-center text-label-md uppercase tracking-wider">
            <span class="bg-surface-white px-3 text-on-surface-variant">Visibilitas Produk</span>
        </div>
    </div>

    <div class="space-y-4">
        <div class="flex items-center gap-3">
            <input type="checkbox" id="is_published" name="is_published" value="1" {{ old('is_published', $product?->is_published ?? true) ? 'checked' : '' }} class="rounded border-gray-300 text-primary shadow-sm focus:ring-primary">
            <div>
                <label for="is_published" class="font-medium text-text-primary text-body-sm block">Tampilkan di Publik</label>
                <p class="text-label-sm text-on-surface-variant">Jika tidak dicentang, produk ini tidak akan muncul di katalog toko Anda.</p>
            </div>
        </div>

        <div class="flex items-center gap-3">
            <input type="checkbox" id="is_featured" name="is_featured" value="1" {{ old('is_featured', $product?->is_featured ?? false) ? 'checked' : '' }} class="rounded border-gray-300 text-primary shadow-sm focus:ring-primary">
            <div>
                <label for="is_featured" class="font-medium text-text-primary text-body-sm block">Jadikan Produk Unggulan</label>
                <p class="text-label-sm text-on-surface-variant">Produk unggulan akan diprioritaskan untuk tampil di Landing Page / Daftar Teratas.</p>
            </div>
        </div>
    </div>
</div>
