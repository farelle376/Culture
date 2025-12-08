<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Langue extends Model
{
    protected $table='langue';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'code_langue',
        'nom_langue',
        'description',
    ];

    
public function contenus()
{
    return $this->hasMany(Contenu::class); // ou belongsToMany si c'est plusieurs à plusieurs
}
   public function utilisateurs()
{
    return $this->hasMany(User::class, 'id_langue');
}

}
