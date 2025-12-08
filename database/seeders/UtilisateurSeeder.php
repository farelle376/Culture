<?php

namespace Database\Seeders;

use App\Models\Langue;
use App\Models\Role;
use App\Models\utilisateur;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UtilisateurSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Utilisateur::create([
    'nom' => 'Comlan',
    'prenom' => 'Maurice',
    'password' => 'Eneam123', 
    'email' => 'maurice.comlan@uac.bj',
    'sexe' => 'masculin',
    'date_inscription' => now(), 
    'date_naissance' => '2000-01-01', 
    'statut' => 'actif',          
    'photo' => 'image.png',               
    'id_roles' => Role::first()->id,   
    'id_langue' => Langue::first()->id, 
]);
 Utilisateur::create([
    'nom' => 'HOUNGA',
    'prenom' => 'Farelle',
    'password' => 'Eneam124', 
    'email' => 'farellehounga@gmail.com',
    'sexe' => 'feminin',
    'date_inscription' => now(), 
    'date_naissance' => '2000-01-01', 
    'statut' => 'actif',          
    'photo' => 'image.png',               
    'id_roles' => Role::find(2)->id,   
    'id_langue' => Langue::find(2)->id, 
]);
    }
}
