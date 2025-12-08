<?php

namespace Database\Seeders;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create(['nom_role'=>'Administrateur']);
         Role::create(['nom_role'=>'Lecteur']);
          Role::create(['nom_role'=>'Contributeur']);
           Role::create(['nom_role'=>'Moderateur']);

    }
}
