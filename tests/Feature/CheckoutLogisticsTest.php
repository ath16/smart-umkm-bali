<?php

namespace Tests\Feature;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\CustomerAddress;
use App\Models\Product;
use App\Models\Store;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CheckoutLogisticsTest extends TestCase
{
    use RefreshDatabase;

    public function test_api_returns_shipping_rates_based_on_weight()
    {
        $response = $this->getJson('/api/shipping-rates?weight=1500');

        $response->assertStatus(200)
                 ->assertJsonPath('data.0.cost', 30000); // 1500g = 2kg, JNE REG is 15000/kg -> 30000
    }

    public function test_checkout_saves_logistics_information()
    {
        // Mock MidtransService to avoid actual API call
        $mock = \Mockery::mock(\App\Services\MidtransService::class);
        $mock->shouldReceive('createSnapToken')->andReturn('mocked-token');
        $this->app->instance(\App\Services\MidtransService::class, $mock);

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
            'stock' => 10,
            'min_stock' => 5,
            'weight' => 2000
        ]);
        
        $address = CustomerAddress::create([
            'customer_id' => $customer->id,
            'user_id' => $customer->id,
            'recipient_name' => 'John Doe',
            'phone' => '081234567890',
            'province' => 'Bali',
            'city' => 'Denpasar',
            'district' => 'Denpasar Selatan',
            'postal_code' => '80222',
            'address' => 'Jl. Bypass Ngurah Rai',
            'is_default' => true,
        ]);

        $cart = Cart::create(['user_id' => $customer->id]);
        CartItem::create([
            'cart_id' => $cart->id,
            'product_id' => $product->id,
            'quantity' => 1
        ]);

        $response = $this->actingAs($customer)->post('/checkout', [
            'address_id' => $address->id,
            'payment_method' => 'Bank Transfer',
            'courier_name' => 'JNE',
            'courier_service' => 'REG',
        ]);

        $response->assertRedirect();

        $this->assertDatabaseHas('orders', [
            'courier_name' => 'JNE',
            'courier_service' => 'REG',
            'shipping_fee' => 30000, // 2kg * 15000
        ]);
    }
}
