<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DashboardTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(\Database\Seeders\DummyDataSeeder::class);
    }

    public function test_owner_can_view_dashboard_metrics()
    {
        $owner = User::where('email', 'owner@smart-umkm.test')->first();

        $response = $this->actingAs($owner)->get('/dashboard');

        $response->assertStatus(200);
        $response->assertSee('Pendapatan Hari Ini');
        $response->assertSee('Pendapatan');
    }

    public function test_admin_can_view_admin_dashboard()
    {
        $admin = User::where('email', 'admin@smart-umkm.test')->first();

        $response = $this->actingAs($admin)->get('/admin/dashboard');

        $response->assertStatus(200);
        $response->assertSee('Dashboard Superadmin');
    }

    public function test_customer_redirected_to_customer_dashboard()
    {
        $customer = User::where('email', 'customer@smart-umkm.test')->first();

        $response = $this->actingAs($customer)->get('/dashboard');

        // Customer dashboard redirects to /customer/dashboard or just works
        // The /dashboard route actually uses a controller that redirects based on role
        $response->assertRedirect('/customer/dashboard');
    }
}
