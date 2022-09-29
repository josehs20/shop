<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePedidosTable extends Migration
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

            $table->decimal("valor_total", 10, 2);
            $table->string("status", 20);
            $table->integer('numero_pedido');
            $table->datetime("data");
            $table->unsignedBigInteger("endereco_id")->nullable();
            $table->unsignedBigInteger('user_id');
            $table->timestamps();

            $table->foreign("endereco_id")->references("id")->on("enderecos")->onDelete("cascade");
            $table->foreign('user_id')->references('id')->on('users')->onDelete("cascade");
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
