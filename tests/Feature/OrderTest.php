<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Order;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class OrderTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(\Database\Seeders\DummyDataSeeder::class);
    }

    public function test_owner_can_view_orders()
    {
        $owner = User::where('email', 'owner@smart-umkm.test')->first();

        $response = $this->actingAs($owner)->get('/dashboard/orders');

        $response->assertStatus(200);
        $response->assertSee('Pesanan Online');
    }

    public function test_owner_can_update_order_status()
    {
        $owner = User::where('email', 'owner@smart-umkm.test')->first();
        $store = $owner->ownedStore;
        $order = Order::where('store_id', $store->id)->first();

        // If there are no orders in the seeder, skip the test
        if (!$order) {
            $this->markTestSkipped('No orders available in seeder.');
        }

        $order->update(['status' => 'processing']);

        $response = $this->actingAs($owner)->patch('/dashboard/orders/' . $order->id . '/status', [
            'status' => 'shipped',
            'shipping_courier' => 'JNE',
            'tracking_number' => 'RESI123456'
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('orders', [
            'id' => $order->id,
            'status' => 'shipped',
            'tracking_number' => 'RESI123456'
        ]);
    }

    public function test_customer_can_view_their_orders()
    {
        $customer = User::where('email', 'customer@smart-umkm.test')->first();

        $response = $this->actingAs($customer)->get('/customer/orders');

        $response->assertStatus(200);
    }
}
