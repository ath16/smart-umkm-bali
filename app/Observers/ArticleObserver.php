<?php

namespace App\Observers;

use App\Models\Article;
use App\Services\CloudinaryService;
use Illuminate\Support\Facades\Log;

class ArticleObserver
{
    public function __construct(protected CloudinaryService $cloudinary) {}

    public function deleting(Article $article): void
    {
        try {
            if ($article->featured_image_public_id) {
                $this->cloudinary->deleteByPublicId($article->featured_image_public_id);
            } elseif ($article->featured_image_url && str_contains($article->featured_image_url, 'cloudinary.com')) {
                $this->cloudinary->deleteImage($article->featured_image_url);
            }
        } catch (\Exception $e) {
            Log::warning("Failed to delete Article featured image from Cloudinary: {$e->getMessage()}");
        }
    }
}
