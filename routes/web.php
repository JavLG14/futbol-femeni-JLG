<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EquipController;
use App\Http\Controllers\EstadiController;
use App\Http\Controllers\JugadoraController;
use App\Http\Controllers\PartitController;
use App\Http\Controllers\IniciController;
use App\Http\Middleware\RoleMiddleware;


Route::get('/', [IniciController::class, 'index'])->name('inici.inici');
Route::get('/historic', [PartitController::class, 'historic'])->name('partits.historic');

Route::get('/historic', [PartitController::class, 'historic'])->name('partits.historic');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Equips & Estadis: Shared resource routes with RoleMiddleware handling specific access inside
    // However, specifically:
    // Admin: Full access
    // Manager: Edit own team (handled by Policy/Controller check, but route access needs to be open to them)
    // Arbitre: Read only (usually)

    // Simplification based on requirements:
    // Admin: Resource full
    Route::middleware([RoleMiddleware::class . ':administrador'])->group(function () {
        Route::resource('equips', EquipController::class)->except(['index', 'show', 'edit', 'update']);
        Route::resource('estadis', EstadiController::class)->except(['index', 'show']);
    });

    // Managers can edit their team. We leave the route open to auth, but Controller/Policy will restrict "which" team.
    // Or we rely on the implementation plan's route groups.
    Route::resource('equips', EquipController::class)->only(['edit', 'update']);

    // Jugadores routes (Protected actions)
    Route::resource('jugadores', JugadoraController::class)
        ->except(['index', 'show'])
        ->parameters(['jugadores' => 'jugadora']);

    // Partits routes (Disabled create/store as per requirement)
    Route::get('/partits/{partit}/edit', [PartitController::class, 'edit'])->name('partits.edit');
    Route::put('/partits/{partit}', [PartitController::class, 'update'])->name('partits.update');
    // Note: destroy is for admin only, usually.
    Route::delete('/partits/{partit}', [PartitController::class, 'destroy'])->name('partits.destroy')->middleware(RoleMiddleware::class . ':administrador');
});

// Public read routes
Route::get('/equips', [EquipController::class, 'index'])->name('equips.index');
Route::get('/equips/{equip}', [EquipController::class, 'show'])->name('equips.show');
Route::get('/estadis', [EstadiController::class, 'index'])->name('estadis.index');
Route::get('/estadis/{estadi}', [EstadiController::class, 'show'])->name('estadis.show');
// Jugadores public routes
Route::get('/jugadores', [JugadoraController::class, 'index'])->name('jugadores.index');
Route::get('/jugadores/{jugadora}', [JugadoraController::class, 'show'])->name('jugadores.show');

// Partits public
Route::get('/partits', [PartitController::class, 'index'])->name('partits.index');
Route::get('/partits/{partit}', [PartitController::class, 'show'])->name('partits.show');

Route::get('/lang/{locale}', function ($locale) {
    if (in_array($locale, ['ca', 'es', 'en'])) {
        Session::put('locale', $locale);
    }
    return back(); // Torna a la pàgina anterior
})->name('setLocale');

require __DIR__ . '/auth.php';
