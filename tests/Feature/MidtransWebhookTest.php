<?php

namespace Tests\Feature;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\PaymentTransaction;
use App\Models\Product;
use App\Models\Store;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MidtransWebhookTest extends TestCase
{
    use RefreshDatabase;

    public function test_webhook_expire_recovers_stock_and_cancels_order()
    {
        $customer = User::factory()->create(['role' => 'customer']);
        $owner = User::factory()->create(['role' => 'owner']);
        $store = Store::create([
            'user_id' => $owner->id,
            'name' => 'Toko Biasa',
            'slug' => 'toko-biasa'
        ]);
        $product = Product::create([
            'store_id' => $store->id, 
            'name' => 'Produk A',
            'cost_price' => 40000,
            'sell_price' => 50000,
            'stock' => 5,
            'min_stock' => 5,
        ]);

        $paymentTx = PaymentTransaction::create([
            'user_id' => $customer->id,
            'reference_number' => 'PAY-TEST-123',
            'amount' => 60000,
            'status' => 'pending',
            'payment_type' => 'Bank Transfer'
        ]);

        $order = Order::create([
            'invoice_number' => 'INV-TEST-123',
            'user_id' => $customer->id,
            'store_id' => $store->id,
            'payment_transaction_id' => $paymentTx->id,
            'status' => 'pending',
            'payment_method' => 'Bank Transfer',
            'shipping_fee' => 10000,
            'total_amount' => 60000
        ]);

        OrderItem::create([
            'order_id' => $order->id,
            'product_id' => $product->id,
            'product_name' => $product->name,
            'price' => $product->sell_price,
            'quantity' => 2,
            'subtotal' => 100000
        ]);

        $response = $this->postJson('/api/midtrans/webhook', [
            'order_id' => 'PAY-TEST-123',
            'transaction_status' => 'expire',
            'fraud_status' => 'accept',
        ]);

        $response->assertStatus(200);

        $this->assertDatabaseHas('payment_transactions', [
            'id' => $paymentTx->id,
            'status' => 'expired'
        ]);

        $this->assertDatabaseHas('orders', [
            'id' => $order->id,
            'status' => 'cancelled'
        ]);

        // Stock should be recovered (5 + 2)
        $this->assertDatabaseHas('products', [
            'id' => $product->id,
            'stock' => 7
        ]);
    }
}
