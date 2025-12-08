<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Media extends Model
{
    protected $table='media';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'id_typeMedia',
        'chemin',
        'description',
        'id_contenu',
        
    ];
    public function typeMedia()
    {
        return $this->belongsTo(Type_media::class, 'id_typeMedia');
    }
    public function contenu()
    {
        return $this->belongsTo(Contenu::class, 'id_contenu');
    }

    

   
}
