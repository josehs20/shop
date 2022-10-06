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
            return response()->json([
                'data' => Correios::calcular_frete($request->pedido),
            ]);
        }else {
            $pedido = new GeralRepositorie($model);
            $pedido->query_base_pedido();
            $pedido->where_comum('id', $request->id_pedido);
            $pedido = $pedido->get_resultado()[0];
            
            return response()->json([
                'data' => Correios::calcular_frete($pedido),
            ]);
        }
       
    }
}
