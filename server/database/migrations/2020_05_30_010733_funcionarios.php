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
            $table->string('email_funcionario', 45)->unique()->nullable();
            $table->string('cpf_funcionario', 11)->unique()->nullable();
            $table->string('rg_funcionario', 11)->unique()->nullable();
            $table->string('pis_funcionario', 11)->unique()->nullable();
            $table->string('carteira_trabalho_funcionario', 11)->unique()->nullable();
            $table->string('telefone', 11)->nullable();
            $table->string('celular', 11);
            $table->decimal('salario', 8, 2)->nullable();
            $table->string('banco', 100)->nullable();
            $table->string('agencia',5)->nullable();
            $table->string('conta',9)->nullable();
            $table->enum('cargo', ['cozinheiro', 'auxiliar', 'garcon', 'gerente'])->nullable();
            $table->enum('status', ['Cadastrado','contratado', 'desligado', 'ferias']);
            $table->unsignedInteger('id_endereco');
            $table->foreign('id_endereco')->references('id_endereco')->on('enderecos');
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
