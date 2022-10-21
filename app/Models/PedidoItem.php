<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PedidoItem extends Model
{
    protected $table = 'pedido_itens';
    protected $fillable = [
        'pedido_id',
        'ptc_id',
        'quantidade'
    ];

    public function ptc()
    {
        return $this->hasOne('App\Models\ProdTamCor','id', 'ptc_id');
    }

    public function prodTamCors()
    {
        return $this->hasOne('App\Models\ProdTamCor', 'id', 'ptc_id');
    }

}
