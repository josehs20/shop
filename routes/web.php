<?php

use App\Http\Controllers\Admin\CategoriaController;
use App\Http\Controllers\Admin\ConfiguracaoController;
use App\Http\Controllers\Admin\CoresController;
use App\Http\Controllers\Admin\EstoqueController;
use App\Http\Controllers\Admin\ProdutoController;
use App\Http\Controllers\Admin\HomeAdminController;
use App\Http\Controllers\Admin\PedidosController;
use App\Http\Controllers\Admin\TamanhoController;
use App\Http\Controllers\Usuario\PedidosController as UsuarioPedidosController;
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
Route::get('/', [\App\Http\Controllers\InicioController::class, 'index'])->name('inicio');
Route::get('/produtoIndividual/{produto}/', [\App\Http\Controllers\InicioController::class, 'unico_produto'])->name('unicoProduto');
Route::get('/finalizarPedido', [\App\Http\Controllers\Usuario\PedidosController::class, 'finalizar_pedido'])->name('finalizarPedido');

Route::get('/get-pedidos-ptc', [\App\Http\Controllers\Usuario\PedidosController::class, 'get_pedidos_ptc']);
Route::get('/get-ptc-relacao-tamanho-cor', [\App\Http\Controllers\Usuario\PedidosController::class, 'get_ptc_relacao_tamanho_cor']);

//MEUS DADOS
Route::get('/configUsuario/meusDados/{id}', [\App\Http\Controllers\Usuario\ConfiguracaoUsuarioController::class, 'index'])->name('meusDadosUsuario');
Route::put('/configUsuario/alterarMeusDados/{id}', [\App\Http\Controllers\Usuario\ConfiguracaoUsuarioController::class, 'alterar_meus_dados']);

//MINHA SENHA
//ROTA PARA A VIEW DE ALTERAR A SENHA
Route::get('/configUsuario/alterarsenha/{id}', [\App\Http\Controllers\Usuario\ConfiguracaoUsuarioController::class, 'alterar_senha'])->name('alterarSenha');
//ROTA QUE REALMENTE ALTERA A SENHA, QUE FAZ O UPDATE NO BANCO DE DADOS
Route::put('/configUsuario/alterarSenha/{id}', [\App\Http\Controllers\Usuario\ConfiguracaoUsuarioController::class, 'alterar_senha_usuario_comum']);

//ENDERECOS
Route::get('/configUsuario/enderecos/{id}', [\App\Http\Controllers\Usuario\ConfiguracaoUsuarioController::class, 'enderecos'])->name('enderecos');

Auth::routes();


Route::middleware('cliente')->group(function () {   
    //adiciona itens da storage no banco
    Route::post('/set-pedidos-itens', [\App\Http\Controllers\Usuario\PedidosController::class, 'set_pedidos_itens']);
    Route::put('/altera-quantidade-item', [\App\Http\Controllers\Usuario\PedidosController::class, 'altera_quantidade_item']);
    Route::delete('/deleta-item', [\App\Http\Controllers\Usuario\PedidosController::class, 'deleta_item']);
    //adiciona item no banco caso usuario esteja logado
    Route::post('/set-item', [\App\Http\Controllers\Usuario\PedidosController::class, 'set_item']);


});

