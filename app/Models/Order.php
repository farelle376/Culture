<?php
// app/Models/Order.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Order extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'order_number',
        'user_id',
        'customer_email',
        'customer_firstname',
        'customer_lastname',
        'customer_phone',
        'shipping_address',
        'shipping_city',
        'shipping_country',
        'shipping_postal_code',
        'billing_address',
        'billing_city',
        'billing_country',
        'billing_postal_code',
        'subtotal',
        'tax_amount',
        'shipping_cost',
        'discount_amount',
        'total',
        'status',
        'items',
        'notes',
        'coupon_code',
        'paid_at',
        'shipped_at',
        'delivered_at',
        'cancelled_at',
    ];
    
    protected $casts = [
        'items' => 'array',
        'subtotal' => 'decimal:2',
        'tax_amount' => 'decimal:2',
        'shipping_cost' => 'decimal:2',
        'discount_amount' => 'decimal:2',
        'total' => 'decimal:2',
        'paid_at' => 'datetime',
        'shipped_at' => 'datetime',
        'delivered_at' => 'datetime',
        'cancelled_at' => 'datetime',
    ];
    
    /**
     * Relations
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    
    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }
    
    public function latestPayment()
    {
        return $this->hasOne(Payment::class)->latestOfMany();
    }
    
    /**
     * Accesseurs
     */
    protected function formattedTotal(): Attribute
    {
        return Attribute::make(
            get: fn () => number_format($this->total, 0, ',', ' ') . ' FCFA'
        );
    }
    
    protected function customerFullName(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->customer_firstname . ' ' . $this->customer_lastname
        );
    }
    
    protected function statusLabel(): Attribute
    {
        $labels = [
            'pending' => ['label' => 'En attente', 'color' => 'warning'],
            'paid' => ['label' => 'Payé', 'color' => 'success'],
            'processing' => ['label' => 'En traitement', 'color' => 'info'],
            'shipped' => ['label' => 'Expédié', 'color' => 'primary'],
            'delivered' => ['label' => 'Livré', 'color' => 'success'],
            'cancelled' => ['label' => 'Annulé', 'color' => 'danger'],
            'refunded' => ['label' => 'Remboursé', 'color' => 'secondary'],
        ];
        
        return Attribute::make(
            get: fn () => $labels[$this->status] ?? ['label' => $this->status, 'color' => 'secondary']
        );
    }
    
    /**
     * Méthodes utilitaires
     */
    public function isPaid(): bool
    {
        return $this->status === 'paid' && $this->paid_at !== null;
    }
    
    public function canBeCancelled(): bool
    {
        return in_array($this->status, ['pending', 'paid']);
    }
    
    public function markAsPaid(): void
    {
        $this->update([
            'status' => 'paid',
            'paid_at' => now(),
        ]);
    }
    
    public function markAsCancelled(): void
    {
        $this->update([
            'status' => 'cancelled',
            'cancelled_at' => now(),
        ]);
    }
    
    /**
     * Scope pour les requêtes courantes
     */
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }
    
    public function scopePaid($query)
    {
        return $query->where('status', 'paid');
    }
    
    public function scopeForUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }
    
    public function scopeRecent($query, $days = 30)
    {
        return $query->where('created_at', '>=', now()->subDays($days));
    }
    
    /**
     * Générer un numéro de commande unique
     */
    public static function generateOrderNumber(): string
    {
        $prefix = 'CMD';
        $date = now()->format('Ymd');
        $random = strtoupper(substr(md5(uniqid()), 0, 6));
        
        return $prefix . $date . $random;
    }
}