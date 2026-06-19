<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\PaymentTransaction;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class CustomerOrderController extends Controller
{
    /**
     * Display a listing of customer's orders.
     */
    public function index()
    {
        $orders = Order::with(['store', 'items.product', 'paymentTransaction'])
            ->where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('customer.orders.index', compact('orders'));
    }

    /**
     * Display the specified order.
     */
    public function show(Order $order)
    {
        $this->authorize('view', $order);
        abort_unless($order->user_id === Auth::id(), 403, 'Akses ditolak.');

        $order->load(['store', 'items.product', 'address', 'paymentTransaction']);

        return view('customer.orders.show', compact('order'));
    }

    /**
     * Cancel the order if it's still pending.
     */
    public function cancel(Order $order)
    {
        $this->authorize('view', $order);
        abort_unless($order->user_id === Auth::id(), 403, 'Akses ditolak.');

        if ($order->status !== 'pending') {
            return back()->with('error', 'Pesanan tidak dapat dibatalkan.');
        }

        $order->update(['status' => 'cancelled']);

        // Jika semua pesanan dalam satu transaksi payment ini dibatalkan, update paymentTransaction
        $paymentTx = $order->paymentTransaction;
        if ($paymentTx) {
            $allCancelled = $paymentTx->orders()->where('status', '!=', 'cancelled')->doesntExist();
            if ($allCancelled) {
                $paymentTx->update(['status' => 'failed']);
            }
        }

        // Kembalikan stok
        foreach ($order->items as $item) {
            if ($item->product) {
                $item->product->increment('stock', $item->quantity);
            }
        }

        return back()->with('success', 'Pesanan berhasil dibatalkan.');
    }

    /**
     * Complete the order when item is received.
     */
    public function complete(Order $order)
    {
        $this->authorize('view', $order);
        abort_unless($order->user_id === Auth::id(), 403, 'Akses ditolak.');

        if ($order->status !== 'shipped') {
            return back()->with('error', 'Pesanan belum bisa diselesaikan.');
        }

        $order->update(['status' => 'completed']);

        return back()->with('success', 'Pesanan telah diselesaikan. Terima kasih telah berbelanja!');
    }

    /**
     * Download Invoice as PDF.
     */
    public function invoice(Order $order)
    {
        $this->authorize('view', $order);
        abort_unless($order->user_id === Auth::id(), 403, 'Akses ditolak.');

        $order->load(['store', 'items.product', 'address', 'paymentTransaction']);
        
        $pdf = Pdf::loadView('customer.orders.invoice', compact('order'));
        
        return $pdf->download('Invoice-' . $order->invoice_number . '.pdf');
    }
}
