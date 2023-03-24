<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePedidosxProductosFidepuntosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('fidepuntos')->create('pedidosx_productos_fidepuntos', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('pedido_id')->unsigned();
            $table->string('codigo_producto');
            $table->integer('producto_id')->unsigned();
            $table->integer('cantidad');
            $table->string('objetivo');
            $table->boolean('oferta')->nullable();
            $table->integer('precio_unitario')->nullable();
            $table->integer('iva')->nullable();
            $table->integer('impoconsumo')->nullable();
            $table->decimal('descuento_porcentaje',9,2)->nullable();
            $table->integer('descuento_valor')->nullable();
            $table->integer('precio')->nullable();
            $table->integer('precio_puntos')->nullable();
            $table->boolean('fidelizacion')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('fidepuntos')->dropIfExists('pedidosx_productos_fidepuntos');
    }
}
