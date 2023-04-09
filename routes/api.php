<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\Response;
use App\Http\Controllers\UtilisateursController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


// Liste paginée des utilisateurs
Route::get('/utilisateurs', [App\Http\Controllers\UtilisateursController::class, 'listeUtilisateurs']);

// Détails d'un seul utilisateur
Route::get('/utilisateurs/{id}', [App\Http\Controllers\UtilisateursController::class, 'detailsUtilisateurs']);

// Ajout d'un utilisateur (accessible avec authentification Basic)
Route::post('/utilisateurs', [App\Http\Controllers\UtilisateursController::class, 'ajoutUtilisateurs'])->middleware('auth.basic');

// Suppression d'un utilisateur (accessible avec authentification Basic)
Route::delete('/utilisateurs/{id}', [App\Http\Controllers\UtilisateursController::class, 'suppressionUtilisateurs'])->middleware('auth.basic');

// Modification d'un utilisateur (accessible avec authentification Basic)
Route::put('/utilisateurs', [App\Http\Controllers\UtilisateursController::class, 'modificationUtilisateurs'])->middleware('auth.basic');
