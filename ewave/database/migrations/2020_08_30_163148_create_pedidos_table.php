<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePedidosTable extends Migration
{

    public function up()
    {
        Schema::create('pedidos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cliente_id')->unsigned();
            $table->foreign('cliente_id')
                        ->references('id')
                        ->on('clientes');
            $table->integer('pastel_id')->unsigned();
            $table->foreign('pastel_id')
                        ->references('id')
                        ->on('pastels');
            $table->softDeletes();            
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('pedidos');
    }
}
