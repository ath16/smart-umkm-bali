<?php

namespace App\Services;

use App\Models\Product;
use App\Models\Store;
use Illuminate\Support\Facades\DB;

class RecommendationService
{
    /**
     * Get Best Selling Products
     * Rule: Products with highest total quantity sold in 'completed' orders.
     */
    public function getBestSellingProducts($limit = 4)
    {
        return Product::with(['images', 'store'])
            ->whereHas('orderItems.order', function($q) {
                $q->where('status', 'completed');
            })
            ->withSum(['orderItems as total_sold' => function($q) {
                $q->whereHas('order', function($q2) {
                    $q2->where('status', 'completed');
                });
            }], 'quantity')
            ->orderByDesc('total_sold')
            ->take($limit)
            ->get();
    }

    /**
     * Get New Products
     * Rule: Recently added products.
     */
    public function getNewProducts($limit = 8)
    {
        return Product::with(['images', 'store'])
            ->inStock()
            ->latest()
            ->take($limit)
            ->get();
    }

    /**
     * Get Similar Products
     * Rule: Products in the same category.
     */
    public function getSimilarProducts(Product $product, $limit = 4)
    {
        return Product::with(['images', 'store'])
            ->where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->inStock()
            ->take($limit)
            ->get();
    }

    /**
     * Get Popular Stores
     * Rule: Stores with the highest number of 'completed' orders.
     */
    public function getPopularStores($limit = 4)
    {
        return Store::with(['setting', 'storeCategory'])
            ->withCount(['orders' => function($q) {
                $q->where('status', 'completed');
            }])
            ->orderByDesc('orders_count')
            ->take($limit)
            ->get();
    }
}
