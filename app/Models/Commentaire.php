<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Commentaire extends Model
{
    protected $table='commentaire';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'texte',
        'note',
        'date_commentaire',
        'id_utilisateur',
        'id_contenu',

    ];
public function utilisateur()
    {
        return $this->belongsTo(Utilisateur::class, 'id_utilisateur');
    }
    
public function contenu()
    {
        return $this->belongsTo(Contenu::class, 'id_contenu');
    }
   
}
