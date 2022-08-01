<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Autenticacao\Autenticacao;
use App\Http\Controllers\Autenticacao\ViewsAutenticacao;
use App\Http\Controllers\Agenda\Agenda;
use App\Http\Controllers\Agenda\ViewsAgenda;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/',[ViewsAutenticacao::class, 'Autenticacao']);
Route::post('/autenticacao', [Autenticacao::class, 'Autenticacao']);
Route::post('/logout', [Autenticacao::class, 'Logout']);

Route::get('/agenda',[ViewsAgenda::class, 'Agenda']);
Route::post('/cadastro-compromisso', [Agenda::class, 'CadastroCompromisso']);
Route::post('/preview-compromisso', [Agenda::class, 'PreviewCompromisso']);
Route::post('/concluir-compromisso', [Agenda::class, 'ConcluirCompromisso']);
Route::post('/cancelar-compromisso', [Agenda::class, 'CancelarCompromisso']);