<?php

namespace Tests\Feature;

use App\Models\Store;
use App\Models\User;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminModerationTest extends TestCase
{
    use RefreshDatabase;

    public function test_only_admin_can_access_admin_dashboard()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $owner = User::factory()->create(['role' => 'owner']);

        $this->actingAs($owner)->get('/admin/dashboard')->assertStatus(403);
        $this->actingAs($admin)->get('/admin/dashboard')->assertStatus(200);
    }

    public function test_admin_can_suspend_and_unsuspend_store()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $owner = User::factory()->create(['role' => 'owner']);
        
        $store = Store::create([
            'user_id' => $owner->id,
            'name' => 'Toko Biasa',
            'slug' => 'toko-biasa',
            'description' => 'Test',
            'status' => 'active',
        ]);

        $this->actingAs($admin)->post("/admin/stores/{$store->id}/suspend", [
            'reason' => 'Melanggar kebijakan'
        ])->assertRedirect();

        $this->assertDatabaseHas('suspensions', [
            'suspendable_id' => $store->id,
            'suspendable_type' => Store::class,
            'reason' => 'Melanggar kebijakan',
            'is_active' => true,
        ]);

        // Toko suspended should not appear in catalog
        $this->get('/store')->assertDontSee('Toko Biasa');

        // Unsuspend
        $this->actingAs($admin)->post("/admin/stores/{$store->id}/unsuspend")->assertRedirect();
        
        $this->assertDatabaseHas('suspensions', [
            'suspendable_id' => $store->id,
            'suspendable_type' => Store::class,
            'is_active' => false,
        ]);

        $this->get('/store')->assertSee('Toko Biasa');
    }
}
