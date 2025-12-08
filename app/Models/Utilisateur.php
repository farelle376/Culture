<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;  // ✔ IMPORTANT
use Illuminate\Notifications\Notifiable;

class Utilisateur extends Authenticatable   // ✔ IMPORTANT
{
    use Notifiable;

    protected $table = 'utilisateur'; // si ton nom de table est bien celui-ci

    protected $fillable = [
        'nom',
        'prenom',
        'email',
        'password',
        'sexe',
        'date_inscription',
        'date_naissance',
        'statut',
        'photo',
        'id_role',
        'id_langue',
    ];
    protected $attributes = [
    'statut' => 'actif',
    'photo' => 'pas de photo',
    'id_role' => 2,
    'date_inscription'=> '2025-12-02 14:00:00'
];

    protected $hidden = [
        'password',
        'remember_token',
    ];
    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    
    public function role()
    {
        return $this->belongsTo(Role::class, 'id_role');
    }

    // Vérifier si l'utilisateur est administrateur
    public function isAdmin()
    {
        return $this->role && $this->role->nom_role==='Administrateur';
    }
    public function contenus()
{
    return $this->hasMany(Contenu::class, 'auteur_id');
}
public function langue()
{
    return $this->belongsTo(Langue::class, 'id_langue');
}
}


