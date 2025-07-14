<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('welcome');
})->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('dashboard', function () {
        return Inertia::render('dashboard');
    })->name('dashboard');
});

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';


Route::resource('usuarios', App\Http\Controllers\UsuarioController::class);

Route::resource('categorias', App\Http\Controllers\CategoriaController::class);

Route::resource('fornecedors', App\Http\Controllers\FornecedorController::class);

Route::resource('produtos', App\Http\Controllers\ProdutoController::class);

Route::resource('movimentacao-estoques', App\Http\Controllers\MovimentacaoEstoqueController::class);

Route::resource('vendas', App\Http\Controllers\VendaController::class);
