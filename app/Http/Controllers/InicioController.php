<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;

class InicioController extends Controller
{
    public function index(){
        $categorias = Categoria::all();
        return view('usuario.welcome', compact('categorias'));
    }
}
