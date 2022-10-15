<?php

namespace App\Http\Controllers\Usuario;

use App\Http\Controllers\Controller;
use App\Models\Categoria;
use App\Models\Cor;
use App\Models\ProdTamCor;
use App\Models\Tamanho;
use App\Repositories\GeralRepositorie;
use Illuminate\Http\Request;

class PedidosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $geralR = new GeralRepositorie();
        $ctc = $geralR->get_tam_cor_cat();
        $tamanhoall = $ctc['tamanho_id'];
        $corall = $ctc['cor_id'];
        $categorias = $ctc['categoria_id'];
        $produtoIndividual = [];
        $produtos = [];

        return view('usuarios.carrinho.carrinho', compact('categorias', 'tamanhoall', 'corall', 'produtoIndividual', 'produtos'));
    }

    public function finalizar_pedido()
    {
        return view('usuarios.finalizarPedido.finalizarPedido');
    }

    public function get_pedidos_ptc(Request $request, ProdTamCor $prodTamCor)
    {
        $pedidos = [];
        if (count($request->ptcProduto) > 0) {
            foreach ($request->ptcProduto as $key => $ptcs) {
                $geralR = new GeralRepositorie($prodTamCor);
                $geralR->query_base_pedido_storage();
                $produto_id = $ptcs['produto_id'];
                foreach ($ptcs as $coluna => $value) {
                    if ($coluna != 'quantidade') {
                        $geralR->where_comum($coluna, $value);
                    }
                }
                $pedidos[$produto_id][] = $geralR->first_comum();
            }
        }
   
        return response()->json([$pedidos]);
    }

    public function get_ptc_relacao_tamanho_cor(Request $request, ProdTamCor $prodTamCor)
    {
        $geralR = new GeralRepositorie($prodTamCor);
        $geralR->query_base_pedido_storage();
        foreach ($request->all() as $coluna => $value) {
            $geralR->where_comum($coluna, $value);
        }
        $relacao = $geralR->get_comum();

        return response()->json($relacao);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
