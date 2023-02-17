<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompaniasFidepuntosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('fidepuntos')->create('companias_fidepuntos', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('tipo');
            $table->string('identificacion');
            $table->string('nombre_compania');
            $table->string('nombre_contacto');
            $table->string('celular_contacto');
            $table->string('telefono_contacto')->nullable();
            $table->string('email_contacto');
            $table->string('direccion');
            $table->string('ciudad');
            $table->string('codigo_postal')->nullable();
            $table->boolean('activo');
            $table->boolean('erp');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('fidepuntos')->dropIfExists('companias_fidepuntos');
    }
}
