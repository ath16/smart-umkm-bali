<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Suspension extends Model
{
    protected $fillable = [
        'admin_id',
        'suspendable_id',
        'suspendable_type',
        'reason',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function suspendable()
    {
        return $this->morphTo();
    }

    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }
}
