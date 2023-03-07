<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFidelizacionClientesFidepuntosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('fidepuntos')->create('fidelizacion_clientes_fidepuntos', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('config_fidelizacion_cliente_id')->unsigned();
            $table->integer('compra_cliente_id')->unsigned();
            $table->integer('cliente_id')->unsigned();
            $table->date('fecha_compra')->nullable();
            $table->integer('producto_id')->unsigned();
            $table->boolean('canjeado')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('fidepuntos')->dropIfExists('fidelizacion_clientes_fidepuntos');
    }
}
