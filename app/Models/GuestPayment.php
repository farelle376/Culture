<?php
// app/Models/GuestPayment.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GuestPayment extends Model
{
    protected $table = 'guest_payments';
    
    protected $fillable = [
        'transaction_id',
        'email',
        'nom',
        'prenom',
        'telephone',
        'amount',
        'plan_id',
        'status',
        'access_code',
        'paid_at',
        'valid_until',
        'metadata',
    ];
    
    protected $casts = [
        'amount' => 'decimal:2',
        'paid_at' => 'datetime',
        'valid_until' => 'datetime',
        'metadata' => 'array',
    ];
    
    // Générer un code d'accès après paiement
    public function generateAccessCode()
    {
        $this->access_code = strtoupper(substr(md5(uniqid()), 0, 12));
        $this->valid_until = now()->addDays($this->plan_id == 1 ? 30 : 365);
        $this->save();
        
        return $this->access_code;
    }
    
    // Vérifier si l'accès est valide
    public function isValid()
    {
        return $this->status === 'approved' 
            && $this->valid_until 
            && $this->valid_until->isFuture();
    }
}