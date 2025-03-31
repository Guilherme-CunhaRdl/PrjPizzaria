<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePizzasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pizzas', function (Blueprint $table) {
            $table->id(); // Cria a coluna 'id' como chave primária
            $table->string('nomePizza'); // Nome da pizza
            $table->decimal('valorPequenaPizza', 8, 2); // Valor da pizza (com 2 casas decimais)
            $table->decimal('valorMediaPizza', 8, 2); // Valor da pizza (com 2 casas decimais)
            $table->decimal('valorGrandePizza', 8, 2); // Valor da pizza (com 2 casas decimais) 
            $table->text('ingredientesPizza'); // Ingredientes da pizza
            $table->string('categoriaPizza'); // Categoria da pizza
            $table->string('imgPizza')->nullable(); // Caminho da imagem da pizza (pode ser nulo)
            $table->timestamps(); // Adiciona as colunas created_at e updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pizzas');
    }
}
