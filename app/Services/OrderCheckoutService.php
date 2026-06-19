<?php

namespace App\Services;

use App\Models\CustomerAddress;
use App\Models\Order;
use App\Models\OrderAddress;
use App\Models\OrderItem;
use App\Models\PaymentTransaction;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class OrderCheckoutService
{
    /**
     * Process checkout logic and create orders.
     *
     * Uses pessimistic locking (lockForUpdate) to prevent race conditions
     * where two customers try to buy the last item simultaneously.
     */
    public function processCheckout($user, $cart, $addressId, $paymentMethod, $courierName = null, $courierService = null, $notes = null)
    {
        $address = CustomerAddress::where('user_id', $user->id)->where('id', $addressId)->firstOrFail();

        $groupedItems = $cart->items->groupBy(function($item) {
            return $item->product->store->id;
        });

        $shippingService = new ShippingService();
        $totalWeight = $cart->items->sum(function ($item) {
            return ($item->product->weight ?? 1000) * $item->quantity;
        });

        $rates = $shippingService->getRates($totalWeight);
        $selectedRate = collect($rates)->first(function($rate) use ($courierName, $courierService) {
            return $rate['courier'] === $courierName && $rate['service'] === $courierService;
        });

        $totalShippingFee = $selectedRate ? $selectedRate['cost'] : 10000;
        // Distribute shipping fee evenly per store
        $shippingFeePerStore = $totalShippingFee / count($groupedItems);

        return DB::transaction(function () use ($user, $cart, $address, $groupedItems, $shippingFeePerStore, $paymentMethod, $courierName, $courierService, $notes) {
            // ============================================================
            // CRITICAL: Lock product rows and validate stock BEFORE creating orders.
            // This prevents race conditions (two customers buying the last item).
            // ============================================================
            $allProductIds = $cart->items->pluck('product_id')->sort()->values()->toArray();

            // Lock rows in consistent order (by ID ASC) to prevent deadlocks
            $lockedProducts = Product::whereIn('id', $allProductIds)
                ->orderBy('id')
                ->lockForUpdate()
                ->get()
                ->keyBy('id');

            // Validate stock availability for ALL items before proceeding
            $stockErrors = [];
            foreach ($cart->items as $item) {
                $product = $lockedProducts->get($item->product_id);

                if (!$product) {
                    $stockErrors[] = "Produk tidak ditemukan.";
                    continue;
                }

                if ($product->stock < $item->quantity) {
                    $stockErrors[] = "Stok \"{$product->name}\" tidak cukup. Tersedia: {$product->stock}, diminta: {$item->quantity}.";
                }
            }

            if (!empty($stockErrors)) {
                throw new \Exception(implode(' ', $stockErrors));
            }

            // Calculate grand total with locked (fresh) prices
            $grandTotal = 0;
            foreach ($groupedItems as $storeId => $items) {
                $subtotal = 0;
                foreach ($items as $item) {
                    $product = $lockedProducts->get($item->product_id);
                    $subtotal += $item->quantity * $product->sell_price;
                }
                $grandTotal += $subtotal + $shippingFeePerStore;
            }

            // Create payment transaction
            $paymentTx = PaymentTransaction::create([
                'user_id' => $user->id,
                'reference_number' => 'PAY-' . date('Ymd') . '-' . strtoupper(Str::random(8)),
                'amount' => $grandTotal,
                'status' => 'pending',
                'payment_type' => $paymentMethod,
            ]);

            foreach ($groupedItems as $storeId => $items) {
                $subtotal = 0;
                foreach ($items as $item) {
                    $product = $lockedProducts->get($item->product_id);
                    $subtotal += $item->quantity * $product->sell_price;
                }
                
                $totalAmount = $subtotal + $shippingFeePerStore;

                $order = Order::create([
                    'invoice_number' => 'INV-' . date('Ymd') . '-' . strtoupper(Str::random(6)),
                    'user_id' => $user->id,
                    'store_id' => $storeId,
                    'payment_transaction_id' => $paymentTx->id,
                    'status' => 'pending',
                    'payment_method' => $paymentMethod,
                    'courier_name' => $courierName,
                    'courier_service' => $courierService,
                    'shipping_fee' => $shippingFeePerStore,
                    'total_amount' => $totalAmount,
                    'notes' => $notes,
                ]);

                // Copy address snapshot
                OrderAddress::create([
                    'order_id' => $order->id,
                    'recipient_name' => $address->recipient_name,
                    'phone' => $address->phone,
                    'province' => $address->province,
                    'city' => $address->city,
                    'district' => $address->district,
                    'postal_code' => $address->postal_code,
                    'address' => $address->address,
                ]);

                // Create items & reduce stock atomically
                foreach ($items as $item) {
                    $product = $lockedProducts->get($item->product_id);
                    $itemSubtotal = $item->quantity * $product->sell_price;
                    
                    OrderItem::create([
                        'order_id' => $order->id,
                        'product_id' => $item->product_id,
                        'product_name' => $product->name,
                        'price' => $product->sell_price,
                        'quantity' => $item->quantity,
                        'subtotal' => $itemSubtotal,
                    ]);

                    // Reduce stock using the locked model instance
                    $product->decrement('stock', $item->quantity);
                }
            }

            // Clear cart
            $cart->items()->delete();

            // Setup Midtrans
            $midtransService = app(MidtransService::class);
            $snapToken = $midtransService->createSnapToken($paymentTx, $user, $address);
            
            $paymentTx->update(['snap_token' => $snapToken]);

            return $paymentTx;
        });
    }
}
