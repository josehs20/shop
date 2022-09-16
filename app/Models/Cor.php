<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cor extends Model
{
    protected $table = 'cores';
    protected $fillable = [
        'nome',
        'codigo'
    ];

    public function prodTamCors()
    {
        return $this->hasMany('App\Models\ProdTamCor');
    }
}
