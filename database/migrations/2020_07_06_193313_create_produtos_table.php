<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProdutosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produtos', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->unsignedBigInteger("categoria");
            $table->string('slug');
            $table->string('imagem');
            $table->string('descricao');
            $table->string('preco');
            $table->string("informacoes")->nullable();
            $table->string("parcelamento")->nullable();
            $table->timestamps();

            $table->foreign('categoria')->references('categoria')->on('categorias');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('produtos');
    }
}
