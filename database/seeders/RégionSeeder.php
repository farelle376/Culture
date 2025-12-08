<?php

namespace Database\Seeders;

use App\Models\Region;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RégionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Region::create(['nom_region'=>'Atacora', 'description'=>'', 'population'=>'1254', 'superficie'=>'15225', 'localisation'=>'']);
        Region::create(['nom_region'=>'Donga', 'description'=>'', 'population'=>'257874', 'superficie'=>'15227', 'localisation'=>'']);
        Region::create(['nom_region'=>'Borgou', 'description'=>'', 'population'=>'22485', 'superficie'=>'15228', 'localisation'=>'']);
        Region::create(['nom_region'=>'Alibori', 'description'=>'', 'population'=>'15524', 'superficie'=>'15229', 'localisation'=>'']);
    }
}
