<x-app-layout>
    @section('title', 'Transaksi Baru')

    <x-slot name="header">
        <h1 class="font-display text-headline-md text-primary-dark">Transaksi Baru</h1>
        <p class="text-body-sm text-on-surface-variant mt-1">Sistem Kasir (Point of Sale)</p>
    </x-slot>

    <div x-data="posSystem()" class="grid grid-cols-1 lg:grid-cols-3 gap-6 relative">
        {{-- Left Side: Product Selection & Chat Mode --}}
        <div class="lg:col-span-2 space-y-6">
            
            {{-- Mode Toggle --}}
            <div class="flex gap-2 p-1 bg-surface-white border border-outline rounded-heritage w-max">
                <button @click="mode = 'classic'" :class="mode === 'classic' ? 'bg-primary text-white shadow' : 'text-on-surface-variant hover:bg-surface-container-high'" class="px-4 py-2 rounded-md text-sm font-semibold transition-colors">Mode Klasik</button>
                <button @click="mode = 'chat'" :class="mode === 'chat' ? 'bg-primary text-white shadow' : 'text-on-surface-variant hover:bg-surface-container-high'" class="px-4 py-2 rounded-md text-sm font-semibold transition-colors">Mode Chat</button>
            </div>

            {{-- Mode: Chat --}}
            <div x-show="mode === 'chat'" style="display: none;" class="bg-surface-white rounded-heritage border border-outline shadow-card p-6">
                <h3 class="font-display text-title-lg font-bold text-primary-dark mb-2">Transaksi Cepat dengan Teks</h3>
                <p class="text-body-sm text-on-surface-variant mb-4">Ketik nama produk dan jumlahnya, pisahkan dengan koma. Contoh: <strong>Kopi Bali 2, Roti Coklat 1</strong></p>
                
                <form action="{{ route('transactions.parse') }}" method="POST">
                    @csrf
                    <textarea name="chat_text" rows="4" class="w-full border-outline rounded-heritage bg-surface text-text-primary text-body-sm placeholder:text-on-surface-variant/50 focus:border-primary focus:ring focus:ring-primary/10 transition-colors mb-4" placeholder="Ketik pesanan di sini...">{{ old('chat_text', $chatText ?? '') }}</textarea>
                    
                    <button type="submit" class="px-6 py-2 bg-primary text-white rounded-heritage font-semibold hover:bg-primary-dark transition-colors">
                        Proses Teks
                    </button>
                </form>
            </div>

            {{-- Mode: Classic --}}
            <div x-show="mode === 'classic'" class="space-y-6">
                {{-- Search Bar --}}
            <div class="bg-surface-white rounded-heritage border border-outline shadow-card p-4">
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                        <svg class="w-4 h-4 text-on-surface-variant" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z"/></svg>
                    </div>
                    <input type="text" x-model="searchQuery" placeholder="Cari produk..." class="w-full pl-10 pr-4 py-3 border-outline rounded-heritage bg-surface text-text-primary text-body-sm placeholder:text-on-surface-variant/50 focus:border-outline-dark focus:ring focus:ring-outline-dark/10 transition-colors">
                </div>
            </div>

            {{-- Products Grid --}}
            <div class="grid grid-cols-2 sm:grid-cols-3 gap-4" style="max-height: calc(100vh - 280px); overflow-y: auto;">
                <template x-for="product in filteredProducts" :key="product.id">
                    <button @click="addToCart(product)" class="bg-surface-white rounded-heritage border border-outline shadow-card p-4 flex flex-col items-start text-left hover:border-primary/50 hover:shadow-md transition-all active:scale-95 group relative overflow-hidden" :class="{'opacity-50 cursor-not-allowed': product.stock <= 0}" :disabled="product.stock <= 0">
                        <div class="w-full aspect-video bg-surface-container rounded-sm flex items-center justify-center mb-3 group-hover:bg-primary/5 transition-colors">
                            <svg class="w-8 h-8 text-on-surface-variant/30 group-hover:text-primary/40 transition-colors" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="m20.25 7.5-.625 10.632a2.25 2.25 0 0 1-2.247 2.118H6.622a2.25 2.25 0 0 1-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125Z"/></svg>
                        </div>
                        <h3 class="font-body text-body-sm font-semibold text-text-primary line-clamp-2 leading-tight w-full" x-text="product.name"></h3>
                        <p class="font-display text-body-sm font-bold text-primary-dark mt-1 tabular-nums" x-text="formatRp(product.sell_price)"></p>
                        
                        <div class="mt-2 w-full flex justify-between items-center text-label-md">
                            <span class="text-on-surface-variant">Stok: <span x-text="product.stock" :class="product.stock <= product.min_stock ? 'text-error' : ''"></span></span>
                        </div>
                        
                        <div x-show="product.stock <= 0" class="absolute inset-0 bg-surface-white/60 flex items-center justify-center backdrop-blur-[1px]">
                            <span class="bg-error text-white px-3 py-1 rounded-full text-label-md font-semibold">Habis</span>
                        </div>
                    </button>
                </template>
                <div x-show="filteredProducts.length === 0" class="col-span-full py-12 text-center text-on-surface-variant">
                    Produk tidak ditemukan.
                </div>
            </div>
            </div>
        </div>

        {{-- Right Side: Cart --}}
        <div class="bg-surface-white rounded-heritage border border-outline shadow-card flex flex-col h-[calc(100vh-140px)] sticky top-6">
            <div class="p-4 border-b border-outline flex justify-between items-center">
                <h2 class="font-display text-headline-md text-text-primary flex items-center gap-2">
                    <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z"/></svg>
                    Keranjang
                </h2>
                <button @click="clearCart" x-show="cart.length > 0" class="text-label-md font-semibold text-error hover:bg-error/10 px-2 py-1 rounded transition-colors">Kosongkan</button>
            </div>

            {{-- Cart Items --}}
            <div class="flex-1 overflow-y-auto p-4 space-y-3">
                <div x-show="cart.length === 0" class="h-full flex flex-col items-center justify-center text-on-surface-variant space-y-3">
                    <svg class="w-12 h-12 text-outline-dark" fill="none" stroke="currentColor" stroke-width="1" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z"/></svg>
                    <p class="text-body-sm text-center">Keranjang masih kosong.<br>Pilih produk di samping.</p>
                </div>
                
                <template x-for="(item, index) in cart" :key="item.product_id">
                    <div class="flex items-start gap-3 p-3 bg-surface rounded-heritage border border-outline">
                        <div class="flex-1 min-w-0">
                            <h4 class="text-body-sm font-semibold text-text-primary truncate" x-text="item.name"></h4>
                            <p class="text-label-md text-on-surface-variant tabular-nums" x-text="formatRp(item.sell_price)"></p>
                        </div>
                        <div class="flex flex-col items-end gap-2">
                            <p class="font-display text-body-sm font-bold text-primary-dark tabular-nums" x-text="formatRp(item.sell_price * item.quantity)"></p>
                            <div class="flex items-center gap-1 bg-surface-white border border-outline rounded-md">
                                <button @click="updateQuantity(index, -1)" class="w-6 h-6 flex items-center justify-center text-on-surface-variant hover:bg-surface-container-high transition-colors" type="button">-</button>
                                <input type="number" x-model.number="item.quantity" @change="validateQuantity(index)" class="w-10 h-6 p-0 text-center border-none bg-transparent text-body-sm font-medium tabular-nums focus:ring-0" min="1" :max="item.stock">
                                <button @click="updateQuantity(index, 1)" class="w-6 h-6 flex items-center justify-center text-on-surface-variant hover:bg-surface-container-high transition-colors" type="button">+</button>
                            </div>
                        </div>
                    </div>
                </template>
            </div>

            {{-- Checkout Form --}}
            <div class="border-t border-outline p-4 bg-surface-container-lowest">
                <form method="POST" action="{{ route('transactions.store') }}" @submit="submitForm">
                    @csrf
                    
                    {{-- Hidden inputs for cart data --}}
                    <template x-for="(item, index) in cart" :key="item.product_id">
                        <div>
                            <input type="hidden" :name="'items['+index+'][product_id]'" :value="item.product_id">
                            <input type="hidden" :name="'items['+index+'][quantity]'" :value="item.quantity">
                        </div>
                    </template>

                    <div class="space-y-3 mb-4">
                        <div class="flex justify-between items-center text-body-sm text-text-primary font-semibold">
                            <span>Total</span>
                            <span class="font-display text-headline-md text-primary-dark tabular-nums" x-text="formatRp(totalAmount)"></span>
                        </div>
                        
                        <div>
                            <label class="block text-label-md text-on-surface-variant mb-1">Jumlah Pembayaran</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                                    <span class="text-on-surface-variant text-body-sm font-medium">Rp</span>
                                </div>
                                <input type="number" name="payment_amount" x-model.number="paymentAmount" class="block w-full pl-10 pr-4 py-2 border-outline rounded-heritage bg-surface-white text-text-primary text-body-lg font-bold tabular-nums focus:border-primary focus:ring focus:ring-primary/20 transition-colors" required min="0" :class="{'border-error': paymentAmount > 0 && paymentAmount < totalAmount}">
                            </div>
                            <p x-show="paymentAmount > 0 && paymentAmount < totalAmount" class="text-error text-label-md mt-1">Uang tidak cukup!</p>
                        </div>

                        <div class="flex justify-between items-center text-body-sm pt-2 border-t border-outline border-dashed">
                            <span class="text-on-surface-variant">Kembalian</span>
                            <span class="font-display font-bold tabular-nums" :class="changeAmount >= 0 ? 'text-accent-teal' : 'text-error'" x-text="formatRp(Math.max(0, changeAmount))"></span>
                        </div>

                        <div>
                            <input type="text" name="notes" placeholder="Catatan (opsional)" class="w-full text-body-sm border-outline rounded-heritage bg-surface-white placeholder:text-on-surface-variant/50 focus:border-outline-dark focus:ring-0 px-3 py-2">
                        </div>
                    </div>

                    @if($errors->any())
                        <div class="mb-4 p-3 bg-error-container text-error rounded-heritage text-body-sm font-medium">
                            {{ $errors->first() }}
                        </div>
                    @endif

                    <button type="submit" class="w-full py-3 bg-primary border border-transparent rounded-heritage font-body text-body-sm font-bold text-white hover:bg-primary-dark disabled:opacity-50 disabled:cursor-not-allowed transition-all active:scale-[0.98] flex items-center justify-center gap-2" :disabled="cart.length === 0 || paymentAmount < totalAmount">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5"/></svg>
                        Simpan Transaksi
                    </button>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('posSystem', () => ({
                mode: '{{ isset($parsedItems) ? 'chat' : 'classic' }}',
                products: @json($products),
                searchQuery: '',
                cart: @json($parsedItems ?? []),
                paymentAmount: '',

                get filteredProducts() {
                    if (this.searchQuery === '') {
                        return this.products;
                    }
                    const q = this.searchQuery.toLowerCase();
                    return this.products.filter(p => p.name.toLowerCase().includes(q));
                },

                get totalAmount() {
                    return this.cart.reduce((sum, item) => sum + (item.sell_price * item.quantity), 0);
                },

                get changeAmount() {
                    const pay = Number(this.paymentAmount) || 0;
                    return pay - this.totalAmount;
                },

                init() {
                    if (this.cart.length > 0) {
                        this.paymentAmount = this.totalAmount;
                    }
                },

                addToCart(product) {
                    if (product.stock <= 0) return;
                    
                    const existing = this.cart.find(i => i.product_id === product.id);
                    if (existing) {
                        if (existing.quantity < product.stock) {
                            existing.quantity++;
                        }
                    } else {
                        this.cart.push({
                            product_id: product.id,
                            name: product.name,
                            sell_price: Number(product.sell_price),
                            stock: product.stock,
                            quantity: 1
                        });
                    }
                    // Auto-set payment amount for convenience if it's currently empty or less than total
                    if (!this.paymentAmount || this.paymentAmount < this.totalAmount) {
                         this.paymentAmount = this.totalAmount;
                    }
                },

                updateQuantity(index, change) {
                    const item = this.cart[index];
                    const newQty = item.quantity + change;
                    
                    if (newQty <= 0) {
                        this.cart.splice(index, 1);
                    } else if (newQty <= item.stock) {
                        item.quantity = newQty;
                    } else {
                        item.quantity = item.stock;
                    }
                    this.updatePaymentAmount();
                },

                validateQuantity(index) {
                    const item = this.cart[index];
                    item.quantity = Number(item.quantity) || 1;
                    if (item.quantity <= 0) {
                        this.cart.splice(index, 1);
                    } else if (item.quantity > item.stock) {
                        item.quantity = item.stock;
                    }
                    this.updatePaymentAmount();
                },

                updatePaymentAmount() {
                    if (this.paymentAmount && this.paymentAmount < this.totalAmount) {
                         this.paymentAmount = this.totalAmount;
                    }
                },

                clearCart() {
                    if(confirm('Kosongkan keranjang?')) {
                        this.cart = [];
                        this.paymentAmount = '';
                    }
                },

                formatRp(n) {
                    return 'Rp' + new Intl.NumberFormat('id-ID').format(Math.floor(n));
                },

                submitForm(e) {
                    if (this.cart.length === 0) {
                        e.preventDefault();
                        alert('Keranjang kosong!');
                        return false;
                    }
                    if (this.paymentAmount < this.totalAmount) {
                        e.preventDefault();
                        alert('Jumlah pembayaran kurang!');
                        return false;
                    }
                }
            }));
        });
    </script>
    @endpush
</x-app-layout>
