<?php

namespace App\Services;

use Cloudinary\Cloudinary;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Log;

class CloudinaryService
{
    protected Cloudinary $cloudinary;

    public function __construct()
    {
        $this->cloudinary = new Cloudinary([
            'cloud' => [
                'cloud_name' => config('services.cloudinary.cloud_name'),
                'api_key'    => config('services.cloudinary.api_key'),
                'api_secret' => config('services.cloudinary.api_secret'),
            ],
            'url' => [
                'secure' => true,
            ],
        ]);
    }

    // ─── UPLOAD METHODS ──────────────────────────────────────────────

    /**
     * Upload a product image.
     * Folder: products/{product-slug}
     */
    public function uploadProductImage(UploadedFile $file, string $productSlug): array
    {
        return $this->upload($file, "products/{$productSlug}");
    }

    /**
     * Upload a store logo.
     * Folder: stores/logo/{store-slug}
     */
    public function uploadStoreLogo(UploadedFile $file, string $storeSlug): array
    {
        return $this->upload($file, "stores/logo/{$storeSlug}");
    }

    /**
     * Upload a store banner.
     * Folder: stores/banner/{store-slug}
     */
    public function uploadStoreBanner(UploadedFile $file, string $storeSlug): array
    {
        return $this->upload($file, "stores/banner/{$storeSlug}");
    }

    /**
     * Upload a user avatar.
     * Folder: users/avatar/{user-id}
     */
    public function uploadUserAvatar(UploadedFile $file, int $userId): array
    {
        return $this->upload($file, "users/avatar/{$userId}");
    }

    /**
     * Upload an article featured image.
     * Folder: landing/articles
     */
    public function uploadArticleImage(UploadedFile $file): array
    {
        return $this->upload($file, 'landing/articles');
    }

    /**
     * Upload a category image.
     * Folder: categories/{slug}
     */
    public function uploadCategoryImage(UploadedFile $file, string $slug): array
    {
        return $this->upload($file, "categories/{$slug}");
    }

    /**
     * Upload a landing page asset.
     * Folder: landing/{section}
     */
    public function uploadLandingAsset(UploadedFile $file, string $section = 'hero'): array
    {
        return $this->upload($file, "landing/{$section}");
    }

    /**
     * Upload a testimonial image.
     * Folder: testimonials
     */
    public function uploadTestimonialImage(UploadedFile $file): array
    {
        return $this->upload($file, 'testimonials');
    }

    // ─── REPLACE ─────────────────────────────────────────────────────

    /**
     * Replace an existing image: delete old, upload new.
     * Returns the full Cloudinary result array.
     */
    public function replace(?string $oldUrl, ?string $oldPublicId, UploadedFile $file, string $folder): array
    {
        // Delete old image first
        if ($oldPublicId) {
            $this->deleteByPublicId($oldPublicId);
        } elseif ($oldUrl) {
            $this->deleteImage($oldUrl);
        }

        return $this->upload($file, $folder);
    }

    // ─── DESTROY ─────────────────────────────────────────────────────

    /**
     * Delete an image from Cloudinary by its public_id.
     */
    public function deleteByPublicId(?string $publicId): bool
    {
        if (empty($publicId)) {
            return false;
        }

        try {
            $this->cloudinary->uploadApi()->destroy($publicId);
            return true;
        } catch (\Exception $e) {
            Log::error("Cloudinary delete by public_id failed: {$e->getMessage()}", ['public_id' => $publicId]);
            return false;
        }
    }

    /**
     * Delete an image from Cloudinary by its URL.
     */
    public function deleteImage(?string $url): bool
    {
        if (empty($url) || !str_contains($url, 'cloudinary.com')) {
            return false;
        }

        $publicId = $this->extractPublicId($url);
        if (!$publicId) {
            return false;
        }

        return $this->deleteByPublicId($publicId);
    }

    // ─── URL GENERATION & OPTIMIZATION ───────────────────────────────

