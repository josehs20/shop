<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cor;
use App\Models\ProdTamCor;
use Illuminate\Http\Request;

class CoresController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.cores.cores');
    }
    public function get_cores(Request $request)
    {
        $cores = Cor::where('nome','like', '%'.$request->nome.'%')->get();
        return response()->json($cores, 200);
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
        $cores = Cor::create(['nome' => ucfirst(mb_strtolower(remove_espacos($request->nome))), 'codigo' => $request->codigo]);
        return response()->json('Cor ' . $cores->nome . ' cadastrada com sucesso!', 200);
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
        $ptc = new ProdTamCor();
        $relacaoPtc = $ptc->get_relacao_cores_ptc($id);
        if (count($relacaoPtc)) {
            return response()->json([
                'msg' => 'A cor ' . $relacaoPtc->first()->cor->nome . ' contem relação com produtos e estoque existentes.',
                'contemPTC' => $relacaoPtc->groupBy('produto_id'),
                'texto' => 'Para excluir esta cor, é necessário excluir os produtos vinculados a ela.'
            ], 200);
        } else {
            $cor = Cor::find($id);
            $cor->delete();
            return response()->json('Cor ' . $cor->nome . ' excluída com sucesso!', 200);
        }
    }
}
