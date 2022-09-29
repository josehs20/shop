<?php

namespace App\Services;

use App\Models\Pedido;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Request;

class GeralServices
{
    public function confirmar_com_senha($senha)
    {
        //MESMA SENHA RETORNA TRUE, DIFERENTE RETORNA FALSE
        return Hash::check($senha, auth()->user()->password);
    }

    public function gera_numero_pedido()
    {
        $num = 0;
        while (true) {
            $num = now('America/Sao_Paulo')->format('u');
            if (!Pedido::where('numero_pedido', $num)->first()) {
                break;
            }
        }
        return $num;
    }
}
