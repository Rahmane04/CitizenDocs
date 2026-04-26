<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;

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
    Route::get('/dashboard', fn() => view('citoyen.dashboard'))->name('dashboard');
});

/*
|--------------------------------------------------------------------------
| Routes Agent
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:agent'])->prefix('agent')->name('agent.')->group(function () {
    Route::get('/dashboard', fn() => view('agent.dashboard'))->name('dashboard');
});

/*
|--------------------------------------------------------------------------
| Routes Admin
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', fn() => view('admin.dashboard'))->name('dashboard');
});

use App\Http\Controllers\Admin\AdminController;

Route::prefix('admin')
     ->middleware(['auth', 'role:admin'])
     ->name('admin.')
     ->group(function () {

    // Dashboard
    Route::get('/dashboard', [AdminController::class, 'dashboard'])
         ->name('dashboard');

    // Utilisateurs
    Route::get('/users', [AdminController::class, 'users'])
         ->name('users');
    Route::post('/users/{user}/toggle', [AdminController::class, 'toggleUser'])
         ->name('users.toggle');

    // Types de documents
    Route::get('/type-documents', [AdminController::class, 'typeDocuments'])
         ->name('type_documents');
    Route::get('/type-documents/create', [AdminController::class, 'createTypeDocument'])
         ->name('type_documents.create');
    Route::post('/type-documents', [AdminController::class, 'storeTypeDocument'])
         ->name('type_documents.store');
    Route::get('/type-documents/{typeDocument}/edit', [AdminController::class, 'editTypeDocument'])
         ->name('type_documents.edit');
    Route::put('/type-documents/{typeDocument}', [AdminController::class, 'updateTypeDocument'])
         ->name('type_documents.update');
    Route::delete('/type-documents/{typeDocument}', [AdminController::class, 'destroyTypeDocument'])
         ->name('type_documents.destroy');

    // Rapports
    Route::get('/rapports', [AdminController::class, 'rapports'])
         ->name('rapports');
});