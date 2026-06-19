<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductCrudTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        // Seed database for business logic tests
        $this->seed(\Database\Seeders\DummyDataSeeder::class);
    }

    public function test_owner_can_view_product_catalog()
    {
        $owner = User::where('email', 'owner@smart-umkm.test')->first();

        $response = $this->actingAs($owner)->get('/dashboard/products');
        
        $response->assertStatus(200);
        $response->assertSee('Produk');
    }

    public function test_owner_can_create_product()
    {
        $owner = User::where('email', 'owner@smart-umkm.test')->first();
        $store = $owner->ownedStore;

        $response = $this->actingAs($owner)->post('/dashboard/products', [
            'store_id' => $store->id,
            'product_category_id' => 1,
            'name' => 'New Test Product',
            'cost_price' => 10000,
            'sell_price' => 15000,
            'stock' => 50,
            'weight' => 100,
            'min_stock' => 5,
            'is_visible' => true
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('products', [
            'name' => 'New Test Product',
            'store_id' => $store->id
        ]);
    }

    public function test_owner_can_update_product()
    {
        $owner = User::where('email', 'owner@smart-umkm.test')->first();
        $store = $owner->ownedStore;
        $product = Product::where('store_id', $store->id)->first();

        $response = $this->actingAs($owner)->put('/dashboard/products/' . $product->id, [
            'store_id' => $store->id,
            'product_category_id' => 1,
            'name' => 'Updated Product Name',
            'cost_price' => 12000,
            'sell_price' => 20000,
            'stock' => 10,
            'weight' => 200,
            'min_stock' => 2,
            'is_visible' => true
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('products', [
            'id' => $product->id,
            'name' => 'Updated Product Name'
        ]);
    }

    public function test_owner_can_delete_product()
    {
        $owner = User::where('email', 'owner@smart-umkm.test')->first();
        $store = $owner->ownedStore;
        $product = Product::where('store_id', $store->id)->first();

        $response = $this->actingAs($owner)->delete('/dashboard/products/' . $product->id);

        $response->assertRedirect();
        $this->assertSoftDeleted('products', [
            'id' => $product->id,
        ]);
    }

    public function test_cashier_cannot_delete_product()
    {
        $cashier = User::where('email', 'cashier@smart-umkm.test')->first();
        $product = Product::first(); // Grab any product

        $response = $this->actingAs($cashier)->delete('/dashboard/products/' . $product->id);

        $response->assertStatus(403);
    }
}
