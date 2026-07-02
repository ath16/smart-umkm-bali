<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'article_category_id',
        'author_id',
        'title',
        'slug',
        'excerpt',
        'content',
        'featured_image_url',
        'featured_image_public_id',
        'status',
        'published_at',
        'meta_title',
        'meta_description',
    ];

    protected static function booted(): void
    {
        static::observe(\App\Observers\ArticleObserver::class);
    }

    protected $casts = [
        'published_at' => 'datetime',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(ArticleCategory::class, 'article_category_id');
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function stores(): BelongsToMany
    {
        return $this->belongsToMany(Store::class);
    }
}
