<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\JugadoraController;
use App\Http\Controllers\Api\EstadiController;
use App\Http\Controllers\Api\EquipController;
use App\Http\Controllers\Api\PartitController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::name('api.')->group(function () {
    Route::apiResource('jugadores', JugadoraController::class)
        ->parameters(['jugadores' => 'jugadora']);

    Route::apiResource('estadis', EstadiController::class)
        ->parameters(['estadis' => 'estadi']);

    Route::apiResource('equips', EquipController::class)
        ->parameters(['equips' => 'equip']);

    Route::apiResource('partits', PartitController::class)
        ->parameters(['partits' => 'partit']);
});