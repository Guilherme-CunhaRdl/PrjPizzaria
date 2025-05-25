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
        Schema::create('pedidos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('idUsuario')->constrained('usuarios')->onDelete('cascade');
            $table->decimal('total', 10, 2);
            $table->decimal('taxa_entrega', 10, 2)->default(0);
            $table->string('endereco_entrega');
            $table->string('status')->default('pendente'); // pendente, preparo, entrega, entregue, cancelado
            $table->string('metodo_pagamento'); // dinheiro, cartao, pix
            $table->text('observacoes')->nullable();
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
        Schema::dropIfExists('pedidos');
    }
};
