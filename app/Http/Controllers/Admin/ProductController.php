<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with(['store']);

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

        $products = $query->paginate(20)->withQueryString();

        return view('admin.products.index', compact('products'));
    }

    public function suspend(Request $request, Product $product)
    {
        $request->validate([
            'reason' => 'required|string|max:1000'
        ]);

        if (!$product->isSuspended()) {
            $product->suspensions()->create([
                'admin_id' => Auth::id(),
                'reason' => $request->reason,
                'is_active' => true
            ]);
        }

        return back()->with('success', 'Produk berhasil diblokir.');
    }

    public function unsuspend(Product $product)
    {
        $product->suspensions()->where('is_active', true)->update(['is_active' => false]);
        return back()->with('success', 'Blokir produk berhasil dicabut.');
    }
}
