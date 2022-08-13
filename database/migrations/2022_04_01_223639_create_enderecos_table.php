<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnderecosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enderecos', function (Blueprint $table) {
            $table->id("id");

            $table->string("rua");
            $table->integer("numero");
            $table->string("bairro", 50);
            $table->string("cidade", 100);
            $table->string("complemento");
            $table->string("referencia")->nullable();
            $table->string("estado", 100);
            $table->integer("cep");
            $table->unsignedBigInteger("usuario_id")->unsigned();

            $table->timestamps();

            $table->foreign("usuario_id")
                    ->references("id")->on("users")
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
        Schema::dropIfExists('enderecos');
    }
}
