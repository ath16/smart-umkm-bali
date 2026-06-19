<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Store;
use App\Models\Product;
use App\Models\Suspension;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = \Illuminate\Support\Facades\Cache::remember('admin_dashboard_stats', now()->addMinutes(15), function () {
            return [
                'total_users' => User::count(),
                'total_stores' => Store::count(),
                'total_products' => Product::count(),
                'active_suspensions' => Suspension::where('is_active', true)->count(),
            ];
        });

        return view('admin.dashboard', compact('stats'));
    }
}
