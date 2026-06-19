<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoice_number',
        'user_id',
        'store_id',
        'payment_transaction_id',
        'status',
        'payment_method',
        'shipping_courier',
        'tracking_number',
        'courier_name',
        'courier_service',
        'waybill_number',
        'shipping_fee',
        'total_amount',
        'notes',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function address()
    {
        return $this->hasOne(OrderAddress::class);
    }

    public function paymentTransaction()
    {
        return $this->belongsTo(PaymentTransaction::class);
    }

    public function getFormattedTotalAmountAttribute()
    {
        return 'Rp ' . number_format($this->total_amount, 0, ',', '.');
    }
    
    public function getFormattedShippingFeeAttribute()
    {
        return 'Rp ' . number_format($this->shipping_fee, 0, ',', '.');
    }
}
