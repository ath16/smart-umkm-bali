<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use App\Models\Store;
use App\Models\Product;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\CustomerAddress;
use App\Services\OrderCheckoutService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Midtrans\Snap;

class OrderCheckoutServiceTest extends TestCase
{
    use RefreshDatabase;

    public function test_process_checkout_creates_orders_and_deducts_stock(): void
    {
        // Mock Midtrans Snap to prevent real API calls
        $this->mock('alias:Midtrans\Snap', function ($mock) {
            $mock->shouldReceive('getSnapToken')->andReturn('mock-snap-token');
        });

        $user = User::factory()->create(['role' => 'customer']);
        $owner = User::factory()->create(['role' => 'owner']);
        $store = Store::create([
            'user_id' => $owner->id,
            'name' => 'Test Store',
            'slug' => 'test-store',
        ]);
        
        $product = Product::create([
            'store_id' => $store->id,
            'name' => 'Test Product',
            'cost_price' => 40000,
            'sell_price' => 50000,
            'stock' => 10
        ]);

        $address = CustomerAddress::create([
            'user_id' => $user->id,
            'recipient_name' => 'John Doe',
            'phone' => '08123456789',
            'province' => 'Bali',
            'city' => 'Denpasar',
            'district' => 'Denpasar Selatan',
            'postal_code' => '80222',
            'address' => 'Jl. Test No. 1',
        ]);

        $cart = Cart::create(['user_id' => $user->id]);
        CartItem::create([
            'cart_id' => $cart->id,
            'product_id' => $product->id,
            'quantity' => 2
        ]);

        $service = new OrderCheckoutService();
        $result = $service->processCheckout($user, $cart, $address->id, 'qris', 'Tolong cepat');

        $this->assertNotNull($result);
        $this->assertEquals('pending', $result->status);
        $this->assertEquals('mock-snap-token', $result->snap_token);
        
        // 50000 * 2 = 100000. Shipping = 10000. Total = 110000.
        $this->assertEquals(110000, $result->amount);

        $this->assertDatabaseHas('orders', [
            'user_id' => $user->id,
            'store_id' => $store->id,
            'total_amount' => 110000,
            'shipping_fee' => 10000,
        ]);

        $this->assertDatabaseHas('order_items', [
            'product_id' => $product->id,
            'quantity' => 2,
            'subtotal' => 100000,
        ]);

        // Stock should be deducted
        $this->assertEquals(8, $product->fresh()->stock);

        // Cart should be empty
        $this->assertEquals(0, $cart->fresh()->items()->count());
    }
}
