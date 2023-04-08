<?php

namespace App\Http\Controllers;
use App\Models\Utilisateurs;

use Illuminate\Http\Request;

class UtilisateursController extends Controller
{
   
    // Liste paginée des utilisateurs
    public function listeUtilisateurs(){
        $utilisateurs = Utilisateurs::select("pseudo", "signe_zodiaque", "signe_chinois")->paginate(perPage:10);
        return response()->json($utilisateurs);
    }

    // Détails d'un seul utilisateur
    public function detailsUtilisateurs($id){
        // $utilisateur = Utilisateurs::find($id);
        $utilisateur = Utilisateurs::select("pseudo", "signe_zodiaque", "signe_chinois", "date_naissance")->where("id", "=", $id)->get();
        return response()->json($utilisateur);
    }

}
