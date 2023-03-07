<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlanPuntosxCompaniaFidepuntosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('fidepuntos')->create('plan_puntosx_compania_fidepuntos', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('plan_puntos_id')->unsigned();
            $table->integer('compania_id')->unsigned();
            $table->boolean('activo');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('fidepuntos')->dropIfExists('plan_puntosx_compania_fidepuntos');
    }
}
