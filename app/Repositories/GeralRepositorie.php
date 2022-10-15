<?php

namespace App\Repositories;

use App\Models\Categoria;
use App\Models\Cor;
use App\Models\Estoque;
use App\Models\Pedido;
use App\Models\PedidoItem;
use App\Models\ProdTamCor;
use App\Models\Produto;
use App\Models\Tamanho;
use Illuminate\Database\Eloquent\Model;

class GeralRepositorie
{
    public function __construct(Model $model = null)
    {
        $this->model = $model;
    }
    //pega todos os tamanhos, cores e categorias 
    public function get_tam_cor_cat()
    {
        return [
            'tamanho_id' => Tamanho::get(),
            'cor_id' => Cor::get(),
            'categoria_id' => Categoria::get()
        ];
    }

    public function filtro_prod_tam_cor($coluna, $ids)
    {
        return ProdTamCor::with(['produto', 'tamanho', 'cor', 'estoque', 'imagens'])->whereIn($coluna, $ids)->get()->groupBy('produto_id');
    }

    public function filtro_prod_tam_cor_categoria($coluna, $ids)
    {
        return Produto::with(['prodTamCors' => function ($query) {
            $query->with(['produto', 'tamanho', 'cor', 'estoque', 'imagens']);
        }])->whereIn($coluna, $ids)->get()->map(function ($value) {
            return $value->prodTamCors;
        });
    }

    public function filtro_prod_tam_cor_qtd_estoque($coluna, $operador, $valor)
    {
        return Estoque::with(['prodTamCor' => function ($query) {
            $query->with(['produto', 'tamanho', 'cor', 'estoque', 'imagens']);
        }])->where($coluna, $operador, $valor)->get()->map(function ($value) {
            return $value->prodTamCor;
        })->groupBy('produto_id');
    }

    public function filtro_estoque_nome_produto($nome)
    {
        $produto = new Produto();
        return $produto->get_produtos($nome);
    }

    //-----------------PEDIDOS----------------//

    public function sum_pedido($pedido_id)
    {
        return PedidoItem::with('ptc')->where('pedido_id', $pedido_id)->get()->map(function ($v) {
            return $v->quantidade * $v->ptc->preco;
        })->sum();
    }
    //-----------QUERYS PEDIDO--------//

    /*TODAS A QUERYS FEITAS TEM QUE SER ATUALIZADO O STATUS DO MODEL 
    EX:this->model = query  (metodo get ultilizado por ultimo no controller)*/

    //QUERY BASE "INICIAL" PARA PEDIDOS NO BANCO DE DADOS
    public function query_base_pedido()
    {
        $this->model = $this->model->with(['pedido_itens' => function ($query) {
            $query->with(['ptc' => function ($query) {
                $query->with(['produto' => function ($query) {
                    $query->with('categoriaProduto');
                }, 'tamanho', 'cor', 'estoque']);
            }]);
        }, 'users', 'endereco']);
    }

    //QUERY BASE "INICIAL" PARA PEDIDOS NA STORAGE NO CLIENTE
    public function query_base_pedido_storage()
    {
        $this->model = $this->model->with(['produto', 'tamanho', 'cor', 'estoque', 'imagens']);
    }

    public function pedidos_nome_cliente($nome = null)
    {
        $this->model = $this->model->whereHas('users', function ($query) use ($nome) {
            $query->where('name', 'like', "%$nome%");
        })->whereIn('status', ['acm', 'age']);
        //  return $this->model->get();
        // return Pedido::with(['pedido_itens' => function ($query) {
        //     $query->with(['ptc' => function ($query) {
        //         $query->with(['produto', 'tamanho', 'cor', 'estoque']);
        //     }]);
        // }, 'users', 'endereco'])->whereHas('users', function ($query) use ($nome) {
        //     $query->where('name', 'like', "%$nome%");
        // })->whereIn('status', ['acm', 'age'])->get();
    }

    public function pedidos_datas($inicial, $final)
    {
        $this->model = $this->model->whereIn('status', ['acm', 'age'])
            ->where('data', '>=', $inicial)->where('data', '<=', $final);
        //return $this->model->get();
        // return Pedido::with(['pedido_itens' => function ($query) {
        //     $query->with(['ptc' => function ($query) {
        //         $query->with(['produto', 'tamanho', 'cor', 'estoque']);
        //     }]);
        // }, 'users', 'endereco'])->whereIn('status', ['acm', 'age'])
        //     ->where('data', '>=', $inicial)->where('data', '<=', $final)->get();
    }

    public function pedidos_cidade($cidade)
    {
        $this->model = $this->model->whereHas('endereco', function ($query) use ($cidade) {
            $query->where('cidade', 'like', "%$cidade%");
        })->whereIn('status', ['acm', 'age']);
        //  return $this->model->get();
        // return Pedido::with(['pedido_itens' => function ($query) {
        //     $query->with(['ptc' => function ($query) {
        //         $query->with(['produto', 'tamanho', 'cor', 'estoque']);
        //     }]);
        // }, 'users', 'endereco'])->whereHas('endereco', function ($query) use ($cidade) {
        //     $query->where('cidade', 'like', "%$cidade%");
        // })->whereIn('status', ['acm', 'age'])->get();
    }
    public function where_comum($coluna, $dadoBusca)
    {
        $this->model = $this->model->where($coluna, $dadoBusca);
    }

    public function get_resultado_order_data()
    {
        return $this->model->orderby('data', 'DESC')->get();
    }

    public function first_comum()
    {
        return $this->model->first();
    }
    public function get_comum()
    {
        return $this->model->get();
    }
}
