<?php

namespace App\Observers;

use App\Models\CustomerProfile;
use App\Services\CloudinaryService;
use Illuminate\Support\Facades\Log;

class CustomerProfileObserver
{
    public function __construct(protected CloudinaryService $cloudinary) {}

    public function deleting(CustomerProfile $profile): void
    {
        try {
            if ($profile->avatar_public_id) {
                $this->cloudinary->deleteByPublicId($profile->avatar_public_id);
            } elseif ($profile->avatar_url && str_contains($profile->avatar_url, 'cloudinary.com')) {
                $this->cloudinary->deleteImage($profile->avatar_url);
            }
        } catch (\Exception $e) {
            Log::warning("Failed to delete CustomerProfile avatar from Cloudinary: {$e->getMessage()}");
        }
    }
}
