<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Contenu extends Model
{
    protected $table='contenu';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'titre',
        'id_type_contenu',
        'texte',
        'date_creation',
        'statut',
        'auteur_id',
        'parent_id',
        'id_region',
        'id_langue',
        'id_moderateur',
        'date_validation',
         'vues',
        'likes_count',
        'commentaires_count',
        'partages_count',
    ];

    
public function typeContenu()
    {
        return $this->belongsTo(Type_contenu::class, 'id_type_contenu');
    }
    public function utilisateur2()
    {
        return $this->belongsTo(Utilisateur::class, 'auteur_id');
    }
    public function utilisateur3()
    {
        return $this->belongsTo(Utilisateur::class, 'parent_id');
    }
    public function region()
    {
        return $this->belongsTo(Region::class, 'id_region');
    }
   public function langue()
    {
        return $this->belongsTo(Role::class, 'id_langue');
    }
    public function utilisateur4()
    {
        return $this->belongsTo(Utilisateur::class, 'id_moderateur');
    }
    public function commentaires()
    {
        return $this->hasMany(Commentaire::class, 'contenu_id');
    }
      public function getImageUrlAttribute()
    {
        if ($this->attributes['image_url']) {
            return asset('storage/' . $this->attributes['image_url']);
        }
        
        // Image par défaut aléatoire
        $defaultImages = [
            'img10.jpeg', 'img11.jpeg', 'img12.jpeg', 'img20.jpeg',
            'img21.jpeg', 'img22.jpeg', 'img23.jpeg', 'img24.jpeg',
            'img25.jpeg', 'img26.jpeg', 'img27.jpeg'
        ];
        
        return asset('adminlte/img/' . $defaultImages[array_rand($defaultImages)]);
    }

    // Scope pour les contenus approuvés
    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }
    
}
