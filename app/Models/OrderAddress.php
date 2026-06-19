<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderAddress extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'recipient_name',
        'phone',
        'province',
        'city',
        'district',
        'postal_code',
        'address',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
