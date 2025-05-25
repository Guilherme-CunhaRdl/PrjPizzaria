<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PizzaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('pizzas')->insert([
            [
                'nomePizza' => 'Calabresa',
                'valorPequenaPizza' => 20.00,
                'valorMediaPizza' => 30.00,
                'valorGrandePizza' => 40.00,
                'ingredientesPizza' => 'Molho de tomate, mussarela, calabresa, cebola, orégano',
                'categoriaPizza' => 'Tradicional',
                'imgPizza' => 'images/calabresa.jpg',
                'destaque' => true,
                'promocao' => false,
                'disponivel' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nomePizza' => 'Frango com Catupiry',
                'valorPequenaPizza' => 22.00,
                'valorMediaPizza' => 32.00,
                'valorGrandePizza' => 42.00,
                'ingredientesPizza' => 'Molho de tomate, mussarela, frango desfiado, catupiry, orégano',
                'categoriaPizza' => 'Especial',
                'imgPizza' => 'images/frango_catupiry.jpg',
                'destaque' => true,
                'promocao' => true,
                'disponivel' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nomePizza' => 'Quatro Queijos',
                'valorPequenaPizza' => 25.00,
                'valorMediaPizza' => 35.00,
                'valorGrandePizza' => 45.00,
                'ingredientesPizza' => 'Molho de tomate, mussarela, parmesão, catupiry, provolone',
                'categoriaPizza' => 'Queijos',
                'imgPizza' => 'images/quatro_queijos.jpg',
                'destaque' => false,
                'promocao' => false,
                'disponivel' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
