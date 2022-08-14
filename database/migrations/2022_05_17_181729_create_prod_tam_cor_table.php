<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProdTamCorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prod_tam_cor', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("produto_id");
            $table->unsignedBigInteger("tamanho_id");
            $table->unsignedBigInteger("cor_id");


            $table->timestamps();

            $table->foreign("produto_id")
                ->references("id")->on("produtos")
                ->onDelete("cascade");

            $table->foreign("tamanho_id")
                ->references("id")->on("tamanhos")
                ->onDelete("cascade");


            $table->foreign("cor_id")
                ->references("id")->on("cores")
                ->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('prod_tam_cor');
    }
}
