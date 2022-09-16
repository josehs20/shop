<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InicioBanco extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tamanhos = ['PP', 'M', 'G'];
        foreach ($tamanhos as $key => $value) {
            DB::table('tamanhos')->insert([
                'nome' => $value,
            ]);
        }

        $cores = [
            ['nome' => 'azul', 'codigo' => '#6A5ACD'],
            ['nome' => 'amarelo', 'codigo' => '#FFFF00'],
            ['nome' => 'preto', 'codigo' => '#000000'],
            ['nome' => 'branco', 'codigo' => '#ffff']
        ];
    
        foreach ($cores as $key => $value) {
            DB::table('cores')->insert($value);
        }
        $categorias = ['Blusa', 'Calça', 'Short'];
        foreach ($categorias as $key => $value) {
            DB::table('categorias')->insert([
                'nome' => $value,
            ]);
        }
    }
}
