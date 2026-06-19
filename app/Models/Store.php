<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;

class Store extends Model
{
    use HasFactory, SoftDeletes, Searchable;

    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($store) {
            if (empty($store->slug)) {
                $store->slug = \Illuminate\Support\Str::slug($store->name);
            }
        });
    }

    protected $fillable = [
        'user_id',
        'name',
        'slug',
        'category',
        'store_category_id',
        'contact',
        'address',
        'description',
    ];

    /**
     * Owner of this store.
     */
    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Cashiers working at this store.
     */
    public function cashiers(): HasMany
    {
        return $this->hasMany(User::class, 'store_id');
    }

    /**
     * Store banners
     */
    public function banners(): HasMany
    {
        return $this->hasMany(StoreBanner::class);
    }

    /**
     * Products belonging to this store.
     */
    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(StoreCategory::class, 'store_category_id');
    }

    public function suspensions()
    {
        return $this->morphMany(Suspension::class, 'suspendable');
    }

    public function isSuspended(): bool
    {
        return $this->suspensions()->where('is_active', true)->exists();
    }

    public function scopeActive($query)
    {
        return $query->whereDoesntHave('suspensions', function ($q) {
            $q->where('is_active', true);
        });
    }

    public function storeCategory()
    {
        return $this->belongsTo(StoreCategory::class, 'store_category_id');
    }

    public function setting()
    {
        return $this->hasOne(StoreSetting::class);
    }

    /**
     * Transactions of this store.
     */
    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }
    /**
     * Get the indexable data array for the model.
     *
     * @return array<string, mixed>
     */
    public function toSearchableArray()
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description ?? '',
            'address' => $this->address ?? '',
        ];
    }
}
