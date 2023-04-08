<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
// use Illuminate\Support\Facades\Route;

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
