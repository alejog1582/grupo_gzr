<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComprasClientesFidepuntosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('fidepuntos')->create('compras_clientes_fidepuntos', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('compania_id')->unsigned();
            $table->string('codigo_producto')->nullable();
            $table->integer('producto_id')->unsigned();
            $table->integer('cantidad')->nullable();
            $table->integer('precio_unitario')->nullable();
            $table->integer('iva')->nullable();
            $table->integer('impoconsumo')->nullable();
            $table->integer('precio_total')->nullable();
            $table->integer('numero_pedido')->nullable();
            $table->integer('numero_factura')->nullable();
            $table->integer('identificacion_cliente')->nullable();
            $table->integer('cliente_id')->unsigned();
            $table->date('fecha_compra')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('fidepuntos')->dropIfExists('compras_clientes_fidepuntos');
    }
}
