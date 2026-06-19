<?php

namespace App\Services;

use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class InsightService
{
    /**
     * Produk Terlaris (Top Selling Products)
     * Logic: Produk dengan quantity penjualan tertinggi selama $days hari terakhir.
     */
    public function getTopSellingProducts(int $storeId, int $days = 7, int $limit = 5)
    {
        return DB::table('transaction_details')
            ->join('transactions', 'transaction_details.transaction_id', '=', 'transactions.id')
            ->join('products', 'transaction_details.product_id', '=', 'products.id')
            ->where('transactions.store_id', $storeId)
            ->where('transactions.created_at', '>=', now()->subDays($days)->startOfDay())
            ->select('products.name', DB::raw('SUM(transaction_details.quantity) as total_quantity'))
            ->groupBy('products.id', 'products.name')
            ->orderByDesc('total_quantity')
            ->limit($limit)
            ->get();
    }

    /**
     * Produk Kurang Laku (Slow Moving Products)
     * Logic: Produk yang tidak memiliki transaksi selama $days hari terakhir.
     */
    public function getSlowMovingProducts(int $storeId, int $days = 14, int $limit = 5)
    {
        $startDate = now()->subDays($days)->startOfDay();

        return Product::where('store_id', $storeId)
            ->whereDoesntHave('transactionDetails', function ($query) use ($startDate) {
                $query->whereHas('transaction', function ($q) use ($startDate) {
                    $q->where('created_at', '>=', $startDate);
                });
            })
            ->where('created_at', '<', $startDate) // exclude newly added products
            ->withSum('transactionDetails as all_time_sold', 'quantity')
            ->orderByDesc('stock')
            ->limit($limit)
            ->get();
    }

    /**
     * Hari Tersibuk (Busiest Day)
     * Logic: Hari dengan total pendapatan tertinggi dalam $days hari terakhir.
     */
    public function getBusiestDay(int $storeId, int $days = 7)
    {
        $busiest = Transaction::where('store_id', $storeId)
            ->where('created_at', '>=', now()->subDays($days)->startOfDay())
            ->select(
                DB::raw('DATE(created_at) as date'),
                DB::raw('SUM(total_amount) as total_revenue'),
                DB::raw('COUNT(id) as total_transactions')
            )
            ->groupBy('date')
            ->orderByDesc('total_revenue')
            ->first();

        if ($busiest) {
            $busiest->date_formatted = Carbon::parse($busiest->date)->translatedFormat('l, d M');
        }

        return $busiest;
    }

    /**
     * Data untuk Chart.js (Penjualan & Pendapatan Harian)
     */
    public function getDailyChartData(int $storeId, int $days = 7)
    {
        $transactions = Transaction::where('store_id', $storeId)
            ->where('created_at', '>=', now()->subDays($days - 1)->startOfDay())
            ->select(
                DB::raw('DATE(created_at) as date'),
                DB::raw('SUM(total_amount) as revenue'),
                DB::raw('COUNT(id) as sales_count')
            )
            ->groupBy('date')
            ->orderBy('date')
            ->get()
            ->keyBy('date');

        $labels = [];
        $revenueData = [];
        $salesData = [];

        for ($i = $days - 1; $i >= 0; $i--) {
            $date = now()->subDays($i)->format('Y-m-d');
            $labels[] = now()->subDays($i)->translatedFormat('d M');
            
            if ($transactions->has($date)) {
                $revenueData[] = (float) $transactions[$date]->revenue;
                $salesData[] = (int) $transactions[$date]->sales_count;
            } else {
                $revenueData[] = 0;
                $salesData[] = 0;
            }
        }

        return [
            'labels' => $labels,
            'revenue' => $revenueData,
            'sales' => $salesData,
        ];
    }
}
