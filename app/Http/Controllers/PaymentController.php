<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PaymentTransaction;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Midtrans\Config;
use Midtrans\Notification;

class PaymentController extends Controller
{
    /**
     * Handle Midtrans webhook notifications.
     */
    public function webhook(Request $request)
    {
        Config::$serverKey = env('MIDTRANS_SERVER_KEY', 'SB-Mid-server-x');
        Config::$isProduction = env('MIDTRANS_IS_PRODUCTION', false);

        try {
            $notif = new Notification();

            $transactionStatus = $notif->transaction_status;
            $paymentType = $notif->payment_type;
            $orderId = $notif->order_id;
            $fraudStatus = $notif->fraud_status;

            $paymentTx = PaymentTransaction::where('reference_number', $orderId)->first();

            if (!$paymentTx) {
                return response()->json(['message' => 'Payment transaction not found'], 404);
            }

            $previousStatus = $paymentTx->status;

            if ($transactionStatus == 'capture') {
                if ($paymentType == 'credit_card') {
                    if ($fraudStatus == 'challenge') {
                        $paymentTx->status = 'pending';
                    } else {
                        $paymentTx->status = 'paid';
                    }
                }
            } else if ($transactionStatus == 'settlement') {
                $paymentTx->status = 'paid';
            } else if ($transactionStatus == 'pending') {
                $paymentTx->status = 'pending';
            } else if ($transactionStatus == 'deny') {
                $paymentTx->status = 'failed';
            } else if ($transactionStatus == 'expire') {
                $paymentTx->status = 'expired';
            } else if ($transactionStatus == 'cancel') {
                $paymentTx->status = 'failed';
            }

            $paymentTx->save();

            // Sync order status
            if ($paymentTx->status === 'paid') {
                Order::where('payment_transaction_id', $paymentTx->id)->update(['status' => 'paid']);
            } elseif (in_array($paymentTx->status, ['failed', 'expired'])) {
                // Only revert stock if transitioning FROM a non-failed state
                if (!in_array($previousStatus, ['failed', 'expired'])) {
                    $this->revertStock($paymentTx);
                }

                Order::where('payment_transaction_id', $paymentTx->id)->update(['status' => 'cancelled']);
            }

            return response()->json(['message' => 'OK'], 200);

        } catch (\Exception $e) {
            Log::error('Midtrans webhook error: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString(),
            ]);

            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    /**
     * Revert stock for all items in cancelled/expired orders.
     *
     * Uses DB::transaction + lockForUpdate to safely increment
     * product stock back to its original amount.
     */
    private function revertStock(PaymentTransaction $paymentTx): void
    {
        DB::transaction(function () use ($paymentTx) {
            $orders = Order::where('payment_transaction_id', $paymentTx->id)->get();

            foreach ($orders as $order) {
                $orderItems = OrderItem::where('order_id', $order->id)->get();

                foreach ($orderItems as $orderItem) {
                    // Lock the product row to prevent concurrent modification
                    $product = Product::where('id', $orderItem->product_id)->lockForUpdate()->first();

                    if ($product) {
                        $product->increment('stock', $orderItem->quantity);

                        Log::info("Stock reverted: {$product->name} +{$orderItem->quantity} (Order: {$order->invoice_number})");
                    }
                }
            }
        });
    }
}
