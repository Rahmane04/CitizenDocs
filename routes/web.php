<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\DemandeController;

/*
|--------------------------------------------------------------------------
| Routes publiques
|--------------------------------------------------------------------------
*/
Route::get('/', fn() => view('welcome'));

// Authentification
Route::middleware('guest')->group(function () {
    Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('/register', [RegisteredUserController::class, 'store']);
    Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('/login', [AuthenticatedSessionController::class, 'store']);
});

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout')->middleware('auth');

/*
|--------------------------------------------------------------------------
| Routes Citoyen
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:citoyen'])->prefix('citoyen')->name('citoyen.')->group(function () {
    Route::get('/dashboard', function() {
        return view('layouts.app', ['user' => auth()->user()]);
    })->name('dashboard');
    Route::get('/demandes', [DemandeController::class, 'index'])->name('demandes.index');
    Route::get('/demandes/create', [DemandeController::class, 'create'])->name('demandes.create');
    Route::post('/demandes', [DemandeController::class, 'store'])->name('demandes.store');
});

/*
|--------------------------------------------------------------------------
| Routes Agent
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:agent'])->prefix('agent')->name('agent.')->group(function () {
    Route::get('/dashboard', function() {
        return view('layouts.app', ['user' => auth()->user()]);
    })->name('dashboard');
});

/*
|--------------------------------------------------------------------------
| Routes Admin
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', function() {
        return view('layouts.app', ['user' => auth()->user()]);
    })->name('dashboard');
});