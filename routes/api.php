<?php

use App\Http\Controllers\AulaController;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('aulas', [AulaController::class, "index"])->name("aula.index");
Route::post('aulas', [AulaController::class, "store"])->name("aula.store");
Route::get('aulas/create', [AulaController::class, "create"])->name("aula.create");
Route::get('aulas/{id}', [AulaController::class, "show"])->name("aula.show");
Route::delete('aulas/{id}', [AulaController::class, "destroy"])->name("aula.destroy");
Route::put('aulas/{id}', [AulaController::class, "update"])->name("aula.update");

Route::post('login', [AuthController::class, "login"]);
Route::get('user', [AuthController::class, "me"])->middleware('api');
Route::post('logout', [AuthController::class, "logout"])->middleware('api');
Route::post('refresh', [AuthController::class, "refresh"])->middleware('api');
