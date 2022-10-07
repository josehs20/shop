<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    protected $table = 'pedidos';
    protected $fillable = [
        'valor_total',
        'numero_pedido',
        'status',
        'data',
        'user_id',
        'endereco_id',
        'codRastreio'
    ];

    public function pedido_itens()
    {
        return $this->hasMany('App\Models\PedidoItem');
    }

    public function users()
    {
        return $this->hasOne('App\Models\User', 'id', 'user_id');
    }
    public function endereco()
    {
        return $this->hasOne('App\Models\Endereco', 'id', 'endereco_id');
    }
}