    /**
     * Generate an optimized Cloudinary URL with transformations.
     *
     * @param string|null $url  The base Cloudinary URL.
     * @param string      $type Preset: 'thumbnail', 'small', 'medium', 'large', 'hero', 'banner', 'product_card', 'avatar'.
     * @return string
     */
    public static function generateOptimizedUrl(?string $url, string $type = 'medium'): string
    {
        if (empty($url)) {
            return self::placeholderUrl($type);
        }

        // If it's not a Cloudinary URL, return as-is
        if (!str_contains($url, 'cloudinary.com') && !str_contains($url, 'res.cloudinary')) {
            return $url;
        }

        // Insert Cloudinary transformations before /upload/ path segment
        $transformations = self::getTransformations($type);

        return preg_replace(
            '#(/upload/)#',
            "/upload/{$transformations}/",
            $url,
            1
        );
    }

    /**
     * Get Cloudinary transformation string for a given preset type.
     * All presets use f_auto (WebP/AVIF), q_auto for optimal delivery.
     */
    protected static function getTransformations(string $type): string
    {
        return match ($type) {
            'thumbnail'    => 'c_fill,w_400,h_400,f_auto,q_auto',
            'small'        => 'c_fill,w_400,h_400,f_auto,q_auto',
            'medium'       => 'c_fill,w_600,h_600,f_auto,q_auto',
            'large'        => 'c_fill,w_800,h_800,f_auto,q_auto',
            'product_card' => 'c_fill,w_800,h_800,f_auto,q_auto',
            'banner'       => 'c_fill,w_1600,h_600,f_auto,q_auto',
            'hero'         => 'c_fill,w_1920,h_1080,f_auto,q_auto',
            'avatar'       => 'c_fill,w_300,h_300,f_auto,q_auto',
            default        => 'f_auto,q_auto',
        };
    }

    /**
     * Return an SVG placeholder URL matching the expected dimensions.
     */
    public static function placeholderUrl(string $type = 'medium'): string
    {
        [$w, $h] = match ($type) {
            'thumbnail'    => [400, 400],
            'small'        => [400, 400],
            'medium'       => [600, 600],
            'large'        => [800, 800],
            'product_card' => [800, 800],
            'banner'       => [1600, 600],
            'hero'         => [1920, 1080],
            'avatar'       => [300, 300],
            default        => [600, 600],
        };

        $svg = '<svg xmlns="http://www.w3.org/2000/svg" width="' . $w . '" height="' . $h . '" viewBox="0 0 ' . $w . ' ' . $h . '">'
             . '<rect fill="%23f1f5f9" width="' . $w . '" height="' . $h . '"/>'
             . '<text fill="%2394a3b8" font-family="sans-serif" font-size="14" text-anchor="middle" x="50%25" y="50%25" dy=".3em">No Image</text>'
             . '</svg>';

        return 'data:image/svg+xml,' . $svg;
    }

    // ─── CORE UPLOAD ─────────────────────────────────────────────────

    /**
     * Core upload logic. Returns standardized result array.
     */
    protected function upload(UploadedFile $file, string $folder): array
    {
        try {
            $result = $this->cloudinary->uploadApi()->upload(
                $file->getRealPath(),
                [
                    'folder'         => $folder,
                    'resource_type'  => 'image',
                    'transformation' => [
                        'quality'      => 'auto',
                        'fetch_format' => 'auto',
                    ],
                ]
            );

            return [
                'success'   => true,
                'url'       => $result['secure_url'],
                'public_id' => $result['public_id'],
                'width'     => $result['width'] ?? null,
                'height'    => $result['height'] ?? null,
                'format'    => $result['format'] ?? null,
                'bytes'     => $result['bytes'] ?? null,
            ];
        } catch (\Exception $e) {
            Log::error("Cloudinary upload failed: {$e->getMessage()}", [
                'folder' => $folder,
                'file'   => $file->getClientOriginalName(),
            ]);

            return [
                'success'   => false,
                'url'       => null,
                'public_id' => null,
                'error'     => $e->getMessage(),
            ];
        }
    }

    /**
     * Extract public_id from a Cloudinary URL.
     */
    protected function extractPublicId(string $url): ?string
    {
        if (preg_match('#/upload/(?:v\d+/)?(.+?)(?:\.\w+)?$#', $url, $matches)) {
            return $matches[1];
        }

        return null;
    }
}
