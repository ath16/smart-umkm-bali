<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\ProductReview;
use App\Models\StoreReview;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    /**
     * Store a product review.
     */
    public function storeProductReview(Request $request, Order $order)
    {
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }

        if ($order->status !== 'completed') {
            return back()->with('error', 'Hanya pesanan yang sudah selesai yang bisa diulas.');
        }

        $request->validate([
            'product_id' => 'required|exists:products,id',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:1000',
        ]);

        // Check if item belongs to order
        $itemExists = $order->items()->where('product_id', $request->product_id)->exists();
        if (!$itemExists) {
            return back()->with('error', 'Produk tidak ditemukan dalam pesanan ini.');
        }

        ProductReview::updateOrCreate(
            [
                'user_id' => Auth::id(),
                'product_id' => $request->product_id,
                'order_id' => $order->id,
            ],
            [
                'rating' => $request->rating,
                'comment' => $request->comment,
            ]
        );

        return back()->with('success', 'Ulasan produk berhasil disimpan.');
    }

    /**
     * Store a store review.
     */
    public function storeStoreReview(Request $request, Order $order)
    {
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }

        if ($order->status !== 'completed') {
            return back()->with('error', 'Hanya pesanan yang sudah selesai yang bisa diulas.');
        }

        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:1000',
        ]);

        StoreReview::updateOrCreate(
            [
                'user_id' => Auth::id(),
                'store_id' => $order->store_id,
                'order_id' => $order->id,
            ],
            [
                'rating' => $request->rating,
                'comment' => $request->comment,
            ]
        );

        return back()->with('success', 'Ulasan toko berhasil disimpan.');
    }
}
