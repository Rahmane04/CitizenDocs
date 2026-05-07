<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\DemandeController;
use App\Http\Controllers\Agent\TraitementController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\PaiementController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\Auth\OtpController;

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
// Redirection intelligente après login
Route::get('/dashboard', function() {
    $role = auth()->user()->role;
    return match($role) {
        'admin'  => redirect()->route('admin.dashboard'),
        'agent'  => redirect()->route('agent.dashboard'),
        default  => redirect()->route('citoyen.dashboard'),
    };
})->middleware('auth')->name('dashboard');
/*
|--------------------------------------------------------------------------
| Routes Citoyen
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:citoyen'])->prefix('citoyen')->name('citoyen.')->group(function () {
    Route::get('/dashboard', function() {
    $user = auth()->user();
    $stats = [
        'en_attente' => $user->demandes()->where('statut', 'en_attente')->count(),
        'validee'    => $user->demandes()->where('statut', 'validee')->count(),
        'rejetee'    => $user->demandes()->where('statut', 'rejetee')->count(),
    ];
    return view('layouts.app', [
        'user'  => $user,
        'stats' => $stats
    ]);
})->name('dashboard');
    Route::get('/demandes', [DemandeController::class, 'index'])->name('demandes.index');
    Route::get('/demandes/create', [DemandeController::class, 'create'])->name('demandes.create');
    Route::post('/demandes', [DemandeController::class, 'store'])->name('demandes.store');
    Route::get('/demandes/{demande}/payer', [PaiementController::class, 'create'])->name('paiements.create');
    Route::post('/demandes/{demande}/payer', [PaiementController::class, 'store'])->name('paiements.store');
    Route::get('/demandes/{demande}/telecharger', [DocumentController::class, 'download'])->name('documents.download');
    Route::get('/paiements', [PaiementController::class, 'index'])->name('paiements.index');
    Route::get('/documents', [DocumentController::class, 'index'])->name('documents.index');
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
    Route::get('/demandes', [TraitementController::class, 'index'])->name('demandes.index');
    Route::get('/demandes/{demande}', [TraitementController::class, 'show'])->name('demandes.show');
    Route::post('/demandes/{demande}/traiter', [TraitementController::class, 'traiter'])->name('demandes.traiter');
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
    Route::get('/users', [AdminController::class, 'users'])->name('users');
    Route::post('/users/{user}/toggle', [AdminController::class, 'toggleUser'])->name('users.toggle');
    Route::get('/type-documents', [AdminController::class, 'typeDocuments'])->name('type_documents');
    Route::get('/type-documents/create', [AdminController::class, 'createTypeDocument'])->name('type_documents.create');
    Route::post('/type-documents', [AdminController::class, 'storeTypeDocument'])->name('type_documents.store');
    Route::get('/type-documents/{typeDocument}/edit', [AdminController::class, 'editTypeDocument'])->name('type_documents.edit');
    Route::put('/type-documents/{typeDocument}', [AdminController::class, 'updateTypeDocument'])->name('type_documents.update');
    Route::delete('/type-documents/{typeDocument}', [AdminController::class, 'destroyTypeDocument'])->name('type_documents.destroy');
    Route::get('/rapports', [AdminController::class, 'rapports'])->name('rapports');
    Route::get('/agents/create', [AdminController::class, 'createAgent'])->name('agents.create');
    Route::post('/agents', [AdminController::class, 'storeAgent'])->name('agents.store');
});

Route::get('/verify-otp', [OtpController::class, 'show'])->name('verify.otp');
Route::post('/verify-otp', [OtpController::class, 'verify'])->name('verify.otp.submit');