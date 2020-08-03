
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
            $table->string('nome')->unique();
            $table->foreignId("categoria");
            $table->string('slug')->unique();
            $table->string('imagem');
            $table->string('descricao');
            $table->string('preco');
            $table->text("informacoes")->nullable();
            $table->string("parcelamento")->nullable();
            $table->string("emPromo")->nullable();
            $table->string("promo")->nullable();
            $table->string("valorDescontado")->nullable();
            $table->timestamps();

            $table->foreign('categoria')->references('id')->on('categorias')->onDelete('CASCADE');
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
