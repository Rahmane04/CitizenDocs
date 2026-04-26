<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Agent\TraitementController;

Route::get('/', function () {
    return view('welcome');
});

// Routes d'authentification (login, logout, register)
Auth::routes();

// Routes agent
Route::middleware(['auth', 'role:agent'])
    ->prefix('agent')
    ->name('agent.')
    ->group(function () {
        Route::get('/demandes', [TraitementController::class, 'index'])
            ->name('demandes.index');
        Route::get('/demandes/{demande}', [TraitementController::class, 'show'])
            ->name('demandes.show');
        Route::post('/demandes/{demande}/traiter', [TraitementController::class, 'traiter'])
            ->name('demandes.traiter');
    });
