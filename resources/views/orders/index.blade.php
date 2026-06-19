<x-app-layout>
    @section('title', 'Pesanan Online')

    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-lg font-semibold text-slate-900">Pesanan Online</h1>
                <p class="text-xs text-slate-500 mt-0.5">Kelola pesanan dari marketplace</p>
            </div>
        </div>
    </x-slot>

    {{-- Flash Messages --}}
    @if(session('success'))
        <div x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 4000)" class="mb-4 flex items-center gap-2.5 bg-emerald-50 border border-emerald-200 rounded-lg px-4 py-2.5">
            <svg class="w-4 h-4 text-emerald-500 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5"/></svg>
            <p class="text-xs text-emerald-700 font-medium">{{ session('success') }}</p>
        </div>
    @endif

    {{-- Filter --}}
    <div class="mb-4">
        <form method="GET" action="{{ route('dashboard.orders.index') }}" class="flex gap-2">
            <select name="status" class="border border-slate-200 rounded-lg bg-white text-xs text-slate-700 px-3 py-2 focus:border-slate-400 focus:ring-1 focus:ring-slate-400/20 transition-colors">
                <option value="">Semua Status</option>
                <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="paid" {{ request('status') === 'paid' ? 'selected' : '' }}>Dibayar</option>
                <option value="processing" {{ request('status') === 'processing' ? 'selected' : '' }}>Diproses</option>
                <option value="shipped" {{ request('status') === 'shipped' ? 'selected' : '' }}>Dikirim</option>
                <option value="completed" {{ request('status') === 'completed' ? 'selected' : '' }}>Selesai</option>
                <option value="cancelled" {{ request('status') === 'cancelled' ? 'selected' : '' }}>Dibatalkan</option>
            </select>
            <button type="submit" class="px-4 py-2 bg-white border border-slate-200 rounded-lg text-xs font-medium text-slate-700 hover:bg-slate-50 transition-colors">Filter</button>
            @if(request('status'))
                <a href="{{ route('dashboard.orders.index') }}" class="px-4 py-2 bg-white border border-slate-200 rounded-lg text-xs font-medium text-slate-500 hover:bg-slate-50 transition-colors">Reset</a>
            @endif
        </form>
    </div>

    {{-- Table --}}
    <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
        @if($orders->count() > 0)
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="border-b border-slate-100">
                            <th class="text-left px-5 py-2.5 text-[10px] font-semibold text-slate-400 uppercase tracking-wider">No. Pesanan</th>
                            <th class="text-left px-5 py-2.5 text-[10px] font-semibold text-slate-400 uppercase tracking-wider">Tanggal</th>
                            <th class="text-left px-5 py-2.5 text-[10px] font-semibold text-slate-400 uppercase tracking-wider">Pelanggan</th>
                            <th class="text-right px-5 py-2.5 text-[10px] font-semibold text-slate-400 uppercase tracking-wider">Total</th>
                            <th class="text-center px-5 py-2.5 text-[10px] font-semibold text-slate-400 uppercase tracking-wider">Status</th>
                            <th class="text-center px-5 py-2.5 text-[10px] font-semibold text-slate-400 uppercase tracking-wider w-20"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $order)
                        @php
                            $statusStyles = [
                                'pending' => 'bg-amber-50 text-amber-700',
                                'paid' => 'bg-blue-50 text-blue-700',
                                'processing' => 'bg-violet-50 text-violet-700',
                                'shipped' => 'bg-indigo-50 text-indigo-700',
                                'completed' => 'bg-emerald-50 text-emerald-700',
                                'cancelled' => 'bg-red-50 text-red-600',
                            ];
                            $statusLabels = [
                                'pending' => 'Pending',
                                'paid' => 'Dibayar',
                                'processing' => 'Diproses',
                                'shipped' => 'Dikirim',
                                'completed' => 'Selesai',
                                'cancelled' => 'Dibatalkan',
                            ];
                        @endphp
                        <tr class="border-b border-slate-50 last:border-0 hover:bg-slate-50/50 transition-colors">
                            <td class="px-5 py-3">
                                <a href="{{ route('dashboard.orders.show', $order) }}" class="text-xs font-medium text-slate-800 hover:underline">{{ $order->order_number }}</a>
                            </td>
                            <td class="px-5 py-3 text-xs text-slate-500">{{ $order->created_at->format('d M Y H:i') }}</td>
                            <td class="px-5 py-3">
                                <div class="flex items-center gap-2">
                                    <div class="w-6 h-6 rounded-full bg-slate-100 flex items-center justify-center text-[10px] font-semibold text-slate-500 shrink-0">{{ strtoupper(substr($order->user->name, 0, 1)) }}</div>
                                    <span class="text-xs text-slate-600">{{ $order->user->name }}</span>
                                </div>
                            </td>
                            <td class="px-5 py-3 text-right text-xs text-slate-800 font-medium tabular-nums">Rp{{ number_format($order->total_amount, 0, ',', '.') }}</td>
                            <td class="px-5 py-3 text-center">
                                <span class="inline-flex px-2 py-0.5 text-[11px] font-medium rounded-full {{ $statusStyles[$order->status] ?? 'bg-slate-100 text-slate-600' }}">{{ $statusLabels[$order->status] ?? ucfirst($order->status) }}</span>
                            </td>
                            <td class="px-5 py-3 text-center">
                                <a href="{{ route('dashboard.orders.show', $order) }}" class="p-1.5 rounded-md text-slate-400 hover:text-slate-600 hover:bg-slate-100 transition-colors inline-flex" title="Detail">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5"/></svg>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @if($orders->hasPages())
                <div class="px-5 py-3 border-t border-slate-100">
                    {{ $orders->links() }}
                </div>
            @endif
        @else
            {{-- Empty State --}}
            <div class="px-5 py-16 text-center">
                <div class="w-12 h-12 rounded-xl border-2 border-dashed border-slate-200 mx-auto mb-4 flex items-center justify-center">
                    <svg class="w-5 h-5 text-slate-300" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z"/></svg>
                </div>
                <h3 class="text-sm font-medium text-slate-700 mb-1">Belum ada pesanan</h3>
                <p class="text-xs text-slate-400">Pesanan dari pelanggan marketplace akan muncul di sini.</p>
            </div>
        @endif
    </div>
</x-app-layout>
