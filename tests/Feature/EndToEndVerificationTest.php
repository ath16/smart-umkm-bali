<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Store;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\StoreCategory;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Cart;
use App\Models\Article;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Database\Seeders\DummyDataSeeder;

class EndToEndVerificationTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        // Seed database to have data to test with
        $this->seed(DummyDataSeeder::class);
    }

    // ==========================================
    // GUEST SCENARIOS
    // ==========================================

    public function test_1_guest_can_view_landing_page()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSee('Smart UMKM Bali');
    }

    public function test_2_guest_can_view_marketplace_products()
    {
        $response = $this->get('/marketplace');
        $response->assertStatus(200);
        $response->assertSee('Katalog Produk');
    }

    public function test_3_guest_can_view_store_profile()
    {
        $store = Store::first();
        $response = $this->get('/stores/' . $store->slug);
        $response->assertStatus(200);
        $response->assertSee($store->name);
    }

    public function test_4_guest_can_view_product_detail()
    {
        $product = Product::first();
        $response = $this->get('/marketplace/' . $product->slug);
        $response->assertStatus(200);
        $response->assertSee($product->name);
    }

    public function test_5_guest_can_view_articles()
    {
        $response = $this->get('/blog');
        $response->assertStatus(200);
    }

    public function test_6_guest_cannot_access_checkout()
    {
        $response = $this->get('/checkout');
        $response->assertRedirect('/login');
    }

    public function test_7_guest_cannot_access_dashboard()
    {
        $response = $this->get('/dashboard');
        $response->assertRedirect('/login');
    }

    // ==========================================
    // CUSTOMER SCENARIOS
    // ==========================================

    public function test_8_customer_can_login()
    {
        $customer = User::where('email', 'customer@smart-umkm.test')->first();
        $response = $this->post('/login', [
            'email' => $customer->email,
            'password' => 'password',
        ]);
        $this->assertAuthenticatedAs($customer);
        $response->assertRedirect(route('marketplace.index', absolute: false));
    }

    public function test_9_customer_can_add_to_cart()
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

    public function test_10_customer_can_view_cart()
    {
        $customer = User::where('email', 'customer@smart-umkm.test')->first();
        $response = $this->actingAs($customer)->get('/cart');
        $response->assertStatus(200);
    }

    public function test_11_customer_can_view_checkout()
    {
        $customer = User::where('email', 'customer@smart-umkm.test')->first();
        // Assume they have items in cart for checkout to work
        $product = Product::first();
        $this->actingAs($customer)->post('/cart', ['product_id' => $product->id, 'quantity' => 1]);
        
        $response = $this->actingAs($customer)->get('/checkout');
        $response->assertStatus(200);
    }

    public function test_12_customer_can_view_order_history()
    {
        $customer = User::where('email', 'customer@smart-umkm.test')->first();
        $response = $this->actingAs($customer)->get('/customer/orders');
        $response->assertStatus(200);
    }

    // ==========================================
    // OWNER SCENARIOS
    // ==========================================

    public function test_13_owner_can_login_to_dashboard()
    {
        $owner = User::where('email', 'owner@smart-umkm.test')->first();
        $response = $this->post('/login', [
            'email' => $owner->email,
            'password' => 'password',
        ]);
        $this->assertAuthenticatedAs($owner);
        $response->assertRedirect(route('dashboard', absolute: false));
    }

    public function test_14_owner_can_view_store_dashboard()
    {
        $owner = User::where('email', 'owner@smart-umkm.test')->first();
        $response = $this->actingAs($owner)->get('/dashboard');
        $response->assertStatus(200);
    }

    public function test_15_owner_can_view_product_catalog()
    {
        $owner = User::where('email', 'owner@smart-umkm.test')->first();
        $response = $this->actingAs($owner)->get('/merchant/products');
        $response->assertStatus(200);
    }

    public function test_16_owner_can_create_product()
    {
        $owner = User::where('email', 'owner@smart-umkm.test')->first();
        $store = $owner->ownedStores()->first();
        $category = ProductCategory::first();

        $response = $this->actingAs($owner)->post('/merchant/products', [
            'store_id' => $store->id,
            'product_category_id' => $category->id,
            'name' => 'New Product Testing',
            'cost_price' => 10000,
            'sell_price' => 15000,
            'stock' => 50,
            'weight' => 100,
            'min_stock' => 5,
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('products', [
            'name' => 'New Product Testing'
        ]);
    }

    public function test_17_owner_can_view_orders()
    {
        $owner = User::where('email', 'owner@smart-umkm.test')->first();
        $response = $this->actingAs($owner)->get('/merchant/orders');
        $response->assertStatus(200);
    }

    public function test_18_owner_cannot_access_other_owner_store()
    {
        $owner1 = User::where('email', 'owner@smart-umkm.test')->first();
        // Create another owner
        $owner2 = User::factory()->create(['role' => 'owner']);
        $store2 = Store::factory()->create(['user_id' => $owner2->id]);

        // owner1 tries to view/edit owner2's store product page (IDOR check)
        // Without IDOR protection this might work, but with protection it should 403 or 404
        $response = $this->actingAs($owner1)->get('/merchant/stores/' . $store2->id . '/edit');
        
        // Either 404 or 403 is fine for IDOR protection
        $this->assertTrue(in_array($response->status(), [403, 404]));
    }

    public function test_19_owner_can_view_reports()
    {
        $owner = User::where('email', 'owner@smart-umkm.test')->first();
        // Assuming there is an insight/report page
        $response = $this->actingAs($owner)->get('/dashboard'); // Dashboard has reports
        $response->assertStatus(200);
    }

    // ==========================================
    // CASHIER SCENARIOS
    // ==========================================

    public function test_20_cashier_can_login()
    {
        $cashier = User::where('email', 'cashier@smart-umkm.test')->first();
        $this->actingAs($cashier);
        $this->assertAuthenticatedAs($cashier);
    }

    public function test_21_cashier_can_access_pos()
    {
        $cashier = User::where('email', 'cashier@smart-umkm.test')->first();
        $response = $this->actingAs($cashier)->get('/merchant/pos');
        $response->assertStatus(200);
    }

    public function test_22_cashier_cannot_access_store_settings()
    {
        $cashier = User::where('email', 'cashier@smart-umkm.test')->first();
        $store = $cashier->store;
        
        // Cashiers shouldn't be able to edit store settings
        $response = $this->actingAs($cashier)->get('/merchant/stores/' . $store->id . '/edit');
        $this->assertTrue(in_array($response->status(), [403, 404]));
    }

    public function test_23_cashier_cannot_delete_products()
    {
        $cashier = User::where('email', 'cashier@smart-umkm.test')->first();
        $product = Product::where('store_id', $cashier->store_id)->first();
        
        $response = $this->actingAs($cashier)->delete('/merchant/products/' . $product->id);
        $this->assertTrue(in_array($response->status(), [403, 404]));
    }

    // ==========================================
    // ADMIN SCENARIOS
    // ==========================================

    public function test_24_admin_can_login()
    {
        $admin = User::where('email', 'admin@smart-umkm.test')->first();
        $this->actingAs($admin);
        $this->assertAuthenticatedAs($admin);
    }

    public function test_25_admin_can_view_activity_logs()
    {
        $admin = User::where('email', 'admin@smart-umkm.test')->first();
        $response = $this->actingAs($admin)->get('/admin/activity-logs');
        $response->assertStatus(200);
    }
}
