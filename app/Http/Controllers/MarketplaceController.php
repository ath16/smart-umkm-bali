<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Store;
use App\Models\ProductCategory;
use App\Models\Article;
use App\Services\RecommendationService;

class MarketplaceController extends Controller
{
    protected $recommendationService;

    public function __construct(RecommendationService $recommendationService)
    {
        $this->recommendationService = $recommendationService;
    }

    public function index()
    {
        $bestSellingProducts = $this->recommendationService->getBestSellingProducts(4);
        
        // If there are not enough best selling products (e.g. new app), fallback to new products
        if ($bestSellingProducts->count() < 4) {
            $popularProducts = $this->recommendationService->getNewProducts(8);
        } else {
            $popularProducts = $bestSellingProducts->merge($this->recommendationService->getNewProducts(4))->take(8);
        }

        $popularStores = $this->recommendationService->getPopularStores(6);
        
        // Fallback for stores
        if ($popularStores->count() < 6) {
            $popularStores = Store::with(['setting', 'storeCategory'])->latest()->take(6)->get();
        }

        // Product categories for the category grid
        $categories = ProductCategory::withCount('products')->orderByDesc('products_count')->take(8)->get();

        // Latest articles for Cultural Spotlight
        $latestArticles = Article::with(['author', 'category'])->latest()->take(3)->get();

        return view('welcome', [
            'popularProducts' => $popularProducts,
            'popularStores' => $popularStores,
            'categories' => $categories,
            'latestArticles' => $latestArticles,
            'transparentNav' => true,
        ]);
    }
}
