<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePedidoItensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pedido_itens', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ptc_id');
            $table->integer('quantidade');
            $table->unsignedBigInteger('pedido_id');
            $table->timestamps();

            $table->foreign('ptc_id')->references('id')->on('prod_tam_cor')->onDelete("cascade");
            $table->foreign('pedido_id')->references('id')->on('pedidos')->onDelete("cascade");

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pedido_itens');
    }
}
