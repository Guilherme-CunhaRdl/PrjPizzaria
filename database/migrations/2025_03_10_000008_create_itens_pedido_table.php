<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('itens_pedido', function (Blueprint $table) {
            $table->id();
            $table->foreignId('idPedido')->constrained('pedidos')->onDelete('cascade');
            $table->foreignId('idPizza')->nullable()->constrained('pizzas')->onDelete('set null');
            $table->foreignId('idBebida')->nullable()->constrained('bebidas')->onDelete('set null');
            $table->foreignId('idSobremesa')->nullable()->constrained('sobremesas')->onDelete('set null');
            $table->foreignId('idAcompanhamento')->nullable()->constrained('acompanhamentos')->onDelete('set null');
            $table->integer('quantidade');
            $table->decimal('precoTotal', 8, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('itens_pedido');
    }
};
