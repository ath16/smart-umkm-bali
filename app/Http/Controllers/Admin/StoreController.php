<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StoreController extends Controller
{
    public function index(Request $request)
    {
        $query = Store::with(['owner', 'category']);

        if ($request->filled('status')) {
            if ($request->status === 'suspended') {
                $query->whereHas('suspensions', function($q) {
                    $q->where('is_active', true);
                });
            } elseif ($request->status === 'active') {
                $query->whereDoesntHave('suspensions', function($q) {
                    $q->where('is_active', true);
                });
            }
        }

        $stores = $query->paginate(20)->withQueryString();

        return view('admin.stores.index', compact('stores'));
    }

    public function suspend(Request $request, Store $store)
    {
        $request->validate([
            'reason' => 'required|string|max:1000'
        ]);

        if (!$store->isSuspended()) {
            $store->suspensions()->create([
                'admin_id' => Auth::id(),
                'reason' => $request->reason,
                'is_active' => true
            ]);
        }

        return back()->with('success', 'Toko berhasil diblokir.');
    }

    public function unsuspend(Store $store)
    {
        $store->suspensions()->where('is_active', true)->update(['is_active' => false]);
        return back()->with('success', 'Blokir toko berhasil dicabut.');
    }
}
