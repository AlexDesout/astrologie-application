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
            'date_naissance' => "1981-04-12",
            'heure_naissance' => "12:00:00"
        ]);
        DB::table('utilisateurs')->insert([
            'pseudo' => 'Al',
            'mail' => 'alex@gmail.com',
            'mdp' => "alexx",
            'signe_zodiaque' => "cancer",
            'signe_chinois' => "chèvre",
            'date_naissance' => "2003-07-11",
            'heure_naissance' => "12:00:00"
        ]);
      
    }
}
