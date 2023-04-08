<?php

namespace App\Http\Controllers;

use App\Models\Utilisateurs;
use Illuminate\Http\Request;

class UtilisateursController extends Controller
{

    // Liste paginée des utilisateurs
    public function listeUtilisateurs()
    {
        $utilisateurs = Utilisateurs::select("pseudo", "signe_zodiaque", "signe_chinois");
        $ok = $utilisateurs->paginate(perPage: 10);
        if ($ok) {
            return response()->json($ok);
        } else {
            return response()->json(["status" => 0, "message" => "Pas trouvé"], 400);
        }
    }

    // Détails d'un seul utilisateur
    public function detailsUtilisateurs($id)
    {
        $utilisateur = Utilisateurs::select("pseudo", "signe_zodiaque", "signe_chinois", "jour", "mois", "annee")->where("id", "=", $id);
        $ok = $utilisateur->get();
        if ($ok) {
            return response()->json($ok);
        } else {
            return response()->json(["status" => 0, "message" => "Pas trouvé"], 400);
        }
    }

    // Fonction qui recherche le signe du zodiaque en fonction du jour et du mois
   

    public function ajoutUtilisateurs(Request $request)
    {
        $zodiaque = $this->chercheZodiaque($request->jour, $request->mois);
        $chinois = $this->chercheChinois($request->annee);

        $utilisateur = new Utilisateurs;
        $utilisateur->pseudo = $request->pseudo;
        $utilisateur->mail = $request->mail;
        $utilisateur->mdp = $request->mdp;
        $utilisateur->signe_zodiaque = $zodiaque;
        $utilisateur->signe_chinois = $chinois;
        $utilisateur->jour = $request->jour;
        $utilisateur->mois = $request->mois;
        $utilisateur->annee = $request->annee;
        $ok = $utilisateur->save();
        if ($ok) {
            return response()->json(["status" => 1, "message" => "Utilisateur ajouté"],201);
        } 
        else {
            return response()->json(["status" => 0, "message" => "pb lors de
    l'ajout"],400);
        }
        
    }

    function chercheZodiaque($jour, $mois)
    {
        if (($mois == 1 && $jour >= 20) || ($mois == 2 && $jour <= 18)) {
            return "Verseau";
        } elseif (($mois == 2 && $jour >= 19) || ($mois == 3 && $jour <= 20)) {
            return "Poissons";
        } elseif (($mois == 3 && $jour >= 21) || ($mois == 4 && $jour <= 19)) {
            return "Bélier";
        } elseif (($mois == 4 && $jour >= 20) || ($mois == 5 && $jour <= 20)) {
            return "Taureau";
        } elseif (($mois == 5 && $jour >= 21) || ($mois == 6 && $jour <= 20)) {
            return "Gémeaux";
        } elseif (($mois == 6 && $jour >= 21) || ($mois == 7 && $jour <= 22)) {
            return "Cancer";
        } elseif (($mois == 7 && $jour >= 23) || ($mois == 8 && $jour <= 22)) {
            return "Lion";
        } elseif (($mois == 8 && $jour >= 23) || ($mois == 9 && $jour <= 22)) {
            return "Vierge";
        } elseif (($mois == 9 && $jour >= 23) || ($mois == 10 && $jour <= 22)) {
            return "Balance";
        } elseif (($mois == 10 && $jour >= 23) || ($mois == 11 && $jour <= 21)) {
            return "Scorpion";
        } elseif (($mois == 11 && $jour >= 22) || ($mois == 12 && $jour <= 21)) {
            return "Sagittaire";
        } else {
            return "Capricorne";
        }
        
    }

    function chercheChinois($annee)
    {
        $animaux = ["Singe", "Coq", "Chien", "Cochon", "Rat", "Boeuf", "Tigre", "Lapin", "Dragon", "Serpent", "Cheval", "Chèvre"];
        $cycles = $annee % 12;
        $signe = $animaux[$cycles];
        return $signe;
    }
}
