<?php

namespace App\Http\Controllers;

use App\Models\ProductReview;
use Illuminate\Http\Request;
use Illuminate\View\View;

class StoreReviewController extends Controller
{
    /**
     * Get the current store for the authenticated user.
     */
    private function getStoreId(): int
    {
        $store = auth()->user()->currentStore();
        abort_unless($store, 403, 'Anda belum memiliki usaha.');

        return $store->id;
    }

    /**
     * Display a listing of the product reviews for the store.
     */
    public function index(Request $request): View
    {
        $storeId = $this->getStoreId();

        $reviews = ProductReview::with(['user', 'product', 'order'])
            ->whereHas('product', function($query) use ($storeId) {
                $query->where('store_id', $storeId);
            })
            ->latest()
            ->paginate(15);

        return view('reviews.index', compact('reviews'));
    }
}
