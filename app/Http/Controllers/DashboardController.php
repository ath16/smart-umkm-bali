<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        
        if ($user->isAdmin()) {
            return redirect()->route('admin.dashboard');
        }

        if ($user->isCustomer()) {
            return redirect()->route('customer.dashboard');
        }

        if ($user->isCashier()) {
            return redirect()->route('dashboard.transactions.create');
        }

        $store = $user->currentStore();

        if (!$store) {
            return redirect()->route('stores.create')
                ->with('status', 'Silakan daftarkan toko Anda terlebih dahulu untuk mengakses Dasbor.');
        }

        $cacheKey = "store_{$store->id}_dashboard_data";
        
        $data = \Illuminate\Support\Facades\Cache::remember($cacheKey, now()->addMinutes(15), function () use ($store) {
            $insightService = app(\App\Services\InsightService::class);
            
            return [
                'store' => $store,
                'totalProducts' => $store->products()->count(),
                'lowStockProducts' => $store->products()
                    ->whereColumn('stock', '<=', 'min_stock')
                    ->get(),
                'todayTransactions' => $store->transactions()
                    ->whereDate('created_at', today())
                    ->count(),
                'todayRevenue' => $store->transactions()
                    ->whereDate('created_at', today())
                    ->sum('total_amount'),
                'monthRevenue' => $store->transactions()
                    ->whereMonth('created_at', now()->month)
                    ->whereYear('created_at', now()->year)
                    ->sum('total_amount'),
                'monthProfit' => $store->transactions()
                    ->whereMonth('created_at', now()->month)
                    ->whereYear('created_at', now()->year)
                    ->selectRaw('SUM(total_amount) - SUM(total_cost) as profit')
                    ->value('profit') ?? 0,
                
                // Insight Data
                'topProducts' => $insightService->getTopSellingProducts($store->id),
                'slowProducts' => $insightService->getSlowMovingProducts($store->id),
                'busiestDay' => $insightService->getBusiestDay($store->id),
                'chartData' => $insightService->getDailyChartData($store->id),
                
                'recentTransactions' => $store->transactions()
                    ->with('user', 'details')
                    ->latest()
                    ->take(5)
                    ->get(),
                    
                // Marketplace Analytics
                'marketplaceTotalOrders' => $store->orders()->where('status', 'completed')->count(),
                'marketplaceTotalRevenue' => $store->orders()->where('status', 'completed')->sum('total_amount'),
                'marketplaceCustomerCount' => $store->orders()->where('status', 'completed')->distinct('user_id')->count('user_id'),
                'marketplaceRecentOrders' => $store->orders()->with('user')->latest()->take(5)->get(),
            ];
        });

        // Ensure we merge the current $store model back in case of cache hits to get fresh relationships
        $data['store'] = $store;

        return view('dashboard', $data);
    }
}
