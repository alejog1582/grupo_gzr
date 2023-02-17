<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogsImportacionesFidepuntosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('fidepuntos')->create('logs_importaciones_fidepuntos', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('proceso');
            $table->string('identificador_importacion');
            $table->date('fecha_ejecucion');
            $table->integer('user_id')->unsigned();
            $table->string('tipo_cargue');
            $table->integer('numero_fila_excel')->nullable();
            $table->string('resultado');
            $table->string('motivo_decline')->nullable();
            $table->longText('data');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('fidepuntos')->dropIfExists('logs_importaciones_fidepuntos');
    }
}
