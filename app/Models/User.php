<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable, SoftDeletes;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'store_id',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Store owned by this user (owner role).
     */
    public function ownedStore(): HasOne
    {
        return $this->hasOne(Store::class, 'user_id');
    }

    /**
     * Store this user works at (cashier role).
     */
    public function store(): BelongsTo
    {
        return $this->belongsTo(Store::class);
    }

    /**
     * Transactions recorded by this user.
     */
    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }

    /**
     * Get the customer profile.
     */
    public function customerProfile(): HasOne
    {
        return $this->hasOne(CustomerProfile::class);
    }

    /**
     * Get the customer addresses.
     */
    public function customerAddresses(): HasMany
    {
        return $this->hasMany(CustomerAddress::class);
    }

    /**
     * Get the store context for this user.
     * Owner: returns their owned store.
     * Cashier: returns the store they belong to.
     */
    public function currentStore(): ?Store
    {
        return $this->isOwner() ? $this->ownedStore : $this->store;
    }

    public function isOwner(): bool
    {
        return $this->role === 'owner';
    }

    public function isCashier(): bool
    {
        return $this->role === 'cashier';
    }

    public function isCustomer(): bool
    {
        return $this->role === 'customer';
    }

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function suspensionsGiven(): HasMany
    {
        return $this->hasMany(Suspension::class, 'admin_id');
    }
}
