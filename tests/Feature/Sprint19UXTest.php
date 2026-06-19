<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\RateLimiter;
use Tests\TestCase;
use App\Models\User;
use App\Models\Store;
use App\Models\Product;
use App\Models\Cart;
use App\Models\CartItem;

class Sprint19UXTest extends TestCase
{
    use RefreshDatabase;

    public function test_checkout_route_has_rate_limiting(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        // Send 11 requests
        for ($i = 0; $i < 10; $i++) {
            $this->post('/checkout', []);
        }

        $response = $this->post('/checkout', []);
        $response->assertStatus(429); // Too Many Requests
    }

    public function test_cart_item_can_be_updated_via_ajax(): void
    {
        $owner = User::factory()->create(['role' => 'owner']);
        $store = Store::create(['user_id' => $owner->id, 'name' => 'Test Store', 'slug' => 'test-store', 'domain' => 'test-store.smart-umkm.id']);
        $product = Product::create(['store_id' => $store->id, 'name' => 'Test Product', 'slug' => 'test-product', 'description' => 'Test', 'cost_price' => 500, 'sell_price' => 1000, 'stock' => 10, 'min_stock' => 5]);
        
        $customer = User::factory()->create(['role' => 'customer']);
        $cart = Cart::create(['user_id' => $customer->id]);
        $cartItem = CartItem::create(['cart_id' => $cart->id, 'product_id' => $product->id, 'quantity' => 1]);

        $this->actingAs($customer);

        $response = $this->putJson("/cart/{$cartItem->id}", [
            'quantity' => 5
        ]);

        $response->assertStatus(200);
        $response->assertJson([
            'success' => true,
        ]);
        
        $this->assertDatabaseHas('cart_items', [
            'id' => $cartItem->id,
            'quantity' => 5,
        ]);
    }

    public function test_cart_item_can_be_removed_via_ajax(): void
    {
        $owner = User::factory()->create(['role' => 'owner']);
        $store = Store::create(['user_id' => $owner->id, 'name' => 'Test Store 2', 'slug' => 'test-store-2', 'domain' => 'test-store-2.smart-umkm.id']);
        $product = Product::create(['store_id' => $store->id, 'name' => 'Test Product 2', 'slug' => 'test-product-2', 'description' => 'Test', 'cost_price' => 500, 'sell_price' => 1000, 'stock' => 10, 'min_stock' => 5]);
        
        $customer = User::factory()->create(['role' => 'customer']);
        $cart = Cart::create(['user_id' => $customer->id]);
        $cartItem = CartItem::create(['cart_id' => $cart->id, 'product_id' => $product->id, 'quantity' => 1]);

        $this->actingAs($customer);

        $response = $this->deleteJson("/cart/{$cartItem->id}");

        $response->assertStatus(200);
        $response->assertJson([
            'success' => true,
        ]);
        
        $this->assertDatabaseMissing('cart_items', [
            'id' => $cartItem->id,
        ]);
    }
}
