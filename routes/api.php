<?php

use App\Http\Controllers\api\PassportAuthController;
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

Route::post('/login',[PassportAuthController::class, 'login']);
Route::post('/registro',[PassportAuthController::class, 'register']);

Route::middleware(['auth:api', 'rol'])->group(function() {
    
    Route::middleware(['scope:admin'])
    ->group(function() {
        Route::resource('/libros', LibroController::class);
    });

    Route::middleware(['scope:client'])
    ->group(function() {
        Route::resource('/carrito', CarritoController::class);
        Route::resource('/reservas', ReservaController::class);
        Route::resource('/pedidos', PedidoController::class);
        Route::resource('/favoritos', FavoritosController::class);
        Route::get('/perfil', [UserController::class, 'show']);
    });

});

Route::get('/libros', [LibroController::class, 'index']);