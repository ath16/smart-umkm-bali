<?php

namespace App\Http\Controllers;

use App\Models\Store;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CatalogController extends Controller
{
    /**
     * Show the store discovery list.
     */
    public function index(Request $request): View
    {
        if ($request->filled('search')) {
            $query = Store::search($request->search)->query(fn ($q) => $q->active()->with(['setting', 'storeCategory']));
        } else {
            $query = Store::active()->with(['setting', 'storeCategory']);
        }

        if ($request->filled('category')) {
            $query->whereHas('storeCategory', function($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        $stores = $query->paginate(12)->withQueryString();
        
        $storeCategories = \App\Models\StoreCategory::all();

        return view('marketplace.stores.index', compact('stores', 'storeCategories'));
    }

    /**
     * Show the public catalog for a store.
     */
    public function show(Request $request, string $slug): View
    {
        $store = Store::active()->with(['setting', 'storeCategory'])->where('slug', $slug)->firstOrFail();

        if ($request->filled('search')) {
            $query = Product::search($request->search)->query(function ($q) use ($store) {
                $q->where('store_id', $store->id)
                  ->active()
                  ->with('category', 'images')
                  ->where('stock', '>', 0)
                  ->where('is_published', true);
            });
        } else {
            $query = $store->products()->active()->with('category', 'images')->where('stock', '>', 0)->where('is_published', true);
        }

        if ($request->filled('category')) {
            $query->whereHas('category', function($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        $products = $query->orderBy('name')->paginate(12)->withQueryString();
        $categories = ProductCategory::all();

        $reviews = \App\Models\StoreReview::with('user')->where('store_id', $store->id)->latest()->get();

        return view('marketplace.stores.show', compact('store', 'products', 'categories', 'reviews'));
    }
}
