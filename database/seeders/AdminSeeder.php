<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('admins')->insert([
            [
                'nomeAdmin' => 'Administrador Geral',
                'emailAdmin' => 'admin@pizzaria.com',
                'senhaAdmin' => Hash::make('admin123'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nomeAdmin' => 'Gerente da Loja',
                'emailAdmin' => 'gerente@pizzaria.com',
                'senhaAdmin' => Hash::make('gerente123'),
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
