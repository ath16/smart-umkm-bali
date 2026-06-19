<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StaffManagementTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(\Database\Seeders\DummyDataSeeder::class);
    }

    public function test_owner_can_view_staff_list()
    {
        $owner = User::where('email', 'owner@smart-umkm.test')->first();

        $response = $this->actingAs($owner)->get('/staff');

        $response->assertStatus(200);
        $response->assertSee('Manajemen Staff');
    }

    public function test_owner_can_create_cashier()
    {
        $owner = User::where('email', 'owner@smart-umkm.test')->first();

        $response = $this->actingAs($owner)->post('/staff', [
            'name' => 'New Cashier',
            'email' => 'new_cashier@smart-umkm.test',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('users', [
            'email' => 'new_cashier@smart-umkm.test',
            'role' => 'cashier',
            'store_id' => $owner->ownedStore->id
        ]);
    }

    public function test_owner_can_delete_cashier()
    {
        $owner = User::where('email', 'owner@smart-umkm.test')->first();
        // Create a temporary cashier first
        $cashier = User::factory()->create([
            'role' => 'cashier',
            'store_id' => $owner->ownedStore->id
        ]);

        $response = $this->actingAs($owner)->delete('/staff/' . $cashier->id);

        $response->assertRedirect();
        $this->assertSoftDeleted('users', [
            'id' => $cashier->id
        ]);
    }

    public function test_cashier_cannot_access_staff_management()
    {
        $cashier = User::where('email', 'cashier@smart-umkm.test')->first();

        $response = $this->actingAs($cashier)->get('/staff');

        // Expect 403 Forbidden because 'role:owner' middleware is applied
        $response->assertStatus(403);
    }
}
