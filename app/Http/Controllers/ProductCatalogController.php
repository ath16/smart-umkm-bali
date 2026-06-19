<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductCategory;

class ProductCatalogController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::active()->with(['store', 'category', 'images'])
            ->where('is_published', true)
            ->whereHas('store', function($q) {
                $q->active();
            }); // Only show active products that have an active store

        // Search Product or Store
        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhereHas('store', function($q2) use ($request) {
                      $q2->where('name', 'like', '%' . $request->search . '%');
                  });
            });
        }

        // Filter Category
        if ($request->filled('category')) {
            $query->whereHas('category', function($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        // Filter Price (min, max)
        if ($request->filled('min_price')) {
            $query->where('sell_price', '>=', $request->min_price);
        }
        if ($request->filled('max_price')) {
            $query->where('sell_price', '<=', $request->max_price);
        }

        // Sort Product
        $sort = $request->get('sort', 'latest');
        switch ($sort) {
            case 'price_asc':
                $query->orderBy('sell_price', 'asc');
                break;
            case 'price_desc':
                $query->orderBy('sell_price', 'desc');
                break;
            case 'latest':
            default:
                $query->latest();
                break;
        }

        $products = $query->paginate(12)->withQueryString();
        $categories = ProductCategory::all();

        return view('marketplace.products.index', compact('products', 'categories'));
    }

    public function show($slug)
    {
        $product = Product::active()->with(['store', 'category', 'images'])
            ->where('slug', $slug)
            ->where('is_published', true)
            ->whereHas('store', function($q) {
                $q->active();
            })
            ->firstOrFail();

        $similarProducts = Product::active()->with(['store', 'category', 'images'])
            ->where('product_category_id', $product->product_category_id)
            ->where('id', '!=', $product->id)
            ->where('is_published', true)
            ->whereHas('store', function($q) {
                $q->active();
            })
            ->inRandomOrder()
            ->take(4)
            ->get();

        $reviews = \App\Models\ProductReview::with('user')->where('product_id', $product->id)->latest()->get();

        return view('marketplace.products.show', compact('product', 'similarProducts', 'reviews'));
    }
}
