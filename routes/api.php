<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    AgenceController,
    FilialeController,
    BusController,
    GuichetController,
    TrajetController,
    ArretController,
    VoyageController,
    ReservationController,
    PaiementController,
    UserController,
    ArretTrajetController
};

/*
|--------------------------------------------------------------------------
| ROUTES PUBLIQUES (sans authentification)
|--------------------------------------------------------------------------
*/

// Connexion (limite à 5 tentatives/minute)
Route::post('/login', [UserController::class, 'login'])
    ->middleware('throttle:5,1')
    ->name('login');

// Inscription client (publique)
Route::post('/register', [UserController::class, 'register'])
    ->name('register');

/*
|--------------------------------------------------------------------------
| ROUTES PROTÉGÉES (auth:sanctum)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth:sanctum'])->group(function () {

    // Déconnexion
    Route::post('/logout', [UserController::class, 'logout'])->name('logout');

    // Récupération des infos de l'utilisateur connecté
    Route::get('/me', [UserController::class, 'me'])->name('me');

    /*
    |--------------------------------------------------------------------------
    | Ressources RESTful protégées (réservées aux admins, agents, etc.)
    |--------------------------------------------------------------------------
    */
    Route::apiResource('users', UserController::class);
    Route::apiResource('agences', AgenceController::class);
    Route::apiResource('filiales', FilialeController::class);
    Route::apiResource('buses', BusController::class);
    Route::apiResource('guichets', GuichetController::class);
    Route::apiResource('trajets', TrajetController::class);
    Route::apiResource('arrets', ArretController::class);
    Route::apiResource('voyages', VoyageController::class);
    Route::apiResource('reservations', ReservationController::class);
    Route::apiResource('paiements', PaiementController::class);

    // Gestion des arrêts d’un trajet
    Route::controller(ArretTrajetController::class)->group(function(){
        Route::post('/arret-trajet', 'store');         // Associer arrêts
        Route::get('/arret-trajet/{trajet_id}', 'show'); // Voir arrêts
        Route::delete('/arret-trajet', 'detach');        // Détacher un arrêt
    });
});
