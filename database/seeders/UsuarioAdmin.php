<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsuarioAdmin extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'usuario',
            'email' => 'usuario@gmail.com',
            'password' => Hash::make('12345678'),
            'perfil' => 'administrador',
            'cpf' => '00000000000',
            'telefone' => '912345678',

        ]);
        DB::table('users')->insert([
            'name' => 'Cliente Teste',
            'email' => 'cliente@gmail.com',
            'password' => Hash::make('12345678'),
            'perfil' => 'cliente',
            'cpf' => '1111111111',
            'telefone' => '9999999999',
        ]);
        //------crea enderecos para usuario de cidade diferentes porque as consultas não feitas só por cidades------///
        DB::table('enderecos')->insert([
            'rua' => 'Rua São sebastião',
            'numero' => 50,
            'bairro' => 'Cehab',
            'cidade' => 'Itaperuna',
            'complemento' => 'Casa',
            'referencia' => 'Perto do valão',
            'estado' => 'RJ',
            'cep' => 29300000,
            'user_id' => DB::table('users')->where('perfil', 'cliente')->first()->id,
        ]);
        DB::table('enderecos')->insert([
            'rua' => 'Rua São sebastião',
            'numero' => 50,
            'bairro' => 'Cehab',
            'cidade' => 'Espera Feliz',
            'complemento' => 'Casa',
            'referencia' => 'Perto do valão',
            'estado' => 'RJ',
            'cep' => 29300000,
            'user_id' => DB::table('users')->where('perfil', 'cliente')->first()->id,
        ]);
        DB::table('enderecos')->insert([
            'rua' => 'Rua São sebastião',
            'numero' => 50,
            'bairro' => 'Cehab',
            'cidade' => 'Guarapari',
            'complemento' => 'Casa',
            'referencia' => 'Perto do valão',
            'estado' => 'RJ',
            'cep' => 29300000,
            'user_id' => DB::table('users')->where('perfil', 'cliente')->first()->id,
        ]);
        DB::table('enderecos')->insert([
            'rua' => 'Rua São sebastião',
            'numero' => 50,
            'bairro' => 'Cehab',
            'cidade' => 'Rio de janeiro',
            'complemento' => 'Casa',
            'referencia' => 'Perto do valão',
            'estado' => 'RJ',
            'cep' => 29300000,
            'user_id' => DB::table('users')->where('perfil', 'cliente')->first()->id,
        ]);
        DB::table('enderecos')->insert([
            'rua' => 'Rua São sebastião',
            'numero' => 50,
            'bairro' => 'Cehab',
            'cidade' => 'Goiás',
            'complemento' => 'Casa',
            'referencia' => 'Perto do valão',
            'estado' => 'RJ',
            'cep' => 29300000,
            'user_id' => DB::table('users')->where('perfil', 'cliente')->first()->id,
        ]);
        DB::table('enderecos')->insert([
            'rua' => 'Rua São sebastião',
            'numero' => 50,
            'bairro' => 'Cehab',
            'cidade' => 'Mato Grosso',
            'complemento' => 'Casa',
            'referencia' => 'Perto do valão',
            'estado' => 'RJ',
            'cep' => 29300000,
            'user_id' => DB::table('users')->where('perfil', 'cliente')->first()->id,
        ]);
    }
}
