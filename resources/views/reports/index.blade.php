<x-app-layout>
    @section('title', 'Laporan Penjualan')

    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-lg font-semibold text-slate-900">Laporan Penjualan</h1>
                <p class="text-xs text-slate-500 mt-0.5">{{ $report['range']['label'] }}</p>
            </div>
            <a href="{{ route('reports.pdf', ['type' => $currentType, 'date' => $currentDate]) }}" target="_blank" class="inline-flex items-center gap-1.5 px-3.5 py-2 bg-white border border-slate-200 rounded-md text-xs font-medium text-slate-700 hover:bg-slate-50 transition-colors">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3"/></svg>
                Export PDF
            </a>
        </div>
    </x-slot>

    {{-- Inline Filters --}}
    <div class="mb-5">
        <form method="GET" action="{{ route('reports.index') }}" class="flex flex-wrap items-end gap-3">
            <div>
                <label for="type" class="block text-[10px] font-semibold text-slate-400 uppercase tracking-wider mb-1">Periode</label>
                <select name="type" id="type" class="border border-slate-200 rounded-md bg-white text-xs text-slate-700 px-3 py-2 focus:border-slate-400 focus:ring-1 focus:ring-slate-400/20 w-36" onchange="this.form.submit()">
                    <option value="daily" {{ $currentType === 'daily' ? 'selected' : '' }}>Harian</option>
                    <option value="weekly" {{ $currentType === 'weekly' ? 'selected' : '' }}>Mingguan</option>
                    <option value="monthly" {{ $currentType === 'monthly' ? 'selected' : '' }}>Bulanan</option>
                </select>
            </div>
            <div>
                <label for="date" class="block text-[10px] font-semibold text-slate-400 uppercase tracking-wider mb-1">Tanggal</label>
                @if($currentType === 'monthly')
                    <input type="month" name="date" id="date" value="{{ $currentDate ? substr($currentDate, 0, 7) : now()->format('Y-m') }}" class="border border-slate-200 rounded-md bg-white text-xs text-slate-700 px-3 py-2 focus:border-slate-400 focus:ring-1 focus:ring-slate-400/20 w-40">
                @else
                    <input type="date" name="date" id="date" value="{{ $currentDate ?: now()->format('Y-m-d') }}" class="border border-slate-200 rounded-md bg-white text-xs text-slate-700 px-3 py-2 focus:border-slate-400 focus:ring-1 focus:ring-slate-400/20 w-40">
                @endif
            </div>
            <button type="submit" class="px-4 py-2 bg-slate-900 text-white rounded-md text-xs font-medium hover:bg-slate-800 transition-colors">Terapkan</button>
        </form>
    </div>

    {{-- Narrative Insight --}}
    <div class="bg-slate-50 border border-slate-200 rounded-xl p-4 mb-5 flex items-start gap-3">
        <div class="w-8 h-8 rounded-lg bg-slate-200 flex items-center justify-center shrink-0 mt-0.5">
            <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 18v-5.25m0 0a6.01 6.01 0 0 0 1.5-.189m-1.5.189a6.01 6.01 0 0 1-1.5-.189m3.75 7.478a12.06 12.06 0 0 1-4.5 0m3.75 2.383a14.406 14.406 0 0 1-3 0M14.25 18v-.192c0-.983.658-1.823 1.508-2.316a7.5 7.5 0 1 0-7.517 0c.85.493 1.509 1.333 1.509 2.316V18"/></svg>
        </div>
        <div>
            <h3 class="text-xs font-semibold text-slate-700 mb-0.5">Insight</h3>
            <p class="text-xs text-slate-500 leading-relaxed">{{ $report['narrative'] }}</p>
        </div>
    </div>

    {{-- Financial KPIs --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-5">
        <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-5">
            <p class="text-xs font-medium text-slate-500 uppercase tracking-wider">Pendapatan Kotor</p>
            <p class="text-2xl font-semibold text-slate-900 mt-2 tabular-nums">Rp{{ number_format($report['totalRevenue'], 0, ',', '.') }}</p>
        </div>
        <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-5">
            <p class="text-xs font-medium text-slate-500 uppercase tracking-wider">Total Modal</p>
            <p class="text-2xl font-semibold text-slate-900 mt-2 tabular-nums">Rp{{ number_format($report['totalCost'], 0, ',', '.') }}</p>
        </div>
        <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-5">
            <p class="text-xs font-medium text-slate-500 uppercase tracking-wider">Laba Bersih</p>
            <p class="text-2xl font-semibold mt-2 tabular-nums {{ $report['totalProfit'] >= 0 ? 'text-emerald-600' : 'text-red-600' }}">Rp{{ number_format($report['totalProfit'], 0, ',', '.') }}</p>
        </div>
        <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-5">
            <p class="text-xs font-medium text-slate-500 uppercase tracking-wider">Margin Laba</p>
            <p class="text-2xl font-semibold text-slate-900 mt-2 tabular-nums">{{ $report['profitMargin'] }}%</p>
        </div>
    </div>

    {{-- Chart --}}
    @if($currentType !== 'daily' && count($report['dailyBreakdown']['labels']) > 0)
    <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-5 mb-5">
        <h3 class="text-sm font-semibold text-slate-900 mb-4">Tren Laba & Pendapatan</h3>
        <div class="relative h-64 w-full">
            <canvas id="reportChart"></canvas>
        </div>
    </div>
    @endif

    {{-- Product Breakdown Table --}}
    <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
        <div class="px-5 py-4 border-b border-slate-100">
            <h3 class="text-sm font-semibold text-slate-900">Rincian Penjualan Produk</h3>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-slate-100">
                        <th class="text-left px-5 py-2.5 text-[10px] font-semibold text-slate-400 uppercase tracking-wider">Produk</th>
                        <th class="text-right px-5 py-2.5 text-[10px] font-semibold text-slate-400 uppercase tracking-wider">Terjual</th>
                        <th class="text-right px-5 py-2.5 text-[10px] font-semibold text-slate-400 uppercase tracking-wider">Pendapatan</th>
                        <th class="text-right px-5 py-2.5 text-[10px] font-semibold text-slate-400 uppercase tracking-wider">Modal</th>
                        <th class="text-right px-5 py-2.5 text-[10px] font-semibold text-slate-400 uppercase tracking-wider">Laba</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($report['productBreakdown'] as $item)
                    <tr class="border-b border-slate-50 last:border-0 hover:bg-slate-50/50 transition-colors">
                        <td class="px-5 py-3 text-xs font-medium text-slate-800">{{ $item->product_name }}</td>
                        <td class="px-5 py-3 text-xs text-slate-600 text-right tabular-nums">{{ $item->quantity }}</td>
                        <td class="px-5 py-3 text-xs text-slate-800 text-right font-medium tabular-nums">Rp{{ number_format($item->revenue, 0, ',', '.') }}</td>
                        <td class="px-5 py-3 text-xs text-slate-500 text-right tabular-nums">Rp{{ number_format($item->cost, 0, ',', '.') }}</td>
                        <td class="px-5 py-3 text-xs font-semibold text-right tabular-nums {{ $item->profit >= 0 ? 'text-emerald-600' : 'text-red-600' }}">Rp{{ number_format($item->profit, 0, ',', '.') }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-5 py-12 text-center text-xs text-slate-400">Tidak ada data penjualan pada periode ini.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @push('scripts')
    @if($currentType !== 'daily' && count($report['dailyBreakdown']['labels']) > 0)
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const data = @json($report['dailyBreakdown']);

            Chart.defaults.font.family = "'Inter', system-ui, sans-serif";
            Chart.defaults.font.size = 11;
            Chart.defaults.color = '#94a3b8';

            new Chart(document.getElementById('reportChart').getContext('2d'), {
                type: 'bar',
                data: {
                    labels: data.labels,
                    datasets: [
                        {
                            label: 'Pendapatan',
                            data: data.revenue,
                            backgroundColor: '#e2e8f0',
                            hoverBackgroundColor: '#0f172a',
                            borderRadius: 4,
                            order: 2
                        },
                        {
                            label: 'Laba Bersih',
                            data: data.profit,
                            type: 'line',
                            borderColor: '#0f172a',
                            backgroundColor: '#0f172a',
                            borderWidth: 1.5,
                            tension: 0.3,
                            pointRadius: 3,
                            pointHoverRadius: 5,
                            fill: false,
                            order: 1
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    interaction: { mode: 'index', intersect: false },
                    plugins: {
                        tooltip: {
                            backgroundColor: '#0f172a',
                            titleFont: { size: 11 },
                            bodyFont: { size: 11 },
                            padding: 8,
                            cornerRadius: 6,
                            callbacks: {
                                label: ctx => ctx.dataset.label + ': Rp' + new Intl.NumberFormat('id-ID').format(ctx.parsed.y)
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
        });
    </script>
    @endif
    @endpush
</x-app-layout>
