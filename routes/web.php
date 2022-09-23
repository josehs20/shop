<?php

use App\Http\Controllers\Admin\CategoriaController;
use App\Http\Controllers\Admin\CoresController;
use App\Http\Controllers\Admin\EstoqueController;
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

//PRODUTOS
Route::resource('/produto', ProdutoController::class);
Route::get('/get_produtos', [\App\Http\Controllers\Admin\ProdutoController::class, 'get_produtos']);
Route::post('store_ptc/{id}', [\App\Http\Controllers\Admin\ProdutoController::class, 'store_ptc']);
Route::put('update_ptc/{id}', [\App\Http\Controllers\Admin\ProdutoController::class, 'update_ptc']);
Route::post('/upload-imagem-produto/{id}', [\App\Http\Controllers\Admin\ProdutoController::class, 'upload_imagem_produto']);
Route::delete('/remove-imagem/{id}', [\App\Http\Controllers\Admin\ProdutoController::class, 'remove_imagem']);
Route::put('/prioridade-imagem/{id}', [\App\Http\Controllers\Admin\ProdutoController::class, 'prioridade_imagem']);

//CATEGORIAS
Route::resource('/categoria', CategoriaController::class);
//TAMANHO
Route::resource('/tamanho', TamanhoController::class);
//COR
Route::resource('/cor', CoresController::class);
//ESTOQUE
Route::resource('/estoque', EstoqueController::class);
//PESQUISA DE CATEGORIAS
Route::get('/get_categorias', [\App\Http\Controllers\Admin\CategoriaController::class, 'get_categorias']);
//PESQUISA DE TAMANHOS
Route::get('/get_tamanhos', [\App\Http\Controllers\Admin\TamanhoController::class, 'get_tamanhos']);
//PESQUISA DE CORES
Route::get('/get_cores', [\App\Http\Controllers\Admin\CoresController::class, 'get_cores']);



