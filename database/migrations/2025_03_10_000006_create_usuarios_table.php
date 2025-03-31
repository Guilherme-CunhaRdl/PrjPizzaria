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
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id();
            $table->string('nomeUsuario', 100);
            $table->date('dataNasc')->nullable();
            $table->string('cpfUsuario', 15)->nullable();
            $table->string('rgUsuario', 15)->nullable();
            $table->string('imgUsuario', 36)->nullable();
            $table->string('emailUsuario', 100);
            $table->string('senhaUsuario', 255);
            $table->string('logradouroUsuario', 255)->nullable();
            $table->string('numeroUsuario', 10)->nullable();
            $table->string('complementoUsuario', 100)->nullable();
            $table->string('bairroUsuario', 100)->nullable();
            $table->string('cidadeUsuario', 100)->nullable();
            $table->string('estadoUsuario', 2)->nullable();
            $table->string('cepUsuario', 9)->nullable();
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
        Schema::dropIfExists('usuarios');
    }
};
