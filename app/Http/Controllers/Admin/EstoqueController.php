<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Estoque;
use App\Models\ProdTamCor;
use App\Models\Produto;
use App\Repositories\GeralRepositorie;

class EstoqueController extends Controller
{
    public function __construct(GeralRepositorie $geral, Produto $prod)
    {
        $this->geral = $geral;
        $this->prod = $prod;
        $this->dadosIniciais = [
            'produtos' => $this->prod->get_produtos(),
            'paramsFiltro' => $this->geral->get_tam_cor_cat(),
        ];
    }
  
    public function index_balanco(Request $request)
    {
        return view('admin.estoque.index-balanco', $this->dadosIniciais);
    }

    public function index_movimentacao(Request $request)
    {
        return view('admin.estoque.index-movimentacao', $this->dadosIniciais);
    }

    public function index_zeramento(Request $request)
    {
        return view('admin.estoque.index-zeramento', $this->dadosIniciais);
    }

    public function get_produtos_filtro(Request $request)
    {

        if ($request->coluna == 'categoria_id') {
            return response()->json($this->geral->filtro_prod_tam_cor_categoria($request->coluna, $request->ids), 200);
        }

        if ($request->coluna == 'quantidade') {
            return response()->json($this->geral->filtro_prod_tam_cor_qtd_estoque($request->coluna, $request->operador, $request->valor), 200);
        }

        if ($request->coluna == 'nome') {
            return response()->json($this->geral->filtro_estoque_nome_produto($request->nome), 200);
        }

        return response()->json($this->geral->filtro_prod_tam_cor($request->coluna, $request->ids), 200);
    }

    public function update_estoques(Request $request)
    {
        if (!count($request->all())) {
            return response()->json(['valido' => false, 'msg' => 'Nenhuma alteração selecionada!.'], 200);
        } else {
            //CASO MOVIMENTO SEJA ADICIONAR OU DIMINUIR ENTRA AQUI
            if (array_key_exists('tipoMovimento', $request->data[0])) { 
                    foreach ($request->data as $key => $v) {
                      $estoque = Estoque::find($v['id']);
                      $estoque->update(['quantidade' => $v['tipoMovimento'] == '-' ? $estoque->quantidade - $v['quantidade'] 
                        : $estoque->quantidade + $v['quantidade']]);
                    }             
            }else {
                //SE MOVIEMNTO FOI ZERAR OU BALANCEAR ENTRA AQUI
                foreach ($request->data as $key => $v) {
                    Estoque::find($v['id'])->update(['quantidade' => $v['quantidade']]);
                }
            }
            return response()->json(['valido' => true, 'msg' => 'Estoque atualizado com sucesso!.', 'dados' => $this->prod->get_produtos()], 200);
        }
    }

    // public function destroy($id)
    // {
    //     $ptc = new ProdTamCor();
    //     $elemento = $ptc->destroy_prod_tam_cor($id);
    //     return response()->json();
    // }
}
