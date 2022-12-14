<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Pedido;
use App\Repositories\GeralRepositorie;
use App\Services\Correios;
use Whoops\Run;

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

            $pedidos->where_comum('status', $request->status);
        } else {
            $pedidos->pedidos_nome_cliente();
        }

        return response()->json($pedidos->get_resultado_order_data());
    }

    public function show($id)
    {
        $status = ['age', 'acm', 'etr'];
        //MANDA PARA O CONTRUTOR, ESSE CONTRUTOR DE GERALEPOSITORIE PODE RECEBER QUALQUER MODEL
        $pedido = new GeralRepositorie($this->pedido);
        $pedido->query_base_pedido();
        $pedido->where_comum('id', $id);
        $pedido = $pedido->get_resultado_order_data()[0];

        unset($status[array_search($pedido->status, $status)]);

        return view('admin.pedidos.show', ['pedido' => $pedido, 'status' => $status]);
    }

    public function post_codigo_rastreio(Request $request)
    {
        $response = Correios::rastreio($request->codigo);

        if (array_key_exists('eventos', $response['objetos'][0])) {

            $valido = $response['objetos'][0]['codObjeto'];
            Pedido::find($request->id_pedido)->update(['codRastreio' => $valido]);
    
            return response()->json(['valido' => true,'msg' => 'Codigo '. $valido .' registrado com sucesso', $response['objetos']]);
        } else {
            $valido = explode(':', $response['objetos'][0]['mensagem']);
            return response()->json(['valido' => false ,'msg' => $valido[1] . ' ou ainda n??o consta na base de dados dos correios']);
        }
    }
}
