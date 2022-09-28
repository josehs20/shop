<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProdTamCor extends Model
{
    protected $table = 'prod_tam_cor';
    protected $fillable = [
        'id',
        'produto_id',
        'tamanho_id',
        'cor_id',
        'custo',
        'preco'
    ];

    public function produto()
    {
        return $this->hasOne('App\Models\Produto', 'id', 'produto_id');
    }

    public function imagens()
    {
        return $this->hasMany('App\Models\Imagem', 'produto_id', 'produto_id');
    }

    public function tamanho()
    {
        return $this->hasOne('App\Models\Tamanho','id', 'tamanho_id');
    }

    public function cor()
    {
        return $this->hasOne('App\Models\Cor', 'id', 'cor_id');
    }

    public function estoque()
    {
        return $this->hasOne('App\Models\Estoque');
    }

    public function get_relacao_cores_ptc($id)
    {
      $ptc = ProdTamCor::with(['produto', 'tamanho', 'cor', 'estoque'])->where('cor_id', $id)
      ->get();
      return $ptc;
    }
    public function destroy_prod_tam_cor($id)
    {
        $ptc = ProdTamCor::find($id);
        dd($ptc);
        $ptc->delete();
        return $ptc;
    }
}
