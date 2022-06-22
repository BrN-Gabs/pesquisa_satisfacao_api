<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('nome')->length(100);
            $table->string('email')->nullable();
            $table->string('senha');
            $table->integer('telefone')->length(11);
            $table->integer('cpf')->length(11);
            $table->integer('cep')->length(8);
            $table->string('cidade');
            $table->string('estado');
            $table->string('endereco');
            $table->string('bairro');
            $table->string('numero');
            $table->time('horario');
            $table->unsignedBigInteger('perfil_id');
            $table->foreign('perfil_id')->references('id')->on('perfil');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clientes');
    }
};
