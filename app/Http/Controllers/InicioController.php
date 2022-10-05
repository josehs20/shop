<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Imagem;
use App\Models\ProdTamCor;
use App\Models\Produto;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\FuncCall;

class InicioController extends Controller
{
    public function index($produto = null)
    {
        $tamanhos = [];
        $cores = [];
        $produtoIndividual = [];

        $categorias = Categoria::all();
        if (!$produto) {
            $produtos = Produto::with(['prodTamCors' => function ($query) {
                $query->with(['imagens' => function ($query) {
                    $query->where('prioridade', 1)->get();
                }]);
            }])->get()->map(function ($value) {
                $maior = $value->prodTamCors()->orderBy('preco', 'desc')->first()->preco;
                $menor = $value->prodTamCors()->orderBy('preco', 'asc')->first()->preco;
                $mm = [
                    'precoMaior' => $maior,
                    'precoMenor' => $menor,
                    'nome' => $value->nome,
                    'imagem' => $value->prodTamCors[0]->imagens,
                    'idProduto' => $value->id
                ];
                return $mm;
            });
        } else {
            $produtos = [];
            $prod = new Produto();
            $produtoIndividual = $prod->get_produto_id($produto);
            $ptc = $produtoIndividual->map(function ($value) {
                return [
                    'tamanhos' => $value->tamanho->nome,
                    'cores' => $value->cor->nome,
                    'precos' => $value->preco
                ];
            })->toArray();
            foreach ($ptc as $key => $value) {
                $tamanhos[] = $value['tamanhos'];
                $cores[] = $value['cores'];
            }
            $tamanhos = array_unique($tamanhos);
            $cores = array_unique($cores);  
        }


        // dd($produtoIndividual);
        return view('usuarios.welcome', compact('categorias', 'produtos', 'produtoIndividual', 'tamanhos', 'cores'));
    }
}
