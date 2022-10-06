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

    public function upload_imagem_produto($request, $produto)
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
            $img->resize(400, 450)->save('storage/imageProduto/' . $produto->id . '/' . $nameImage, null, 'jpg');
            // $img->resize(200, 200, function ($constraint) {
            //     $constraint->aspectRatio();
            //     $constraint->upsize();
            // })->save('storage/imageProduto/'. $nameImage, null, 'jpg');
        }
        return;
    }

    public function get_imagens_produto($id)
    {
        return Imagem::where('produto_id', $id)->get();
    }

    //id da imagem a ser passado
    public function get_imagens_relacao_produto($id)
    {
        return Imagem::find($id)->produto()->first()->imagens()->get();
        
    }
}
