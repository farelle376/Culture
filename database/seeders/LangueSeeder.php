<?php

namespace Database\Seeders;
use App\Models\Langue;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LangueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Langue::create(['nom_langue'=>'Goun', 'code_langue'=>'Gn', 'description'=>'Langue du Bénin']);
        Langue::create(['nom_langue'=>'Fon', 'code_langue'=>'Fn', 'description'=>'Langue du Bénin']);
        Langue::create(['nom_langue'=>'Dendi', 'code_langue'=>'Dn', 'description'=>'Langue du Bénin']);
        Langue::create(['nom_langue'=>'Yoruba', 'code_langue'=>'Yr', 'description'=>'Langue du Bénin']);
    }
}
