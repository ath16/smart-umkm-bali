<?php

namespace App\Services;

use App\Models\Transaction;
use App\Models\TransactionDetail;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class ReportService
{
    /**
     * Get date range based on filter type.
     */
    public function getDateRange(string $type, ?string $date = null): array
    {
        return match ($type) {
            'daily' => $this->getDailyRange($date),
            'weekly' => $this->getWeeklyRange($date),
            'monthly' => $this->getMonthlyRange($date),
            default => $this->getDailyRange($date),
        };
    }

    private function getDailyRange(?string $date): array
    {
        $day = $date ? Carbon::parse($date) : today();

        return [
            'start' => $day->copy()->startOfDay(),
            'end' => $day->copy()->endOfDay(),
            'label' => $day->translatedFormat('l, d F Y'),
            'type' => 'daily',
        ];
    }

    private function getWeeklyRange(?string $date): array
    {
        $day = $date ? Carbon::parse($date) : today();
        $start = $day->copy()->startOfWeek(Carbon::MONDAY);
        $end = $day->copy()->endOfWeek(Carbon::SUNDAY);

        return [
            'start' => $start->startOfDay(),
            'end' => $end->endOfDay(),
            'label' => $start->translatedFormat('d M Y') . ' — ' . $end->translatedFormat('d M Y'),
            'type' => 'weekly',
        ];
    }

    private function getMonthlyRange(?string $date): array
    {
        $day = $date ? Carbon::parse($date . '-01') : today();

        return [
            'start' => $day->copy()->startOfMonth()->startOfDay(),
            'end' => $day->copy()->endOfMonth()->endOfDay(),
            'label' => $day->translatedFormat('F Y'),
            'type' => 'monthly',
        ];
    }

    /**
     * Generate the full report data.
     */
    public function generateReport(int $storeId, string $type, ?string $date = null): array
    {
        $range = $this->getDateRange($type, $date);

        $transactions = Transaction::where('store_id', $storeId)
            ->whereBetween('created_at', [$range['start'], $range['end']])
            ->get();

        $details = TransactionDetail::whereHas('transaction', function ($q) use ($storeId, $range) {
            $q->where('store_id', $storeId)
              ->whereBetween('created_at', [$range['start'], $range['end']]);
        })->get();

        // Summary calculations
        $totalRevenue = $details->sum(fn ($d) => $d->sell_price * $d->quantity);
        $totalCost = $details->sum(fn ($d) => $d->cost_price * $d->quantity);
        $totalProfit = $totalRevenue - $totalCost;
        $totalItemsSold = $details->sum('quantity');
        $totalTransactions = $transactions->count();

        // Product breakdown (aggregated by product)
        $productBreakdown = $details->groupBy('product_id')->map(function ($group) {
            $first = $group->first();
            $qty = $group->sum('quantity');
            $revenue = $group->sum(fn ($d) => $d->sell_price * $d->quantity);
            $cost = $group->sum(fn ($d) => $d->cost_price * $d->quantity);

            return (object) [
                'product_name' => $first->product_name,
                'quantity' => $qty,
                'revenue' => $revenue,
                'cost' => $cost,
                'profit' => $revenue - $cost,
            ];
        })->sortByDesc('quantity')->values();

        // Top product
        $topProduct = $productBreakdown->first();

        // Daily breakdown for charts (only for weekly/monthly)
        $dailyBreakdown = $this->getDailyBreakdown($storeId, $range);

        // Generate narrative
        $narrative = $this->generateNarrative(
            $type,
            $range['label'],
            $totalTransactions,
            $totalItemsSold,
            $totalRevenue,
            $totalProfit,
            $topProduct
        );

        return [
            'range' => $range,
            'totalRevenue' => $totalRevenue,
            'totalCost' => $totalCost,
            'totalProfit' => $totalProfit,
            'totalItemsSold' => $totalItemsSold,
            'totalTransactions' => $totalTransactions,
            'profitMargin' => $totalRevenue > 0 ? round(($totalProfit / $totalRevenue) * 100, 1) : 0,
            'productBreakdown' => $productBreakdown,
            'dailyBreakdown' => $dailyBreakdown,
            'narrative' => $narrative,
            'transactions' => $transactions,
        ];
    }

    /**
     * Get daily breakdown for chart data within a range.
     */
    private function getDailyBreakdown(int $storeId, array $range): array
    {
        $rows = Transaction::where('store_id', $storeId)
            ->whereBetween('created_at', [$range['start'], $range['end']])
            ->select(
                DB::raw('DATE(created_at) as date'),
                DB::raw('SUM(total_amount) as revenue'),
                DB::raw('SUM(total_cost) as cost'),
                DB::raw('COUNT(id) as count')
            )
            ->groupBy('date')
            ->orderBy('date')
            ->get()
            ->keyBy('date');

        $labels = [];
        $revenue = [];
        $profit = [];
        $sales = [];

        $current = $range['start']->copy();
        while ($current->lte($range['end'])) {
            $key = $current->format('Y-m-d');
            $labels[] = $current->translatedFormat('d M');

            if ($rows->has($key)) {
                $revenue[] = (float) $rows[$key]->revenue;
                $profit[] = (float) $rows[$key]->revenue - (float) $rows[$key]->cost;
                $sales[] = (int) $rows[$key]->count;
            } else {
                $revenue[] = 0;
                $profit[] = 0;
                $sales[] = 0;
            }

            $current->addDay();
        }

        return [
            'labels' => $labels,
            'revenue' => $revenue,
            'profit' => $profit,
            'sales' => $sales,
        ];
    }

    /**
     * Generate template-based narrative.
     */
    private function generateNarrative(
        string $type,
        string $periodLabel,
        int $totalTransactions,
        int $totalItemsSold,
        float $totalRevenue,
        float $totalProfit,
        ?object $topProduct
    ): string {
        if ($totalTransactions === 0) {
            return match ($type) {
                'daily' => "Pada {$periodLabel}, belum ada transaksi yang tercatat.",
                'weekly' => "Pada minggu {$periodLabel}, belum ada transaksi yang tercatat.",
                'monthly' => "Pada bulan {$periodLabel}, belum ada transaksi yang tercatat.",
            };
        }

        $revenueFormatted = 'Rp' . number_format($totalRevenue, 0, ',', '.');
        $profitFormatted = 'Rp' . number_format($totalProfit, 0, ',', '.');
        $topName = $topProduct ? $topProduct->product_name : '-';
        $topQty = $topProduct ? $topProduct->quantity : 0;

        $profitSentence = $totalProfit >= 0
            ? "Laba bersih yang diperoleh sebesar {$profitFormatted}."
            : "Terjadi kerugian sebesar {$profitFormatted}.";

        return match ($type) {
            'daily' => "Pada {$periodLabel}, Anda berhasil mencatat {$totalTransactions} transaksi " .
                       "dengan total {$totalItemsSold} produk terjual dan pendapatan {$revenueFormatted}. " .
                       "{$profitSentence} " .
                       "Produk terlaris hari ini adalah \"{$topName}\" ({$topQty} terjual).",

            'weekly' => "Pada minggu {$periodLabel}, usaha Anda mencatat {$totalTransactions} transaksi " .
                        "dengan {$totalItemsSold} produk terjual. Total pendapatan mencapai {$revenueFormatted}. " .
                        "{$profitSentence} " .
                        "Produk terlaris minggu ini adalah \"{$topName}\" dengan {$topQty} unit terjual.",

            'monthly' => "Bulan {$periodLabel}, Anda berhasil menjual {$totalItemsSold} produk " .
                         "melalui {$totalTransactions} transaksi dengan total pendapatan {$revenueFormatted}. " .
                         "{$profitSentence} " .
                         "Produk terlaris bulan ini adalah \"{$topName}\" ({$topQty} terjual).",
        };
    }
}
