<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePuntosxComprasFidepuntosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('fidepuntos')->create('puntosx_compras_fidepuntos', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('plan_puntos_compania_id')->unsigned();
            $table->integer('valor_punto');
            $table->integer('valor_punto_canje');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('fidepuntos')->dropIfExists('puntosx_compras_fidepuntos');
    }
}
