<?php

namespace App\Http\Controllers;

use App\Models\Utilisateurs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Http;

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

    // Fonction qui recherche le signe astrologique chinois en fonction de l'année
    function chercheChinois($annee)
    {
        $animaux = ["Singe", "Coq", "Chien", "Cochon", "Rat", "Boeuf", "Tigre", "Lapin", "Dragon", "Serpent", "Cheval", "Chèvre"];
        $cycles = $annee % 12;
        $signe = $animaux[$cycles];
        return $signe;
    }


    public function ajoutUtilisateurs(Request $request)
    {
        // Validation des informations saisies
        $validator = Validator::make($request->all(), [
            // 'id' => ['required','numeric'],
            'pseudo' => ['required', 'string', 'unique:utilisateurs,pseudo'],
            'mail' => ['required', 'email', 'unique:utilisateurs,mail'],
            'mdp' => ['required', 'string'],
            'jour' => ['required', 'integer', 'between:1,31'],
            'mois' => ['required', 'integer', 'between:1,12'],
            'annee' => ['required', 'integer', 'between:1900,2023']
        ]);

        if ($validator->fails()) {
            return $validator->errors();
        }

        // Recherche des signes astro
        $zodiaque = $this->chercheZodiaque($request->jour, $request->mois);
        $chinois = $this->chercheChinois($request->annee);

        // Ajout dans la bdd
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
            return response()->json(["status" => 1, "message" => "Utilisateur ajouté", "data" => $utilisateur], 201);
        } else {
            return response()->json(["status" => 0, "message" => "pb lors de
    l'ajout"], 400);
        }
    }

    // Fonction qui supprime un utilisateur à partir de son id
    public function suppressionUtilisateurs($id)
    {
        $utilisateur = Utilisateurs::find($id);
        $ok = $utilisateur->delete();
        if ($ok) {
            return response()->json(["status" => 1, "message" => "Supprimé", "data" => $utilisateur], 200);
        } else {
            return response()->json(["status" => 0, "message" => "pb lors de
            supression"], 400);
        }
    }

    public function modificationUtilisateurs(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => ['required', 'numeric'],
            'pseudo' => ['required', 'string', 'unique:utilisateurs,pseudo'],
            'mail' => ['required', 'email', 'unique:utilisateurs,mail'],
            'mdp' => ['required', 'string'],
            'jour' => ['required', 'integer', 'between:1,31'],
            'mois' => ['required', 'integer', 'between:1,12'],
            'annee' => ['required', 'integer', 'between:1900,2023']
        ]);

        if ($validator->fails()) {
            return $validator->errors();
        }

        if ($utilisateur = Utilisateurs::find($request->id)) {
            $utilisateur->pseudo = $request->pseudo;
            $utilisateur->mail = $request->mail;
            $utilisateur->mdp = $request->mdp;
            $utilisateur->signe_zodiaque = $this->chercheZodiaque($request->jour, $request->mois);;
            $utilisateur->signe_chinois = $this->chercheChinois($request->annee);
            $utilisateur->jour = $request->jour;
            $utilisateur->mois = $request->mois;
            $utilisateur->annee = $request->annee;
            $ok = $utilisateur->save();
            return response()->json($utilisateur);
            if ($ok) {
                return response()->json(["status" => 1, "message" => "utilisateur modifié", "data" => $utilisateur], 201);
            } else {
                return response()->json(["status" => 0, "message" => "Problème lors de la modification"], 400);
            }
        } else {
            return response()->json(["status" => 0, "message" => "Problème lors de la modification"], 400);
        }
    }
}
