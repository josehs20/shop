<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Categoria;
use App\Models\Cor;
use App\Models\ProdTamCor;
use App\Models\Produto;
use App\Models\Tamanho;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Faker\Provider\Image;

class ProdutoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.produto.produto', [
            'tamanhos' => Tamanho::get(),
            'cores' => Cor::get(),
            'categorias' => Categoria::get(),
        ]);
    }

    public function get_produtos(Request $request)
    {
        $produtos = Produto::get();
        return response()->json($produtos, 200);
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
        $produto = Produto::with('prodTamCors')->where('nome', $request->nome)->first();

        if (!$produto) {
            $produto = Produto::create(['nome' => $request->nome, 'categoria_id' => $request->categoria]);
            $ptc = true;
        }

        $ptc = $produto->prodTamCors();


        return response()->json($ptc, 200);
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
