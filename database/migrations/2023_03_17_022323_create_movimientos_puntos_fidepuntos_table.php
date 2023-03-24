<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMovimientosPuntosFidepuntosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('fidepuntos')->create('movimientos_puntos_fidepuntos', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('pedido_id')->unsigned();
            $table->integer('puntaje_anterior');
            $table->string('tipo');
            $table->integer('puntos_compras_id')->unsigned()->nullable();
            $table->integer('puntos_productos_id')->unsigned()->nullable();
            $table->integer('puntos_otrogados');
            $table->integer('puntos_actuales');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('fidepuntos')->dropIfExists('movimientos_puntos_fidepuntos');
    }
}
