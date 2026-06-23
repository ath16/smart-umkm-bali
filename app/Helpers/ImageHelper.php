<?php

use App\Services\CloudinaryService;

if (!function_exists('imageUrl')) {
    /**
     * Generate an optimized image URL with Cloudinary transformations.
     * Falls back to a placeholder SVG if the URL is empty.
     *
     * Usage in Blade:
     *   <img src="{{ imageUrl($product->primaryImage->image_url, 'product_card') }}">
     *   <img src="{{ imageUrl($store->setting->banner_url, 'banner') }}">
     *   <img src="{{ imageUrl($profile->avatar_url, 'thumbnail') }}">
     *
     * @param  string|null  $url   The stored Cloudinary URL (or any image URL).
     * @param  string       $type  Preset: thumbnail|small|medium|large|product_card|banner|hero
     * @return string              A valid image URL (never null).
     */
    function imageUrl(?string $url, string $type = 'medium'): string
    {
        return CloudinaryService::generateOptimizedUrl($url, $type);
    }
}

if (!function_exists('placeholderImage')) {
    /**
     * Return a placeholder image URL for a given preset type.
     *
     * @param  string  $type  Preset: thumbnail|small|medium|large|product_card|banner|hero
     * @return string
     */
    function placeholderImage(string $type = 'medium'): string
    {
        return CloudinaryService::placeholderUrl($type);
    }
}
