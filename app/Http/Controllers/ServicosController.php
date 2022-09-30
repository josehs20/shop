<?php

namespace App\Http\Controllers;

use App\Services\ServicosApis;
use Illuminate\Http\Request;

class ServicosController extends Controller
{
    public function calculo_frete(ServicosApis $service)
    {

        $calculo = $service->service_calculo_correio();
        return response()->json([
            'data' => $calculo,
        ]);
    }
}
