<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Region extends Model
{
    protected $table='region';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'nom_region',
        'description',
        'population',
        'superficie',
        'localisation',
    ];
     public function contenus()
    {
        return $this->hasMany(Contenu::class, 'id_region');
    }
    protected $casts = [
        'population' => 'integer',
        'superficie' => 'float',
    ];

   
}
