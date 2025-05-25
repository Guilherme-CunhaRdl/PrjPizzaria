<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('usuarios')->insert([
            [
                'nomeUsuario' => 'João da Silva',
                'dataNasc' => '1990-05-15',
                'cpfUsuario' => '123.456.789-00',
                'rgUsuario' => '12.345.678-9',
                'imgUsuario' => 'images/joao.jpg',
                'emailUsuario' => 'joao@email.com',
                'senhaUsuario' => Hash::make('senha123'),
                'logradouroUsuario' => 'Rua das Flores',
                'numeroUsuario' => '123',
                'complementoUsuario' => 'Apto 101',
                'bairroUsuario' => 'Centro',
                'cidadeUsuario' => 'São Paulo',
                'estadoUsuario' => 'SP',
                'cepUsuario' => '01001-000',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nomeUsuario' => 'Maria Oliveira',
                'dataNasc' => '1985-10-03',
                'cpfUsuario' => '987.654.321-00',
                'rgUsuario' => '98.765.432-1',
                'imgUsuario' => 'images/maria.jpg',
                'emailUsuario' => 'maria@email.com',
                'senhaUsuario' => Hash::make('segura456'),
                'logradouroUsuario' => 'Av. Brasil',
                'numeroUsuario' => '456',
                'complementoUsuario' => null,
                'bairroUsuario' => 'Jardins',
                'cidadeUsuario' => 'Rio de Janeiro',
                'estadoUsuario' => 'RJ',
                'cepUsuario' => '20040-000',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
