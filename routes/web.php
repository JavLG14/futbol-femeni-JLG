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
Route::resource('equips', EquipController::class);
Route::resource('estadis', EstadiController::class);

Route::get('/jugadores', [JugadoraController::class, 'index'])->name('jugadores.index');
Route::get('/jugadores/crear', [JugadoraController::class, 'create'])->name('jugadores.create');
Route::post('/jugadores', [JugadoraController::class, 'store'])->name('jugadores.store');
Route::get('/jugadores/{jugadora}', [JugadoraController::class, 'show'])->name('jugadores.show');

Route::get('/partits', [PartitController::class, 'index'])->name('partits.index');
Route::get('/partits/crear', [PartitController::class, 'create'])->name('partits.create');
Route::post('/partits', [PartitController::class, 'store'])->name('partits.store');
Route::get('/partits/{partit}', [PartitController::class, 'show'])->name('partits.show');

Route::get('/historic', [PartitController::class, 'historic'])->name('partits.historic');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', RoleMiddleware::class.':administrador' ])->group(function (){
    Route::resource('/equips', EquipController::class)->except(['index', 'show']);
    Route::resource('/estadis', EstadiController::class)->except(['index', 'show']);
});
Route::middleware(['auth', RoleMiddleware::class.':manager' ])->group(function (){
    Route::resource('/equips', EquipController::class)->only([ 'update','edit' ]);
    Route::resource('/estadis', EstadiController::class)->only([ 'edit','update']);
});
Route::resource('/equips', EquipController::class)->only(['index', 'show']);
Route::resource('/estadis', EstadiController::class)->only(['index', 'show']);

Route::get('/lang/{locale}', function ($locale) {
    if (in_array($locale, ['ca', 'es', 'en'])) {
        Session::put('locale', $locale);
    }
    return back(); // Torna a la pàgina anterior
})->name('setLocale');

require __DIR__.'/auth.php';
