<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Imagem;
use App\Models\Produto;
use Illuminate\Http\Request;

class InicioController extends Controller
{
    public function index(){
        $categorias = Categoria::all();
        $produtos = Produto::all();
        return view('usuario.welcome', compact('categorias', 'produtos'));
    }
}
