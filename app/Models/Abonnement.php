<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Abonnement extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'description',
        'prix',
        'duree_jours',
        'avantages',
        'actif',
    ];

    protected $casts = [
        'prix' => 'float',
        'actif' => 'boolean',
        'avantages' => 'array',
    ];
}