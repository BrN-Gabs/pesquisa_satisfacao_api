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
            $table->string('nome')->length(100);
            $table->string('email')->nullable();
            $table->string('senha');
            $table->string('telefone')->length(11);
            $table->string('cpf')->length(11);
            $table->string('cep')->length(8);
            $table->string('cidade');
            $table->string('estado');
            $table->string('endereco');
            $table->string('bairro');
            $table->string('numero');
            $table->unsignedBigInteger('perfils_id')->nullable();
            $table->foreign('perfils_id')->references('id')->on('perfils');
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
        Schema::dropIfExists('clientes');
    }
};
