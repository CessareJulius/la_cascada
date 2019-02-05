<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClienteMesaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cliente_mesa', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cliente_id')->unsigned();
            $table->integer('mesa_id')->unsigned();
            $table->timestamps();

            //Relations
            $table->foreign('cliente_id')->references('id')->on('clientes')
                  ->onDelete('CASCADE')
                  ->onUpdate('CASCADE');

            $table->foreign('mesa_id')->references('id')->on('mesas')
                  ->onDelete('CASCADE')
                  ->onUpdate('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cliente_mesa');
    }
}
