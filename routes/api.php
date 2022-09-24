<?php

use App\Http\Controllers\api\PassportAuthController;
use App\Http\Controllers\api\VerifyEmailController;
use App\Http\Controllers\api\UserController;
use App\Http\Controllers\api\PedidoController;
use App\Http\Controllers\api\ReservaController;
use App\Http\Controllers\api\CarritoController;
use App\Http\Controllers\api\LibroController;
use App\Http\Controllers\api\FavoritosController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/login', [PassportAuthController::class, 'login']);
Route::post('/registro', [PassportAuthController::class, 'register']);

Route::post('/email/verification-notification', [VerifyEmailController::class, 'sendVerificationEmail'])->name('verification.send');
Route::get('/email/verify/{id}/{hash}', [VerifyEmailController::class, 'verify'])
    ->middleware(['signed'])
    ->name('verification.verify');

Route::middleware(['auth:api', 'rol'])->group(function() {
    
    Route::middleware(['scope:admin'])
    ->group(function() {
        Route::get('/libros/historialLibros', [LibroController::class, 'historialLibros']);
        Route::resource('/libros', LibroController::class);
    });

    Route::middleware(['scope:client'])
    ->group(function() {
        Route::resource('/carrito', CarritoController::class);
        Route::get('/carrito/usuario/{id}', [CarritoController::class,'showByUser']);
        Route::resource('/reservas', ReservaController::class);
        Route::get('/reservas/usuario/{id}', [ReservaController::class,'showByUser']);
        Route::resource('/pedidos', PedidoController::class);
        Route::get('/pedidos/usuario/{id}', [PedidoController::class,'showByUser']);
        Route::resource('/favoritos', FavoritosController::class);
        Route::get('/favoritos/usuario/{id}', [FavoritosController::class,'showByUser']);
        Route::get('/perfil', [UserController::class, 'show']);
    });

});

Route::get('/libros', [LibroController::class, 'index']);