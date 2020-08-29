<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePastelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pastels', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome', 100)->comment('Nome do Pastel campo obrigatório');
            $table->decimal('preco', 18,2)->comment('Preço do Pastel campo obrigatório');
            $table->string('foto')->nullable()->comment('Foto do Pastel');
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
        Schema::dropIfExists('pastels');
    }
}
