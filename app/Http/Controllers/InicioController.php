<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Cor;
use App\Models\Imagem;
use App\Models\ProdTamCor;
use App\Models\Produto;
use App\Models\Tamanho;
use App\Repositories\GeralRepositorie;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\FuncCall;

class InicioController extends Controller
{
    public function index()
    {
        $geralR = new GeralRepositorie();
        $ctc = $geralR->get_tam_cor_cat();

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
        $tamanhos = [];
        $cores = [];
     
        return view('usuarios.produtos.variosProdutos', compact('produtos', 'ctc'));
    }

    public function unico_produto($produto)
    {
        $produtos = [];
        $geralR = new GeralRepositorie();
        $ctc = $geralR->get_tam_cor_cat();
        $produtoIndividual = [];

        $prod = new Produto();
        $produtoIndividual = $prod->get_produto_id($produto);
        $ptc = $produtoIndividual->map(function ($value) {
            return [
                'tamanhos' => $value->tamanho,
                'cores' => $value->cor,
                'precos' => $value->preco
            ];
        })->toArray();
        foreach ($ptc as $key => $value) {
            $tamanhos[] = $value['tamanhos'];
            $cores[] = $value['cores'];
        }
        $tamanhos = array_unique($tamanhos);
        $cores = array_unique($cores);

        return view('usuarios.produtos.unicoProduto', compact('produtoIndividual','ctc'));
    }
}
