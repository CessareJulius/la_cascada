<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->increments('id');
            $table->string('codigo')->unique();
            $table->string('nombre');
            $table->text('descripcion');
            $table->string('precio');
            $table->time('tiempo_preparacion');
            $table->enum('status', ['disponible', 'agotado'])->default('disponible');
            $table->integer('cantidad')->nullable();
            $table->integer('categoria_id')->unsigned();
            $table->string('imagen')->default('item-default.jpg');
            $table->timestamps();

            //Relations
            $table->foreign('categoria_id')->references('id')->on('categorias')
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
        Schema::dropIfExists('menus');
    }
}
