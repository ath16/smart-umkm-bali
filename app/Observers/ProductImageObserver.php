<?php

namespace App\Observers;

use App\Models\ProductImage;
use App\Services\CloudinaryService;
use Illuminate\Support\Facades\Log;

class ProductImageObserver
{
    public function __construct(protected CloudinaryService $cloudinary) {}

    public function deleting(ProductImage $image): void
    {
        try {
            if ($image->public_id) {
                $this->cloudinary->deleteByPublicId($image->public_id);
            } elseif ($image->image_url && str_contains($image->image_url, 'cloudinary.com')) {
                $this->cloudinary->deleteImage($image->image_url);
            }
        } catch (\Exception $e) {
            Log::warning("Failed to delete ProductImage from Cloudinary: {$e->getMessage()}");
        }
    }
}
