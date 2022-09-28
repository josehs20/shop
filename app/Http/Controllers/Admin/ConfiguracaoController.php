<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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
    public function alterar_meus_dados(Request $request){
        //VERIFCA SE A SENHA INFORMADA NO SWEETALERT É A MESMA DO USUARIO
        //SE FOR A MESMA SENHA ELE DEIXA ATUALIZAR OS DADOS EMAIL E NOME
        if($this->service->confirmar_com_senha($request->password)){
            User::find(auth()->user()->id)->update(['name' => $request->name, 'email' => $request->email]);
            return response()->json(['valido' => true, 'msg' => 'Dados alterados com sucesso!', 'nomeUsuario' => $request->name], 200);
        }else{
            return response()->json([ 'valido' => false, 'msg' => 'A senha não confere!'], 200);
        }
    }
    public function meus_dados($id){
        return view('admin.config.meusDados');
    }

    //ALTERAR SENHA DO USUARIO
    public function alterar_senha_usuario(Request $request){
        if($this->service->confirmar_com_senha($request->password)){
            User::find(auth()->user()->id)->update(['password' => Hash::make($request->novaSenha)]);
            return response()->json(['valido' => true, 'msg' => 'Senha alterada com sucesso!'], 200);
        }else{
            return response()->json([ 'valido' => false, 'msg' => 'A senha não confere!'], 200);
        }
    }
    public function alterar_senha($id){
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
}
