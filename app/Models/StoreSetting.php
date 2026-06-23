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
        'banner_url',
        'operational_hours',
        'social_links',
        'theme_config',
    ];

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
