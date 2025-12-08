<?php
// app/Models/Payment.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Payment extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'order_id',
        'user_id',
        'fedapay_transaction_id',
        'fedapay_customer_id',
        'amount',
        'currency',
        'description',
        'status',
        'payment_method',
        'payment_method_details',
        'payment_url',
        'callback_url',
        'return_url',
        'metadata',
        'fedapay_response',
        'card_last4',
        'card_brand',
        'card_country',
        'mobile_money_number',
        'mobile_money_operator',
        'attempts',
        'failure_reason',
        'ip_address',
        'user_agent',
        'initiated_at',
        'completed_at',
        'failed_at',
        'refunded_at',
    ];
    
    protected $casts = [
        'amount' => 'decimal:2',
        'metadata' => 'array',
        'fedapay_response' => 'array',
        'initiated_at' => 'datetime',
        'completed_at' => 'datetime',
        'failed_at' => 'datetime',
        'refunded_at' => 'datetime',
    ];
    
    /**
     * Relations
     */
    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }
    
    public function user(): BelongsTo
    {
        return $this->belongsTo(Utilisateur::class);
    }
    
    /**
     * Accesseurs
     */
    protected function formattedAmount(): Attribute
    {
        return Attribute::make(
            get: function () {
                if ($this->currency === 'XOF') {
                    return number_format($this->amount, 0, ',', ' ') . ' FCFA';
                }
                return number_format($this->amount, 2, ',', ' ') . ' ' . $this->currency;
            }
        );
    }
    
    protected function statusLabel(): Attribute
    {
        $labels = [
            'pending' => ['label' => 'En attente', 'color' => 'warning'],
            'processing' => ['label' => 'En traitement', 'color' => 'info'],
            'completed' => ['label' => 'Terminé', 'color' => 'success'],
            'failed' => ['label' => 'Échoué', 'color' => 'danger'],
            'canceled' => ['label' => 'Annulé', 'color' => 'secondary'],
            'refunded' => ['label' => 'Remboursé', 'color' => 'info'],
            'disputed' => ['label' => 'Contesté', 'color' => 'danger'],
        ];
        
        return Attribute::make(
            get: fn () => $labels[$this->status] ?? ['label' => $this->status, 'color' => 'secondary']
        );
    }
    
    protected function paymentMethodLabel(): Attribute
    {
        $labels = [
            'card' => 'Carte bancaire',
            'mobile_money' => 'Mobile Money',
            'bank_transfer' => 'Virement bancaire',
            'cash' => 'Espèces',
            'other' => 'Autre',
        ];
        
        return Attribute::make(
            get: fn () => $labels[$this->payment_method] ?? $this->payment_method
        );
    }
    
    /**
     * Méthodes utilitaires
     */
    public function isCompleted(): bool
    {
        return $this->status === 'completed';
    }
    
    public function isPending(): bool
    {
        return $this->status === 'pending';
    }
    
    public function isFailed(): bool
    {
        return $this->status === 'failed';
    }
    
    public function markAsCompleted(): void
    {
        $this->update([
            'status' => 'completed',
            'completed_at' => now(),
        ]);
    }
    
    public function markAsFailed(string $reason = null): void
    {
        $this->update([
            'status' => 'failed',
            'failure_reason' => $reason,
            'failed_at' => now(),
        ]);
    }
    
    /**
     * Scope pour les requêtes courantes
     */
    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed');
    }
    
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }
    
    public function scopeFailed($query)
    {
        return $query->where('status', 'failed');
    }
    
    public function scopeForOrder($query, $orderId)
    {
        return $query->where('order_id', $orderId);
    }
    
    public function scopeRecent($query, $days = 30)
    {
        return $query->where('created_at', '>=', now()->subDays($days));
    }
    
    public function scopeByFedapayId($query, $transactionId)
    {
        return $query->where('fedapay_transaction_id', $transactionId);
    }
    
    /**
     * Vérifier si le paiement a expiré (plus de 30 minutes)
     */
    public function hasExpired(): bool
    {
        return $this->status === 'pending' && 
               $this->created_at->diffInMinutes(now()) > 30;
    }
}