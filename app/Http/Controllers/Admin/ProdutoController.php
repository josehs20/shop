<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Categoria;
use App\Models\Cor;
use App\Models\Imagem;
use App\Models\Produto;
use App\Models\Tamanho;
use Illuminate\Http\Request;

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
            $produto = Produto::create(['nome' => remove_espacos($request->nome), 'categoria_id' => $request->categoria]);
        }

        $ptc = $produto->prodTamCors()->where('tamanho_id', $request->tamanho)->where('cor_id', $request->cor)->first();
        if (!$ptc) {
            $ptc = $produto->prodTamCors()->create([
                'tamanho_id' => $request->tamanho,
                'cor_id' => $request->cor,
                'custo' => $request->custo,
                'preco' => $request->preco
            ]);
            
            //cria estoque
            $ptc->estoque()->create(['quantidade' =>  $request->estoque]);

            if (!$ptc->produto->imagens()->count()) {
                $image = new Imagem();
                $image->upload_imagem_produto($request, $ptc->produto);
            }
            return response()->json(['msg' => 'Produto '.$ptc->produto->nome.', do tamanho '.$ptc->tamanho->nome.' e cor '. $ptc->cor->nome.', criado com sucesso!'], 200);
        } else {  
            return response()->json(['msg' => 'Produto da mesma cor e tamanho existente'], 422);
        }
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
