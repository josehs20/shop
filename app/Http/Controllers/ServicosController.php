<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Repositories\GeralRepositorie;
use App\Services\Correios;
use Illuminate\Http\Request;
use Illuminate\Support\Fluent;

class ServicosController extends Controller
{
    public function calculo_frete(Request $request, Pedido $model)
    {
        if ($request->cep) {
            //caso cep seja informado vai calcular o frete do item
            return response()->json([
                'data' => Correios::calcular_frete_pedidos($request->pedido),
            ]);
        }else {
            //calcula frete do pedido inteiro ou carrinho
            $pedido = new GeralRepositorie($model);
            $pedido->query_base_pedido();
            $pedido->where_comum('id', $request->id_pedido);
            $pedido = $pedido->get_resultado()[0];
            
            return response()->json([
                'data' => Correios::calcular_frete_pedidos($pedido),
            ]);
        }
       
    }

    public function rastreio_pedido(Request $request)
    {
        if ($request->codigo != '') {
            $response = Correios::rastreio($request->codigo);
            return response()->json([
                //api correios retorna um nível chamado objetos
                'data' => $response['objetos']
            ]);
        }else {
            return response()->json([
                'data' => 'Nenhum codigo informado'
            ]);
        }
      
    }
}
