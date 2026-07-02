<?php

namespace App\Observers;

use App\Models\StoreSetting;
use App\Services\CloudinaryService;
use Illuminate\Support\Facades\Log;

class StoreSettingObserver
{
    public function __construct(protected CloudinaryService $cloudinary) {}

    public function deleting(StoreSetting $setting): void
    {
        try {
            if ($setting->logo_public_id) {
                $this->cloudinary->deleteByPublicId($setting->logo_public_id);
            } elseif ($setting->logo_url && str_contains($setting->logo_url, 'cloudinary.com')) {
                $this->cloudinary->deleteImage($setting->logo_url);
            }

            if ($setting->banner_public_id) {
                $this->cloudinary->deleteByPublicId($setting->banner_public_id);
            } elseif ($setting->banner_url && str_contains($setting->banner_url, 'cloudinary.com')) {
                $this->cloudinary->deleteImage($setting->banner_url);
            }
        } catch (\Exception $e) {
            Log::warning("Failed to delete StoreSetting images from Cloudinary: {$e->getMessage()}");
        }
    }
}
