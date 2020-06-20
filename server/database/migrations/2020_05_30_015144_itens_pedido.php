<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ItensPedido extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('itens_pedido', function (Blueprint $table) {
            $table->increments('id_item_produto');
            $table->unsignedInteger('id_produto');
            $table->unsignedInteger('id_pedido');
            $table->tinyInteger('avaliacao_produto')->nullable()    ;
            $table->foreign('id_produto')->references('id_produto')->on('produtos');
            $table->foreign('id_pedido')->references('id_pedido')->on('pedidos');
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
        Schema::dropIfExists('itens_pedidos');
    }
}
