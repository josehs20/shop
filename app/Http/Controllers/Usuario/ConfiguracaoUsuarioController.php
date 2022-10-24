<?php

namespace App\Http\Controllers\Usuario;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Repositories\GeralRepositorie;
use App\Services\GeralServices;
use Illuminate\Http\Request;

class ConfiguracaoUsuarioController extends Controller
{

    public function __construct(GeralServices $service)
    {
        $this->service = $service;
    }

    public function index($id){
        $geralR = new GeralRepositorie();
        $ctc = $geralR->get_tam_cor_cat();
        return view('usuarios.configUsuario.meusDados', compact('id', 'ctc'));
    }

    //ATUALIZANDO OS DADOS DO USUARIO
    public function alterar_meus_dados(Request $request)
    {
        //VERIFCA SE A SENHA INFORMADA NO SWEETALERT É A MESMA DO USUARIO
        //SE FOR A MESMA SENHA ELE DEIXA ATUALIZAR OS DADOS EMAIL E NOME
        if ($this->service->confirmar_com_senha($request->password)) {
            User::find(auth()->user()->id)->update(['name' => $request->name, 'email' => $request->email]);
            return response()->json(['valido' => true, 'msg' => 'Dados alterados com sucesso!', 'nomeUsuario' => $request->name], 200);
        } else {
            return response()->json(['valido' => false, 'msg' => 'A senha não confere!'], 200);
        }
    }
}