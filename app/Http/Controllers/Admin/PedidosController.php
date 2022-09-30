<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Pedido;
use App\Repositories\GeralRepositorie;

class PedidosController extends Controller
{
    public function __construct(Pedido $pedido)
    {
        $this->pedido = $pedido;
    }

    public function index(Request $request)
    {
        return view('admin.pedidos.index');
    }

    public function get_pedidos(Request $request)
    {
        $pedidos = new GeralRepositorie($this->pedido);

        $pedidos->query_base_pedido();

        if ($request->nome) {
            $pedidos->pedidos_nome_cliente($request->nome); // ($request->nome);
        }
        if ($request->inicial && $request->final) {

            $pedidos->pedidos_datas($request->inicial, $request->final);
        }
        if ($request->cidade) {

            $pedidos->pedidos_cidade($request->cidade);
        }
        if ($request->status) {

            $pedidos->pedidos_status($request->status);
        } else {

            $pedidos->pedidos_nome_cliente();
        }

        return response()->json($pedidos->get_resultado());
    }

    public function show($id)
    {
        return view('admin.pedidos.show');
    }
}
