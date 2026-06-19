<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detail Pesanan') }} #{{ $order->order_number }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            @if(session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">
                    {{ session('error') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    <div class="flex justify-between items-start mb-8">
                        <div>
                            <h3 class="text-lg font-medium text-gray-900">Informasi Pelanggan</h3>
                            <p class="mt-1 text-sm text-gray-600">Nama: {{ $order->user->name }}</p>
                            <p class="text-sm text-gray-600">Email: {{ $order->user->email }}</p>
                            <p class="text-sm text-gray-600">Waktu Order: {{ $order->created_at->format('d M Y H:i') }}</p>
                        </div>
                        
                        <div class="text-right border p-4 rounded-md">
                            <h3 class="text-sm font-medium text-gray-900 mb-2">Update Status Pesanan</h3>
                            
                            @if($order->status === 'paid' || $order->status === 'processing')
                                <div class="space-y-3">
                                    @if($order->status === 'paid')
                                        <form action="{{ route('dashboard.orders.update_status', $order) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="status" value="processing">
                                            <x-primary-button class="w-full justify-center bg-purple-600 hover:bg-purple-700 focus:ring-purple-500">
                                                Terima & Proses Pesanan
                                            </x-primary-button>
                                        </form>
                                    @endif

                                    @if($order->status === 'processing')
                                        <form action="{{ route('dashboard.orders.update_status', $order) }}" method="POST" class="space-y-3 border-b pb-4 mb-4">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="status" value="shipped">
                                            <div>
                                                <input type="text" name="shipping_courier" placeholder="Kurir (Misal: JNE, J&T)" class="w-full text-sm border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                                            </div>
                                            <div>
                                                <input type="text" name="tracking_number" placeholder="Nomor Resi" class="w-full text-sm border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                                            </div>
                                            <x-primary-button class="w-full justify-center bg-indigo-600 hover:bg-indigo-700 focus:ring-indigo-500">
                                                Kirim Pesanan
                                            </x-primary-button>
                                        </form>
                                    @endif

                                    <form action="{{ route('dashboard.orders.update_status', $order) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin membatalkan pesanan ini? Stok akan dikembalikan secara otomatis.');">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="status" value="cancelled">
                                        <button type="submit" class="w-full inline-flex justify-center items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                            Batalkan Pesanan
                                        </button>
                                    </form>
                                </div>
                            @else
                                <p class="text-sm text-gray-500 mb-2">Status saat ini: 
                                    @php
                                        $labels = [
                                            'pending' => 'Pending (Menunggu Pembayaran)',
                                            'paid' => 'Dibayar',
                                            'processing' => 'Diproses',
                                            'shipped' => 'Dikirim',
                                            'completed' => 'Selesai',
                                            'cancelled' => 'Dibatalkan',
                                        ];
                                    @endphp
                                    <strong>{{ $labels[$order->status] ?? $order->status }}</strong>
                                </p>
                                @if($order->status === 'shipped' || $order->status === 'completed')
                                    <div class="bg-gray-50 p-3 rounded text-left border">
                                        <p class="text-xs text-gray-500 uppercase tracking-wider mb-1">Informasi Pengiriman</p>
                                        <p class="text-sm font-medium text-gray-900">{{ $order->shipping_courier ?? 'Kurir tidak diketahui' }}</p>
                                        <p class="text-sm text-gray-600">Resi: <span class="font-mono">{{ $order->tracking_number ?? '-' }}</span></p>
                                    </div>
                                @endif
                            @endif
                        </div>
                    </div>

                    <div class="border-t border-gray-200 pt-6 mb-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Alamat Pengiriman</h3>
                        @if($order->orderAddress)
                            <p class="text-sm font-medium text-gray-900">{{ $order->orderAddress->recipient_name }} ({{ $order->orderAddress->phone }})</p>
                            <p class="text-sm text-gray-600">{{ $order->orderAddress->address }}</p>
                            <p class="text-sm text-gray-600">{{ $order->orderAddress->district }}, {{ $order->orderAddress->city }}, {{ $order->orderAddress->province }} {{ $order->orderAddress->postal_code }}</p>
                        @else
                            <p class="text-sm text-gray-500">Alamat tidak tersedia.</p>
                        @endif
                    </div>

                    <div class="border-t border-gray-200 pt-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Daftar Produk</h3>
                        <table class="min-w-full divide-y divide-gray-200 border">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Produk</th>
                                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Harga</th>
                                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Qty</th>
                                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($order->orderItems as $item)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $item->product_name }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 text-right">Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 text-right">{{ $item->quantity }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 text-right font-medium">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot class="bg-gray-50 font-medium">
                                <tr>
                                    <td colspan="3" class="px-6 py-3 text-right text-sm text-gray-900">Ongkos Kirim</td>
                                    <td class="px-6 py-3 text-right text-sm text-gray-900">Rp {{ number_format($order->shipping_fee, 0, ',', '.') }}</td>
                                </tr>
                                <tr>
                                    <td colspan="3" class="px-6 py-3 text-right text-sm text-gray-900 uppercase">Total</td>
                                    <td class="px-6 py-3 text-right text-sm text-indigo-600 font-bold">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                    <div class="mt-6">
                        <a href="{{ route('dashboard.orders.index') }}" class="text-sm text-indigo-600 hover:text-indigo-900">&larr; Kembali ke Daftar Pesanan</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
