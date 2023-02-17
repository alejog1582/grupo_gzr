<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClienteFidepuntosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('fidepuntos')->create('cliente_fidepuntos', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('tipo');
            $table->string('identificacion');
            $table->string('nombre_completo');
            $table->string('nombre_comercial')->nullable();
            $table->integer('puntos_total');
            $table->string('codigo_cliente');
            $table->integer('membresia_id')->nullable()->unsigned();
            $table->boolean('otorgada_membresia')->nullable();
            $table->date('fecha_otorgada_membresia')->nullable();
            $table->boolean('procesar_membresia')->nullable();
            $table->string('celular');
            $table->string('telefono')->nullable();
            $table->string('email');
            $table->string('direccion')->nullable();
            $table->string('ciudad')->nullable();
            $table->string('barrio')->nullable();
            $table->string('codigo_postal')->nullable();
            $table->string('latitud')->nullable();
            $table->string('longitud')->nullable();
            $table->integer('compania_id')->unsigned();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('fidepuntos')->dropIfExists('cliente_fidepuntos');
    }
}
