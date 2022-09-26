<?php

namespace App\Repositories;

use App\Models\Categoria;
use App\Models\Cor;
use App\Models\ProdTamCor;
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

    public function filtro_prod_tam_cor($colum, $ids)
    {
        return ProdTamCor::with(['produto', 'tamanho', 'cor', 'estoque', 'imagens'])->whereIn($colum, $ids)->get()->groupBy('produto_id');
    }
}
