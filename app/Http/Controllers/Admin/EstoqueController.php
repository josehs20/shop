<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ProdTamCor;
use App\Models\Produto;
use App\Repositories\GeralRepositorie;

class EstoqueController extends Controller
{
    public function __construct(GeralRepositorie $geral, Produto $prod)
    {
        $this->geral = $geral;
        $this->prod = $prod;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function index()
    // {
    //     // $prod = new Produto();
    //     // $produtos = $prod->get_produtos();
    //     // return view('admin.estoque.index', ['produtos' => $produtos]);
    // }

    public function index_balanco(Request $request)
    {
        return view('admin.estoque.index-balanco', [
            'produtos' => $this->prod->get_produtos(),
            'paramsFiltro' => $this->geral->get_tam_cor_cat(),
        ]);
    }

    public function index_movimentacao(Request $request)
    {
        return;
    }

    public function get_produtos_filtro(Request $request)
    {
        return response()->json($this->geral->filtro_prod_tam_cor($request->coluna, $request->ids), 200);
    }
    
    public function filtro_categoria_prod_tam_cor()
    {
        return response()->json('foi');
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
        $ptc = new ProdTamCor();
        $elemento = $ptc->destroy_prod_tam_cor($id);
        return response()->json();
    }
}
