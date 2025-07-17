<?php

use Illuminate\Support\Facades\Route;


use App\Http\Controllers\AuthController;

Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/me', [AuthController::class, 'me']);
    Route::post('/logout', [AuthController::class, 'logout']);
});


Route::middleware(['auth:sanctum', 'tipo:Administrador'])->get('/admin-area', function () {
    return response()->json(['message' => 'Bem-vindo, Admin!']);
});

Route::middleware(['auth:sanctum', 'tipo:Vendedor,Administrador'])->get('/vendas', function () {
    return response()->json(['message' => 'Acesso de Vendedor ou Admin']);
});


Route::middleware(['auth:sanctum', 'tipo:Administrador'])->get('/admin-area', function () {
    return response()->json([
        'message' => 'Bem-vindo à área administrativa!',
        'usuario' => auth()->user(),
    ]);
});

