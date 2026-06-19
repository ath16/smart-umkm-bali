<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CartTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(\Database\Seeders\DummyDataSeeder::class);
    }

    public function test_customer_can_add_product_to_cart()
    {
        $customer = User::where('email', 'customer@smart-umkm.test')->first();
        $product = Product::first();

        $response = $this->actingAs($customer)->post('/cart', [
            'product_id' => $product->id,
            'quantity' => 2,
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('cart_items', [
            'product_id' => $product->id,
            'quantity' => 2
        ]);
    }

    public function test_customer_can_update_cart_quantity()
    {
        $customer = User::where('email', 'customer@smart-umkm.test')->first();
        $product = Product::first();

        // Ensure customer has a cart
        $cart = \App\Models\Cart::where('user_id', $customer->id)->first();
        if (!$cart) {
            $cart = \App\Models\Cart::create(['user_id' => $customer->id]);
        }

        // First add to cart
        $this->actingAs($customer)->post('/cart', [
            'product_id' => $product->id,
            'quantity' => 1,
        ]);

        // Get the cart item
        $cartItem = $cart->items()->first();

        // Update quantity
        $response = $this->actingAs($customer)->put('/cart/' . $cartItem->id, [
            'quantity' => 5,
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('cart_items', [
            'id' => $cartItem->id,
            'quantity' => 5
        ]);
    }

    public function test_customer_can_remove_item_from_cart()
    {
        $customer = User::where('email', 'customer@smart-umkm.test')->first();
        $product = Product::first();

        // Ensure customer has a cart
        $cart = \App\Models\Cart::where('user_id', $customer->id)->first();
        if (!$cart) {
            $cart = \App\Models\Cart::create(['user_id' => $customer->id]);
        }

        // Add to cart
        $this->actingAs($customer)->post('/cart', [
            'product_id' => $product->id,
            'quantity' => 1,
        ]);

        $cartItem = $cart->items()->first();

        // Delete from cart
        $response = $this->actingAs($customer)->delete('/cart/' . $cartItem->id);

        $response->assertRedirect();
        $this->assertDatabaseMissing('cart_items', [
            'id' => $cartItem->id,
        ]);
    }
}
