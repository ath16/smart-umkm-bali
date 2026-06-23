<?php

namespace App\Services;

use Cloudinary\Cloudinary;
use Cloudinary\Api\Upload\UploadApi;
use Cloudinary\Transformation\Resize;
use Cloudinary\Transformation\Format;
use Cloudinary\Transformation\Quality;
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

    /**
     * Upload a product image to Cloudinary.
     */
    public function uploadProductImage(UploadedFile $file, int $storeId): array
    {
        return $this->upload($file, "smart-umkm/stores/{$storeId}/products");
    }

    /**
     * Upload a store logo to Cloudinary.
     */
    public function uploadStoreLogo(UploadedFile $file, int $storeId): array
    {
        return $this->upload($file, "smart-umkm/stores/{$storeId}/logo");
    }

    /**
     * Upload a store banner to Cloudinary.
     */
    public function uploadStoreBanner(UploadedFile $file, int $storeId): array
    {
        return $this->upload($file, "smart-umkm/stores/{$storeId}/banners");
    }

    /**
     * Upload a user avatar to Cloudinary.
     */
    public function uploadUserAvatar(UploadedFile $file, int $userId): array
    {
        return $this->upload($file, "smart-umkm/users/{$userId}/avatar");
    }

    /**
     * Upload an article featured image to Cloudinary.
     */
    public function uploadArticleImage(UploadedFile $file): array
    {
        return $this->upload($file, 'smart-umkm/articles');
    }

    /**
     * Delete an image from Cloudinary by its URL.
     */
    public function deleteImage(?string $url): bool
    {
        if (empty($url)) {
            return false;
        }

        $publicId = $this->extractPublicId($url);
        if (!$publicId) {
            return false;
        }

        try {
            $this->cloudinary->uploadApi()->destroy($publicId);
            return true;
        } catch (\Exception $e) {
            Log::error("Cloudinary delete failed: {$e->getMessage()}", ['url' => $url]);
            return false;
        }
    }

    /**
     * Replace an existing image: delete old, upload new.
     */
    public function replaceImage(?string $oldUrl, UploadedFile $file, string $folder): array
    {
        $this->deleteImage($oldUrl);
        return $this->upload($file, $folder);
    }

    /**
     * Generate an optimized Cloudinary URL with transformations.
     * 
     * @param string|null $url  The base Cloudinary URL.
     * @param string      $type Preset: 'thumbnail', 'small', 'medium', 'large', 'hero', 'banner', 'product_card'.
     * @return string The transformed URL, or a placeholder SVG if $url is empty.
     */
    public static function generateOptimizedUrl(?string $url, string $type = 'medium'): string
    {
        if (empty($url)) {
            return self::placeholderUrl($type);
        }

        // If it's not a Cloudinary URL, return as-is (e.g., Unsplash demo URLs)
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
     */
    protected static function getTransformations(string $type): string
    {
        return match ($type) {
            'thumbnail'    => 'c_fill,w_300,h_300,f_auto,q_auto',
            'small'        => 'c_fill,w_400,h_400,f_auto,q_auto',
            'medium'       => 'c_fill,w_600,h_600,f_auto,q_auto',
            'large'        => 'c_fill,w_800,h_800,f_auto,q_auto',
            'product_card' => 'c_fill,w_600,h_600,f_auto,q_auto',
            'banner'       => 'c_fill,w_1600,h_600,f_auto,q_auto',
            'hero'         => 'c_fill,w_1920,h_1080,f_auto,q_auto',
            default        => 'f_auto,q_auto',
        };
    }

    /**
     * Return an SVG placeholder URL matching the expected dimensions.
     */
    public static function placeholderUrl(string $type = 'medium'): string
    {
        [$w, $h] = match ($type) {
            'thumbnail'    => [300, 300],
            'small'        => [400, 400],
            'medium'       => [600, 600],
            'large'        => [800, 800],
            'product_card' => [600, 600],
            'banner'       => [1600, 600],
            'hero'         => [1920, 1080],
            default        => [600, 600],
        };

        // Inline SVG data URI — lightweight, no external request
        $svg = '<svg xmlns="http://www.w3.org/2000/svg" width="' . $w . '" height="' . $h . '" viewBox="0 0 ' . $w . ' ' . $h . '">'
             . '<rect fill="%23e2e8f0" width="' . $w . '" height="' . $h . '"/>'
             . '<text fill="%2394a3b8" font-family="sans-serif" font-size="16" text-anchor="middle" x="50%25" y="50%25" dy=".3em">No Image</text>'
             . '</svg>';

        return 'data:image/svg+xml,' . $svg;
    }

    /**
     * Core upload logic.
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
                        'quality' => 'auto',
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
                'success' => false,
                'url'     => null,
                'error'   => $e->getMessage(),
            ];
        }
    }

    /**
     * Extract public_id from a Cloudinary URL.
     */
    protected function extractPublicId(string $url): ?string
    {
        // Pattern: https://res.cloudinary.com/{cloud}/image/upload/v123/folder/filename.ext
        if (preg_match('#/upload/(?:v\d+/)?(.+?)(?:\.\w+)?$#', $url, $matches)) {
            return $matches[1];
        }

        return null;
    }
}
