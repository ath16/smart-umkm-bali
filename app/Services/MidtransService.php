<?php

namespace App\Services;

use App\Models\PaymentTransaction;
use App\Models\User;
use App\Models\CustomerAddress;
use Illuminate\Support\Facades\Log;

class MidtransService
{
    public function __construct()
    {
        \Midtrans\Config::$serverKey = config('services.midtrans.server_key') ?? env('MIDTRANS_SERVER_KEY');
        \Midtrans\Config::$isProduction = config('services.midtrans.is_production') ?? env('MIDTRANS_IS_PRODUCTION', false);
        \Midtrans\Config::$isSanitized = true;
        \Midtrans\Config::$is3ds = true;
    }

    /**
     * Create Snap Token for a PaymentTransaction
     */
    public function createSnapToken(PaymentTransaction $paymentTx, User $user, CustomerAddress $address): string
    {
        $params = [
            'transaction_details' => [
                'order_id' => $paymentTx->reference_number,
                'gross_amount' => $paymentTx->amount,
            ],
            'customer_details' => [
                'first_name' => $user->name,
                'email' => $user->email,
                'phone' => $address->phone,
            ],
        ];

        try {
            return \Midtrans\Snap::getSnapToken($params);
        } catch (\Exception $e) {
            Log::error('Midtrans Snap Error: ' . $e->getMessage());
            throw $e;
        }
    }
}
