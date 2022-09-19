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

}
