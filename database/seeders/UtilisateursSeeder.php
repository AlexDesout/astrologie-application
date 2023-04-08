<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UtilisateursSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('utilisateurs')->delete();
        DB::table('utilisateurs')->insert([
            'pseudo' => 'Fernand',
            'mail' => 'fernand@gmail.com',
            'mdp' => "fernand69",
            'signe_zodiaque' => "bélier",
            'signe_chinois' => "coq",
            'jour' => "12",
            'mois' => "12",
            'annee' => "1981"
        ]);
        DB::table('utilisateurs')->insert([
            'pseudo' => 'Al',
            'mail' => 'alex@gmail.com',
            'mdp' => "alexx",
            'signe_zodiaque' => "cancer",
            'signe_chinois' => "chèvre",
            'jour' => "1",
            'mois' => "07",
            'annee' => "2003" 
        ]);
      
    }
}
