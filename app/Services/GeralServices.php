<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Request;

class GeralServices
{
    public function confirmar_com_senha($senha){
        //MESMA SENHA RETORNA TRUE, DIFERENTE RETORNA FALSE
        return Hash::check($senha, auth()->user()->password);
    }
}
