<?php

namespace App\Repositories;

use App\Models\Categoria;
use App\Models\Cor;
use App\Models\Estoque;
use App\Models\ProdTamCor;
use App\Models\Produto;
use App\Models\Tamanho;

class GeralRepositorie
{
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
}
