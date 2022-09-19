<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estoque extends Model
{
    protected $table = 'estoque';
    protected $fillable = ['quantidade', 'prod_tam_cor_id'];

    public function prodTamCor()
    {
        return $this->hasOne('App\Models\ProdTamCor');
    }
}
