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
    public function index(){
        $categorias = Categoria::all();
        $produtos = Produto::with('prodTamCors')->get()->map(function($value){
            $maior = $value->prodTamCors()->orderBy('preco', 'desc')->first()->preco;
            $menor = $value->prodTamCors()->orderBy('preco', 'asc')->first()->preco;
            $mm = ['precoMaior' => $maior, 'precoMenor' => $menor, 'nome' => $value->nome];
            return $mm;
        });

        // dd($produtos);
        return view('usuario.welcome', compact('categorias', 'produtos'));
    }
}
