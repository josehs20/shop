<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\PedidoItem;
use App\Models\User;

class PedidosController extends Controller
{
    public function index(Request $request)
    {
        $itens = PedidoItem::with('ptc')->where('pedido_id', 12)->get()->map(function ($v){
            return $v->ptc;
        });
dd($itens->sum('preco'));
        return view('admin.pedidos.index');
    }
}
