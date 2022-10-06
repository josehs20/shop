<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Categoria;
use App\Models\Endereco;
use App\Models\User;
use App\Services\GeralServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ConfiguracaoController extends Controller
{
    public function __construct(GeralServices $service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //redirecionando para meus dados para ser a primeira view a aparecer na tela de minha conta
        return redirect()->route('meusdados', auth()->user()->id);
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

    public function meus_dados($id)
    {
        return view('admin.config.meusDados');
    }

    //ALTERAR SENHA DO USUARIO
    public function alterar_senha_usuario(Request $request)
    {
        if ($this->service->confirmar_com_senha($request->password)) {
            User::find(auth()->user()->id)->update(['password' => Hash::make($request->novaSenha)]);
            return response()->json(['valido' => true, 'msg' => 'Senha alterada com sucesso!'], 200);
        } else {

            return response()->json(['valido' => false, 'msg' => 'A senha não confere!'], 200);
        }
    }

    public function alterar_senha($id)
    {
        return view('admin.config.alterarSenha');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    public function index_config_envio(Request $request)
    {
        $categorias = Categoria::all();
        $enderecoOrigem = auth()->user()->enderecos()->first();
        return view('admin.config.configuracao-envio', ['categorias' => $categorias, 'enderecoOrigem' => $enderecoOrigem]);
    }

    public function post_medidas_envio(Request $request)
    {
        $categoria = Categoria::find($request->id);
        // dd($request->all());
        $categoria->update([
            'largura' => $request->largura,
            'altura' => $request->altura,
            'comprimento' => $request->comprimento,
            'peso' => $request->peso,
        ]);

        return response()->json(['categoria' => Categoria::find($request->id), 'msg' => 'Medidas de envio da categoria' . $categoria->nome . 'Alterado com sucesso.']);
    }

    public function post_cep_envio(Request $request)
    {
        $enderecoCep = auth()->user()->enderecos()->first();
        $dadosEndereco = [
            'rua' => 'Envio Admin',
            'numero' => 0,
            'bairro' => 'Envio Admin',
            'cidade' => $request->cidade,
            'complemento' => 'Envio Admin',
            'referencia' => 'Envio Admin',
            'estado' => $request->uf,
            'cep' => $request->cep,
        ];
        if ($enderecoCep) {
            $enderecoCep->update($dadosEndereco);
        } else {
            auth()->user()->enderecos()->create($dadosEndereco);
        }
        return response()->json(true);
    }
}
