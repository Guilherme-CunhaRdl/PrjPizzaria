<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PedidosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Pegando alguns usuários existentes
        $usuarios = DB::table('usuarios')->pluck('id');

        if ($usuarios->isEmpty()) {
            // Evita erros caso não haja usuários no banco
            return;
        }

        DB::table('pedidos')->insert([
            [
                'idUsuario' => $usuarios->random(),
                'total' => 79.90,
                'taxa_entrega' => 5.00,
                'endereco_entrega' => 'Rua das Palmeiras, 123 - Centro',
                'status' => 'pendente',
                'metodo_pagamento' => 'pix',
                'observacoes' => 'Entregar após as 19h.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'idUsuario' => $usuarios->random(),
                'total' => 99.90,
                'taxa_entrega' => 7.50,
                'endereco_entrega' => 'Av. Principal, 456 - Bairro Novo',
                'status' => 'entregue',
                'metodo_pagamento' => 'cartao',
                'observacoes' => null,
                'created_at' => now()->subDays(1),
                'updated_at' => now()->subDays(1),
            ],
            [
                'idUsuario' => $usuarios->random(),
                'total' => 59.90,
                'taxa_entrega' => 4.00,
                'endereco_entrega' => 'Travessa Um, 789 - Jardim Alegre',
                'status' => 'cancelado',
                'metodo_pagamento' => 'dinheiro',
                'observacoes' => 'Cancelar caso demore mais de 1h.',
                'created_at' => now()->subDays(2),
                'updated_at' => now()->subDays(2),
            ],
        ]);
    }
}
