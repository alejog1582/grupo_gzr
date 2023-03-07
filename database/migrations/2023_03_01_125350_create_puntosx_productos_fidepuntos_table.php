<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePuntosxProductosFidepuntosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('fidepuntos')->create('puntosx_productos_fidepuntos', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('plan_puntos_compania_id')->nullable()->unsigned();
            $table->integer('fabricante_id')->nullable()->unsigned();
            $table->integer('marca_id')->nullable()->unsigned();
            $table->integer('categoria_id')->nullable()->unsigned();
            $table->integer('producto_id')->nullable()->unsigned();
            $table->integer('puntaje_asignado');
            $table->boolean('excluir_puntos_compra')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('fidepuntos')->dropIfExists('puntosx_productos_fidepuntos');
    }
}
