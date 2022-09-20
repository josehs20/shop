<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Intervention\Image\Facades\Image;

class Imagem extends Model
{
    protected $table = "imagems";
    protected $fillable = [
        'nome',
        'prioridade',
        'id_produto',
    ];

    public function produto()
    {
        return $this->belongsTo('App\Models\Produto');
    }

    static function upload_imagem_produto($request, $produto)
    {
        for ($i = 0; $i < count($request->file('imagens')); $i++) {

            //retira os espaços do nome da imagem
            $nameImage = remove_espacos($request->file('imagens')[$i]->getClientOriginalName());
            
            //baixa para storage/public/imageProduto e cria diretorio e faz o upload de acordo com id do produto
            $dir = $request->file('imagens')[$i]->storeAs('public/imageProduto/'.$produto->id,  $nameImage);
            
            //cria caminho da imagem no banco de acordo com id de produto
            $produto->imagens()->create(['nome' => str_replace('public/', '', $dir)]);

            //recupera imagem para redimencionar
            $img = Image::make('storage/imageProduto/' . $produto->id . '/' . $nameImage);
            $img->resize(400, 500, function ($constraint) {
                $constraint->aspectRatio();
            })->save();
        }
        return;
    }
}
