<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->string('nro_orden');
            $table->integer('mesa_id')->unsigned();
            $table->integer('cliente_id')->unsigned();
            $table->integer('menu_id')->unsigned();
            $table->integer('cantidad');
            $table->enum('status', ['cancelado', 'en_espera', 'en_preparacion', 'listo', 'entregado', 'pagado'])->default('en_espera');
            $table->timestamps();

            //Relations
            $table->foreign('mesa_id')->references('id')->on('mesas')
                  ->onDelete('CASCADE')
                  ->onUpdate('CASCADE');

            $table->foreign('cliente_id')->references('id')->on('clientes')
                  ->onDelete('CASCADE')
                  ->onUpdate('CASCADE');

            $table->foreign('menu_id')->references('id')->on('menus')
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
        Schema::dropIfExists('pedidos');
    }
}
