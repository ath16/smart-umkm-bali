<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StoreSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'store_id',
        'logo_url',
        'logo_public_id',
        'banner_url',
        'banner_public_id',
        'operational_hours',
        'social_links',
        'theme_config',
    ];

    protected static function booted(): void
    {
        static::observe(\App\Observers\StoreSettingObserver::class);
    }

    protected $casts = [
        'operational_hours' => 'array',
        'social_links' => 'array',
        'theme_config' => 'array',
    ];

    public function store()
    {
        return $this->belongsTo(Store::class);
    }
}
