<?php

use App\Http\Controllers\Admin\CategoriaController;
use App\Http\Controllers\Admin\ProdutoController;
use App\Http\Controllers\Admin\HomeAdminController;
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
Route::resource('/cadastro/produto', ProdutoController::class);
//CATEGORIAS
Route::resource('/cadastro/categoria', CategoriaController::class);
//PESQUISA DE PRODUTOS
Route::get('/get_produtos', [\App\Http\Controllers\Admin\ProdutoController::class, 'get_produtos']);
