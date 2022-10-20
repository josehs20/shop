<?php

namespace App\Http\Controllers\Usuario;

use App\Http\Controllers\Controller;
use App\Models\Pedido;
use App\Models\PedidoItem;
use App\Models\ProdTamCor;
use App\Repositories\GeralRepositorie;
use App\Services\GeralServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PedidosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $geralR = new GeralRepositorie();
        $ctc = $geralR->get_tam_cor_cat();
        $tamanhoall = $ctc['tamanho_id'];
        $corall = $ctc['cor_id'];
        $categorias = $ctc['categoria_id'];
        $produtoIndividual = [];
        $produtos = [];

        return view('usuarios.carrinho.carrinho', compact('categorias', 'tamanhoall', 'corall', 'produtoIndividual', 'produtos'));
    }

    public function finalizar_pedido()
    {
        $geralR = new GeralRepositorie();
        $ctc = $geralR->get_tam_cor_cat();

        // $tamanhoall = $ctc['tamanho_id'];
        // $corall = $ctc['cor_id'];
        // $categorias = $ctc['categoria_id'];

        $enderecos = auth()->user() ?  auth()->user()->enderecos()->get() : null;

        return view('usuarios.finalizarPedido.finalizarPedido', compact('ctc', 'enderecos'));
    }

    public function get_pedidos_ptc(Request $request, ProdTamCor $prodTamCor)
    {
        $pedidos = [];

        //get ptc no banco 
        if ($request->getPedidoBd && auth()->user()) {

            $pedido = Pedido::with('pedido_itens')->where('user_id', auth()->user()->id)->where('status', 'crr')->first();
            $consulta = $pedido->pedido_itens()->with(['prodTamCors' => function ($query) {
                $query->with(['produto', 'tamanho', 'cor', 'estoque', 'imagens']);
            }])->get();

            foreach ($consulta as $key => $v) {
                $v->prodTamCors->quantidade = $v->quantidade;
                $v->prodTamCors->id_pedido = $pedido->id;
                $v->prodTamCors->id_pedido_item = $v->id;
                $pedidos[$v->prodTamCors->produto_id][] = $v->prodTamCors;
            }

            return response()->json([$pedidos]);
        }
        //get ptc de acordo com localstorage
        if (count($request->ptcProduto) > 0) {
            foreach ($request->ptcProduto as $key => $ptcs) {
                $geralR = new GeralRepositorie($prodTamCor);
                $geralR->query_base_pedido_storage();
                $produto_id = $ptcs['produto_id'];
                foreach ($ptcs as $coluna => $value) {
                    if ($coluna != 'quantidade') {
                        $geralR->where_comum($coluna, $value);
                    }
                }
                $pedidos[$produto_id][] = $geralR->first_comum();
            }
        }

        return response()->json([$pedidos]);
    }

    public function get_ptc_relacao_tamanho_cor(Request $request, ProdTamCor $prodTamCor)
    {
        $geralR = new GeralRepositorie($prodTamCor);
        $geralR->query_base_pedido_storage();
        foreach ($request->all() as $coluna => $value) {
            $geralR->where_comum($coluna, $value);
        }
        $relacao = $geralR->get_comum();

        return response()->json($relacao);
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
    public function set_pedidos_itens(Request $request)
    {
        $geralS = new GeralServices();

        if ($request->localStorage) {
            $pedido = Pedido::create([
                'valor_total' => 0,
                'status' => 'crr',
                'numero_pedido' =>  $geralS->gera_numero_pedido(),
                'data' => now('America/Sao_Paulo')->format('Y-m-d H:i:s'), //now('America/Sao_Paulo')->format('Y-m-d H:i:s'),
                'user_id' => auth()->user()->id,
            ]);

            $valor_total = [];

            foreach ($request->localStorage as $key => $value) {
                $ptc = ProdTamCor::where('produto_id', $value['produto_id'])->where('cor_id', $value['cor_id'])->where('tamanho_id', $value['tamanho_id'])->first();
                $valor_total[] = $ptc->preco * $value['quantidade'];
                $pedido->pedido_itens()->create(['ptc_id' => $ptc->id, 'quantidade' => $value['quantidade']]);
            }

            $pedido->update(['valor_total' => array_sum($valor_total)]);
        }
        return response()->json(['pedido' => $pedido]);
    }

    public function set_item(Request $request)
    {
        $geralS = new GeralServices();
        $ptc = ProdTamCor::where('produto_id', $request->item['produto_id'])->where('cor_id', $request->item['cor_id'])->where('tamanho_id', $request->item['tamanho_id'])->first();
        $pedido = Pedido::with('pedido_itens')->where('user_id', auth()->user()->id)->where('status', 'crr')->first();
        if (!$pedido) {
            //cria pedido no carrinho caso não exista
            $pedido = Pedido::create([
                'valor_total' => 0,
                'status' => 'crr',
                'numero_pedido' =>  $geralS->gera_numero_pedido(),
                'data' => now('America/Sao_Paulo')->format('Y-m-d H:i:s'), //now('America/Sao_Paulo')->format('Y-m-d H:i:s'),
                'user_id' => auth()->user()->id,
            ]);
        }
        $verificaItem = $pedido->pedido_itens()->where('ptc_id', $ptc->id)->first();
        if (!$verificaItem) {
        
            $pedido->pedido_itens()->create(['ptc_id' => $ptc->id, 'quantidade' => $request->item['quantidade']]);
            $this->update_valor_total_pedido($pedido->id);
            return response()->json(['icon' => 'success', 'msg' => 'Item adicionado com sucesso !']);
        } elseif ($verificaItem && $request->item['quantidade'] != $verificaItem->quantidade) {
            $verificaItem->update(['quantidade' => $request->item['quantidade']]);
            $this->update_valor_total_pedido($pedido->id);
            return response()->json(['icon' => 'success', 'msg' => 'Item atualizado com sucesso !']);
        } else {
            return response()->json(['icon' => 'info', 'msg' => 'Item da mesma cor, tamanho e quantidade já existe !']);
        }
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
    public function deleta_item(Request $request)
    {
        $item = PedidoItem::find($request->item['id_pedido_item'])->delete();
        $this->update_valor_total_pedido($request->item['id_pedido']);
        return response()->json(true);
    }

    public function altera_quantidade_item(Request $request)
    {
        $item = PedidoItem::find($request->item['id_pedido_item']);
        $quantidade = $request->operador == '+' ? $item->quantidade + 1 : $item->quantidade - 1;
        if ($quantidade == 0) {
            $item->update(['quantidade' => 0]);
            return response()->json(['zerado' => 'Este item esta com a quantidade 0, deseja excluir?']);
        } else {
            $item->update(['quantidade' => $quantidade]);
            $this->update_valor_total_pedido($request->item['id_pedido']);
            return response()->json(true);
        }
    }

    public function update_valor_total_pedido($id_pedido)
    {
        $pedido = Pedido::with(['pedido_itens' => function ($query) {
            $query->with('prodTamCors');
        }])->find($id_pedido);

        $valor_total = [];

        foreach ($pedido->pedido_itens as $key => $item) {
            $valor_total[] = $item->prodTamCors->preco * $item->quantidade;
        }

        return $pedido->update(['valor_total' => array_sum($valor_total)]);
    }

    public function get_pedido($id_pedido)
    {
        $pedido = Pedido::with('pedido_itens')->find($id_pedido);
        $consulta = $pedido->pedido_itens()->with(['prodTamCors' => function ($query) {
            $query->with(['produto', 'tamanho', 'cor', 'estoque', 'imagens']);
        }])->get();

        foreach ($consulta as $key => $v) {
            $v->prodTamCors->quantidade = $v->quantidade;
            $v->prodTamCors->id_pedido = $pedido->id;
            $v->prodTamCors->id_pedido_item = $v->id;
            $pedidos[$v->prodTamCors->produto_id][] = $v->prodTamCors;
        }

        return response()->json([$pedidos]);
    }
}
