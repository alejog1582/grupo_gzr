<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConfigFidelizacionClientesFidepuntosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('fidepuntos')->create('config_fidelizacion_clientes_fidepuntos', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('plan_puntos_compania_id')->unsigned();
            $table->integer('producto_id')->unsigned();
            $table->string('tipo_fidelizacion');
            $table->integer('porcentaje_descuento_canje')->nullable();
            $table->integer('numero_compras_canje')->nullable();
            $table->integer('producto_canjeable_id')->unsigned();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('fidepuntos')->dropIfExists('config_fidelizacion_clientes_fidepuntos');
    }
}
