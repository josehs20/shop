<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Categoria;
use App\Models\Cor;
use App\Models\Imagem;
use App\Models\ProdTamCor;
use App\Models\Produto;
use App\Models\Tamanho;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
        $consulta = new Produto();
        $produtos = $consulta->get_produtos($request->nome);
        return response()->json(['data' => $produtos], 200);
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
                'custo' => str_replace(',', '.', $request->custo),
                'preco' => str_replace(',', '.', $request->preco)
            ]);

            //cria estoque
            $ptc->estoque()->create(['quantidade' =>  $request->estoque]);
            if (!$ptc->produto->imagens()->count()) {
                $image = new Imagem();
                $image->upload_imagem_produto($request, $ptc->produto);
            }

            return response()->json(['msg' => 'Produto ' . $ptc->produto->nome . ', do tamanho ' . $ptc->tamanho->nome . ' e cor ' . $ptc->cor->nome . ', criado com sucesso!'], 200);
        } else {
            return response()->json(['msg' => 'Produto da mesma cor e tamanho existente'], 422);
        }
    }

    //recebe od atributos da ptc e o id do produto que vai receber a ptc
    public function store_ptc(Request $request, $id)
    {
        $produtoPtc = Produto::find($id);

        $ptc = $produtoPtc->prodTamCors()->where('cor_id', $request->cor_id)->where('tamanho_id', $request->tamanho_id)->first();

        if (!$ptc) {
            $ptc =  $produtoPtc->prodTamCors()->create($request->except('quantidade'));
            $ptc->estoque()->create($request->only('quantidade'));

            $consulta = new Produto();
            $produto = $consulta->get_produto_id($id);

            return response()->json([
                'msg' => 'Produto ' . $ptc->produto->nome . ', do tamanho ' . $ptc->tamanho->nome . ' e cor ' . $ptc->cor->nome . ', criado com sucesso!',
                'produto' => $produto
            ], 200);
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
        $ptc = new Produto();
        $produto = $ptc->get_produto_id($id);
        return view('admin.produto.editProduto', [
            'tamanhos' => Tamanho::get(),
            'cores' => Cor::get(),
            'categorias' => Categoria::get(),
            'produto' => $produto
        ]);
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
        $produto = Produto::find($id);
        $produto->update($request->all());

        return response()->json($produto, 200);
    }

    public function update_ptc(Request $request, $id)
    {
        $produtoPtc = Produto::find($id);

        $ptc = $produtoPtc->prodTamCors()->where('cor_id', $request->cor_id)->where('tamanho_id', $request->tamanho_id)->first();

        if (!$ptc || $ptc->id == $request->ptcId) {

            !$ptc ? ProdTamCor::find($request->ptcId)->update($request->except('ptcId', 'quantidade'))
                : $ptc->update($request->except('ptcId', 'quantidade'));

            $consulta = new Produto();
            $produtoPtc = $consulta->get_produto_id($id);

            return response()->json(['msg' => 'Produto alterado com sucesso', 'produto' => $produtoPtc], 200);
        } else {
            return response()->json(['msg' => 'Produto da mesma cor e tamanho existente'], 422);
        }
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

    //--------------------FUNÇÕES IMAGENS RELACIONADAS AO PRODUTO--------------------//
    public function upload_imagem_produto(Request $request, $id)
    {
        $img = new Imagem();
        $img->upload_imagem_produto($request, Produto::find($id));
        $imagens = $img->get_imagens_produto($id);

        return response()->json(['msg' => 'Upload feito com sucesso!.', 'imagens' => $imagens], 200);
    }

    public function prioridade_imagem(Request $request, $id)
    {
        //Imagem::find($id)->update(['prioridade' => true]);
        $img = new Imagem();
        $imgs = $img->get_imagens_relacao_produto($id);
        $imagPrioridade = $imgs->where('prioridade', true);
        if (!count($imagPrioridade)) {
            $imgs->first()->prioridade =  true;
            $imgs->first()->save();
        } else {
            $imgs->where('prioridade', true)->first()->update(['prioridade' => null]);
            $imgs->find($id)->update(['prioridade' => true]);
            
        }

        return response()->json(['msg' => 'Prioridade de imagem alterada com sucesso!.', 'imagens' => $imgs], 200);
    }

    public function remove_imagem($id)
    {
        $img = new Imagem();
        $imgs = $img->get_imagens_relacao_produto($id);
        if (count($imgs) === 1) {
            return response()->json(['msg' => 'É necessário que o produto tenha no mínimo uma imagem para exibir.'], 422);
        } else {
            $imgDelete = Storage::delete('public/' . $imgs->find($id)->nome);
            if ($imgDelete) {
                
                if ($imgs->find($id)->prioridade) {
                    $imgs->where('prioridade', null)->first()->update(['prioridade' => true]);
                }
                $imgs->find($id)->delete();
                return response()->json([
                    'msg' => 'Imagem deletada com sucesso!.', 'imagens' => $img->get_imagens_produto($imgs->first()->produto->id)
                ], 200);
            } else {
                return response()->json(['msg' => 'Não foi possível tente novamente em alguns instantes'], 200);
            }
        }
    }
}