Route::get('/home', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::middleware('admin')->group(function () {

    Route::resource('/homeAdmin', HomeAdminController::class);
    //CONFIGURACOES DE ENVIO '/configuracao/envio' SE FOR /config/envio ENTRA EM SEGMENSTS DE CONFIG
    Route::get('/configuracao/envio', [\App\Http\Controllers\Admin\ConfiguracaoController::class, 'index_config_envio'])->name('configEnvio');
    Route::post('/post-medida-envio', [ \App\Http\Controllers\Admin\ConfiguracaoController::class, 'post_medidas_envio']);
    Route::post('/post-cep-envio', [ \App\Http\Controllers\Admin\ConfiguracaoController::class, 'post_cep_envio']);
    //CONFIGURAÇÕES
    Route::resource('/config', ConfiguracaoController::class);
    //ROTA PARA ALTERAR OS DADOS DO USUARIO
    Route::put('/config/alterarMeusDados/{id}', [\App\Http\Controllers\Admin\ConfiguracaoController::class, 'alterar_meus_dados']);
    Route::get('/config/meusdados/{id}', [\App\Http\Controllers\Admin\ConfiguracaoController::class, 'meus_dados'])->name('meusdados');
    //ROTA PARA A VIEW DE ALTERAR A SENHA
    Route::get('/config/alterarsenha/{id}', [\App\Http\Controllers\Admin\ConfiguracaoController::class, 'alterar_senha'])->name('alterarsenha');
    //ROTA QUE REALMENTE ALTERA A SENHA, QUE FAZ O UPDATE NO BANCO DE DADOS
    Route::put('/config/alterarsenha/{id}', [\App\Http\Controllers\Admin\ConfiguracaoController::class, 'alterar_senha_usuario']);

    //PRODUTOS
    Route::resource('/produto', ProdutoController::class);
    Route::get('/get_produtos', [\App\Http\Controllers\Admin\ProdutoController::class, 'get_produtos']);
    Route::post('store_ptc/{id}', [\App\Http\Controllers\Admin\ProdutoController::class, 'store_ptc']);
    Route::put('update_ptc/{id}', [\App\Http\Controllers\Admin\ProdutoController::class, 'update_ptc']);
    //IMAGENS PRODUTO
    Route::post('/upload-imagem-produto/{id}', [\App\Http\Controllers\Admin\ProdutoController::class, 'upload_imagem_produto']);
    Route::delete('/remove-imagem/{id}', [\App\Http\Controllers\Admin\ProdutoController::class, 'remove_imagem']);
    Route::put('/prioridade-imagem/{id?}', [\App\Http\Controllers\Admin\ProdutoController::class, 'prioridade_imagem']);
    //ESTOQUES filtro_categoria_prod_tam_cor
    Route::resource('/estoque', EstoqueController::class);
    Route::get('/balanco', [\App\Http\Controllers\Admin\EstoqueController::class, 'index_balanco'])->name('index.balanco');
    Route::get('/movimentacao', [\App\Http\Controllers\Admin\EstoqueController::class, 'index_movimentacao'])->name('index.movimentacao');
    Route::get('/zeramento', [\App\Http\Controllers\Admin\EstoqueController::class, 'index_zeramento'])->name('zeramento.index');
    Route::get('/get_produtos_filtro', [\App\Http\Controllers\Admin\EstoqueController::class, 'get_produtos_filtro']);
    Route::put('/update-estoques', [\App\Http\Controllers\Admin\EstoqueController::class, 'update_estoques']);
    //PEDIDOS
    Route::resource('/pedidos', PedidosController::class);

    Route::get('/get_pedidos', [\App\Http\Controllers\Admin\PedidosController::class, 'get_pedidos']);


    //CATEGORIAS
    Route::resource('/categoria', CategoriaController::class);
    //TAMANHO
    Route::resource('/tamanho', TamanhoController::class);
    //COR
    Route::resource('/cor', CoresController::class);
    //PESQUISA DE CATEGORIAS
    Route::get('/get_categorias', [\App\Http\Controllers\Admin\CategoriaController::class, 'get_categorias']);
    //PESQUISA DE TAMANHOS
    Route::get('/get_tamanhos', [\App\Http\Controllers\Admin\TamanhoController::class, 'get_tamanhos']);
    //PESQUISA DE CORES
    Route::get('/get_cores', [\App\Http\Controllers\Admin\CoresController::class, 'get_cores']);

    //CORREIO ROTAS INTERNAS
    Route::post('/post-codigo-rastreio', [\App\Http\Controllers\Admin\PedidosController::class, 'post_codigo_rastreio']);
});
