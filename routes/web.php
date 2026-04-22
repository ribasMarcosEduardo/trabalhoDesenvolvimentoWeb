<?php

use App\Http\Controllers\UnoescController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BovinoController;
use App\Http\Controllers\FazendaController;
use App\Http\Controllers\AlocacaoController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::get('/users/create', [UserController::class, 'create']);
Route::post('/users/store', [UserController::class, 'store']);
Route::get('/users/{user}', [UserController::class, 'edit']);
Route::put('/users/{user}', [UserController::class, 'update']);
Route::get('/users/{user}/delete', [UserController::class, 'confirmDelete']);
Route::delete('/users/{user}', [UserController::class, 'delete']);

Route::get('/users/{user}/phone', [UserController::class, 'createPhone']);
Route::post('/users/{user}/phone', [UserController::class, 'storePhone']);
Route::delete('/users/{user}/phone/{phone}', [UserController::class, 'deletePhone']);

Route::get('/unoesc', [UnoescController::class, 'index']);
Route::post('/unoesc', [UnoescController::class, 'login']);

Route::get('/users', [UserController::class, 'index']);

//Boi na Faixa --------------------------------------------------

//Exibe form de cadastro de bois
Route::get('/bovinos/create', [BovinoController::class, 'create']);
//Salva o form
Route::post('/bovinos', [BovinoController::class, 'store']);
//Exibe lista de bois
Route::get('/bovinos', [BovinoController::class, 'index']);

// Exibe lista de fazendas
Route::get('/fazendas', [FazendaController::class, 'index']);
// Exibe form de cadastro de fazendas
Route::get('/fazendas/create', [FazendaController::class, 'create']);
// Salva o form
Route::post('/fazendas', [FazendaController::class, 'store']);

// 1. Suas rotas personalizadas primeiro
Route::post('/fazendas/{fazenda}/vincular', [AlocacaoController::class, 'storeVincular']);
Route::delete('/fazendas/{fazenda}/desvincular/{bovino}', [AlocacaoController::class, 'destroyDesvincular']);

// 2. Depois as rotas resource ou outras
Route::resource('fazendas', FazendaController::class);