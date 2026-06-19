<x-app-layout>
    @section('title', 'Dashboard')

    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-lg font-semibold text-slate-900">Dashboard</h1>
                <p class="text-xs text-slate-500 mt-0.5">{{ now()->translatedFormat('l, d F Y') }}</p>
            </div>
        </div>
    </x-slot>

    {{-- KPI Cards --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
        {{-- Pendapatan Hari Ini --}}
        <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-5">
            <p class="text-xs font-medium text-slate-500 uppercase tracking-wider">Pendapatan Hari Ini</p>
            <p class="text-2xl font-semibold text-slate-900 mt-2 tabular-nums">Rp{{ number_format($todayRevenue, 0, ',', '.') }}</p>
            <p class="text-xs text-slate-400 mt-1">pendapatan hari ini</p>
        </div>

        {{-- Transaksi Hari Ini --}}
        <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-5">
            <p class="text-xs font-medium text-slate-500 uppercase tracking-wider">Transaksi Hari Ini</p>
            <p class="text-2xl font-semibold text-slate-900 mt-2 tabular-nums">{{ $todayTransactions }}</p>
            <p class="text-xs text-slate-400 mt-1">transaksi tercatat</p>
        </div>

        {{-- Total Produk --}}
        <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-5">
            <p class="text-xs font-medium text-slate-500 uppercase tracking-wider">Total Produk</p>
            <p class="text-2xl font-semibold text-slate-900 mt-2 tabular-nums">{{ $totalProducts }}</p>
            <p class="text-xs text-slate-400 mt-1">produk terdaftar</p>
        </div>

        {{-- Laba/Pendapatan Bulan Ini --}}
        @if(Auth::user()->isOwner())
        <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-5">
            <p class="text-xs font-medium text-slate-500 uppercase tracking-wider">Laba Bulan Ini</p>
            <p class="text-2xl font-semibold text-emerald-600 mt-2 tabular-nums">Rp{{ number_format($monthProfit, 0, ',', '.') }}</p>
            <p class="text-xs text-slate-400 mt-1">laba bersih bulan ini</p>
        </div>
        @else
        <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-5">
            <p class="text-xs font-medium text-slate-500 uppercase tracking-wider">Pendapatan Bulan Ini</p>
            <p class="text-2xl font-semibold text-slate-900 mt-2 tabular-nums">Rp{{ number_format($monthRevenue, 0, ',', '.') }}</p>
            <p class="text-xs text-slate-400 mt-1">total bulan ini</p>
        </div>
        @endif
    </div>

    {{-- Charts --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 mb-6">
        <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-5">
            <h3 class="text-sm font-semibold text-slate-900 mb-4">Pendapatan (7 Hari)</h3>
            <div class="relative h-56">
                <canvas id="revenueChart"></canvas>
            </div>
        </div>
        <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-5">
            <h3 class="text-sm font-semibold text-slate-900 mb-4">Transaksi (7 Hari)</h3>
            <div class="relative h-56">
                <canvas id="salesChart"></canvas>
            </div>
        </div>
    </div>

    {{-- Business Insights --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
        {{-- Produk Terlaris --}}
        <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-5">
            <h3 class="text-sm font-semibold text-slate-900 mb-3">Produk Terlaris</h3>
            @if($topProducts->count() > 0)
                <div class="space-y-2.5">
                    @foreach($topProducts as $idx => $prod)
                        <div class="flex items-center justify-between">
                            <span class="text-xs text-slate-600 flex items-center gap-2">
                                <span class="w-5 h-5 rounded bg-slate-100 flex items-center justify-center text-[10px] font-bold text-slate-500">{{ $idx + 1 }}</span>
                                <span class="line-clamp-1">{{ $prod->name }}</span>
                            </span>
                            <span class="text-[11px] font-medium bg-slate-100 text-slate-600 px-2 py-0.5 rounded-full tabular-nums">{{ $prod->total_quantity }}</span>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-xs text-slate-400">Belum ada data.</p>
            @endif
        </div>

        {{-- Hari Tersibuk --}}
        <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-5">
            <h3 class="text-sm font-semibold text-slate-900 mb-3">Hari Tersibuk</h3>
            @if($busiestDay)
                <p class="text-lg font-semibold text-slate-900">{{ $busiestDay->date_formatted }}</p>
                <div class="mt-2 space-y-1">
                    <p class="text-xs text-slate-500">Pendapatan: <span class="font-medium text-slate-700">Rp{{ number_format($busiestDay->total_revenue, 0, ',', '.') }}</span></p>
                    <p class="text-xs text-slate-500">Transaksi: <span class="font-medium text-slate-700">{{ $busiestDay->total_transactions }}x</span></p>
                </div>
            @else
                <p class="text-xs text-slate-400">Belum ada data.</p>
            @endif
        </div>

        {{-- Produk Kurang Laku --}}
        <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-5">
            <h3 class="text-sm font-semibold text-slate-900 mb-3">Kurang Laku <span class="text-slate-400 font-normal">(>14 hari)</span></h3>
            @if($slowProducts->count() > 0)
                <div class="space-y-2.5">
                    @foreach($slowProducts as $prod)
                        <div class="flex items-center justify-between">
                            <span class="text-xs text-slate-600 line-clamp-1 flex-1 mr-2">{{ $prod->name }}</span>
                            <span class="text-[11px] font-medium bg-red-50 text-red-600 px-2 py-0.5 rounded-full tabular-nums shrink-0">Stok: {{ $prod->stock }}</span>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-xs text-emerald-500">Semua produk terjual. 🎉</p>
            @endif
        </div>
    </div>

    {{-- Bottom Section: Low Stock + Recent Transactions --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 mb-6">
        @if($lowStockProducts->count() > 0)
        <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-5">
            <div class="flex items-center gap-2 mb-3">
                <div class="w-5 h-5 rounded bg-amber-100 flex items-center justify-center">
                    <svg class="w-3 h-3 text-amber-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z"/></svg>
                </div>
                <h3 class="text-sm font-semibold text-slate-900">Peringatan Stok</h3>
            </div>
            <div class="space-y-2">
                @foreach($lowStockProducts as $product)
                <div class="flex items-center justify-between py-1.5 border-b border-slate-100 last:border-0">
                    <div>
                        <p class="text-xs font-medium text-slate-700">{{ $product->name }}</p>
                        <p class="text-[10px] text-slate-400">Min: {{ $product->min_stock }}</p>
                    </div>
                    <span class="text-[11px] font-semibold px-2 py-0.5 rounded-full {{ $product->stock == 0 ? 'bg-red-50 text-red-600' : 'bg-amber-50 text-amber-600' }}">{{ $product->stock }}</span>
                </div>
                @endforeach
            </div>
            <a href="{{ route('dashboard.products.index') }}" class="block mt-3 text-xs font-medium text-slate-500 hover:text-slate-700 transition-colors">Kelola Produk →</a>
        </div>
        @endif

        {{-- Recent Transactions --}}
        <div class="{{ $lowStockProducts->count() > 0 ? 'lg:col-span-2' : 'lg:col-span-3' }} bg-white rounded-xl border border-slate-200 shadow-sm">
            <div class="flex justify-between items-center px-5 py-4 border-b border-slate-100">
                <h3 class="text-sm font-semibold text-slate-900">Transaksi Terbaru</h3>
                <a href="{{ route('transactions.index') }}" class="text-xs font-medium text-slate-500 hover:text-slate-700 transition-colors">Lihat Semua</a>
            </div>
            @if($recentTransactions->count() > 0)
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="border-b border-slate-100">
                            <th class="text-left px-5 py-2.5 text-[10px] font-semibold text-slate-400 uppercase tracking-wider">Invoice</th>
                            <th class="text-left px-5 py-2.5 text-[10px] font-semibold text-slate-400 uppercase tracking-wider">Kasir</th>
                            <th class="text-right px-5 py-2.5 text-[10px] font-semibold text-slate-400 uppercase tracking-wider">Total</th>
                            <th class="text-right px-5 py-2.5 text-[10px] font-semibold text-slate-400 uppercase tracking-wider">Waktu</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($recentTransactions as $trx)
                        <tr class="border-b border-slate-50 last:border-0 hover:bg-slate-50/50 transition-colors">
                            <td class="px-5 py-3 text-xs font-medium text-slate-800"><a href="{{ route('transactions.show', $trx) }}" class="hover:underline">{{ $trx->invoice_number }}</a></td>
                            <td class="px-5 py-3 text-xs text-slate-500">{{ $trx->user->name }}</td>
                            <td class="px-5 py-3 text-xs text-slate-800 text-right font-medium tabular-nums">Rp{{ number_format($trx->total_amount, 0, ',', '.') }}</td>
                            <td class="px-5 py-3 text-xs text-slate-400 text-right">{{ $trx->created_at->diffForHumans() }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @else
            <div class="px-5 py-12 text-center">
                <p class="text-xs text-slate-400">Belum ada transaksi tercatat.</p>
            </div>
            @endif
        </div>
    </div>

    {{-- Marketplace Analytics --}}
    <h2 class="text-sm font-semibold text-slate-900 mb-3">Marketplace</h2>
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-6">
        <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-5">
            <p class="text-xs font-medium text-slate-500 uppercase tracking-wider">Total Pesanan</p>
            <p class="text-2xl font-semibold text-slate-900 mt-2 tabular-nums">{{ $marketplaceTotalOrders }}</p>
            <p class="text-xs text-slate-400 mt-1">pesanan selesai</p>
        </div>
        <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-5">
            <p class="text-xs font-medium text-slate-500 uppercase tracking-wider">Total Revenue</p>
            <p class="text-2xl font-semibold text-emerald-600 mt-2 tabular-nums">Rp{{ number_format($marketplaceTotalRevenue, 0, ',', '.') }}</p>
            <p class="text-xs text-slate-400 mt-1">dari pesanan selesai</p>
        </div>
        <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-5">
            <p class="text-xs font-medium text-slate-500 uppercase tracking-wider">Total Pelanggan</p>
            <p class="text-2xl font-semibold text-slate-900 mt-2 tabular-nums">{{ $marketplaceCustomerCount }}</p>
            <p class="text-xs text-slate-400 mt-1">pelanggan unik</p>
        </div>
    </div>

    {{-- Recent Marketplace Orders --}}
    <div class="bg-white rounded-xl border border-slate-200 shadow-sm">
        <div class="flex justify-between items-center px-5 py-4 border-b border-slate-100">
            <h3 class="text-sm font-semibold text-slate-900">Pesanan Masuk Terbaru</h3>
            <a href="{{ route('dashboard.orders.index') }}" class="text-xs font-medium text-slate-500 hover:text-slate-700 transition-colors">Lihat Semua</a>
        </div>
        @if($marketplaceRecentOrders->count() > 0)
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-slate-100">
                        <th class="text-left px-5 py-2.5 text-[10px] font-semibold text-slate-400 uppercase tracking-wider">No. Pesanan</th>
                        <th class="text-left px-5 py-2.5 text-[10px] font-semibold text-slate-400 uppercase tracking-wider">Pelanggan</th>
                        <th class="text-left px-5 py-2.5 text-[10px] font-semibold text-slate-400 uppercase tracking-wider">Status</th>
                        <th class="text-right px-5 py-2.5 text-[10px] font-semibold text-slate-400 uppercase tracking-wider">Total</th>
                        <th class="text-right px-5 py-2.5 text-[10px] font-semibold text-slate-400 uppercase tracking-wider">Waktu</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($marketplaceRecentOrders as $order)
                    @php
                        $statusStyles = [
                            'pending' => 'bg-amber-50 text-amber-700',
                            'paid' => 'bg-blue-50 text-blue-700',
                            'processing' => 'bg-violet-50 text-violet-700',
                            'shipped' => 'bg-indigo-50 text-indigo-700',
                            'completed' => 'bg-emerald-50 text-emerald-700',
                            'cancelled' => 'bg-red-50 text-red-600',
                        ];
                    @endphp
                    <tr class="border-b border-slate-50 last:border-0 hover:bg-slate-50/50 transition-colors">
                        <td class="px-5 py-3 text-xs font-medium text-slate-800"><a href="{{ route('dashboard.orders.show', $order) }}" class="hover:underline">{{ $order->order_number }}</a></td>
                        <td class="px-5 py-3 text-xs text-slate-500">{{ $order->user->name }}</td>
                        <td class="px-5 py-3">
                            <span class="inline-flex px-2 py-0.5 text-[11px] font-medium rounded-full {{ $statusStyles[$order->status] ?? 'bg-slate-100 text-slate-600' }}">{{ ucfirst($order->status) }}</span>
                        </td>
                        <td class="px-5 py-3 text-xs text-slate-800 text-right font-medium tabular-nums">Rp{{ number_format($order->total_amount, 0, ',', '.') }}</td>
                        <td class="px-5 py-3 text-xs text-slate-400 text-right">{{ $order->created_at->diffForHumans() }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
        <div class="px-5 py-12 text-center">
            <p class="text-xs text-slate-400">Belum ada pesanan marketplace.</p>
        </div>
        @endif
    </div>

    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const chartData = @json($chartData);

            Chart.defaults.font.family = "'Inter', system-ui, sans-serif";
            Chart.defaults.font.size = 11;
            Chart.defaults.color = '#94a3b8';

            // Revenue Chart (Stripe-style)
            new Chart(document.getElementById('revenueChart').getContext('2d'), {
                type: 'line',
                data: {
                    labels: chartData.labels,
                    datasets: [{
                        label: 'Pendapatan',
                        data: chartData.revenue,
                        borderColor: '#0f172a',
                        backgroundColor: 'rgba(15, 23, 42, 0.04)',
                        borderWidth: 1.5,
                        pointBackgroundColor: '#0f172a',
                        pointRadius: 3,
                        pointHoverRadius: 5,
                        fill: true,
                        tension: 0.3,
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: false },
                        tooltip: {
                            backgroundColor: '#0f172a',
                            titleFont: { size: 11 },
                            bodyFont: { size: 11 },
                            padding: 8,
                            cornerRadius: 6,
                            callbacks: {
                                label: ctx => 'Rp' + new Intl.NumberFormat('id-ID').format(ctx.parsed.y)
                            }
                        }
                    },
                    scales: {
                        x: { grid: { display: false }, border: { display: false } },
                        y: {
                            beginAtZero: true,
                            border: { display: false },
                            grid: { color: '#f1f5f9' },
                            ticks: {
                                callback: v => v >= 1000000 ? 'Rp' + (v/1000000) + 'M' : v >= 1000 ? 'Rp' + (v/1000) + 'k' : 'Rp' + v
                            }
                        }
                    }
                }
            });

            // Sales Chart
            new Chart(document.getElementById('salesChart').getContext('2d'), {
                type: 'bar',
                data: {
                    labels: chartData.labels,
                    datasets: [{
                        label: 'Transaksi',
                        data: chartData.sales,
                        backgroundColor: '#e2e8f0',
                        hoverBackgroundColor: '#0f172a',
                        borderRadius: 4,
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: false },
                        tooltip: {
                            backgroundColor: '#0f172a',
                            titleFont: { size: 11 },
                            bodyFont: { size: 11 },
                            padding: 8,
                            cornerRadius: 6,
                        }
                    },
                    scales: {
                        x: { grid: { display: false }, border: { display: false } },
                        y: {
                            beginAtZero: true,
                            border: { display: false },
                            grid: { color: '#f1f5f9' },
                            ticks: { stepSize: 1 }
                        }
                    }
                }
            });
        });
    </script>
    @endpush
</x-app-layout>
