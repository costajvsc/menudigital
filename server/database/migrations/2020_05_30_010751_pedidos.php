<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Pedidos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pedidos', function (Blueprint $table) {
            $table->increments('id_pedido');
            $table->string('nome_cliente', 50);
            $table->string('cpf_cliente', 11)->nullable();
            $table->string('email_cliente', 50);
            $table->string('telefone', 11);
            $table->enum('status', ['Em produção', 'Finalizado', 'Cancelado']);
            $table->tinyInteger('avaliacao_funcionario')->nullable();
            $table->timestamps();
            $table->unsignedInteger('id_funcionario');
            $table->foreign('id_funcionario')->references('id_funcionario')->on('funcionarios');
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
}
