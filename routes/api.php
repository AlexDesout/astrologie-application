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

// Route::middleware(['basic','digest'])->get('/utilisateurs', [App\Http\Controllers\UtilisateursController::class, 'listeUtilisateurs']);
// Route::group(['middleware' => ['basic', 'digest']])->get('/utilisateurs', [App\Http\Controllers\UtilisateursController::class, 'listeUtilisateurs']);

// Route::group(['middleware' => ['basic', 'digest']])->get('/utilisateurs', [App\Http\Controllers\UtilisateursController::class, 'listeUtilisateurs']);
Route::get('/utilisateurs', [App\Http\Controllers\UtilisateursController::class, 'listeUtilisateurs']);

// Détails d'un seul utilisateur
Route::get('/utilisateurs/{id}', [App\Http\Controllers\UtilisateursController::class, 'detailsUtilisateurs']);

// Ajout d'un utilisateur


// Route::middleware(['basic'])->group(function () {
//     Route::post('/utilisateurs', [App\Http\Controllers\UtilisateursController::class, 'ajoutUtilisateurs']);
// });

Route::post('/utilisateurs', [App\Http\Controllers\UtilisateursController::class, 'ajoutUtilisateurs'])->middleware('auth.basic');
// Route::post('/utilisateurs', [App\Http\Controllers\UtilisateursController::class, 'ajoutUtilisateurs'])->middleware('auth.digest');

// Route::middleware(['digest'])->group(function () {
//     Route::post('/utilisateurs', [App\Http\Controllers\UtilisateursController::class, 'ajoutUtilisateurs']);
// });
