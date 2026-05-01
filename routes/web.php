<?php

use Illuminate\Support\Facades\Route;

// Controllers
use App\Http\Controllers\UnoescController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BovinoController;
use App\Http\Controllers\FazendaController;
use App\Http\Controllers\AlocacaoController;
// Models
use App\Models\Bovino;
use App\Models\Fazenda;
use App\Models\Alocacao;

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

// Dashboard BoiNaFaixa
Route::get('/', function () {
    $totalBovinos = Bovino::count();
    $totalFazendas = Fazenda::count();
    
    $bovinosAlocados = Alocacao::distinct('bovino_id')->count('bovino_id');

    $bovinosLivres = $totalBovinos - $bovinosAlocados;

    return view('dashboard', compact('totalBovinos', 'totalFazendas', 'bovinosLivres'));
});

// --------------------------------------------------
// BOI NA FAIXA
// --------------------------------------------------

// ----- BOVINOS -----
// Exibe form de cadastro de bois
Route::get('/bovinos/create', [BovinoController::class, 'create']);
// Salva o form
Route::post('/bovinos', [BovinoController::class, 'store']);
// Exibe lista de bois
Route::get('/bovinos', [BovinoController::class, 'index']);
// Exibe o form de edição
Route::get('/bovinos/{bovino}/edit', [BovinoController::class, 'edit']);
// Atualiza o bovino
Route::put('/bovinos/{bovino}', [BovinoController::class, 'update']);
// Exclui o bovino
Route::delete('/bovinos/{bovino}', [BovinoController::class, 'destroy']);

// ----- FAZENDAS -----
// Exibe lista de fazendas
Route::get('/fazendas', [FazendaController::class, 'index']);
// Exibe form de cadastro de fazendas
Route::get('/fazendas/create', [FazendaController::class, 'create']);
// Salva o form
Route::post('/fazendas', [FazendaController::class, 'store']);
// Exibe o form de edição
Route::get('/fazendas/{fazenda}/edit', [FazendaController::class, 'edit']);
// Atualiza a fazenda
Route::put('/fazendas/{fazenda}', [FazendaController::class, 'update']);
// Exclui a fazenda
Route::delete('/fazendas/{fazenda}', [FazendaController::class, 'destroy']);

// ----- ALOCAÇÕES -----
Route::post('/fazendas/{fazenda}/vincular', [AlocacaoController::class, 'storeVincular']);
Route::delete('/fazendas/{fazenda}/desvincular/{bovino}', [AlocacaoController::class, 'destroyDesvincular']);