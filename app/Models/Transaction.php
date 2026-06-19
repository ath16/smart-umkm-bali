<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'store_id',
        'user_id',
        'invoice_number',
        'total_amount',
        'total_cost',
        'payment_amount',
        'change_amount',
        'notes',
    ];

    protected function casts(): array
    {
        return [
            'total_amount' => 'decimal:2',
            'total_cost' => 'decimal:2',
            'payment_amount' => 'decimal:2',
            'change_amount' => 'decimal:2',
        ];
    }

    public function store(): BelongsTo
    {
        return $this->belongsTo(Store::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function details(): HasMany
    {
        return $this->hasMany(TransactionDetail::class);
    }

    /**
     * Generate invoice number: INV-YYYYMMDD-XXXX
     */
    public static function generateInvoiceNumber(): string
    {
        $date = now()->format('Ymd');
        $lastInvoice = static::where('invoice_number', 'like', "INV-{$date}-%")
            ->orderBy('invoice_number', 'desc')
            ->first();

        if ($lastInvoice) {
            $lastNumber = (int) substr($lastInvoice->invoice_number, -4);
            $newNumber = $lastNumber + 1;
        } else {
            $newNumber = 1;
        }

        return sprintf('INV-%s-%04d', $date, $newNumber);
    }
}
