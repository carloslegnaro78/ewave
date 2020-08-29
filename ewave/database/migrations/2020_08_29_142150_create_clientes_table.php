<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome', 100)->comment('Nome do Cliente campo obrigatorio');
            $table->string('email',80)->comment('Email do Cliente campo obrigatorio');
            $table->string('telefone', 14)->nullable()->comment('Email do Cliente');
            $table->date('nascimento')->nullable()->comment('Data de nascimento do Cliente');
            $table->string('endereco', 80)->nullable()->comment('Endereço do Cliente');
            $table->string('complemento', 20)->nullable()->comment('Complemento do Cliente');
            $table->string('bairro', 80)->nullable()->comment('Bairro do Cliente');
            $table->string('cep', 8)->nullable()->comment('Cep do Cliente');
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
        Schema::dropIfExists('clientes');
    }
}
