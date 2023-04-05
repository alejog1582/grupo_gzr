<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMensajesFidepuntosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('fidepuntos')->create('mensajes_fidepuntos', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('tipo');
            $table->string('nombre')->nullable();
            $table->string('email')->nullable();
            $table->string('celular')->nullable();
            $table->string('plan_cotizacion')->nullable();
            $table->string('nombre_empresa')->nullable();
            $table->longText('mensaje')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('fidepuntos')->dropIfExists('mensajes_fidepuntos');
    }
}
