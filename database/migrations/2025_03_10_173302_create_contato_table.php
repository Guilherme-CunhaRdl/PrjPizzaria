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
        Schema::create('contato', function (Blueprint $table) {
            $table->id(); // Criar a coluna 'id' como chave primária
            $table->string('nomeContato'); // Coluna 'nomeContato'
            $table->string('emailContato'); // Coluna 'emailContato'
            $table->string('assuntoContato'); // Coluna 'assuntoContato'
            $table->text('mensagemContato'); // Coluna 'mensagemContato'
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
        Schema::dropIfExists('contato');
    }
};
