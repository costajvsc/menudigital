<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Funcionarios extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('funcionarios', function (Blueprint $table) {
            $table->increments('id_funcionario');
            $table->string('nome_funcionario', 45);
            $table->string('email_funcionario', 45);
            $table->string('cpf_funcionario', 11);
            $table->string('rg_funcionario', 11);
            $table->string('pis_funcionario', 11);
            $table->string('carteira_trabalho_funcionario', 11);
            $table->string('telefone', 11);
            $table->string('celular', 11);
            $table->decimal('salario', 8, 2);
            $table->string('banco', 100);
            $table->string('agencia',5);
            $table->string('conta',9);
            $table->enum('cargo', ['cozinheiro', 'auxiliar', 'garcon', 'gerente']);
            $table->enum('status', ['contratado', 'desligado', 'ferias']);
            $table->char('ext_foto', 6);
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
        Schema::dropIfExists('funcionarios');
    }
}
