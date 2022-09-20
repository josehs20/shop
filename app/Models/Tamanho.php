<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tamanho extends Model
{
    protected $table = 'tamanhos';
    protected $fillable = [
        'id',
        'nome'
    ];


    public function produtos()
    {
        return $this->hasMany('App\Models\Produto');
    }
}
