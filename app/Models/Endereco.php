<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Endereco extends Model
{
    protected $table = 'enderecos';
    protected $fillable = [
        'rua',
        'numero',
        'bairro',
        'cidade',
        'complemento',
        'referencia',
        'estado',
        'cep',
        'usuario_id'
    ];

    public function enderecosUsuario()
    {
       return $this->hasMany('App\Models\User');
    }
}
