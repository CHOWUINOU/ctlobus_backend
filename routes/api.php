<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AgenceController;
use App\Http\Controllers\FilialeController;
use App\Http\Controllers\BusController;
use App\Http\Controllers\GuichetController;
use App\Http\Controllers\TrajetController;
use App\Http\Controllers\ArretController;
use App\Http\Controllers\VoyageController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\PaiementController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ArretTrajetController;


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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
// Routes publiques (exemple : inscription, login)
Route::post('register', [UserController::class, 'register']);
Route::post('login', [UserController::class, 'login']);


 // Gestion des utilisateurs
    Route::apiResource('users', UserController::class);

    // Agences
    Route::apiResource('agences', AgenceController::class);

    // Filiales liées aux agences
    Route::apiResource('filiales', FilialeController::class);

    // Buses
    Route::apiResource('buses', BusController::class);

    // Guichets
    Route::apiResource('guichets', GuichetController::class);

    // Trajets
    Route::apiResource('trajets', TrajetController::class);

    // Arrêts
    Route::apiResource('arrets', ArretController::class);

    // Voyages
    Route::apiResource('voyages', VoyageController::class);

    // Réservations
    Route::apiResource('reservations', ReservationController::class);

    // Paiements
    Route::apiResource('paiements', PaiementController::class);

/* trajet_arret */
Route::controller(ArretTrajetController::class)->group(function(){
    Route::post('/arret-trajet', 'store');         // Associer arrêts à un trajet
    Route::get('/arret-trajet/{trajet_id}', 'show'); // Voir arrêts d’un trajet
    Route::delete('/arret-trajet', 'detach');        // Détacher un arrêt d’un trajet
});
 // Logout sert à déconnecter un utilisateur authentifié.
    Route::post('logout', [UserController::class, 'logout']);
