<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ItensPedidoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pedidos = DB::table('pedidos')->pluck('id');
        $pizzas = DB::table('pizzas')->pluck('id');

        if ($pedidos->isEmpty() || $pizzas->isEmpty()) {
            // Não insere se não houver dados suficientes
            return;
        }

        $tamanhos = ['pequena', 'media', 'grande'];

        DB::table('itens_pedido')->insert([
            [
                'idPedido' => $pedidos->random(),
                'idPizza' => $pizzas->random(),
                'tamanho' => 'media',
                'quantidade' => 2,
                'preco_unitario' => 32.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'idPedido' => $pedidos->random(),
                'idPizza' => $pizzas->random(),
                'tamanho' => 'grande',
                'quantidade' => 1,
                'preco_unitario' => 45.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'idPedido' => $pedidos->random(),
                'idPizza' => $pizzas->random(),
                'tamanho' => 'pequena',
                'quantidade' => 3,
                'preco_unitario' => 20.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
