<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFacturaPedido extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('factura_pedido', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('factura_id')->unsigned();
            $table->integer('pedido_id')->unsigned();
            $table->timestamps();

            //Relations
            $table->foreign('factura_id')->references('id')->on('facturas')
                  ->onDelete('CASCADE')
                  ->onUpdate('CASCADE');

            $table->foreign('pedido_id')->references('id')->on('pedidos')
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
        Schema::dropIfExists('factura_pedido');
    }
}
