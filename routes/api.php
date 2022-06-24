<?php

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\PesquisaController;
use App\Http\Controllers\RespostaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//Perfil
Route::get('/perfil', [PerfilController::class, 'index']);
Route::get('/perfil/{id}', [PerfilController::class, 'show']);
Route::post('/perfil', [PerfilController::class, 'store']);
Route::delete('/perfil/{id}', [PerfilController::class, 'destroy']);
Route::put('/perfil/{id}', [PerfilController::class, 'update']);

//Cliente
Route::get('/clientes', [ClienteController::class, 'index']);
Route::get('/clientes/{id}', [ClienteController::class, 'show']);
Route::post('/clientes', [ClienteController::class, 'store']);
Route::delete('/clientes/{id}', [ClienteController::class, 'destroy']);
Route::put('/clientes/{id}', [ClienteController::class, 'update']);

//Pesquisa
Route::get('/pesquisas', [PesquisaController::class, 'index']);
Route::get('/pesquisas/{id}', [PesquisaController::class, 'show']);
Route::get('/clientes/{clienteId}/pesquisa', [PesquisaController::class, 'pesquisaCliente']);
Route::post('/clientes/{clienteId}/pesquisa', [PesquisaController::class, 'store']);
Route::delete('/pesquisas/{id}', [PesquisaController::class, 'destroy']);


//Route::get('/clientes/pesquisa/{tema}', [PesquisaController::class, 'pesquisaTema']);
//Route::get('/pesquisas/{pesquisa}/respostas', [RespostaController::class, 'index']);
//Route::post('/pesquisas/{pesquisa}/respostas/assistir', [RespostaController::class, 'assistir']);
//Route::post('/clientes/{id}/editaNome', [ClienteController::class, 'editaNome']);
