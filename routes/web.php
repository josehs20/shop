<?php

use App\Http\Controllers\Admin\CategoriaController;
use App\Http\Controllers\Admin\ConfiguracaoController;
use App\Http\Controllers\Admin\CoresController;
use App\Http\Controllers\Admin\ProdutoController;
use App\Http\Controllers\Admin\HomeAdminController;
use App\Http\Controllers\Admin\TamanhoController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('/homeAdmin', HomeAdminController::class);

//CONFIGURAÇÕES
Route::resource('/config', ConfiguracaoController::class);
Route::get('/config/meusdados/{id}', [\App\Http\Controllers\Admin\ConfiguracaoController::class, 'meus_dados'])->name('meusdados');
Route::put('/config/meusdados/{id}', [\App\Http\Controllers\Admin\ConfiguracaoController::class, 'alterar_meus_dados']);
Route::get('/config/alterarsenha/{id}', [\App\Http\Controllers\Admin\ConfiguracaoController::class, 'alterar_senha'])->name('alterarsenha');

//PRODUTOS
Route::resource('/cadastro/produto', ProdutoController::class);
//CATEGORIAS
Route::resource('/cadastro/categoria', CategoriaController::class);
//TAMANHO
Route::resource('/cadastro/tamanho', TamanhoController::class);
//COR
Route::resource('/cadastro/cor', CoresController::class);

//PESQUISA DE PRODUTOS
Route::get('/get_produtos', [\App\Http\Controllers\Admin\ProdutoController::class, 'get_produtos']);
//PESQUISA DE CATEGORIAS
Route::get('/get_categorias', [\App\Http\Controllers\Admin\CategoriaController::class, 'get_categorias']);
//PESQUISA DE TAMANHOS
Route::get('/get_tamanhos', [\App\Http\Controllers\Admin\TamanhoController::class, 'get_tamanhos']);
//PESQUISA DE CORES
Route::get('/get_cores', [\App\Http\Controllers\Admin\CoresController::class, 'get_cores']);



