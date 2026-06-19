<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\View\View;

class StoreOrderController extends Controller
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
     * Display a listing of the incoming orders.
     */
    public function index(Request $request): View
    {
        $storeId = $this->getStoreId();

        $query = Order::with('user')
            ->where('store_id', $storeId)
            ->latest();

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $orders = $query->paginate(10)->withQueryString();

        return view('orders.index', compact('orders'));
    }

    /**
     * Display the specified order.
     */
    public function show(Order $order): View
    {
        $this->authorize('view', $order);
        abort_unless($order->store_id === $this->getStoreId(), 403, 'Akses ditolak.');

        $order->load(['orderItems.product', 'orderAddress', 'user', 'paymentTransaction']);

        return view('orders.show', compact('order'));
    }

    /**
     * Update the order status.
     */
    public function updateStatus(Request $request, Order $order)
    {
        $this->authorize('update', $order);
        abort_unless($order->store_id === $this->getStoreId(), 403, 'Akses ditolak.');

        $request->validate([
            'status' => 'required|in:processing,shipped,cancelled',
            'shipping_courier' => 'required_if:status,shipped|nullable|string|max:100',
            'tracking_number' => 'required_if:status,shipped|nullable|string|max:100',
        ]);

        // Logic validasi state transition
        if ($request->status === 'processing' && $order->status !== 'paid') {
            return back()->with('error', 'Hanya pesanan berstatus Dibayar yang dapat diproses.');
        }

        if ($request->status === 'shipped' && $order->status !== 'processing') {
            return back()->with('error', 'Hanya pesanan berstatus Diproses yang dapat dikirim.');
        }
        
        if ($request->status === 'cancelled' && !in_array($order->status, ['pending', 'paid', 'processing'])) {
            return back()->with('error', 'Pesanan ini tidak dapat dibatalkan.');
        }

        \Illuminate\Support\Facades\DB::transaction(function () use ($request, $order) {
            $updateData = ['status' => $request->status];

            if ($request->status === 'shipped') {
                $updateData['shipping_courier'] = $request->shipping_courier;
                $updateData['tracking_number'] = $request->tracking_number;
            }

            if ($request->status === 'cancelled') {
                // Revert stock
                foreach ($order->orderItems as $item) {
                    \App\Models\Product::where('id', $item->product_id)
                        ->increment('stock', $item->quantity);
                }
            }

            $order->update($updateData);
        });

        return back()->with('success', 'Status pesanan berhasil diperbarui.');
    }
}
