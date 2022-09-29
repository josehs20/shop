<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\GeralRepositorie;

class PedidosController extends Controller
{
    public function __construct(GeralRepositorie $geral)
    {
       $this->geral = $geral;
    }

    public function index(Request $request)
    {
        return view('admin.pedidos.index');
    }

    public function get_pedidos(Request $request)
    {
        if ($request->nome) {
           $pedidos = $this->geral->get_pedidos_nome($request->nome);
        }else {
            $pedidos = $this->geral->get_pedidos_nome();
        }
        return response()->json($pedidos);
    }
}
