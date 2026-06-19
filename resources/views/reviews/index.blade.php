<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Ulasan Produk') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    @if($reviews->count() > 0)
                        <div class="space-y-6">
                            @foreach($reviews as $review)
                                <div class="border-b border-gray-200 pb-6 last:border-0 last:pb-0">
                                    <div class="flex justify-between items-start mb-2">
                                        <div class="flex items-center gap-4">
                                            <div class="font-medium text-gray-900">{{ $review->user->name }}</div>
                                            <div class="text-sm text-gray-500">{{ $review->created_at->diffForHumans() }}</div>
                                        </div>
                                        <div class="flex items-center text-yellow-400">
                                            @for($i = 1; $i <= 5; $i++)
                                                @if($i <= $review->rating)
                                                    <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20">
                                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                                    </svg>
                                                @else
                                                    <svg class="w-5 h-5 fill-current text-gray-300" viewBox="0 0 20 20">
                                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                                    </svg>
                                                @endif
                                            @endfor
                                        </div>
                                    </div>
                                    <div class="mb-2">
                                        <p class="text-sm font-medium text-indigo-600">Produk: {{ $review->product->name }}</p>
                                        <p class="text-xs text-gray-500">No. Pesanan: <a href="{{ route('dashboard.orders.show', $review->order_id) }}" class="hover:underline">{{ $review->order->order_number }}</a></p>
                                    </div>
                                    <p class="text-gray-700 whitespace-pre-wrap">{{ $review->comment }}</p>
                                </div>
                            @endforeach
                        </div>
                        <div class="mt-6">
                            {{ $reviews->links() }}
                        </div>
                    @else
                        <div class="text-center py-8">
                            <p class="text-gray-500">Belum ada ulasan produk untuk toko Anda.</p>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
