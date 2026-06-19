<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;

class Product extends Model
{
    use HasFactory, SoftDeletes, Searchable;

    protected $fillable = [
        'store_id',
        'product_category_id',
        'name',
        'slug',
        'description',
        'cost_price',
        'sell_price',
        'stock',
        'weight',
        'min_stock',
        'is_published',
        'is_featured',
    ];

    protected function casts(): array
    {
        return [
            'cost_price' => 'decimal:2',
            'sell_price' => 'decimal:2',
            'stock' => 'integer',
            'min_stock' => 'integer',
        ];
    }

    public function store(): BelongsTo
    {
        return $this->belongsTo(Store::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(ProductCategory::class, 'product_category_id');
    }

    public function images(): HasMany
    {
        return $this->hasMany(ProductImage::class);
    }

    public function transactionDetails(): HasMany
    {
        return $this->hasMany(TransactionDetail::class);
    }

    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    /**
     * Check if the product stock is at or below minimum.
     */
    public function isLowStock(): bool
    {
        return $this->stock <= $this->min_stock;
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

    /**
     * Scope: only products that are in stock.
     */
    public function scopeInStock($query)
    {
        return $query->where('stock', '>', 0);
    }

    /**
     * Scope: search by product name.
     */
    public function scopeSearch($query, ?string $search)
    {
        if ($search) {
            return $query->where('name', 'like', "%{$search}%");
        }

        return $query;
    }

    /**
     * Get formatted cost price.
     */
    public function getFormattedCostPriceAttribute(): string
    {
        return 'Rp' . number_format($this->cost_price, 0, ',', '.');
    }

    /**
     * Get formatted sell price.
     */
    public function getFormattedSellPriceAttribute(): string
    {
        return 'Rp' . number_format($this->sell_price, 0, ',', '.');
    }

    /**
     * Get profit margin per item.
     */
    public function getProfitAttribute(): float
    {
        return $this->sell_price - $this->cost_price;
    }

    /**
     * Get formatted profit.
     */
    public function getFormattedProfitAttribute(): string
    {
        return 'Rp' . number_format($this->profit, 0, ',', '.');
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
        ];
    }
}
