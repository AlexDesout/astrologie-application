<?php

namespace App\Http\Controllers;
use App\Models\Utilisateurs;

use Illuminate\Http\Request;

class UtilisateursController extends Controller
{
   
    // Liste paginée des utilisateurs
    public function listeUtilisateurs(){
        $utilisateurs = Utilisateurs::select("Pseudo", "signe_zodiaque", "signe_chinois")->paginate(perPage:1);
        return response()->json($utilisateurs);
    }

}
