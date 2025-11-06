<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EquipController;
use App\Http\Controllers\EstadiController;
use App\Http\Controllers\JugadoraController;
use App\Http\Controllers\PartitController;
use App\Http\Controllers\IniciController;

Route::get('/', [IniciController::class, 'index'])->name('inici.inici');

Route::resource('equips', EquipController::class);

Route::resource('estadis', EstadiController::class);

Route::get('/jugadores', [JugadoraController::class, 'index'])->name('jugadores.index');
Route::get('/jugadores/crear', [JugadoraController::class, 'create'])->name('jugadores.create');
Route::post('/jugadores', [JugadoraController::class, 'store'])->name('jugadores.store');

Route::get('/partits', [PartitController::class, 'index'])->name('partits.index');
Route::get('/partits/crear', [PartitController::class, 'create'])->name('partits.create');
Route::post('/partits', [PartitController::class, 'store'])->name('partits.store');