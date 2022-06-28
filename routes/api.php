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

//Login
Route::post('/login', [ClienteController::class, 'verificaLogin']);

//Perfil
Route::get('/perfil', [PerfilController::class, 'index'])->middleware('check.token');
Route::get('/perfil/{id}', [PerfilController::class, 'show'])->middleware('check.token');
Route::post('/perfil', [PerfilController::class, 'store'])->middleware('check.token');
Route::delete('/perfil/{id}', [PerfilController::class, 'destroy'])->middleware('check.token');
Route::put('/perfil/{id}', [PerfilController::class, 'update'])->middleware('check.token');

//Cliente
Route::get('/clientes', [ClienteController::class, 'index'])->middleware('check.token');
Route::get('/clientes/{id}', [ClienteController::class, 'show'])->middleware('check.token');
Route::post('/clientes', [ClienteController::class, 'store'])->middleware('check.token');
Route::delete('/clientes/{id}', [ClienteController::class, 'destroy'])->middleware('check.token');
Route::put('/clientes/{id}', [ClienteController::class, 'update'])->middleware('check.token');

//Pesquisa
Route::get('/pesquisas', [PesquisaController::class, 'index'])->middleware('check.token');
Route::get('/pesquisas/{id}', [PesquisaController::class, 'show'])->middleware('check.token');
Route::get('/clientes/{clienteId}/pesquisas', [PesquisaController::class, 'pesquisaCliente'])->middleware('check.token');
Route::get('/pesquisas/tema/{tema}', [PesquisaController::class, 'pesquisaTema'])->middleware('check.token');
Route::post('/clientes/{clienteId}/pesquisas', [PesquisaController::class, 'store'])->middleware('check.token');
Route::put('/clientes/{clienteId}/pesquisas/{id}', [PesquisaController::class, 'update'])->middleware('check.token');
Route::delete('/pesquisas/{id}', [PesquisaController::class, 'destroy'])->middleware('check.token');

//Resposta
Route::get('/respostas', [RespostaController::class, 'index'])->middleware('check.token');
Route::get('/respostas/{id}', [RespostaController::class, 'show'])->middleware('check.token');
Route::get('/clientes/{clienteId}/respostas', [RespostaController::class, 'respostaCliente'])->middleware('check.token');
Route::get('/pesquisas/{pesquisaId}/respostas', [RespostaController::class, 'respostaPesquisa'])->middleware('check.token');
Route::post('/clientes/pesquisas/{pesquisaId}/respostas', [RespostaController::class, 'store'])->middleware('check.token');
Route::put('/clientes/pesquisas/{pesquisaId}/respostas/{id}', [RespostaController::class, 'update'])->middleware('check.token');
Route::delete('/respostas/{id}', [RespostaController::class, 'destroy'])->middleware('check.token');
