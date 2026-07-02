<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Store;
use App\Models\StoreCategory;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductSlugTest extends TestCase
{
    use RefreshDatabase;

    protected $store;
    protected $productCategory;

    protected function setUp(): void
    {
        parent::setUp();
        
        // Create necessary dependencies for a product
        $user = User::factory()->create();
        $storeCategory = StoreCategory::create(['name' => 'Test Store Category', 'slug' => 'test-store-category']);
        $this->store = Store::create([
            'user_id' => $user->id,
            'store_category_id' => $storeCategory->id,
            'name' => 'Test Store',
            'slug' => 'test-store',
            'address' => 'Test Address',
            'is_active' => true,
        ]);
        $this->productCategory = ProductCategory::create(['name' => 'Test Category', 'slug' => 'test-category']);
    }

    public function test_product_generates_slug_on_create()
    {
        $product = Product::create([
            'store_id' => $this->store->id,
            'product_category_id' => $this->productCategory->id,
            'name' => 'Kopi Kintamani Asli',
            'cost_price' => 10000,
            'sell_price' => 15000,
            'is_published' => true,
        ]);

        $this->assertNotNull($product->slug);
        $this->assertEquals('kopi-kintamani-asli', $product->slug);
    }

    public function test_product_slug_is_unique()
    {
        $product1 = Product::create([
            'store_id' => $this->store->id,
            'product_category_id' => $this->productCategory->id,
            'name' => 'Kopi Kintamani Asli',
            'cost_price' => 10000,
            'sell_price' => 15000,
            'is_published' => true,
        ]);

        $product2 = Product::create([
            'store_id' => $this->store->id,
            'product_category_id' => $this->productCategory->id,
            'name' => 'Kopi Kintamani Asli',
            'cost_price' => 10000,
            'sell_price' => 15000,
            'is_published' => true,
        ]);

        $this->assertEquals('kopi-kintamani-asli', $product1->slug);
        $this->assertEquals('kopi-kintamani-asli-2', $product2->slug);
    }

    public function test_product_slug_updates_when_name_changes()
    {
        $product = Product::create([
            'store_id' => $this->store->id,
            'product_category_id' => $this->productCategory->id,
            'name' => 'Kopi Lama',
            'cost_price' => 10000,
            'sell_price' => 15000,
            'is_published' => true,
        ]);

        $this->assertEquals('kopi-lama', $product->slug);

        $product->update(['name' => 'Kopi Baru']);
        $this->assertEquals('kopi-baru', $product->slug);
    }

    public function test_product_detail_page_loads_with_slug()
    {
        $product = Product::create([
            'store_id' => $this->store->id,
            'product_category_id' => $this->productCategory->id,
            'name' => 'Kopi Kintamani Asli',
            'cost_price' => 10000,
            'sell_price' => 15000,
            'is_published' => true,
        ]);

        $response = $this->get(route('products.show', $product->slug));
        $response->assertStatus(200);
        $response->assertSee($product->name);
    }

    public function test_product_detail_page_returns_404_for_invalid_slug()
    {
        $response = $this->get(route('products.show', 'invalid-slug-that-does-not-exist'));
        $response->assertStatus(404);
    }
}
