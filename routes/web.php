<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\PedidoController;



Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/login', [AuthController::class, 'ShowLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');




Route::middleware('auth')->group(function () {


    Route::get('/', function () {
        return view('welcome');
    });
    Route::resource('produtos', ProdutoController::class);
    Route::resource('clientes', ClienteController::class)->except(['show']);
    Route::resource('pedidos', PedidoController::class)->except(['edit', 'update' ]);
    Route::post('/pedidos/{pedido}/assinar', [PedidoController::class, 'assinar'])->name('pedidos.assinar');
});
