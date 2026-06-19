<x-customer-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="font-display text-headline-md text-primary-dark">Alamat Pengiriman</h1>
                <p class="text-body-sm text-on-surface-variant mt-1">Kelola daftar alamat untuk keperluan pengiriman pesanan Anda.</p>
            </div>
            <a href="{{ route('customer.address.create') }}" class="px-4 py-2 bg-primary text-white text-sm font-semibold rounded-heritage shadow hover:bg-primary-dark transition-colors flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/></svg>
                Tambah Alamat
            </a>
        </div>
    </x-slot>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($addresses as $address)
            <div class="bg-surface-white rounded-heritage border {{ $address->is_default ? 'border-primary shadow-md relative overflow-hidden' : 'border-outline shadow-sm' }} p-6 flex flex-col">
                
                @if($address->is_default)
                    <div class="absolute top-0 right-0 bg-primary text-white text-[10px] font-bold px-3 py-1 rounded-bl-lg uppercase tracking-wider">
                        Utama
                    </div>
                @endif

                <div class="mb-4">
                    <h3 class="font-display font-bold text-text-primary text-title-md">{{ $address->label }}</h3>
                    <p class="text-label-md text-on-surface-variant uppercase tracking-wider mt-1">{{ $address->recipient_name }}</p>
                </div>
                
                <div class="flex-1 space-y-2 mb-6">
                    <p class="text-body-sm text-text-primary">
                        {{ $address->phone }}
                    </p>
                    <p class="text-body-sm text-on-surface-variant leading-relaxed">
                        {{ $address->address }}<br>
                        {{ $address->district }}, {{ $address->city }}<br>
                        {{ $address->province }}, {{ $address->postal_code }}
                    </p>
                </div>

                <div class="flex gap-3 mt-auto pt-4 border-t border-outline">
                    <a href="{{ route('customer.address.edit', $address) }}" class="text-sm font-semibold text-primary hover:text-primary-dark transition-colors">Edit</a>
                    <form action="{{ route('customer.address.destroy', $address) }}" method="POST" class="ml-auto" onsubmit="return confirm('Hapus alamat ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-sm font-semibold text-error hover:text-red-700 transition-colors">Hapus</button>
                    </form>
                </div>
            </div>
        @empty
            <div class="col-span-full bg-surface-white rounded-heritage border border-outline p-10 text-center">
                <svg class="w-12 h-12 text-outline-dark mx-auto mb-3" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z"/></svg>
                <h3 class="font-display font-bold text-text-primary mb-1">Belum Ada Alamat</h3>
                <p class="text-body-sm text-on-surface-variant mb-4">Anda belum menambahkan alamat pengiriman apapun.</p>
                <a href="{{ route('customer.address.create') }}" class="inline-flex px-4 py-2 bg-primary text-white text-sm font-semibold rounded-heritage hover:bg-primary-dark transition-colors">
                    Tambah Alamat Sekarang
                </a>
            </div>
        @endforelse
    </div>
</x-customer-layout>
