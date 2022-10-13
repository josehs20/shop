<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Produto;
use App\Models\User;
use App\Services\GeralServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        if (auth()->user()->perfil == 'administrador') {
            setcookie('p_k_p', User::find(1)->public_key);
            Session::flash('msgAlerta', ['success', 'Bem vindo, ' . auth()->user()->name . '!']);
            return redirect()->route('homeAdmin.index');
        } else {
            setcookie('p_k_p', User::find(1)->public_key);
            $categorias = Categoria::all();
            $produtos = Produto::all();

            return view('usuario.welcome', compact('categorias', 'produtos'));
        }
    }
}
