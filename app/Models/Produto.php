<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    protected $table = "produtos";
    protected $fillable = [
        'nome',
        'categoria_id',
    ];

    public function prodTamCors()
    {
        return $this->hasmany('App\Models\ProdTamCor');
    }

    public function imagens()
    {
        return $this->hasMany('App\Models\Imagem');
    }

    static function get_produtos($nome = '')
    {
        $produtos = ProdTamCor::with(['produto', 'tamanho', 'cor', 'estoque', 'imagens'])
            ->whereHas('produto', function ($query) use ($nome) {
                $query->where('nome', 'like', '%' . $nome . '%');
            })->get()->groupBy('produto_id');

        return $produtos;
    }

    static function get_produto_id($id)
    {
        $produto = ProdTamCor::with(['produto', 'tamanho', 'cor', 'estoque', 'imagens'])
            ->where('produto_id', $id)->get();
        return $produto;
    }
}
