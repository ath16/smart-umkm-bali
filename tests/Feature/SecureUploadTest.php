<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Store;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class SecureUploadTest extends TestCase
{
    use RefreshDatabase;

    public function test_customer_cannot_upload_invalid_avatar()
    {
        Storage::fake('public');

        $user = User::factory()->create(['role' => 'customer']);

        // Mock an invalid file masquerading as a png (MIME spoofing)
        // Or simply a file with invalid extension
        $file = UploadedFile::fake()->create('document.pdf', 100, 'application/pdf');

        $response = $this->actingAs($user)->put(route('customer.profile.update'), [
            'name' => 'John Doe',
            'email' => $user->email,
            'avatar' => $file,
        ]);

        $response->assertSessionHasErrors('avatar');
        
        $this->assertEquals(0, count(Storage::disk('public')->allFiles('avatars')));
    }

    public function test_owner_cannot_upload_invalid_logo_or_banner()
    {
        Storage::fake('public');

        $user = User::factory()->create(['role' => 'owner']);
        $store = Store::create([
            'user_id' => $user->id,
            'name' => 'Toko Baru',
            'slug' => 'toko-baru',
        ]);
        $user->update(['store_id' => $store->id]);

        $invalidLogo = UploadedFile::fake()->create('script.php', 100, 'text/x-php');
        $invalidBanner = UploadedFile::fake()->create('malicious.svg', 100, 'image/svg+xml');

        $response = $this->actingAs($user)->put(route('stores.update'), [
            'name' => 'Toko Baru',
            'logo' => $invalidLogo,
            'banner' => $invalidBanner,
        ]);

        $response->assertSessionHasErrors(['logo', 'banner']);

        $this->assertEquals(0, count(Storage::disk('public')->allFiles('stores')));
    }
}
