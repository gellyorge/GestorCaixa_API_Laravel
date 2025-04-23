<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\AuthController;


Route::post('login', [AuthController::class, 'login']);
Route::post('CriarUsuario', [UsuarioController::class, 'store']);

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('usuarios', UsuarioController::class)->except('store', 'show');
    Route::post('logout', [AuthController::class, 'logout']);
});