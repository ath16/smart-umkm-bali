<?php

namespace App\Http\Controllers\Webhook;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PaymentTransaction;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class MidtransController extends Controller
{
    public function handleNotification(Request $request)
    {
        // For security, midtrans server key check could be added here
        $payload = $request->all();
        
        Log::info('Midtrans Webhook Payload: ', $payload);

        $orderId = $payload['order_id'] ?? null;
        $transactionStatus = $payload['transaction_status'] ?? null;
        $fraudStatus = $payload['fraud_status'] ?? null;

        if (!$orderId) {
            return response()->json(['message' => 'Invalid order_id'], 400);
        }

        $paymentTx = PaymentTransaction::with('orders.items.product')->where('reference_number', $orderId)->first();

        if (!$paymentTx) {
            return response()->json(['message' => 'Payment transaction not found'], 404);
        }

        DB::beginTransaction();

        try {
            if ($transactionStatus == 'capture' || $transactionStatus == 'settlement') {
                if ($fraudStatus == 'challenge') {
                    $paymentTx->update(['status' => 'pending']);
                } else {
                    $paymentTx->update(['status' => 'paid']);
                    // Update all associated orders to paid
                    foreach ($paymentTx->orders as $order) {
                        $order->update(['status' => 'paid']);
                    }
                }
            } else if ($transactionStatus == 'cancel' || $transactionStatus == 'deny' || $transactionStatus == 'expire') {
                $mappedStatus = $transactionStatus === 'expire' ? 'expired' : 'failed';
                $paymentTx->update(['status' => $mappedStatus]);
                
                // Cancel all associated orders and recover stock
                foreach ($paymentTx->orders as $order) {
                    if ($order->status !== 'cancelled') {
                        $order->update(['status' => 'cancelled']);
                        
                        // Recover stock
                        foreach ($order->items as $item) {
                            if ($item->product) {
                                $item->product->increment('stock', $item->quantity);
                            }
                        }
                    }
                }
            } else if ($transactionStatus == 'pending') {
                $paymentTx->update(['status' => 'pending']);
            }

            DB::commit();
            return response()->json(['message' => 'Webhook handled']);

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Midtrans Webhook Error: ' . $e->getMessage());
            return response()->json(['message' => 'Error handling webhook'], 500);
        }
    }
}
